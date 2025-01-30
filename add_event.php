<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="./assets/css/soft-design-system.css">
<?php
session_start();
@include './config.php';

// Ensure the user is logged in
if (!isset($_SESSION['NamaDepan'])) {
    header('location:../Login_Signup/Login.php');
}

if (isset($_POST['submit'])) {
    // Check if the user is logged in and retrieve email from session
    if (isset($_SESSION['Email'])) {
        $Email = $_SESSION['Email']; 
    } else {
        header("Location: ./pages/editprofile.php?error=Email is not set in the session");
    }

    // Sanitize and retrieve form inputs
    $foto = 'default-image.jpg';
    $eventName = mysqli_real_escape_string($conn, $_POST['eventName']);
    $eventDescription = mysqli_real_escape_string($conn, $_POST['eventDescription']);
    $eventLocation = mysqli_real_escape_string($conn, $_POST['eventLocation']);
    $eventDateStart = mysqli_real_escape_string($conn, $_POST['eventDateStart']);
    $eventDateEnd = mysqli_real_escape_string($conn, $_POST['eventDateEnd']);
    $eventCategory = mysqli_real_escape_string($conn, $_POST['eventCategory']);
    $eventBenefits = mysqli_real_escape_string($conn, $_POST['eventBenefits']);
    $eventPayment = mysqli_real_escape_string($conn, $_POST['eventPayment']);
    $eventStipend = mysqli_real_escape_string($conn, $_POST['eventStipend']);
    $eventHours = mysqli_real_escape_string($conn, $_POST['eventHours']);
    $eventEmail = mysqli_real_escape_string($conn, $_POST['eventEmail']);
    $eventType = mysqli_real_escape_string($conn, $_POST['eventType']);
    $namleng = $_SESSION['NamaDepan'] . ' ' . $_SESSION['NamaBelakang'];

    
    // Ensure required fields are not empty
    if (!empty($eventName) && !empty($eventDescription) && !empty($eventLocation)) {
        // Insert the event into the database
        if(isset($_FILES['event-photo']) && $_FILES['event-photo']['error'] === 0) {
            $img_name = $_FILES['event-photo']['name'];
            $size = $_FILES['event-photo']['size'];
            $tmp_name = $_FILES['event-photo']['tmp_name'];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_ex = array("jpg", "jpeg", "png");
    
            if(in_array($img_ex_lc, $allowed_ex)) {
                if($size <= 825000) {
                    $new_img_name = uniqid("Event-Picture-", true).'.'.$img_ex_lc;
                    $img_upload_path = './uploads/'.$new_img_name;
                    move_uploaded_file($tmp_name, $img_upload_path);
                    $foto = $new_img_name; 
                } else {
                    $em = "Terlalu Besar Mase!";
                    header("Location: ./pages/editprofile.php?error=$em");
                }
            } else {
                $em = "Ganti Tipe File Bos!";
                header("Location: ./pages/editprofile.php?error=$em");
            }
        }
        $insert_event = "INSERT INTO acara (Nama_Event, Deskripsi, Dipost_Oleh, Lokasi, Tanggal_Mulai, Tanggal_Selesai, Kategori, Manfaat, Jenis_Pembayaran, Stipend_Wage, Jam_Pekerjaan, Email_Kontak, Tanggal_Posting, Tipe_Acara, Foto_Event, Email_Poster) VALUES ('$eventName', '$eventDescription', '$namleng', '$eventLocation', '$eventDateStart', '$eventDateEnd','$eventCategory', '$eventBenefits', '$eventPayment', '$eventStipend', '$eventHours', '$eventEmail', CURRENT_TIMESTAMP, '$eventType', '$foto', '$Email')";
        if (mysqli_query($conn, $insert_event)) {
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    swal({
                        title: "Event Added Successfully!",
                        text: "You will be redirected to the events page.",
                        icon: "success",
                        button: "Ok",
                    }).then(() => {
                        window.location.href = "./pages/events.php";  // Redirect to the events page
                    });
                });
            </script>
            <?php
        } else {
            ?>
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    swal({
                        title: "Error Adding Event",
                        text: "There was an issue with adding the event. Please try again.",
                        icon: "error",
                        button: "Ok",
                    }).then(() => {
                        window.location.href = "./pages/add_event.php";  // Redirect back to the add event page
                    });
                });
            </script>
            <?php
        }
    } else {
        // If fields are missing
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                swal({
                    title: "Error",
                    text: "Please fill in all the required fields.",
                    icon: "warning",
                    button: "Ok",
                }).then(() => {
                    window.location.href = "./pages/add_event.php";  // Redirect back to the add event page
                });
            });
        </script>
        <?php
    }
} else {
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            swal({
                title: "Unauthorized Access",
                text: "You must submit the form to add an event.",
                icon: "warning",
                button: "Ok",
            }).then(() => {
                window.location.href = "./pages/add_event.php";  // Redirect back to the add event page
            });
        });
    </script>
    <?php
}
?>
