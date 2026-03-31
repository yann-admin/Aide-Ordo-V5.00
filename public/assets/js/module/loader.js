/* ▂ ▅  ????????????????????  ▅ ▂ */
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */
/* ▂ ▂ ▂ ▂ ▂ ▂ ▂ */
/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
// import { objectForm } from "../Entities/Form.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
// export { ARRAY_OBJ_FORMS };
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/* ▂ ▅  CONSTANT  ▅ ▂ */
    const MODE_DEV = true;
    if (MODE_DEV) console.clear();
    const STATUS_MESSAGES = [
        "Traitement en cours",
        "Un petit instant",
        "C'est un peu long",
        "Nous avons peu être quelques soucis",
        "Nous réessayons de vous connecter",
        "Vous devriez, vérifier votre connexion internet"
    ];
    const TOTAL_INDEX = STATUS_MESSAGES.length;
    const DIV_STATUS = document.getElementById('status'); 
    const DIV_LOADER = document.getElementById('loader')
/* ▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂▂ */

    let tOn = 0;  
    let tOnStatus = 0;   
    let currentStep = 0;
    let loaderStart = false;

    export async function startLoader(duration) { 
        
        if ( loaderStart ) return; // Prevent multiple calls to startLoader while it's already running

        DIV_LOADER.classList.replace('visibilityHidden', 'visibilityVisible');  
        
        if (currentStep < TOTAL_INDEX) {
            // Update the status message
            DIV_STATUS.innerHTML = STATUS_MESSAGES[currentStep];
            // Animate the status with a subtle fade
            DIV_STATUS.style.opacity = 0;
            tOnStatus = setTimeout(() => {
                DIV_STATUS.style.opacity = 1;
            }, 300);

            currentStep++;
            
            // Schedule the next update
            tOn = setTimeout(() => { startLoader(duration) }, duration);
            loaderStart = true;
        }
    }


    export async function stopLoader(delay) {
        setTimeout(() => {
            currentStep = 0;
            DIV_STATUS.innerHTML = '';
            DIV_LOADER.classList.replace('visibilityVisible', 'visibilityHidden');
            clearTimeout(tOn);
            clearTimeout(tOnStatus);
            loaderStart = false;
        }, delay);
    }


    // Restart the animation when it completes
    function restartAnimation() {
        if (currentStep >= totalSteps) {
            currentStep = 0;
            progressFill.style.width = '0%';
            setTimeout(updateLoader, 1000);
        } else {
            setTimeout(restartAnimation, 1000);
        }
    }


        

