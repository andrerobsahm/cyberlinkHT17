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




const voteUp = document.querySelectorAll('.voteUp');
const voteDown = document.querySelectorAll('.voteDown');
const sum = document.querySelector('.sum');

const url = "../../app/votes/votes.php"
const sumVotes = "../../app/votes/sumVotes.php"

// VOTE UP BUTTON
