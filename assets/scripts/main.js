'use strict';

const voteUp = document.querySelectorAll('.voteUp');
const voteDown = document.querySelectorAll('.voteDown');
const sum = document.querySelector('.sum');
const url = "../../app/votes/votes.php";
const sumVotes = "../../app/votes/getSumVotes.php";
// FOR VOTEUP BUTTONS
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
    console.log("hej");
  })
});
// FOR VOTEDOWN BUTTONS
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
    console.log("då");
  })
});





// ALERT MESSAGE IF DELETING CONTENT
document.querySelectorAll('.deletingContent').addEventListener('click', (event) => {
        if (confirm("Are you sure about this?") == true) {
        window.alert("Ok. Removing content.")
        }
        else {
            event.preventDefault();
        }
});
