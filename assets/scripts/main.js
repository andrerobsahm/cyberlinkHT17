'use strict';

//ALERT MESSAGE IF DELETING CONTENT
document.querySelector('.deletingUser').addEventListener('click', (event) => {

        if (confirm("Are you sure about this?") == true) {
        window.alert("Ok. Removing content... Sad to see you go.")
        }
        else {
            event.preventDefault();
        }
})
