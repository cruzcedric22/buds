<?php
require_once "includes/config.php";
session_start();

// if (isset($_POST['txtEmail']) && isset($_POST['txtUserPass'])) {
//     $e = addslashes($_POST['txtEmail']);
//     $p = addslashes($_POST['txtUserPass']);
//     $sql = "SELECT * FROM login WHERE email='$e' AND password='$p'";

//     if ($rs = $conn->query($sql)) {
//         if ($rs->num_rows > 0) {
//             $row = $rs->fetch_assoc();
//             $userType = $row['userType'];


//             // Redirect based on userType
//             if ($userType == "1") {
//                 // Guest redirection
//                 // header("location: index.php");
//             } elseif ($userType == "2") {
//                 // Business admin redirection
//                 $_SESSION['email'] = $e;
// 								// Retrieve ownerId for the logged-in user
// 							 $ownerSql = "SELECT ID FROM owner_list WHERE Email='$e'";
// 							 $ownerResult = $conn->query($ownerSql);

// 							 if ($ownerResult->num_rows > 0) {
// 									 $ownerRow = $ownerResult->fetch_assoc();
// 									 $_SESSION['ownerId'] = $ownerRow['ID']; // Store ownerId in a session variable
// 							 }

//                 header('location: homepage.php');
//             } elseif ($userType == "3") {
//                 // Regular user redirection
//                 // header('location: index.php');
//             } elseif ($userType == "4") {
//                 // Superadmin redirection
//                 // header('location: index.php');
//         } else {
//             // Login failed
//             echo '<script> alert("Login Failed: Invalid Credentials!")</script>';
//         }
//     } else {
//         // Query error
//         echo $conn->error;
//     }
// 	}
// }

//GUEST USER SIGN IN
if (isset($_POST["signguest"])) {

  $firstname      = $_POST['fname'];
  $middlename     = $_POST['mname'];
  $lastname       = $_POST['lname'];
  $email          = $_POST['email'];
  $password       = $_POST['password'];
  $passconfirm    = $_POST['passwordconfirm'];

  $sql1 = "INSERT INTO `guest_login`( `firstName`, `middleName`, `lastName`, `email`, `password`, `confirmPassword`) VALUES ('$firstname','$middlename','$lastname','$email','$password','$passconfirm')";
  $result1 = $conn->query($sql1);

  $sql2 = "INSERT INTO `login` (`email`,`password`,`userType`) VALUES ('$email','$password', 'guest')";
  $result2 = $conn->query($sql2);

  header("Location: index.php");
  exit();
}

//BUSINESS SIGN UP

if (isset($_POST["btnbusiness"])) {
  $Email          = $_POST['email'];
  $Firstname      = $_POST['firstname'];
  $Middlename     = $_POST['middlename'];
  $Surname        = $_POST['surname'];
  $Birthday        = $_POST['birthday'];
  $Age            = $_POST['age'];
  $Sex            = $_POST['sex'];
  $Address        = $_POST['address'];
  $Contactnumber  = $_POST['contactnumber'];
  $Password       = $_POST['password'];
  $Passconfirm    = $_POST['passwordconfirm'];

  $sql3 = "INSERT INTO owner_list (Surname, Firstname, MiddleName, Email, contactNumber, Address, Sex, Birthday, Age) VALUES ('$Surname','$Firstname','$Middlename','$Email','$Contactnumber','$Address','$Sex','$Birthday','$Age')";


  if ($Password !== $Passconfirm) {
    echo '<script>alert("Password do not match! Please Try Again.")</script>';
  } elseif ($conn->query($sql3)) {
    $sql4 = "INSERT INTO login (email,password,usertype) VALUES ('$Email', '$Password', '2')";
    $result4 = $conn->query($sql4);
    echo '<script>alert("Registration Success!")</script>';
    header("Location: index.php");
    exit();
  } else {
    die("Error:" . $conn->error);
    echo '<script>alert("Registration Failed!")</script>';
  }
}


