'use strict';

//--- VOTING ON POSTS ---
const voteUp = document.querySelectorAll('.voteUp');
const voteDown = document.querySelectorAll('.voteDown');
const sum = document.querySelector('.sum');
const url = "../../app/votes/votes.php";
const sumVotes = "../../app/votes/getSumVotes.php";

// UPVOTE BUTTON
Array.from(voteUp).forEach(up => {
    up.addEventListener('click', () => {
        fetch(url, {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            credentials: "include",
            body: `up=${up.value}&dir=${up.dataset.dir}`
        })

        .then(response => {
            return response.json()
      });
  });
});

// DOWNVOTE BUTTON
Array.from(voteDown).forEach(down => {
    down.addEventListener('click', () => {
        fetch(url, {
            method: "POST",
            headers: {"Content-Type": "application/x-www-form-urlencoded"},
            credentials: "include",
            body: `down=${down.value}&dir=${down.dataset.dir}`
        })
        .then(response => {
            return response.json()
        });
    });
});//--- END VOTING ON POSTS ---


//--- ALERT MESSAGE IF DELETING CONTENT ---
const deleteContent = document.querySelectorAll('.deletingContent');
Array.from(deleteContent).forEach(button => {
    button.addEventListener('click', (event) => {
        if (confirm("Are you sure about this?") == true) {
            // window.alert("Ok. Removing content.")
            return true;
        }
        else {
            event.preventDefault();
        }
    });
});//--- END ALERT MESSAGE ---
