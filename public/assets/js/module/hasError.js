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


/*▂ ▅ ▆ █ hasError ( field ) █ ▆ ▅ ▂ */
/**
 * 
 * @param {*} field 
 * @returns { void | {type: string, message: string} }
 */
export function hasError(field) {

    // We test if the field is readonly
    if (field.readOnly) { return; };

    // We test type of the field and return if the type of field is not supported || field.type === 'select-one' || field.type === 'select-multiple'
    if (field.disabled || field.type === 'file' || field.type === 'reset' || field.type === 'submit' || field.type === 'button' || field.type === 'hidden' || field.type === 'checkbox' || field.type === 'radio') { return; };
    
    // We tets if field is valid
    if (field.validity.valid) { return; };

    // We create a variable validity to stock the validity of the field
    let validity = field.validity;

    // We test the different types of validity and return an object with the type of error and the message to display
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
    // We test if the field has a pattern mismatch and return the message with the title attribute of the field to give a more specific message to the user
    if (validity.patternMismatch) { return { type: 'patternMismatch', message: `Veuillez respecter le format demandé. S'il vous plaît ${field.getAttribute('title')}` }; }; 
    
    // We test if the field has a type mismatch and return the message with the type of the field to give a more specific message to the user
    if (validity.typeMismatch) {
        if (field.type === 'email') { return { type: 'typeMismatch', message: 'Veuillez entrer une adresse email valide s\'il vous plaît' }; };
        if (field.type === 'url') { return { type: 'typeMismatch', message: 'Veuillez entrer une adresse URL valide s\'il vous plaît' }; };
        return { type: 'typeMismatch', message: 'Veuillez entrer une valeur du bon type. S\'il vous plaît' };
    };

    // We test if the field has a too short value and return the message with the minlength attribute of the field to give a more specific message to the user
    if (validity.tooShort) { return { type: 'tooShort', message: `Veuillez entrer au moins ${field.getAttribute('minLength')} caractères s\'il vous plaît. Vous en avez entré ${field.value.length}. ` }; };

    // We test if the field has a too long value and return the message with the maxlength attribute of the field to give a more specific message to the user
    if (validity.tooLong) { return { type: 'tooLong', message: `Veuillez entrer au maximum ${field.getAttribute('maxLength')} caractères s\'il vous plaît. Vous en avez entré ${field.value.length}. ` }; };

    // We test if the field has a range underflow and return the message with the min attribute of the field to give a more specific message to the user
    if (validity.rangeUnderflow) { return { type: 'rangeUnderflow', message: `Veuillez entrer une valeur supérieure ou égale à ${field.getAttribute('min')}. S\'il vous plaît` }; };

    // We test if the field has a range overflow and return the message with the max attribute of the field to give a more specific message to the user
    if (validity.rangeOverflow) { return { type: 'rangeOverflow', message: `Veuillez entrer une valeur inférieure ou égale à ${field.getAttribute('max')}. S\'il vous plaît` }; };

    // If the field has an unknown error, we return a generic message
    return { type: 'unknownError', message: 'Le champ est invalide.' };

};