?>
<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Aler Template">
  <meta name="keywords" content="Aler, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
  <title>BuDS</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
  <link rel="stylesheet" href="css/nice-select.css" type="text/css">
  <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
  <link rel="stylesheet" href="css/magnific-popup.css" type="text/css">
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="css/style.css" type="text/css">
  <link rel="stylesheet" href="css/templatemo-plot-listing.css" type="text/css">

</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Offcanvas Menu Wrapper Begin -->
  <div class="offcanvas-menu-overlay"></div>
  <div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
      <span class="icon_close"></span>
    </div>
    <div class="logo">
      <a href="./index.html">
        <img src="img/logo-main.png" alt="">
      </a>
    </div>
    <div id="mobile-menu-wrap"></div>
    <div class="om-widget">
      <!-- <ul>
                <li><i class="icon_mail_alt"></i> Aler.support@gmail.com</li>
                <li><i class="fa fa-mobile-phone"></i> 125-711-811 <span>125-668-886</span></li>
            </ul> -->
      <a href="#" class="hw-btn">Sign-In</a>
    </div>
  </div>
  <!-- Offcanvas Menu Wrapper End -->

  <!-- Header Section Begin -->
  <header class="header-section">
    <div class="hs-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-2">
            <div class="logo">
              <a href="./index.php"><img src="img/logo-main.png" alt=""></a><br>
              <!-- <ul>Business Directory</ul> -->
            </div>
          </div>
          <div class="col-lg-10">
            <div class="ht-widget">
              <button onclick="document.getElementById('id01').style.display='block'">Login</a>
            </div>

          </div>

        </div>

        <div class="canvas-open">
          <span class="icon_menu"></span>
        </div>
      </div>
    </div>
    <div class="hs-nav">
      <div class="container">
        <div class="row">
          <div class="col-lg-9">
            <nav class="nav-menu">
              <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./listing.php">Business Listing</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div id="id01" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content w-100">
        <div class="modal-header">
          <h3 class="text-center mb-6 font-weight-bold">LOG IN</h3>
          <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container mt-4">
          <div class="card px-2 py-3" id="form1">
            <div class="form-data" v-if="!submitted">
              <div class="forms-inputs mb-4">
                <form method="post">
                  <span>Email</span>
                  <input type="text" name="txtEmail" id="email" required>
              </div>
              <div class="forms-inputs mb-4">
                <span>Password</span>
                <input type="password" name="txtUserPass" required>
                <h6><a href="#">Forgot Password?</a></h6>
              </div>
              <div class="mb-3">
                <button class="btn w-100">LOG IN</button>
              </div>
            </div>
            </form>
            <div class="success-data" v-else>
              <div class="text-center d-flex flex-column">
                <h6 class="text-center fs-1">Don't have a user account? <a href="#id02" data-toggle="modal">Sign Up</a></h6>
              </div>
            </div>
            <div class="success-data" v-else>
              <div class="text-center d-flex flex-column">
                <h6 class="text-center fs-1">Don't have a business account? <a href="#id03" data-toggle="modal">Sign Up</a></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="id02" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content w-100">
        <div class="modal-header">
          <h3 class="text-center mb-6 font-weight-bold">USER ACCOUNT REGISTRATION</h3>
          <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container mt-4">
          <div class="card px-2 py-3" id="form2">
            <div class="form-data" v-if="!submitted">
              <form class="" action="index.php" method="post">

              </form>
              <div class="row">
                <div class="col">
                  <div class="forms-inputs mb-4"> <span>First Name</span> <input type="text">
                  </div>
                </div>
                <div class="col">
                  <div class="forms-inputs mb-4"> <span>Middle Name</span> <input type="text">
                  </div>
                </div>

                <div class="col">
                  <div class="forms-inputs mb-4"> <span>Last Name</span> <input type="text">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="forms-inputs mb-4"> <span>Email</span> <input type="text"> </div>
                </div>
              </div>
              <div class="forms-inputs mb-4"> <span>Password</span> <input type="password">
              </div>
              <div class="forms-inputs mb-4"> <span>Confirm Password</span> <input type="password">
              </div>
              <!-- <div class="form-group form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <p class="form-check-label" for="exampleCheck1">By clicking this, you are agreeing to the <a href="#">Terms & Conditions </a> and the <a href="#">Privacy Policy</a>.</p>
                            </div> -->
              <div class="mb-3"> <button class="btn w-100">SIGN UP</button> </div>
            </div>
            <!-- <div class="success-data" v-else>
                          <div class="text-center d-flex flex-column"> <i class='bx bxs-badge-check'></i> <h6 class="text-center fs-1">Already have an Account? <a href="#id01" data-toggle="modal">Sign In</a></h6> </div>
                      </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="id03" class="modal">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content w-100">
        <div class="modal-header">
          <h3 class="text-center mb-6 font-weight-bold">BUSINESS ACCOUNT REGISTRATION</h3>
          <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
        </div>
        <div class="container mt-4">
          <div class="card px-2 py-3" id="form2">
            <div class="form-data" v-if="!submitted">
              <form class="" action="index.php" method="post">
                <div class="row">
                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>Email</span> <input type="email" name="email"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>First Name</span> <input type="text" name="firstname"></div>
                  </div>
                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>Middle Name</span> <input type="text" name="middlename"></div>
                  </div>

                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>Last Name</span> <input type="text" name="surname">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>Birthday</span> <input type="date" name="birthday" required></div>
                  </div>
                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>Age</span> <input type="text" name="age" required></div>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group form-check">
                      <span>Sex</span>
                      <br>
                      <input type="radio" id="Female" name="sex" value="Female" required> Female
                      <input type="radio" id="Male" name="sex" value="Male" required> Male
                    </div>
                  </div>

                  <div class="col">
                    <div class="forms-inputs mb-4"> <span>Contact Number</span> <input type="tell" name="contactnumber"></div>
                  </div>
                </div>
                <div class="forms-inputs mb-4"> <span>Address</span> <input type="text" name="address"></div>
                <div class="forms-inputs mb-4"> <span>Password</span> <input type="password" name="password"></div>
                <div class="forms-inputs mb-4"> <span>Confirm Password</span> <input type="password" name="passwordconfirm"></div>
                <div class="form-group form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <p class="form-check-label" for="exampleCheck1">By clicking this, you are agreeing to the <a href="#">Terms & Conditions </a> and the <a href="#">Privacy Policy</a>.</p>
                </div>
                <div class="mb-3"> <button class="btn w-100" name="btnbusiness">SIGN UP</button></div>
            </div>
            </form>
            <!-- <div class="success-data" v-else>
                          <div class="text-center d-flex flex-column"> <i class='bx bxs-badge-check'></i> <h6 class="text-center fs-1">Already have an Account? <a href="#id01" data-toggle="modal">Sign In</a></h6> </div>
                      </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Hero Section Begin -->
  <div class="main-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="top-text header-text">
            <h6>Business Directory of Caloocan City </h6>
            <h2>Find and Discover Local Business</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <form id="search-form" class="filter-form" name="gs" method="submit" role="search" action="#">
            <div class="row">
              <div class="col-lg-9 align-self-center">
                <fieldset>
                  <input type="name" name="name" id="searchVal" class="searchText" placeholder=" Enter a Business Name" autocomplete="on" required>
                </fieldset>
              </div>
              <div class="col-lg-3">
                <fieldset>
                  <button class="main-button" onclick="searchpage()"><i class="fa fa-search"></i> Search Now</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-lg-10 offset-lg-1">
          <ul class="categories">
            <li><a href="category.html"><span class="icon"><img src="img/categories/search-icon-01.png" alt="Home"></span> Real Estate</a></li>
            <li><a href="listing.html"><span class="icon"><img src="img/categories/search-icon-02.png" alt="Food"></span> Food & Dining</a></li>
            <li><a href="#"><span class="icon"><img src="img/categories/search-icon-03.png" alt="Vehicle"></span> Automotive</a></li>
            <li><a href="#"><span class="icon"><img src="img/categories/search-icon-04.png" alt="Shopping"></span> Shopping</a></li>
            <li><a href="#"><span class="icon"><img src="img/categories/search-icon-05.png" alt="Travel"></span> More</a></li>

          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Property Section Begin -->
  <section class="property-section latest-property-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-title">
            <h4>LATEST BUSINESS</h4>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="property-controls">
            <ul>
              <li data-filter="all">All</li>
              <li data-filter=".automotive">Automotive</li>
              <li data-filter=".food">Food & Dining </li>
              <li data-filter=".hotel">Hotel</li>
              <li data-filter=".estate">Real Estate</li>
              <li data-filter=".travel">Travel</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row property-filter">
        <div class="col-lg-4 col-md-6 mix all hotel">
          <div class="property-item">
            <div class="pi-pic set-bg" data-setbg="img/property/listing-01.jpg">
            </div>
            <div class="pi-text">
              <h5><a href="./details.html">Sogo</a></h5>
              <p><span class="icon_pin_alt"></span> Monumento, Caloocan City</p>
              <ul>
                <li><i class="fa fa-info"></i> Desciption about Business</li>
              </ul>
              <div class="pi-agent">
                <div class="pa-item">
                  <div class="pa-text">
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-search"></i> View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mix all food">
          <div class="property-item">
            <div class="pi-pic set-bg" data-setbg="img/property/listing-04.jpg">
            </div>
            <div class="pi-text">
              <h5><a href="./details.html">Silver Crown</a></h5>
              <p><span class="icon_pin_alt"></span> Sangandaan, Caloocan City</p>
              <ul>
                <li><i class="fa fa-info"></i> Desciption about Business</li>
              </ul>
              <div class="pi-agent">
                <div class="pa-item">
                  <div class="pa-text">
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-search"></i> View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mix all estate">
          <div class="property-item">
            <div class="pi-pic set-bg" data-setbg="img/property/listing-03.jpg">
            </div>
            <div class="pi-text">
              <h5><a href="./details.html">Emiart</a></h5>
              <p><span class="icon_pin_alt"></span> Maypajo, Caloocan City</p>
              <ul>
                <li><i class="fa fa-info"></i> Desciption about Business</li>
              </ul>
              <div class="pi-agent">
                <div class="pa-item">
                  <div class="pa-text">
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-search"></i> View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mix all food">
          <div class="property-item">
            <div class="pi-pic set-bg" data-setbg="img/property/listing-07.jpg">
            </div>
            <div class="pi-text">
              <h5><a href="./details.html">Jollibee</a></h5>
              <p><span class="icon_pin_alt"></span> 10th Avenue, Caloocan City</p>
              <ul>
                <li><i class="fa fa-info"></i> Desciption about Business</li>
              </ul>
              <div class="pi-agent">
                <div class="pa-item">
                  <div class="pa-text">
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-search"></i> View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mix all food">
          <div class="property-item">
            <div class="pi-pic set-bg" data-setbg="img/property/listing-08.jpg">
            </div>
            <div class="pi-text">
              <h5><a href="./details.html">Mc Donalds</a></h5>
              <p><span class="icon_pin_alt"></span> Maypajo, Caloocan City</p>
              <ul>
                <li><i class="fa fa-info"></i> Desciption about Business</li>
              </ul>
              <div class="pi-agent">
                <div class="pa-item">
                  <div class="pa-text">
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-search"></i> View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mix all food">
          <div class="property-item">
            <div class="pi-pic set-bg" data-setbg="img/property/listing-09.jpg">
            </div>
            <div class="pi-text">
              <h5><a href="./details.html">KFC</a></h5>
              <p><span class="icon_pin_alt"></span> 10th Avenue, Caloocan City</p>
              <ul>
                <li><i class="fa fa-info"></i> Desciption about Business</li>
              </ul>
              <div class="pi-agent">
                <div class="pa-item">
                  <div class="pa-text">
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-search"></i> View More</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="team-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8">
          <div class="section-title">
            <h4>Top 10 Popular Business in the City of Caloocan</h4>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center mb-3">
          <div class="col-lg-12 col-xl-12">
            <div class="card shadow-0 border rounded-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12 col-lg-5 col-xl-5 mb-lg-0">
                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                      <img src="img/property/listing-09.jpg" class="w-100" />
                      <a href="#!">
                        <div class="hover-overlay">
                          <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                    <br>
                    <h5>Businesss Name</h5>
                    <h6>Business Owner</h6>
                    <div class="d-flex flex-row">
                      <div class="text-warning mb-1 me-2">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <span> (310) Reviews</span>
                    </div>
                    <div class="mt-1 mb-0 text-muted small">
                      <span>Category</span>
                      <span class="text-primary"> • </span>
                      <span>Category</span>
                      <span class="text-primary"> • </span>
                      <span>Category<br /></span>
                    </div>
                    <p class="text-truncate mb-4 mb-md-0">
                      Brief Description about the Business
                    </p>
                    <br>
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-eye"></i> View Info</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center mb-3">
          <div class="col-lg-12 col-xl-12">
            <div class="card shadow-0 border rounded-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12 col-lg-5 col-xl-5 mb-lg-0">
                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                      <img src="img/property/listing-08.jpg" class="w-100" />
                      <a href="#!">
                        <div class="hover-overlay">
                          <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                    <br>
                    <h5>Businesss Name</h5>
                    <h6>Business Owner</h6>
                    <div class="d-flex flex-row">
                      <div class="text-warning mb-1 me-2">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <span> (310) Reviews</span>
                    </div>
                    <div class="mt-1 mb-0 text-muted small">
                      <span>Category</span>
                      <span class="text-primary"> • </span>
                      <span>Category</span>
                      <span class="text-primary"> • </span>
                      <span>Category<br /></span>
                    </div>
                    <p class="text-truncate mb-4 mb-md-0">
                      Brief Description about the Business
                    </p>
                    <br>
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-eye"></i> View Info</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row justify-content-center mb-3">
          <div class="col-lg-12 col-xl-12">
            <div class="card shadow-0 border rounded-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-12 col-lg-5 col-xl-5 mb-lg-0">
                    <div class="bg-image hover-zoom ripple rounded ripple-surface">
                      <img src="img/property/listing-07.jpg" class="w-100" />
                      <a href="#!">
                        <div class="hover-overlay">
                          <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                        </div>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                    <br>
                    <h5>Businesss Name</h5>
                    <h6>Business Owner</h6>
                    <div class="d-flex flex-row">
                      <div class="text-warning mb-1 me-2">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                      </div>
                      <span> (310) Reviews</span>
                    </div>
                    <div class="mt-1 mb-0 text-muted small">
                      <span>Category</span>
                      <span class="text-primary"> • </span>
                      <span>Category</span>
                      <span class="text-primary"> • </span>
                      <span>Category<br /></span>
                    </div>
                    <p class="text-truncate mb-4 mb-md-0">
                      Brief Description about the Business
                    </p>
                    <br>
                    <a class="btn btn-success" href="./details.html" role="button"><i class="fa fa-eye"></i> View Info</a>
                    <!-- <div class="btn btn-outline-success">
                                    <a href="contact.html"><i class="fa fa-search"></i> View More</a>
                                  </div> -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </section>

  <!-- Footer Section Begin -->
  <footer class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="fs-about">
            <div class="fs-logo">
              <a href="#">
                <img src="img/flogo.png" alt="">
              </a>
            </div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
              labore et dolore magna aliqua ut aliquip ex ea</p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Footer Section End -->

  <!-- Js Plugins -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/mixitup.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <script src="js/jquery.slicknav.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.richtext.min.js"></script>
  <script src="js/image-uploader.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/main1.js"></script>
  <script src="js/login.js"></script>
  <script>
    $('#id02, #id03').on('show.bs.modal', function(e) {
      $('#id01').modal('hide'); // Close the first modal when the second modal is shown
    });

    $('#id02, #id03').on('hidden.bs.modal', function(e) {
      $('#id01').modal('show'); // Reopen the first modal when the second or third modal is closed
    });

    function searchpage() {
      var searchVal = encodeURIComponent($('#searchVal').val()); // Encode the searchVal
      setTimeout(function() {
        window.location.href = "listing.php?a=" + searchVal;
      }, 1);
    }
  </script>
</body>

</html>