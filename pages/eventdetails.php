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

<!--filter-->

  <div class="container mt-sm-5 mt-3">
    <div class="row">
  
    <div class="col-lg-3">
      <div class="position-sticky pb-lg-5 pb-3 mt-lg-0 mt-5 ps-2" style="top: 100px">
        <div class="col-12">
          <!-- Filter Card -->
          <div class="position-relative border-radius-xl overflow-hidden shadow-lg mb-7" id="filter-card">
            <div class="tab-content tab-space">
              <div class="tab-pane active" id="filter">
                <aside class="sc-jjlhz2-0 dqkTeL" style="max-width: 288px;">
                  <a class="sc-1v38bp9-0 sc-1h2bnkx-0 cYYJWF bGongl" href="/en/nonprofit/905e77d651b74af78826b68c1668cd03-globalteer-totnes">
                    <img src="../uploads/<?php echo $event['Foto_Event'] ?>"  
                        alt="Logo" 
                        width="180" height="128" data-qa-id="org-logo" 
                        loading="lazy" style="max-width: 100%; max-height: 100%; object-fit: contain; object-position: left center; aspect-ratio: 1240 / 1240;">
                  </a>
                  <div aria-hidden="true">
                    <div class="sc-1pfcxqe-0 fEPRNl">
                      <h5 class="card-title"><?php echo $event['Nama_Event'] ?></h5>
                      <div class="sc-1pfcxqe-0 gqSmpY">
                        <a href="/en/nonprofit/905e77d651b74af78826b68c1668cd03-globalteer-totnes" 
                          data-qa-id="org-link" class="sc-12kw2ys-0 ccxKLl" style="outline: 0px;">Posted By <?php echo $event['Dipost_Oleh'] ?></a>
                      </div>
                      <div class="sc-1p4hpd5-0 gBLkfM">
                        <div data-qa-id="listing-status" class="sc-1p4hpd5-1 kGacPS">
                          <div role="img" aria-label="location-filled icon" class="sc-r8vw27-0 kZkhXp" 
                              style="width: 13px; height: 13px; --src: url(/assets/1e6ab527da68b229b85423a89312857fb126330b/images/icons/normalized/location-filled.svg);"></div>On-site
                        </div>
                        <div class="sc-1p4hpd5-2 cyfHIj border-bottom"><span class="text-muted small">
                                  <i class="fas fa-map-marker-alt"></i>
                                  <?php echo $event['Lokasi'] ?>
                                  </span></div>
                      </div>
                    </div>
                    <hr class="sc-rzizms-0 jECxmY" style="margin-top: 24px; margin-bottom: 24px;">
                  </div>
                  <div style="display: flex; align-items: center;">
                      <div class="sc-1oq5f4p-0 kDLhAy">Posted <?php echo $event['Tanggal_Posting'] ?></div>
                  </div>
                  <div class="sc-1pfcxqe-0 kiNRKh">
                    <div class="sc-1nql2tu-0 kLioV">
                      <div style="margin-top: 24px;">
                        <a class="sc-1w2vike-0 kzHTox primary medium" 
                          data-qa-id="easy-apply-button" href="/en/nonprofit-internship/3a3cc4864c514db39da7d48e5123e17d-sports-coach-in-cambodia-with-a-uk-charity-accommodation-food-included-globalteer-krong-siem-reap#apply">
                          <div class="mb-3">
                            <button class="btn btn-primary me-2">Apply</button>
                          </div>
                        </a>
                      </div>
                    </div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
          <!-- Tombol untuk menampilkan filter -->
          
        </div>
      </div>
    </div>

<!--filter end-->


<div class="col-lg-9 mt-5">
  <!-- Event Details Section -->
  <div class="container mt-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title"><?php echo $event['Nama_Event'] ?></h5>
        <h6 class="card-subtitle mb-2 text-muted">Posted By <?php echo $event['Dipost_Oleh'] ?></h6>
        <p class="card-text"><?php echo $event['Tipe_Acara'] ?>, <span class="text-muted small">
                                  <i class="fas fa-map-marker-alt"></i>
                                  <?php echo $event['Lokasi'] ?>
                                  </span></p>
        
        <!-- Apply, Save, Share Buttons -->
        <div class="mb-3">
          <button class="btn btn-primary me-2">Apply</button>
          <button class="btn btn-outline-secondary me-2">Bookmark</button>
          <button class="btn btn-outline-secondary">Share</button>
        </div>

        <!-- Event Details -->
        <h6>Details</h6>
        <ul class="list-group">
          <li class="list-group-item"><strong>Internship Benefits:</strong> <?php echo $event['Manfaat'] ?></li>
          <li class="list-group-item"><strong>Payment:</strong> <?php echo $event['Jenis_Pembayaran'] ?></li>
          <li class="list-group-item"><strong>Stipend / Wage:</strong> <?php echo $event['Stipend_Wage'] ?></li>
          <li class="list-group-item"><strong>Hours Per Week:</strong> <?php echo $event['Jam_Pekerjaan'] ?> Hours Per Week</li>
        </ul>

        <div id="desc" class="mt-4">
          <div class="mt-4">
            <h6>Description</h6>
            <p><?php echo $event['Deskripsi'] ?></p>
          </div>
        </div>

        <div id="apply" class="mt-4">
          <div class="mt-4">
            <h6>How To Apply:</h6>
            <p>Interested candidates are requested to send the following to <a href="<?php echo $event['Email_Kontak'] ?>"><?php echo $event['Email_Kontak'] ?></a></p>
            <ol>
              <li>One-page cover letter outlining:</li>
              <ul>
                <li>The role you are applying for</li>
                <li>The location you are applying for</li>
                <li>Why you are applying</li>
                <li>What you think you can bring to the role</li>
                <li>Your planned start date</li>
                <li>Your time commitment</li>
              </ul>
              <li>A detailed CV/Resume</li>
            </ol>
          </div>
        </div>

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



<!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
<!--  Google Maps Plugin    -->

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
