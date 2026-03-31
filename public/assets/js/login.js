/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener

    WARNNING: On mobile, the change event doesn't work if parameters are passed. Known iOS and Android bug. 
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import * as loader from "./module/loader.js";
import { fieldValidity } from "./module/fieldValidity.js";
import { handleFormSubmit } from "./module/handleFormSubmit.js";
import * as selectManager from "./module/selectManager.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */


/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */


/*▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */
const MODE_DEV = false;

/* **************************** */


/* MODAL PRIMARY */
    // We select the modal element, create a Bootstrap modal instance, and select the form, message container, submit button, and close button elements within the modal. We also create an instance of the form class using the selected form and submit button elements.
    const myModalPrimary = document.querySelector('.primary');
    // We create a new instance of the Bootstrap Modal class, passing in the selected modal element, which allows us to control the behavior of the modal (e.g., show, hide, etc.) using the methods provided by the Bootstrap Modal class.
    const myModalPrimaryInstance = new bootstrap.Modal(myModalPrimary);   
    //  We select the form element within the modal, which will be used to handle form submissions when the user interacts with the modal's form.
    const myModalPrimaryForm = myModalPrimary.querySelector('form');
    // We select the element with the id "modal-msg" within the modal, which will be used to display messages (e.g., success or error messages) to the user after form submission.
    const modalMsg = myModalPrimary.querySelector('#modal-msg');
    // We select the submit button within the modal form, which will be used to trigger the form submission when clicked.
    const myModalPrimarySubmitBtn = myModalPrimary.querySelector('button[type="submit"]');
    // We select the close button within the modal, which will be used to close the modal when clicked.
    const myModalPrimaryCloseBtn = myModalPrimary.querySelector('button[data-bs-dismiss="modal"]');

    
/* END MODAL PRIMARY */


/* ▂ ▅ ▆ █ WINDOW ADDEVENTLISTENER █ ▆ ▅ ▂ */
window.addEventListener("load", () => {
    // We show the modal when the window loads, prompting the user to log in before accessing the dashboard. This ensures that only authenticated users can access the dashboard and its features.
    myModalPrimaryInstance.show(); // Show the modal when the window loads

    // We disable the submit button by default to prevent form submission until the form is valid. This ensures that users cannot submit the form with invalid or incomplete data, improving the overall user experience and data integrity.
    myModalPrimarySubmitBtn.disabled = true; // Disable the submit button by default

    // We add a submit event listener to the form, which triggers the handleFormSubmit function when the form is submitted. The handleFormSubmit function is responsible for handling the form submission logic, such as validating the form data, sending it to the server, and displaying appropriate messages based on the response.
    document.addEventListener('blur', function (event) { fieldValidity(event, myModalPrimarySubmitBtn) }, true);

    // We add a submit event listener to the form, which triggers the handleFormSubmit function when the form is submitted. The handleFormSubmit function is responsible for handling the form submission logic, such as validating the form data, sending it to the server, and displaying appropriate messages based on the response.
    myModalPrimarySubmitBtn.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent the default form submission behavior
        handleFormSubmit(myModalPrimaryForm, myModalPrimarySubmitBtn.dataset.url, modalMsg);
    });

    // We add a click event listener to the close button, which triggers the hide method of the modal instance when clicked. This allows users to close the modal when they are done interacting with it or if they choose not to log in.
    myModalPrimaryCloseBtn.addEventListener('click', function () {
        myModalPrimaryInstance.hide(); // Hide the modal when the close button is clicked
    });

});
/* END WINDOW ADDEVENTLISTENER */


/* ▂ ▅ ▆ █ DEBUG █ ▆ ▅ ▂ */
if (MODE_DEV) {
    console.clear();
    console.log("Debug mode is ON");
    console.log("myModalPrimaryFormClass:", myModalPrimaryFormClass);
    console.log("myModalPrimaryForm:", myModalPrimaryForm);
    console.log("modalMsg:", modalMsg);
    console.log("myModalPrimarySubmitBtn:", myModalPrimarySubmitBtn);
    console.log("myModalPrimaryCloseBtn:", myModalPrimaryCloseBtn);
}
/* END DEBUG */