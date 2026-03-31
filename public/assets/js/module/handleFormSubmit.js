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
const MODE_DEV = true;
if (MODE_DEV) console.clear();
/* **************************** */



/* ▂ ▅ ▆ █ handleFormSubmit() █ ▆ ▅ ▂ */
/**
 *  @param {HTMLFormElement} form - The form element to be submitted
 *  @param {string} url - The URL to which the form data will be sent
 *  @param {HTMLElement} modalMsg - The element where the response message will be displayed
 * @return {Promise<void>} - A promise that resolves when the form submission is complete
 */
export async function handleFormSubmit( form , url , modalMsg ) {
    //Note : Seuls les champs de formulaires valides sont inclus dans un objet FormData, 
    // c'est-à-dire ceux qui portent un nom (attribut name), qui ne sont pas désactivés et 
    // qui sont cochés (boutons radio et cases à cocher) ou sélectionnés (une ou plusieurs options dans une sélection).

    const formData = new FormData(form); // Create a FormData object from the form
    // Convert the FormData object to a plain JavaScript object                                 login-control
    const formDataObj = Object.fromEntries(formData.entries());
    if (MODE_DEV) console.log("FormData object:", formDataObj);
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(formDataObj)
    })
    .then(res => res.json())
    .then(data => {
        console.log(data)
        if (data.success) {
            // Step 6 -> If the response is successful, we display a success message and redirect to the dashboard
            modalMsg.innerHTML = `<div class="alert alert-success" role="alert">${data.message}</div>`;
            let redirectUrl = data.redirectUrl || "error"; // Use the redirectUrl from the response, or default to "error"
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 2000);

        } else {
            // Step 7 -> If the response is an error, we display the error message
            modalMsg.innerHTML = `<div class="alert alert-danger text-center" role="alert">${data.message}</div>`;
        }
   })


}