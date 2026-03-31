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
        namespace App\src\Renderer;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */
        use \Throwable;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class FormRenderer{

            /* ▂ ▅ Constants ▅ ▂ */

            /* ▂▂▂▂▂▂▂▂▂▂▂ */
            
            /* ▂ ▅ Attributs  ▅ ▂ */
            
            /* ▂▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅ renderV1 ▅ ▂ */
                /** @return string */
                public function renderV1( FormBuilder $formBuilder ) : string {
                    $form = [];
                    $form[] = "<!-- Formulaire -->";
                    $form[] = "<div class='col-10 mb-3 py-3 text-center container-form-login'>";
                    $form[] = "<form method='{$this->securityXSS($formBuilder->getMethod())}' action='{$this->securityXSS($formBuilder->getAction())}' enctype='{$this->securityXSS($formBuilder->getEnctype())}' class='{$this->securityXSS($formBuilder->getClass())}' id='{$this->securityXSS($formBuilder->getId())}'>";
                    foreach ($formBuilder->getInputs() as $input) {
                        $attributes = '';
                        foreach ($input['attributes'] as $key => $value) {
                            $attributes .= "$key='{$this->securityXSS($value)}' ";
                        }
                        $form[] = "<input type='{$this->securityXSS($input['type'])}' name='{$this->securityXSS($input['name'])}' value='{$this->securityXSS($input['value'])}' $attributes/>";
                    }
                    $form[] = "</form>";
                    $form[] = "</div>";
                    $form[] = "<!-- Fin du formulaire -->";
                    return implode("\n", $form); // for better readability in the HTML source code
                }

                /* ▂ ▅ renderV2 ▅ ▂ */
                /** @return string */
                 public static function renderV2( object $formBuilder ) : string {
                    $form = [];
                    $form[] = "<!-- Formulaire -->";
                    $form[] = "<div class='col-10 mb-3 py-3 text-center container-form-login'>";
                    $form[] = "<form method='" . self::securityXSS($formBuilder->getMethod()) . "' action='" . self::securityXSS($formBuilder->getAction()) . "' enctype='" . self::securityXSS($formBuilder->getEnctype()) . "' class='" . self::securityXSS($formBuilder->getClass()) . "' id='" . self::securityXSS($formBuilder->getId()) . "'>";
                    foreach ($formBuilder->getInputs() as $input) {
                        $attributes = '';
                        $icon = '';
                        $options = [];
                        foreach ($input['attributes'] as $key => $value) {
                            if($key === 'i') {
                                $icon = $value; // we store the icon in a variable to display it later, we skip it in the attributes for the input element
                                continue; // we skip the 'i' attribute for the input element, it's used for the icon
                            }
                            // we skip the 'options' attribute for the input element, it's used for select inputs
                            if ($key === 'options') { $attributesOptions = $value; continue; }
                                
                            if($key === 'minlength' || $key === 'maxlength') {
                                $attributes .= "$key='{$value}' ";
                            }elseif($key === 'required') {
                                if ($value === true) {$attributes .= "required='true' ";}
                            }elseif($key === 'readonly') {
                                if ($value === true) {$attributes .= "readonly='readonly' ";}
                            }elseif($key === 'placeholder') {
                                $attributes .= "placeholder='" . self::securityXSS($value) . "' ";
                                $labelField = $value; // we create a label for the input field using the placeholder attribute, we capitalize the first letter of the placeholder for better readability
                            }
                            else {
                                $attributes .= "$key='" . self::securityXSS($value) . "' ";
                            }
                        }

                        if ( $input['type'] === 'button' ) {
                            $form[] = "<div class='d-grid gap-2'>";
                                $form[] = "<button type='" . self::securityXSS($input['type']) . "' name='" . self::securityXSS($input['name']) . "' $attributes>" . self::securityXSS($input['value']) . "</button>";
                            $form[] = "</div>";
                            continue; // we skip the rest of the loop for buttons, we don't want to wrap them in a div with an icon
                        }

                        if ( $input['type'] === 'submit' ) {
                            $form[] = "<div class='d-grid gap-2'>";
                                $form[] = "<button type='" . self::securityXSS($input['type']) . "' name='" . self::securityXSS($input['name']) . "' $attributes>" . self::securityXSS($input['value']) . "</button>";
                            $form[] = "</div>";
                            continue; // we skip the rest of the loop for submit buttons, we don't want to wrap them in a div with an icon
                        }

                        if ( $input['type'] === 'select' ) {
                            $form[] = "<div class='input-group align-content-center has-validation mb-2'>";
                                $form[] ="<span id='picto-" . self::securityXSS($input['name']) . "' class='input-group-text'>" . $icon . "</span>";
                                $form[] ="<div class='form-floating is-invalid'>";
                                    $form[] = "<select name='" . self::securityXSS($input['name']) . "' $attributes>";
                                        # We initialize the index 0 of the options array with an empty value to display a placeholder in the select element, we also add a default option with an empty value to force the user to choose an option
                                        $form[] = "<option value=''>" . "Choisir une option" . "</option>";

                                        foreach ($attributesOptions as $key => $attributesValue) {

                                            foreach ($attributesValue as $keyValue => $value) {

                                                if (is_array($value)) {
                                                    $valueOption = intval($value['value']);
                                                    $textOption = strval($value['text']);
                                                }else {
                                                    $valueOption = strval($value);
                                                    $textOption = strval($value);
                                                }
                                                $selected = ($valueOption === intval($input['value'])) ? "selected" : "";
                                                $form[] = "<option value='" . $valueOption . "' $selected>" . self::securityXSS($textOption) . "</option>";

                                            }
 
                                       }

                                    $form[] = "</select>";
                                    $form[] = "<label for='" . self::securityXSS($input['name']) . "'>" . self::securityXSS(ucfirst($labelField)) . "</label>";
                                $form[] = "</div>";
                            $form[] = "</div>";
                            continue; // we skip the rest of the loop for reset buttons, we don't want to wrap them in a div with an icon
                        }

                        if ( $input['type'] === 'textarea' ) {
                            $form[] = "<div class='input-group align-content-center has-validation mb-2'>";
                                $form[] ="<span id='picto-" . self::securityXSS($input['name']) . "' class='input-group-text'>" . $icon . "</span>";
                                $form[] ="<div class='form-floating is-invalid'>";
                                    $form[] = "<textarea name='" . self::securityXSS($input['name']) . "' $attributes>" . self::securityXSS($input['value']) . "</textarea>";
                                    $form[] = "<label for='" . self::securityXSS($input['name']) . "'>" . self::securityXSS(ucfirst($labelField)) . "</label>";
                                $form[] = "</div>";
                            $form[] = "</div>";
                            continue; // we skip the rest of the loop for reset buttons, we don't want to wrap them in a div with an icon
                        }

                        if ( $input['type'] === 'text' || $input['type'] === 'email') {
                            if( !empty($input['value']) ) {
                                $valueInput = "value='" . self::securityXSS($input['value']) . "'";
                            } else {
                                $valueInput = "";
                            }
                            $form[] = "<div class='input-group align-content-center has-validation mb-2'>";
                                $form[] ="<span id='picto-" . self::securityXSS($input['name']) . "' class='input-group-text'>" . $icon . "</span>";
                                $form[] ="<div class='form-floating is-invalid'>";
                                    $form[] = "<input type='" . self::securityXSS($input['type']) . "' name='" . self::securityXSS($input['name']) . "' {$valueInput} $attributes/>";
                                    $form[] = "<label for='" . self::securityXSS($input['name']) . "'>" . self::securityXSS(ucfirst($labelField)) . "</label>";
                                $form[] = "</div>";
                            $form[] = "</div>";
                            // we skip the rest of the loop for text, email and password inputs, we want to wrap them in a div with an icon
                        }

                        if ( $input['type'] === 'password' ) {
                            if( !empty($input['value']) ) {
                                $valueInput = "value='" . self::securityXSS($input['value']) . "'";
                            } else {
                                $valueInput = "";
                            }
                            $form[] = "<div class='input-group align-content-center has-validation mb-2'>";
                                $form[] ="<span id='picto-" . self::securityXSS($input['name']) . "' class='input-group-text'>" . $icon . "</span>";
                                $form[] ="<div class='form-floating is-invalid'>";
                                    $form[] = "<input type='" . self::securityXSS($input['type']) . "' name='" . self::securityXSS($input['name']) . "' {$valueInput} $attributes/>";
                                    $form[] = "<label for='" . self::securityXSS($input['name']) . "'>" . self::securityXSS(ucfirst($labelField)) . "</label>";
                                $form[] = "</div>";
                                $form[] ="<span id='password-eye' class='input-group-text pictoEye'>" . "<i class='fa-solid fa-eye'></i>" . "</span>";
                            $form[] = "</div>";
                            continue; // we skip the rest of the loop for password inputs, we want to wrap them in a div with an icon
                        }


                        if( $input['type'] === 'hidden' ) {
                            $form[] = "<input type='" . self::securityXSS($input['type']) . "' name='" . self::securityXSS($input['name']) . "' value='" . self::securityXSS($input['value']) . "' $attributes/>";
                            continue; // we skip the rest of the loop for hidden inputs, we don't want to wrap them in a div with an icon
                        }

                        if( $input['type'] === 'readonly' ) {
                            $form[] = "<input type='text' name='" . self::securityXSS($input['name']) . "' value='" . self::securityXSS($input['value']) . "' readonly $attributes/>";
                        }

                        if( $input['type'] === 'other' ) {
                            $form[] = $input['value']; // we directly add the element to the form without any modification, it's used for adding elements other than inputs (ex: a paragraph or a div)
                        }
                        
                    }
                    $form[] = "</form>";
                    $form[] = "</div>";
                    $form[] = "<!-- Fin du formulaire -->";
                    return implode("\n", $form); // for better readability in the HTML source code
                }

                /* ▂ ▅ securityXSS ▅ ▂ */
                /** @return string */
                private static function securityXSS(string $input) : string {
                    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂▂ */

        }

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
    
?>

