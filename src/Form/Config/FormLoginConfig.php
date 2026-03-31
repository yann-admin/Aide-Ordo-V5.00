<?php
    declare(strict_types=1);
    /* ▂ ▅ ▆ █ Information █ ▆ ▅ ▂ */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  NameSpace  █ ▆ ▅ ▂ */
        namespace App\src\Form\Config;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
error_reporting(E_ALL);


        /* *********** OBLIGATORY *********** */
        # We include the RegexConfig class to use the regular expressions for form validation
            use App\config\RegexConfig;
        /* ********************************** */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class FormLoginConfig{

            public static function getLoginFormConfig() : array {

                # We create a new instance of the RegexConfig class to access the regular expressions for form validation
                    $regexConfig = new RegexConfig();
                return [
                    # We define the configuration for the 'identifiant' field of the login form, including its type, id, placeholder, validation rules, and other attributes
                        'identifiant' => [
                            'type' => 'text',
                            'id' => 'identifiant',
                            'placeholder' => 'Votre identifiant',
                            'required' => true,
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'minlength' => $regexConfig->getMinLength('identifiant'),
                            'maxlength' => $regexConfig->getMaxLength('identifiant'),
                            'pattern' => $regexConfig->getPattern('identifiant'),
                            'title' => $regexConfig->getTitle('identifiant'),
                            'i' => '<i class="fa-solid fa-user"></i>',
                            'value' => 'Yannoch17'],
                    # We define the configuration for the 'password' field of the login form, including its type, id, placeholder, validation rules, and other attributes    
                        'password' => [
                            'type' => 'password',
                            'id' => 'password',
                            'placeholder' => 'Votre mot de passe',
                            'required' => true,
                            'class' => 'form-control',
                            'autocomplete' => 'off',
                            'minlength' => $regexConfig->getMinLength('password'),
                            'maxlength' => $regexConfig->getMaxLength('password'),
                            'pattern' => $regexConfig->getPattern('password'),
                            'title' => $regexConfig->getTitle('password'),
                            'i' => '<i class="fa-solid fa-lock"></i>',
                            'value' => '45501991Ym/4'],
                        
                    ];

            }
        }