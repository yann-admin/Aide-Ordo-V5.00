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
        namespace App\src\Form\Builder;
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    /* ▂ ▅ ▆ █  Inclusion  █ ▆ ▅ ▂ */

        /* *********** OBLIGATORY *********** */
            # We include the Form class to extend it and create the FormLoginBuilder class
            use App\src\Form\Form;
            # We include the Token class to generate CSRF tokens for the form
            use App\src\Service\Security\Token;
            # We include the FormRenderer class to render the form in HTML
            use App\src\Renderer\FormRenderer;
        /* ********************************** */

    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */


    /* ▂ ▅ ▆ █ Class █ ▆ ▅ ▂ */
        class FormLoginBuilder extends Form {
            /* ▂ ▅ Constants ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂ */

            /* ▂ ▅ Attributs ▅ ▂ */
            /* ▂▂▂▂▂▂▂▂▂▂▂▂*/

            /* ▂ ▅ Methodes ▅ ▂ */

                /* ▂ ▅  constructor() ▅ ▂ */
                public function __construct(){
                    # We call the parent FormBuilder constructor for better code reusability and to initialize the formConfig attribute
                    parent::__construct();
                }
    
                /* ▂ ▅  build() ▅ ▂ */
                /** @param array $inputs */
                /** @return self : the current instance of the Form  */
                public function build( array $inputs ) : self {
                    # We define the form configuration in an array
                    $this->setConfig([
                        'action' => '#',
                        'method' => 'POST',
                        'enctype' => 'multipart/form-data',
                        'class' => 'justify-content-center row validate',
                        'id' => 'form'
                    ]);
                    # We loop for configuration this inputs
                    foreach ($inputs as $name => $attributes) {
                        $type = $attributes['type'] ?? 'text';
                        $this->addInput($type, $name, '', $attributes);
                    }
                    # We add the CSRF token input to the form
                    $this -> addToken( Token::createTokenInput() );
                    # We add an anti-robot input to the form
                    $this -> addAntiRobot('');
                    # We render the form using the FormRenderer class and return the HTML string
                    return $this;
                }

            /* ▂▂▂▂▂▂▂▂▂▂▂ */

        }
        
    /* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
?>
