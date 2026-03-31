/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener

    WARNNING: On mobile, the change event doesn't work if parameters are passed. Known iOS and Android bug. 
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑▲↑ */


/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */

/*▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */
const MODE_DEV = false;
if (MODE_DEV) console.clear();
/* **************************** */


/*▂ ▅ ▆ █ showError ( field, message ) █ ▆ ▅ ▂ */
/**
 * @param {HTMLInputElement|HTMLSelectElement|HTMLTextAreaElement} field - The form field that has the error
 * @param {string} message - The error message to display
 * @return {void}
 */
export function showError(field, message) {
    let errorMessage = field.parentNode.querySelector('.error-message');
    if (!errorMessage) {
        errorMessage = document.createElement('div');
        errorMessage.className = 'error-message text-danger mt-1';
        errorMessage.textContent = message;
        field.parentNode.appendChild(errorMessage);
    } else {
        errorMessage.textContent = message;
    };

    /* We add class is-invalid bootstrap and remove class is-valid bootstrap to field */
    field.classList.add('is-invalid');
    field.classList.remove('is-valid');
};