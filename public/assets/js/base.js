/*
MEMO:
    https://developer.mozilla.org/fr/docs/Web/API/EventTarget/addEventListener

    WARNNING: On mobile, the change event doesn't work if parameters are passed. Known iOS and Android bug. 
*/

/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Import  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */
import * as loader from "./module/loader.js";
// import { fieldValidity } from "./module/fieldValidity.js";
// import { handleFormSubmit } from "./module/handleFormSubmit.js";
// import * as selectManager from "./module/selectManager.js";
/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Import  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */


/* ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ Export  ↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓ */

/* ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ Export  ↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑ */


/*▂ ▅ ▆ █ CONSTANT █ ▆ ▅ ▂ */
const MODE_DEV = true;

/* **************************** */

/* MODAL PRIMARY */

/* END MODAL PRIMARY */


/* ▂ ▅ ▆ █ WINDOW ADDEVENTLISTENER █ ▆ ▅ ▂ */
window.addEventListener("load", () => {

});
/* END WINDOW ADDEVENTLISTENER */


/* ▂ ▅ ▆ █ DEBUG █ ▆ ▅ ▂ */
if (MODE_DEV) {
    console.clear();
}
/* END DEBUG */