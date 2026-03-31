<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */
        # Config → contient juste des données / Configurations
        # Builder → construit
        # Manager → gère
        # Renderer → affiche / génère le rendu
        # Factory → crée
        # Service → fournit une logique métier
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Form;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        # We include the Static Request class to handle HTTP requests
        use App\src\Service\Http\Request;

        # We include the Static Token class to handle CSRF tokens
        use App\src\Service\Security\Token;

        # We include the Static MessageConfig class to get the messages for the application
        use App\src\Service\Config\MessageConfig;

        # We include the Static Request class to handle HTTP requests
        use App\src\Service\Security\Field;

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class FormValidator{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  validate() ▅ ▂ */
                /** @param array $data : the data to validate
                 *  @param array $rules : the rules to apply to the data
                 *  @return array : an array containing the errors if there are any, otherwise an empty array */
                public static function validate( string $backUrl ) : array {
                    $filBack = [];
                    $filBack['success'] = true;
                    $filBack['message'] ='';
                    # We get the data from the request body and decode it from JSON to an associative array
                    $filBack['inputs'] = Request::inputDecode() ?? [];
                    
                    # We check if the request method is POST for security reasons, as we only want to accept POST requests for form submissions, and we return an error message if the method is not POST
                    if( !Request::isPost() ){
                    $filBack['success'] = false;
                    $filBack['message'] = MessageConfig::getMessage('method_error', ['redirect_url' => $backUrl]);
                    return $filBack;
                    }
                    
                    # We control Token CSRF for attack prevention using the verifyToken() method from the Token class, which checks if the token is valid and not expired
                    if ( !Token::verifyToken($filBack['inputs']['csrf_token'] ?? '') ) {
                        $filBack['success'] = false;
                        $filBack['message'] = MessageConfig::getMessage('csrf_token_error', ['redirect_url' => $backUrl]);
                        return $filBack;
                    }

                    # We control AntiBot Token for attack prevention using the verifyAntibot() method from the Token class, which checks if the token is valid and not expired
                    if ( !Token::verifyAntibot($filBack['inputs']['antibot'] ?? '') ) {
                        $filBack['success'] = false;
                        $filBack['message'] = MessageConfig::getMessage('antibot_error', ['redirect_url' => $backUrl]);
                        return $filBack;
                    }

                    # We return the errors if there are any, otherwise we return an empty array
                    return $filBack;
                }


                /* ▂ ▅  fieldValidate() ▅ ▂ */
                /** @param array $echapFields : the fields to escape
                 *  @param array $inputsConfig : the configuration for the inputs
                 *  @param array $data : the data to validate
                 *  @param string $backUrl : the URL to redirect to in case of error
                 *  @return array : an array containing the errors if there are any, otherwise an empty array */
                public static function fieldValidate( array $inputsConfig, array $data, string $backUrl ) : array {
                    $filBack = [];
                    $filBack['success'] = true;
                    $filBack['message'] ='';
                    # We execute the login logic if the verification is successful
                    foreach( $inputsConfig as $input => $attributes ){
                        # We echap field arrays for security reasons, as we want to prevent XSS attacks by escaping the data before validating it, and we skip hidden fields as they are not visible to the user and do not need to be validated in the same way as visible fields
                        if ( $attributes['type'] === 'hidden') { continue; }
                        # We clean the data using the cleanData() method from the Field class, which applies htmlspecialchars to prevent XSS attacks
                        $data[$input] = Field::cleanData($data[$input]);

                        # We check if the field is required using the isRequired() method from the Field class, which checks if the value is empty
                        if ( $attributes['required'] && !Field::isRequired($data[$input]) ) {
                            $filBack['success'] = false;
                            $filBack['message'] = MessageConfig::getMessage('field_required_error', ['field' => $input, 'redirect_url' => $backUrl]);
                            return $filBack;
                        }

                        if ( $data[$input] === '' ) { continue; } // We skip empty fields that are not required, as they do not need to be validated

                        # We check if the field has a minimum length using the isMinLength() method from the Field class, which checks if the length of the value is less than the specified minimum
                        if ( isset($attributes['minlength']) && !Field::isMinLength($data[$input], $attributes['minlength']) ) {
                            $filBack['success'] = false;
                            $filBack['message'] = MessageConfig::getMessage('field_min_length_error', ['field' => $input, 'min' => $attributes['minlength'], 'redirect_url' => $backUrl]);
                            return $filBack;
                        }

                        # We check if the field has a maximum length using the isMaxLength() method from the Field class, which checks if the length of the value is greater than the specified maximum
                        if ( isset($attributes['maxlength']) && !Field::isMaxLength($data[$input], $attributes['maxlength']) ) {
                            $filBack['success'] = false;
                            $filBack['message'] = MessageConfig::getMessage('field_max_length_error', ['field' => $input, 'max' => $attributes['maxlength'], 'redirect_url' => $backUrl]);
                            return $filBack;
                        }

                        # We check if the field matches a specific pattern using the validateRegex() method from the Field class, which checks if the value matches the specified regex pattern
                        if ( isset($attributes['pattern']) && !Field::validateRegex($attributes['pattern'], $data[$input]) ) {
                            $filBack['success'] = false;
                            $filBack['message'] = MessageConfig::getMessage('field_pattern_error', ['field' => $input, 'redirect_url' => $backUrl]);
                            return $filBack;
                        }

                    }
                    
                    return $filBack;
                }
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>
