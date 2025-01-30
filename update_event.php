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

if (!isset($_GET['id'])) {
    echo "No event ID provided.";
    exit();
}

$eventID = intval($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Periksa apakah email pengguna tersedia di sesi
    if (!isset($_SESSION['Email'])) {
        header("Location: ./pages/editprofile.php?error=Email is not set in the session");
        exit();
    }
    $Email = $_SESSION['Email'];

    // Sanitize input
    $eventName = mysqli_real_escape_string($conn, $_POST['eventName'] ?? '');
    $eventDescription = mysqli_real_escape_string($conn, $_POST['eventDescription'] ?? '');
    $eventLocation = mysqli_real_escape_string($conn, $_POST['eventLocation'] ?? '');
    $eventDateStart = mysqli_real_escape_string($conn, $_POST['eventDateStart'] ?? '');
    $eventDateEnd = mysqli_real_escape_string($conn, $_POST['eventDateEnd'] ?? '');
    $eventCategory = mysqli_real_escape_string($conn, $_POST['eventCategory'] ?? '');
    $eventBenefits = mysqli_real_escape_string($conn, $_POST['eventBenefits'] ?? '');
    $eventPayment = mysqli_real_escape_string($conn, $_POST['eventPayment'] ?? '');
    $eventStipend = mysqli_real_escape_string($conn, $_POST['eventStipend'] ?? '');
    $eventHours = mysqli_real_escape_string($conn, $_POST['eventHours'] ?? '');
    $eventEmail = mysqli_real_escape_string($conn, $_POST['eventEmail'] ?? '');
    $eventType = mysqli_real_escape_string($conn, $_POST['eventType'] ?? '');
    $namleng = $_SESSION['NamaDepan'] . ' ' . $_SESSION['NamaBelakang'];

    // Update data acara
    $updates = [];
    if (!empty($eventName)) {
        $updates[] = "Nama_Event = '$eventName'";
    }
    if (!empty($eventDescription)) {
        $updates[] = "Deskripsi = '$eventDescription'";
    }
    if (!empty($eventLocation)) {
        $updates[] = "Lokasi = '$eventLocation'";
    }
    if (!empty($eventDateStart) && !empty($eventDateEnd)) {
        $updates[] = "Tanggal_Mulai = '$eventDateStart', Tanggal_Selesai = '$eventDateEnd'";
    }
    if (!empty($eventCategory)) {
        $updates[] = "Kategori = '$eventCategory'";
    }
    if (!empty($eventBenefits)) {
        $updates[] = "Manfaat = '$eventBenefits'";
    }
    if (!empty($eventPayment)) {
        $updates[] = "Jenis_Pembayaran = '$eventPayment'";
    }
    if (!empty($eventStipend)) {
        $updates[] = "Stipend_Wage = '$eventStipend'";
    }
    if (!empty($eventHours)) {
        $updates[] = "Jam_Pekerjaan = '$eventHours'";
    }
    if (!empty($eventEmail)) {
        $updates[] = "Email_Kontak = '$eventEmail'";
    }
    if (!empty($eventType)) {
        $updates[] = "Tipe_Acara = '$eventType'";
    }

    // Update query jika ada perubahan
    if (!empty($updates)) {
        $update_query = "UPDATE acara SET " . implode(', ', $updates) . " WHERE Id_Event = '$eventID'";
        if (!mysqli_query($conn, $update_query)) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function () {
                    swal('Error Editing Event', 'There was an issue updating the event. Please try again.', 'error')
                        .then(() => window.location.href = './pages/add_event.php');
                });
            </script>";
            exit();
        }
    }

    // Handle upload foto jika ada
    if (isset($_FILES['event-photo']) && $_FILES['event-photo']['error'] === 0) {
        $img_name = $_FILES['event-photo']['name'];
        $size = $_FILES['event-photo']['size'];
        $tmp_name = $_FILES['event-photo']['tmp_name'];
        $img_ex = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        $allowed_ex = ['jpg', 'jpeg', 'png'];

        if (in_array($img_ex, $allowed_ex) && $size <= 825000) {
            $new_img_name = uniqid("Event-Picture-", true) . '.' . $img_ex;
            $img_upload_path = './uploads/' . $new_img_name;

            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                $update_photo_query = "UPDATE acara SET Foto_Event = '$new_img_name' WHERE Id_Event = '$eventID'";
                if (!mysqli_query($conn, $update_photo_query)) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function () {
                            swal('Error Editing Photo', 'Could not update the event photo.', 'error')
                                .then(() => window.location.href = './pages/add_event.php');
                        });
                    </script>";
                    exit();
                }
            }
        } else {
            $error_message = $size > 825000 ? "File size too large." : "Invalid file type.";
            header("Location: ./pages/editprofile.php?error=$error_message");
            exit();
        }
    }

    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            swal('Event Changed Successfully!', 'You will be redirected to the events page.', 'success')
                .then(() => window.location.href = './pages/events.php');
        });
    </script>";
}
?>
