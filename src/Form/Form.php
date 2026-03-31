<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Form;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # We include the Throwable class for error handling
        use \Throwable;

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class Form{

            /* ▂ ▅ Constants ▅ ▂ */
            private const SET_METHOD = "Error in setMethod: ";
            /* ▂▂▂▂▂▂▂▂▂▂▂ */
            
            /* ▂ ▅ Attributs ▅ ▂ */
                private string $method;
                private string $action;
                private string $enctype;
                private string $class;
                private string $id;
                private array $inputs = [];
            
            /* ▂▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ __construct ▅ ▂ */
                    /** @return void */
                    public function __construct(array $configForm = [] ) {
                        $this -> method = $configForm['method'] ?? 'POST';
                        $this -> action = $configForm['action'] ?? '#';
                        $this -> enctype = $configForm['enctype'] ?? 'multipart/form-data';
                        $this -> class = $configForm['class'] ?? 'justify-content-center row validate';
                        $this -> id = $configForm['id'] ?? 'form';
                    }

                /* ▂ ▅ addInput ▅ ▂ */
                /** @return self */
                public function addInput(string $type, string $name, string $value = '', array $attributes = []) : self {
                    $this -> inputs[] = [
                        'type' => $type,
                        'name' => $name,
                        'value' => $value,
                        'attributes' => $attributes
                    ];
                    return $this;
                }

                /* ▂ ▅ addOther ▅ ▂ */
                /** @return self */
                public function addOther( string $element) : self {
                    $this -> inputs[] = [
                        'type' => 'other',
                        'name' => '',
                        'value' => $element,
                        'attributes' => []
                    ];
                    return $this;
                }


                /* ▂ ▅ addToken ▅ ▂ */
                /** @return self */
                public function addToken(string $token) : self {
                    $this -> inputs[] = [
                        'type' => 'hidden',
                        'name' => 'csrf_token',
                        'value' => $token,
                        'attributes' => []
                    ];
                    return $this;
                }
                
                /* ▂ ▅ addAntiRobot ▅ ▂ */
                /** @return self */
                public function addAntiRobot( string $value = '') : self {
                    $this -> inputs[] = [
                        'type' => 'hidden',
                        'name' => 'anti_robot',
                        'value' => $value,
                        'attributes' => []
                    ];
                    return $this;
                }

                /* ▂ ▅  addRedirectUrl() ▅ ▂ */
                /** @param string $backUrl : the URL to redirect to in case of error
                 *  @return self : the form instance with the redirect URL added as a hidden input, which will be used in the JavaScript code to redirect the user to the specified URL in case of error during form submission */
                public function addRedirectUrl(string $backUrl) : self {
                    $this -> inputs[] = [
                        'type' => 'hidden',
                        'name' => 'redirect_url',
                        'value' => $backUrl,
                        'attributes' => []
                    ];
                    return $this;
                }

                /* ▂ ▅ Setters ▅ ▂ */
                /** @return self */
                public function setMethod(string $method) : self {
                    if (!in_array(strtoupper($method), ['GET', 'POST'])) {
                        error_log( self::SET_METHOD . "Invalid form method: $method" );
                        throw new \InvalidArgumentException("Invalid form method: $method");
                    }
                    $this -> method = $method; return $this;
                }

                /** @return self */
                public function setConfig(array $configForm) : self {
                    $this -> method = $configForm['method'] ?? $this -> method;
                    $this -> action = $configForm['action'] ?? $this -> action;
                    $this -> enctype = $configForm['enctype'] ?? $this -> enctype;
                    $this -> class = $configForm['class'] ?? $this -> class;
                    $this -> id = $configForm['id'] ?? $this -> id;
                    return $this;
                }

                /** @return self */
                public function setAction(string $action) : self {$this -> action = $action; return $this;}

                /** @return self */
                public function setEnctype(string $enctype) : self {$this -> enctype = $enctype; return $this;}

                /** @return self */
                public function setClass(string $class) : self {$this -> class = $class; return $this;}

                /** @return self */
                public function setId(string $id) : self {$this -> id = $id; return $this;}

                /* ▂ ▅ Getters ▅ ▂ */
                /** @return string */
                public function getMethod() : string { return $this -> method; }

                /** @return string */
                public function getAction() : string { return $this -> action; }
                
                /** @return string */
                public function getEnctype() : string { return $this -> enctype; }

                /** @return string */
                public function getClass() : string { return $this -> class; }
                
                /** @return string */
                public function getId() : string { return $this -> id; }

                /** @return array */
                public function getInputs() : array { return $this -> inputs; }


        }
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

?>
