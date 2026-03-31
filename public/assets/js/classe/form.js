/*▂ ▅ ▆ █ CONSTANT CONSOLE █ ▆ ▅ ▂ */
const MODE_DEV = true;
if (MODE_DEV) console.clear();

export default class Form {
    constructor( form, btnSubmit = null ) {
        this.id = form.id || null;
        this.method = form.method || null;
        this.action = form.action || null;
        this.enctype = form.enctype || null;
        this.elements = form.elements || [];
        //this.fields = arrayFields(this.elements);
        this.btnSubmit = btnSubmit;
    }

    initForm( ) {
        this.btnSubmit.disabled = true; // Disable submit button on form initialization
    }

    fieldValidity( e ) {
        // We create a variable to stock the field that trigger the event
        let field = e.target;
        // We test if the field is in the form, if not we return 
        if(field.form==null){return;};
        // We test if the flied has the class 'validate', if not we return
        if ( !field.form.className.includes('validate') ) { return; };
        // We create a variable errorField
        let errorField = hasError(field);
        if (MODE_DEV) console.log(`Field ${field.name} has error:`, errorField);
        // We test if there is an error in the field
        if (errorField) {
            // We call the function showErrorMessage to display the error message
            showErrorMessage(field, errorField.message);
        } else {
            // We call the function removeErrorMessage to remove the error message if the field is valid
            removeErrorMessage(field);
        }

        if (field.form.checkValidity()) {
            this.btnSubmit.disabled = false; // Enable submit button if form is valid
        } else {
            this.btnSubmit.disabled = true; // Disable submit button if form is not valid
        };
        if (MODE_DEV) console.log(`Form ${field.form.name} will validate:`, field.form.willValidate);

    }
}

/* ▂ ▅ ▆ █ FUNCTION HAS ERROR █ ▆ ▅ ▂ */
let hasError = function (field) {
    // We test if the field is readonly
    if (field.readOnly) { return; };
    // We test type of the field and return if the type of field is not supported || field.type === 'select-one' || field.type === 'select-multiple'
    if (field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button' || field.type === 'hidden' || field.type === 'checkbox' || field.type === 'radio' ) { return; };
    // We tets if field is valid
    if (field.validity.valid) { return; };
    // We create a variable validity to stock the validity of the field
    let validity = field.validity;

    if (validity.valueMissing) {
        if (field.type === 'checkbox') { return { type: 'valueMissing', message: 'Veuillez cocher cette case s\'il vous plaît' }; };
        if (field.type === 'radio') { return { type: 'valueMissing', message: 'Veuillez sélectionner une option s\'il vous plaît' }; };
        if (field.tagName.toLowerCase() === 'select') { return { type: 'valueMissing', message: 'Veuillez sélectionner une option s\'il vous plaît' }; };
        if (field.type === 'select') { return { type: 'valueMissing', message: 'Veuillez sélectionner une option s\'il vous plaît' }; };
        if (field.type === 'file') { return { type: 'valueMissing', message: 'Veuillez sélectionner un fichier s\'il vous plaît' }; };
        if (field.type === 'email') { return { type: 'valueMissing', message: 'Veuillez entrer votre adresse email s\'il vous plaît' }; };
        if (field.type === 'password') { return { type: 'valueMissing', message: 'Veuillez entrer votre mot de passe s\'il vous plaît' }; };
        if (field.type === 'text') { return { type: 'valueMissing', message: 'Veuillez remplir ce champ s\'il vous plaît' }; };
        if (field.type === 'url') { return { type: 'valueMissing', message: 'Veuillez entrer une adresse URL s\'il vous plaît' }; };
        if (field.type === 'number') { return { type: 'valueMissing', message: 'Veuillez entrer un nombre s\'il vous plaît' }; };
        if (field.tagName.toLowerCase() === 'textarea') { return { type: 'valueMissing', message: 'Veuillez remplir ce champ s\'il vous plaît' }; };
        return { type: 'valueMissing', message: 'Veuillez remplir ce champ s\'il vous plaît' };
    };

    if (validity.patternMismatch) { return { type: 'patternMismatch', message: `Veuillez respecter le format demandé. S'il vous plaît ${field.getAttribute('title')}` }; }; 
    
    if (validity.typeMismatch) {
        if (field.type === 'email') { return { type: 'typeMismatch', message: 'Veuillez entrer une adresse email valide s\'il vous plaît' }; };
        if (field.type === 'url') { return { type: 'typeMismatch', message: 'Veuillez entrer une adresse URL valide s\'il vous plaît' }; };
        return { type: 'typeMismatch', message: 'Veuillez entrer une valeur du bon type. S\'il vous plaît' };
    };

    if (validity.tooShort) { return { type: 'tooShort', message: `Veuillez entrer au moins ${field.getAttribute('minLength')} caractères s\'il vous plaît. Vous en avez entré ${field.value.length}. ` }; };

    if (validity.tooLong) { return { type: 'tooLong', message: `Veuillez entrer au maximum ${field.getAttribute('maxLength')} caractères s\'il vous plaît. Vous en avez entré ${field.value.length}. ` }; };

    if (validity.rangeUnderflow) { return { type: 'rangeUnderflow', message: `Veuillez entrer une valeur supérieure ou égale à ${field.getAttribute('min')}. S\'il vous plaît` }; };

    if (validity.rangeOverflow) { return { type: 'rangeOverflow', message: `Veuillez entrer une valeur inférieure ou égale à ${field.getAttribute('max')}. S\'il vous plaît` }; };

    return { type: 'unknownError', message: 'Le champ est invalide.' };
};


/* ▂ ▅ ▆ █ FUNCTION SHOW ERROR MESSAGE █ ▆ ▅ ▂ */
function showErrorMessage(field, message) {
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

/* ▂ ▅ ▆ █ FUNCTION REMOVE ERROR MESSAGE █ ▆ ▅ ▂ */
function removeErrorMessage(field) {
    let errorMessage = field.parentNode.querySelector('.error-message');
    if (errorMessage) {
        field.parentNode.removeChild(errorMessage);
    };
    /* We add class is-valid bootstrap and remove class is-invalid bootstrap to field */
    field.classList.add('is-valid');
    field.classList.remove('is-invalid');
};


// function arrayFields(elements) {
//     let arrayFields = [];
//     for (const element of elements) {
//         Array.from(element.attributes).forEach(attr => {
//             if (!arrayFields[attr.name]) {
//                 arrayFields[attr.name] = [];
//             }
//             arrayFields[attr.name].push(attr.value);
//         });
//     }
//     return arrayFields;
// };

