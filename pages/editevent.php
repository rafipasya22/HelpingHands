<?php

@include '../config.php';
session_start();

if(isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email']; 
} else {
    header("Location: Edit.php?error=Email is not set in the session");

}

$eventID = intval($_GET['id']);

if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}
$Query = mysqli_query($conn, "SELECT * FROM relawan WHERE Email = '$Email'");
$data = mysqli_fetch_array($Query);

$acara = mysqli_query($conn, "SELECT * FROM acara WHERE Id_Event = '$eventID'");
$event = mysqli_fetch_array($acara);


?>
<!--
=========================================================
* Soft UI Design 3 System - v1.1.0
=========================================================

* Product Page:  https://www.creative-tim.com/product/soft-ui-design-system 
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/HandinHandLogo.png">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<title>HelpingHands</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Nucleo Icons -->
<link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />

<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<!-- CSS Files -->
<link id="pagestyle" href="../assets/css/soft-design-system.css?v=1.1.0" rel="stylesheet" />





<!-- Nepcha Analytics (nepcha.com) -->
<!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
<script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="index-page">
  <!-- Navbar -->
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg  blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid px-0">
                <a id="navbar-brand" class="navbar-brand fw-bold d-flex align-items-center ms-3" href="../Home.php">
                    <img src="../assets/img/HandinHandLogo.png" alt="Logo" style="height: 40px; margin-right: 8px;" />
                    <span id="Help">Helping</span><span id="Tangan">Hands</span>
                </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon mt-2">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </span>
            </button>
            <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100" id="navigation">
              <ul class="navbar-nav navbar-nav-hover ms-lg-12 ps-lg-5 w-100">

                <!--dropdown pertama start-->
                <li class="nav-item mx-2 mt-1">
                  <a class="nav-link ps-2 fw-bold" href="./events.php">
                    Events
                  </a>
                </li>
                <li class="nav-item mx-2 mt-1">
                  <a class="nav-link ps-2 fw-bold" href="./postedevents.php">
                    My Posted Events
                  </a>
                </li>
                <li class="nav-item mx-2 mt-1">
                  <a class="nav-link ps-2 fw-bold" href="./bookmark.php">
                    Bookmarks
                  </a>
                </li>
                <!--end dropdown pertama-->
                
                <!--bagian kanan-->
                <li class="nav-item my-auto ms-lg-auto me-3">
                <!-- Dropdown for profile with username -->
                <div class="dropdown">
                  <a href="javascript:;" class="d-flex align-items-center" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <!-- Profile image (rounded) -->
                    <?php
                                    $carifoto = "SELECT Foto_Profil FROM relawan WHERE Nama_Depan = '$_SESSION[NamaDepan]'";
                                    $fotoprofil = mysqli_query($conn, $carifoto);
                                    if(mysqli_num_rows($fotoprofil)>0){
                                        while ($relawan = mysqli_fetch_assoc($fotoprofil)){
                                            if($relawan['Foto_Profil'] !== NULL){?>
                                              <img class="rounded-circle object-fit-cover" src="../uploads/<?=$relawan['Foto_Profil']?>" width="40" height="40">
                                            <?php  
                                            }else{?>
                                              <img class="rounded-circle object-fit-cover" src="../assets/img/def.jpg" width="40" height="40">  
                                            <?php 
                                            }
                                        }
                                    }else{
                                        ?>
                                        <img class="rounded-circle object-fit-cover" src="../assets/img/def.jpg" width="40" height="40">
                                        <?php 
                                    }
                    ?>
                    <!-- Username and type of user -->
                    
                    <img src="../assets/img/down-arrow-dark.svg" alt="down-arrow" class="arrow ms-2">
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="./author.php">My Profile</a></li>
                    <li><a class="dropdown-item" href="./editprofile.php">Edit Profile</a></li>
                    <li><a id="Logout" class="dropdown-item" href="../Logout.php">Log out</a></li>
                  </ul>
                </div>
              </li>


              </ul>
            </div>
          </div>
        </nav>
  <!-- End Navbar -->
      </div>
    </div>
  </div>


