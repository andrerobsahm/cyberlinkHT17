'use strict';

//ALERT MESSAGE IF DELETING CONTENT
document.querySelector('.deletingContent').addEventListener('click', (event) => {

        if (confirm("Are you sure about this?") == true) {
        window.alert("Ok. Removing content.")
        }
        else {
            event.preventDefault();
        }
})
