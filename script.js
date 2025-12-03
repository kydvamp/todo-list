<?php
if (isset($_POST["submit-filter"])) {
    $filter = $_POST["filter"];
    if ($filter == "complete") {
        $activity = query("SELECT * FROM activity WHERE status = 'complete'");
    } elseif ($filter == "pending") {
        $activity = query("SELECT * FROM activity WHERE status = 'pending'");
    } else {
        $activity = query("SELECT * FROM activity");
    }
}
?>

// EVENT ADD FORM
const nameInput = document.getElementById('nama');
const addButton = document.getElementById('add-button');
const addBox = document.getElementById('add-box');
const addButtonSubmit = document.getElementsByClassName('btn-button')[0];

addButton.addEventListener('click', function() {
  addBox.classList.toggle('active');
  nameInput.setAttribute('required', '');
});

addButtonSubmit.addEventListener('click', function() {
  if(nameInput === '') {
    addBox.classList.toggle('active');
  }
});

function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
  event.preventDefault();
  const data = event.dataTransfer.getData("text");
  const draggedElement = document.getElementById(data);
  event.target.appendChild(draggedElement);
}