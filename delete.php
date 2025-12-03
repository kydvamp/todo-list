<?php
require 'functions.php';

$id = $_GET["id"];
if (deleteData($id) > 0) {
    echo "<script>
            alert('Task deleted successfully!');
            document.location.href = 'index.php';
          </script>";
} else {
    echo "<script>
            alert('Failed to delete task!');
            document.location.href = 'index.php';
          </script>";
}
?>