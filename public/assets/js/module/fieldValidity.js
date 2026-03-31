/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener

    WARNNING: On mobile, the change event doesn't work if parameters are passed. Known iOS and Android bug. 
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import { hasError } from "./hasError.js";
import { showError } from "./showError.js";
import { removeError} from "./removeError.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */


/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/*▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */
const MODE_DEV = false;
if (MODE_DEV) console.clear();
/* **************************** */




/*▂ ▅ ▆ █ fieldValidity ( event ) █ ▆ ▅ ▂ */
/**
 * 
 * @param {*} event 
 * @param {HTMLButtonElement} btnSubmit 
 * @returns { void }
 */
export function fieldValidity( event, btnSubmit ) {
    
    // We create a variable to stock the field that trigger the event
    let field = event.target;
    // We test if the field is in the form, if not we return 
    if (field.form == null) { return; };
    
    // We test if the flied has the class 'validate', if not we return
    if (!field.form.className.includes('validate')) { return; };

    // We create a variable errorField
    let errorField = hasError(field);

    // We test if there is an error in the field and if there is we call the function showError to display the error message, if not we call the function removeError to remove the error message if the field is valid
    if (errorField) {
        // We call the function showError to display the error message
        showError(field, errorField.message);
    } else {
        // We call the function removeError to remove the error message if the field is valid
        removeError(field);
    }

    if (field.form.checkValidity()) {
        btnSubmit.disabled = false; // Enable submit button if form is valid
    } else {
        btnSubmit.disabled = true; // Disable submit button if form is not valid
    };

}
/*******************/