<div class="col mt-8">
  <!-- Event Details Section -->
<div class="container mt-3">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Edit Event</h5>
      
      <form id="eventForm" method="POST" action="../update_event.php?id=<?php echo $eventID?>" enctype="multipart/form-data"> 
      <input type="hidden" name="id" value="<?php echo $event['Id_Event']; ?>"><!-- This points to your PHP file for adding events -->
                  <!-- Event Name -->
                  <div class="mb-3">
                    <label for="eventName" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="eventName" name="eventName" placeholder="<?php echo $event['Nama_Event']?>">
                  </div>

                  <!-- Event Description -->
                  <div class="mb-3">
                    <label for="eventDescription" class="form-label">Event Description</label>
                    <textarea class="form-control" id="eventDescription" name="eventDescription" rows="4" placeholder="<?php echo $event['Deskripsi']?>"></textarea>
                  </div>

                  <!-- Event Location -->
                  <div class="mb-3">
                    <label for="eventLocation" class="form-label">Event Location</label>
                    <input type="text" class="form-control" id="eventLocation" name="eventLocation" placeholder="<?php echo $event['Lokasi']?>">
                  </div>

                  <!-- Event Date -->
                  <div class="mb-3">
                    <label for="eventDate" class="form-label">Event Date Start</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDateStart" placeholder="<?php echo $event['Tanggal_Mulai']?>">
                  </div>
                  <div class="mb-3">
                    <label for="eventDate" class="form-label">Event Date End</label>
                    <input type="date" class="form-control" id="eventDate" name="eventDateEnd" placeholder="<?php echo $event['Tanggal_Selesai']?>">
                  </div>

                  <!-- Event Category -->
                  <div class="mb-3">
                    <label for="eventCategory" class="form-label">Event Category</label>
                    <select class="form-select" id="eventCategory" name="eventCategory">
                      <option selected disabled>Select a category</option>
                      <option value="Application">Application</option>
                      <option value="Design">Design</option>
                      <option value="Management">Management</option>
                      <option value="Mobile">Mobile</option>
                      <option value="Desktop">Desktop</option>
                    </select>
                  </div>

                  <!-- Event Type -->
                  <div class="mb-3">
                    <label for="eventType" class="form-label">Event Type</label>
                    <select class="form-select" id="eventType" name="eventType">
                      <option selected disabled>Event Type</option>
                      <option value="On-Site">On-Site</option>
                      <option value="Remote">Remote</option>
                      <option value="Hybrid">Hybrid</option>
                    </select>
                  </div>

                  <!-- Internship Benefits -->
                  <div class="mb-3">
                    <label for="eventBenefits" class="form-label">Internship Benefits</label>
                    <input type="text" class="form-control" id="eventBenefits" name="eventBenefits" placeholder="<?php echo $event['Manfaat']?>" >
                  </div>

                  <!-- Payment Type -->
                  <div class="mb-3">
                    <label for="eventPayment" class="form-label">Payment Type</label>
                    <input type="text" class="form-control" id="eventPayment" name="eventPayment" placeholder="<?php echo $event['Jenis_Pembayaran']?>" >
                  </div>

                  <!-- Stipend / Wage -->
                  <div class="mb-3">
                    <label for="eventStipend" class="form-label">Stipend / Wage</label>
                    <input type="text" class="form-control" id="eventStipend" name="eventStipend" placeholder="<?php echo $event['Stipend_Wage']?>" >
                  </div>

                  <!-- Hours Per Week -->
                  <div class="mb-3">
                    <label for="eventHours" class="form-label">Hours Per Week</label>
                    <input type="number" class="form-control" id="eventHours" name="eventHours" placeholder="<?php echo $event['Jam_Pekerjaan']?>" >
                  </div>

                  <!-- Contact Email -->
                  <div class="mb-3">
                    <label for="eventEmail" class="form-label">Contact Email</label>
                    <input type="email" class="form-control" id="eventEmail" name="eventEmail" placeholder="<?php echo $event['Email_Kontak']?>">
                  </div>

                  <div>
                    <input type="file" id="fileInput" name="event-photo" accept="image/png, image/jpeg" />
                    <p class="small text-muted mt-1">At least 800x800 px recommended.<br>JPG or PNG is allowed</p>
                  </div>

                  <!-- Submit Button -->
                  <div class="d-flex justify-content-end">
                    <button onclick="window.location.href='./postedevents.php'" type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>

    </div>
  </div>
