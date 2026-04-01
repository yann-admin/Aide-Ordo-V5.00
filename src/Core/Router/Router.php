<?php
    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Core\Router;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        # We include the Road class to get the road configuration, which is a class that contains a static method that returns an array of routes with their corresponding HTTP methods, paths, and controller actions
        use App\config\Road;

        # Class BootApp
        use App\boot\BootApp;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Router {

            /* ▂ ▅ Constants ▅ ▂ */
                const NOT_FOUND = '404 - Page not found';
                const API = '/Aide-Ordo-V5.00';
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
                private static array $roads = [];
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Methodes ▅ ▂ */


                /* ▂ ▅  setRoads  ▅ ▂ */
                public static function setRoads() {
                    self::$roads = Road::getRoad();
                    foreach (self::$roads as $road) {
                        if ($road['method'] === 'GET') {
                            self::get($road['path'], $road['action']);
                        } elseif ($road['method'] === 'POST') {
                            self::post($road['path'], $road['action']);
                        } else {
                            throw new \Exception("Invalid HTTP method: " . $road['method']);
                        }
                    }
                }


                /* ▂ ▅ Get ▅ ▂ */
                /** @param string $path
                 *  @param string $action
                 *  @return void
                 */
                public static function get(string $path, string $action): void{
                    self::addRoute('GET', $path, $action);
                }

                /* ▂ ▅ Post ▅ ▂ */
                /** @param string $path
                 *  @param string $action
                 *  @return void
                 */
                public static function post(string $path, string $action): void {
                    self::addRoute('POST', $path, $action);
                }

                /* ▂ ▅ AddRoute ▅ ▂ */
                /** @param string $method
                 *  @param string $path
                 *  @param string $action
                 *  @return void
                 */
                private static function addRoute(string $method, string $path, string $action): void {
                    self::$roads[] = [
                        'method' => $method,
                        'path' => $path,
                        'action' => $action
                    ];
                }


                /* ▂ ▅ Dispatch ▅ ▂ */
                /** @param string $uri
                 *  @param string $method
                 *  @return void
                 */
                public static function dispatch(string $uri, string $method): void {

                    # We parse the URI to get the path and remove any query parameters
                    $uri = parse_url($uri, PHP_URL_PATH);

                    # We remove the API prefix from the URI if it exists
                    if (strpos($uri, self::API) === 0) {
                        $uri = substr($uri, strlen(self::API));
                    }

                    # If the URI is empty, we set it to the root path
                    $uri = $uri ?: '/';
                    
                    foreach (self::$roads as $road) {
                        # We check if the request method matches the road method, if not we continue to the next road
                        if ($road['method'] !== $method) { continue;}

                        # We convert the road path to a regular expression pattern to match the URI, we replace any {parameter} with a regex group to capture the parameter value
                        # EXAMPLE: /factoryForm/{id} will be converted to the pattern #^/factoryForm/([^/]+)$# to match URIs like /factoryForm/123 and capture the value 123 as the id parameter
                        $pattern = preg_replace('#\{[a-zA-Z]+\}#', '([^/]+)', $road['path']);

                        # We add start and end delimiters to the pattern to ensure it matches the entire URI
                        $pattern = "#^" . "$pattern$#";

                        # We check if the URI matches the pattern, if it does we extract the parameters from the URI and call the corresponding controller and method
                        # EXAMPLE: if the URI is /factoryForm-123 and the route path is /factoryForm-{id}, the pattern will match and we will extract the value 123 as the id parameter to pass to the controller method
                        if (preg_match($pattern, $uri, $params)) {

                            # We remove the first element of the $params array which is the full match of the pattern, we only want the captured groups which are the parameter values
                            # EXAMPLE: if the URI is /factoryForm-123 and the route path is /factoryForm-{id}, the $params array will be [0 => '/factoryForm-123', 1 => '123'], we want to remove the first element to get only the parameter value 123 in the $params array
                            array_shift($params);

                            # We split the action string into the controller name and the method name using the explode function, we use the @ symbol as the delimiter to separate the controller and method
                            # EXAMPLE: if the action is UserController@index, we will split it into $controller = 'UserController' and $method = 'index' to call the index method of the UserController class
                            [$controller, $method] = explode('@', $road['action']);

                            # We build the fully qualified class name of the controller by adding the namespace prefix to the controller name, we assume that all controllers are in the App\src\Controller namespace
                            # EXAMPLE: if the controller is UserController, we will build the class name \App\src\Controller\UserController to instantiate the controller class and call the method
                            $controllerClass = '\\App\\src\\Controller\\' . $controller ;

                            # We check if the controller class exists, if it does not we throw an exception with a message indicating that the controller was not found
                            if (!class_exists($controllerClass)) {
                                throw new \Exception("Controller $controllerClass not found");
                            }

                            # We create an instance of the controller class using the fully qualified class name, we can use the new keyword to instantiate the class and store it in a variable
                            # EXAMPLE: if the controller class is \App\src\Controller\UserController, we will create an instance of the UserController class and store it in the $controllerInstance variable to call the method on that instance
                            $controllerInstance = new $controllerClass();

                            # We check if the method exists in the controller instance, if it does not we throw an exception with a message indicating that the method was not found
                            # EXAMPLE: if the method is index and the controller instance is an instance of the UserController class, we will check if the index method exists in the UserController class, if it does not we will throw an exception indicating that the index method was not found in the UserController class
                            if (!method_exists($controllerInstance, $method)) {
                                throw new \Exception("Method $method not found");
                            }

                            # We call the method on the controller instance and pass the parameters extracted from the URI as arguments, we can use the call_user_func_array function to call the method with the parameters as an array
                            # EXAMPLE: if the method is index, the controller instance is an instance of the UserController class, and the parameters extracted from the URI are [123], we will call the index method of the UserController class with the argument 123 using call_user_func_array([$controllerInstance, $method], $params) which is equivalent to $controllerInstance->index(123)
                            call_user_func_array(
                                [$controllerInstance, $method],
                                $params
                            );

                            return;
                        }
                    }

                    http_response_code(404);
                    header("Location: " . self::API . "/error");
                    echo self::NOT_FOUND;
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */
        }

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
