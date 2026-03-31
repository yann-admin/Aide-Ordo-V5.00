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

/* ▂ ▅ ▆ █ ClearSelect() █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element from which to clear the options
 * @return {void}
 */
export function clearSelect(selectElement) {
    selectElement.innerHTML = '';
}
 



/* ▂ ▅ ▆ █ countOptions() █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element for which to count the options
 * @returns {number} The number of options in the select element
 */
export function countOptions(selectElement) {
    return ( selectElement.options.length );
}


/*▂ ▅ ▆ █ addOption(selectElement, value) █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element to which to add the option
 * @param {HTMLOptionElement} option - The option element to add to the select element
 * @return {void}
 */
export function addOption(selectElement, option) {
    let index = (countOptions(selectElement) - 1); // Get the index of the last option in the select element
    let textOption = index + " - " + option.text; // Get the value of the option to add, or an empty string if the value is not defined
    let valueOption = option.value; // Get the value of the option to add, or an empty string if the value is not defined
    /** @param Option: new (text?: string | undefined, value?: string | undefined, defaultSelected?: boolean | undefined, selected?: boolean | undefined) => HTMLOptionElement */
    console.log("Adding option:", { textOption, valueOption, defaultSelected: option.defaultSelected, selected: option.selected });
    selectElement.add(new Option(textOption, valueOption, option.defaultSelected, option.selected), selectElement.options[index]);
}

/*▂ ▅ ▆ █ addFirstOption(selectElement) █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element from which to clear the options
 * @return {void}
 * This function adds a default option with an empty value at the beginning of the options list in the select element. This can be used to force the user to choose an option from the select element, as the default option will not be valid for form submission.
 */
export function addFirstOption(selectElement) {
    /** @param Option: new (text?: string | undefined, value?: string | undefined, defaultSelected?: boolean | undefined, selected?: boolean | undefined) => HTMLOptionElement */
    clearSelect(selectElement); // Clear the existing options in the select element before adding the default option
    selectElement.add(new Option("# - Choisir une option", "", false, false), selectElement.options[0]);
}

/*▂ ▅ ▆ █ addOptionLastPosition(selectElement, option) █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element to which to add the option
 * @param {HTMLOptionElement} option - The option element to add to the select element
 * @return {void}
 */
export function addOptionLastPosition(selectElement) {
    //let indexLastOption = countOptions(selectElement); // Get the index of the last option in the select element
    let textOption = "## - Ajouter une option"; // Get the value of the option to add, or an empty string if the value is not defined
    let valueOption = "¤¤"; // Get the value of the option to add, or an empty string if the value is not defined
    /** @param Option: new (text?: string | undefined, value?: string | undefined, defaultSelected?: boolean | undefined, selected?: boolean | undefined) => HTMLOptionElement */
    selectElement.add(new Option(textOption, valueOption, false, false));
}


/*▂ ▅ ▆ █ removeOption(selectElement, value) █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element from which to remove the option
 * @param {string} value - The value of the option to remove from the select element
 * @return {void}
 */
export function removeOption(selectElement, value) {
    for (let i = 0; i < selectElement.options.length; i++) {
        if (selectElement.options[i].value === value) {
            selectElement.remove(i);
            break;
        }
    }
}

/* ▂ ▅ ▆ █ sortOptions(selectElement) █ ▆ ▅ ▂ */
/**
 * @param {HTMLSelectElement} selectElement - The select element whose options to sort
 * @return {void}
 */
export function sortOptions(selectElement) {
    let optionsEscape = ['¤¤',' ']; // Array of option values to keep at the end of the options list
    let options = Array.from(selectElement.options);
    options = options.filter(option => !optionsEscape.includes(option.value)); // Filter out the options to keep at the end
    options.sort((a, b) => a.text.localeCompare(b.text)); // Sort the options alphabetically by their text
    optionsEscape.forEach(value => {
        let option = Array.from(selectElement.options).find(option => option.value === value);
        if (option) {
            options.push(option); // Add the options to keep at the end back to the options list
        }
    });
    selectElement.innerHTML = '';
    options.forEach(option => selectElement.add(option));
}


/* ▂ ▅ ▆ █ chargerSelect (selectElement) █ ▆ ▅ ▂ */
/**
 * @param {string} id - The id of the select element to populate with options from the database
 * @param {HTMLSelectElement} selectElement - The select element to populate with options from the database
 * @param {string} url - The URL to which to send the request
 * @return {void}
 *  This function is not used in the current version of the application, but it can be used to populate a select element with options from the database using an AJAX request. The function sends a POST request to the specified URL with the provided id and expects a JSON response containing an array of options. Each option should be an object with "text" and "value" properties. The function then adds each option to the select element using the addOptionLastPosition() function.
 */
export function chargerSelect(id, selectElement, url) {
    let idFetch = parseInt(id, 10); // Convert the id to an integer
    if (isNaN(idFetch)) {
        console.warn('Invalid id:', id);
        return;
    }
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ id: idFetch }) // Send the id as the request body
    })
    .then(res => res.json())
    .then(data => {
        console.log(data)
        if (data.success) {
            addFirstOption(selectElement); // Add a default option at the beginning of the options list
            data.options.forEach(option => {
                addOption(selectElement, option); // Add each option from the database to the select element   
            });
            sortOptions(selectElement); // Sort the options after adding them to the select element
            addOptionLastPosition(selectElement); // Add the "Ajouter une option" option at the end of the options list after adding the options from the database and sorting them
        } else {
            addFirstOption(selectElement); // Add a default option at the beginning of the options list
            addOptionLastPosition(selectElement); // Add the "Ajouter une option" option at the end of the options list after adding the default option
            console.warn('Error fetching options:', data.message);
        }
    })
};

export function addEntries(url) {
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ }) // Send the id as the request body
    })// Redirect the user to the specified URL, which should be the form for adding a new entry (e.g., a new topology)
.then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.href = data.redirect_url;
        } else {
            console.warn('Error redirecting to add entry form:', data.message);
        }
    })

    .catch(error => {
        console.error('Error redirecting to add entry form:', error);
    });
}