</div>

  
</div>

  <footer class="footer pt-5 mt-5">
  <hr class="horizontal dark mb-5">
  <div class="container">
    <div class=" row">
      <div class="col-md-3 mb-4 ms-auto">
        <div>
          <h6 class="text-gradient text-primary font-weight-bolder">Soft UI Design 3 System</h6>
        </div>
        <div>
          <h6 class="mt-3 mb-2 opacity-8">Social</h6>
          <ul class="d-flex flex-row ms-n3 nav">
            <li class="nav-item">
              <a class="nav-link pe-1" href="https://www.facebook.com/CreativeTim/" target="_blank">
                <i class="fab fa-facebook text-lg opacity-8"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link pe-1" href="https://twitter.com/creativetim" target="_blank">
                <i class="fab fa-twitter text-lg opacity-8"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link pe-1" href="https://dribbble.com/creativetim" target="_blank">
                <i class="fab fa-dribbble text-lg opacity-8"></i>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link pe-1" href="https://github.com/creativetimofficial" target="_blank">
                <i class="fab fa-github text-lg opacity-8"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link pe-1" href="https://www.youtube.com/channel/UCVyTG4sCw-rOvB9oHkzZD1w" target="_blank">
                <i class="fab fa-youtube text-lg opacity-8"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>



      <div class="col-md-2 col-sm-6 col-6 mb-4">
        <div>
          <h6 class="text-gradient text-primary text-sm">Company</h6>
          <ul class="flex-column ms-n3 nav">
            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/presentation" target="_blank">
                About Us
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/templates/free" target="_blank">
                Freebies
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/templates/premium" target="_blank">
                Premium Tools
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/blog" target="_blank">
                Blog
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-6 mb-4">
        <div>
          <h6 class="text-gradient text-primary text-sm">Resources</h6>
          <ul class="flex-column ms-n3 nav">
            <li class="nav-item">
              <a class="nav-link" href="https://iradesign.io/" target="_blank">
                Illustrations
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/bits" target="_blank">
                Bits & Snippets
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/affiliates/new" target="_blank">
                Affiliate Program
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-6 mb-4">
        <div>
          <h6 class="text-gradient text-primary text-sm">Help & Support</h6>
          <ul class="flex-column ms-n3 nav">
            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/contact-us" target="_blank">
                Contact Us
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/knowledge-center" target="_blank">
                Knowledge Center
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://services.creative-tim.com/?ref=ct-soft-ui-footer" target="_blank">
                Custom Development
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/sponsorships" target="_blank">
                Sponsorships
              </a>
            </li>

          </ul>
        </div>
      </div>

      <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
        <div>
          <h6 class="text-gradient text-primary text-sm">Legal</h6>
          <ul class="flex-column ms-n3 nav">
            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/terms" target="_blank">
                Terms &amp; Conditions
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/privacy" target="_blank">
                Privacy Policy
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="https://www.creative-tim.com/license" target="_blank">
                Licenses (EULA)
              </a>
            </li>
          </ul>
        </div>
      </div>

      <div class="col-12">
        <div class="text-center">
          <p class="my-4 text-sm">
            All rights reserved. Copyright © <script>document.write(new Date().getFullYear())</script> Soft UI Design System by <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
          </p>
        </div>
      </div>
    </div>
  </div>
</footer>


  

  
  















<!--   Core JS Files   -->
<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>




