<?php

@include '../config.php';
session_start();

if(isset($_SESSION['Email'])) {
    $Email = $_SESSION['Email']; 
} else {
    header("Location: editprofile.php?error=Email is not set in the session");

}

if(!isset($_SESSION['NamaDepan'])){
    header('location:../Login_Signup/Login.php');
}
$Query = mysqli_query($conn, "SELECT * FROM relawan WHERE Email = '$Email'");
$data = mysqli_fetch_array($Query);
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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/HandinHandLogo.png">
  
  <title>
    Your Profile
  </title>
  <!--     Fonts and icons     -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-design-system.css?v=1.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="blog-author bg-gray-100">
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

  <!-- START Testimonials w/ user image & text & info -->
  <section class="pt-6 position-relative">
          
  <div class="container my-5" data-aos="fade-up">
  <div class="card shadow p-4">
    <form action="../upload.php" method="post" enctype="multipart/form-data">
      <div class="d-flex align-items-center mb-4">
        <!-- Profile Photo -->
        <div class="me-3">
          <?php
            $carifoto = "SELECT Foto_Profil FROM relawan WHERE Nama_Depan = '$_SESSION[NamaDepan]'";
            $fotoprofil = mysqli_query($conn, $carifoto);
            if(mysqli_num_rows($fotoprofil) > 0) {
              while ($relawan = mysqli_fetch_assoc($fotoprofil)) {
                if($relawan['Foto_Profil'] !== NULL) {
          ?>
                  <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" src="../uploads/<?=$relawan['Foto_Profil']?>">
          <?php  
                } else {
          ?>
                  <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" src="../assets/img/def.jpg">
          <?php 
                }
              }
            } else {
          ?>
              <img class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" src="../assets/img/def.jpg">
          <?php 
            }
          ?>
        </div>

        <div>
          <input type="file" id="fileInput" name="profile-photo" accept="image/png, image/jpeg" />
          <p class="small text-muted mt-1">At least 800x800 px recommended.<br>JPG or PNG is allowed</p>
        </div>
        <button type="button" id="editmodal" class="btn btn-primary ms-lg-auto"  data-bs-toggle="modal" data-bs-target="#updatePasswordModal">
          <i class="fas fa-pencil-alt me-1"></i> Change Password
        </button>
      </div>

      <!-- Personal Info -->
      <h5>Personal Info</h5>
      <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
        <div>
          <p class="mb-1"><strong>Full Name</strong>: <?php echo $_SESSION['NamaDepan'] . ' ' . $_SESSION['NamaBelakang']; ?></p>
          <p class="mb-1"><strong>Email</strong>: <?php echo $_SESSION['Email']?></p>
        </div>
        <button type="button" id="editmodal" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
      </div>

      <!-- Location -->
      <h5>Location</h5>
      <div class="d-flex align-items-center mb-3">
        <input type="text" class="form-control me-3" placeholder="e.g Bandung, Jawa Barat, Indonesia" value="<?php echo $data['Lokasi'] ?>" name="Lokasi">
      </div>

      <!-- Bio -->
      <h5>Bio</h5>
      <div class="mb-3">
        <textarea class="form-control" rows="5" name="Bio"><?php echo $data['Bio'] ?></textarea>
      </div>

      <div class="d-flex justify-content-end mt-4">
        <button type="button" onclick="window.location.href='author.php'" class="btn btn-secondary me-2">Cancel</button>
        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
      </div>
    </form>
    <form action="../delete.php" method="post">
        <button type="submit" class="btn btn-danger btn-sm" name="delete_photo">Delete Profile Photo</button>
    </form>
    
  </div>
</div>

<!-- Modal Edit Password -->
<div class="modal fade" id="updatePasswordModal" tabindex="-1" aria-labelledby="updatePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatePasswordModalLabel">Update Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../update_password.php" method="POST">
          <div class="mb-3">
            <label for="oldPassword" class="form-label">Old Password</label>
            <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
          </div>
          <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
          </div>
          <div class="mb-3">
            <label for="confirmNewPassword" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="updatePassword">Update Password</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
    

    <!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Personal Info</h5>
        <button id="editpersonal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../updatepersonal.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="fullName" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fullName" name="namadepan" value="<?php echo $_SESSION['NamaDepan']; ?>">
          </div>
          <div class="mb-3">
            <label for="fullName" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="fullName" name="namabelakang" value="<?php echo $_SESSION['NamaBelakang']; ?>">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="Email_Baru" value="<?php echo $_SESSION['Email']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

</section>


  <footer class="footer">
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
  <!-- -------- END FOOTER 5 w/ DARK BACKGROUND ------- -->
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <!--  Plugin for Parallax, full documentation here: https://github.com/wagerfield/parallax  -->
  <script src="../assets/js/plugins/parallax.min.js"></script>
  <!-- Control Center for Soft UI Kit: parallax effects, scripts for the example pages etc -->
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDTTfWur0PDbZWPr7Pmq8K3jiDp0_xUziI"></script>
  <script src="../assets/js/soft-design-system.min.js?v=1.1.0" type="text/javascript"></script>
</body>

</html>