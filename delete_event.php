<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="./assets/css/soft-design-system.css">

<?php
session_start();
@include './config.php';

// Pastikan pengguna telah login
if (!isset($_SESSION['NamaDepan'])) {
    header('Location: ../Login_Signup/Login.php');
    exit();
}

// Pastikan ID event tersedia
if (!isset($_GET['id'])) {
    echo "No event ID provided.";
    exit();
}

$eventID = intval($_GET['id']);

$delete_query = "DELETE FROM acara WHERE Id_Event = '$eventID'";

    if (mysqli_query($conn, $delete_query)) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                swal('Event Deleted!', 'The event has been successfully deleted.', 'success')
                    .then(() => window.location.href = './pages/events.php');
            });
        </script>";
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function () {
                swal('Error Deleting Event', 'There was an issue deleting the event. Please try again.', 'error')
                    .then(() => window.location.href = './pages/events.php');
            });
        </script>";
    }
?>