<!--  Plugin for TypedJS, full documentation here: https://github.com/inorganik/CountUp.js -->
<script src="./assets/js/plugins/countup.min.js"></script>





<script src="./assets/js/plugins/choices.min.js"></script>





<script src="./assets/js/plugins/prism.min.js"></script>
<script src="./assets/js/plugins/highlight.min.js"></script>





<!--  Plugin for Parallax, full documentation here: https://github.com/dixonandmoe/rellax -->
<script src="./assets/js/plugins/rellax.min.js"></script>
<!--  Plugin for TiltJS, full documentation here: https://gijsroge.github.io/tilt.js/ -->
<script src="./assets/js/plugins/tilt.min.js"></script>
<!--  Plugin for Selectpicker - ChoicesJS, full documentation here: https://github.com/jshjohnson/Choices -->
<script src="./assets/js/plugins/choices.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
<script src="./assets/js/plugins/parallax.min.js"></script>

<script>
  AOS.init();
</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const navbar = document.querySelector(".navbar");
    let lastScrollY = window.scrollY;

    // Event untuk mendeteksi scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY === 0) {
            // Jika di awal halaman, tampilkan navbar
            navbar.classList.remove("hidden");
        } else if (window.scrollY > lastScrollY) {
            // Jika scroll ke bawah, sembunyikan navbar
            navbar.classList.add("hidden");
        }
        lastScrollY = window.scrollY;
    });

    // Event untuk mendeteksi posisi kursor
    document.addEventListener("mousemove", (e) => {
        if (e.clientY < 50 && window.scrollY > 0) {
            // Jika kursor di atas halaman (kurang dari 50px dari atas), tampilkan navbar
            navbar.classList.remove("hidden");
        }
    });
});


</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
  const filterCard = document.getElementById("filter-card");
  const toggleButton = document.getElementById("toggle-filter");
  const showButton = document.getElementById("show-filter");

  // Tombol untuk menyembunyikan filter
  toggleButton.addEventListener("click", () => {
    filterCard.classList.add("sembunyi");
    toggleButton.classList.add("sembunyi");
    showButton.classList.remove("sembunyi");
  });

  // Tombol untuk menampilkan filter
  showButton.addEventListener("click", () => {
    filterCard.classList.remove("sembunyi");
    toggleButton.classList.remove("sembunyi");
    showButton.classList.add("sembunyi");
  });
});

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.getElementById("Logout").addEventListener("click", function(event){
        event.preventDefault(); // Menghentikan perilaku default dari tautan

        swal({
            title: "Logout Successful",
            text: "Directing to Login Page",
            icon: "success",
            button: "Ok",
        }).then((value) => {
            if (value) {
                window.location.href = "../Logout.php"; // Lakukan logout saat tombol "Ok" diklik
            }
        });
    });
</script>

<!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
<script src="./assets/js/soft-design-system.min.js?v=1.1.0" type="text/javascript"></script>

<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
          <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
          <script src="./assets/js/plugins/flatpickr.min.js"></script><script href="https://unpkg.com/soft-ui-design-system@1.0.4/assets/js/soft-design-system.min.js" rel="stylesheet"></script><script>
            if (document.querySelector(".datepicker")) {
              flatpickr(".datepicker", {});
            }
          </script>

<script type="text/javascript">

  if (document.getElementById('state1')) {
    const countUp = new CountUp('state1', document.getElementById("state1").getAttribute("countTo"));
    if (!countUp.error) {
      countUp.start();
    } else {
      console.error(countUp.error);
    }
  }
  if (document.getElementById('state2')) {
    const countUp1 = new CountUp('state2', document.getElementById("state2").getAttribute("countTo"));
    if (!countUp1.error) {
      countUp1.start();
    } else {
      console.error(countUp1.error);
    }
  }
  if (document.getElementById('state3')) {
    const countUp2 = new CountUp('state3', document.getElementById("state3").getAttribute("countTo"));
    if (!countUp2.error) {
      countUp2.start();
    } else {
      console.error(countUp2.error);
    };
  }
</script>

</body>

</html>
