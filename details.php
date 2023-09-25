<?php
require_once('./includes/config.php');
session_start();
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header('Location: ceipo/index.php');
    }
}
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);

$id = $_GET['ID'];
//old query
// $sql = "SELECT * FROM business_list WHERE bus_id = '$id'";
$sql = "SELECT * FROM business_list AS bl 
INNER JOIN business_links AS bll ON bl.bus_id = bll.bus_id
INNER JOIN brgyzone_list AS bzl ON bl.BusinessBrgy = bzl.ID
INNER JOIN business_location AS bloc ON bl.bus_id = bloc.bus_id
WHERE 
bl.bus_id = $id";
$disp = "";
$overview = "";
$FAQs = "";
$socialMedia = "";
if ($rs = $conn->query($sql)) {
    if ($rs->num_rows > 0) {
        while ($row = $rs->fetch_assoc()) {
            $disp .= '<div class="row">
                        <div class="col-lg-4">
                            <div class="profile-agent-info">
                                <div class="pi-pic">
                                    <img src=" img/logo/' . $row['Businesslogo'] . '" alt="">
                                    <div class="rating-point">
                                        4.5
                                    </div>
                                </div>
                                <div class="pi-text">
                                    <h5>' . $row['BusinessName'] . '</h5>
                                    <p>Since April 2001</p>
                                    <p>Opening Time: ' . $row['BusinessOpenHour'] . ' Closing Time: ' . $row['BusinessCloseHour'] . '</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="profile-agent-widget">
                                <ul>
                                    <li>Address <span>' . $row['BusinessAddress'] . ' Brgy. ' . $row['BusinessBrgy'] . ' Zone: ' . $row['zone'] . '</span></li>
                                    <li>Contact Us <span>123-456-789</span><br><span>123-456-789</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="profile-agent-newslatter">
                                <h5>Mark Us!</h5>
                                <form action="#">
                                    <div class="btn btn-success mx"><i class="fa fa-phone"></i> Call</div>
                                    <div class="btn btn-success mx"><i class="fa fa-star"></i> Rate Us!</div>
                                </form>
                            </div>
                        </div>
                    </div>';
            $overview .= '<div class="tab-desc">
                        <p>' . $row['BusinessDescrip'] . '</p>
                  </div>';
            $FAQs .= '<div class="tab-desc">
                <p>FAQs AREA</p>
              </div>';
            $socialMedia .= '<div class="section-title sidebar-title">
                        <h5>FOLLOW US</h5>
                    </div>
                    <div class="fu-links">
                        <a href=' . $row['bus_fb'] . ' class="facebook"><i class="fa fa-facebook"></i></a>
                        <a href=' . $row['bus_ig'] . ' class="instagram"><i class="fa fa-instagram"></i></a>
                    </div>';
            $lat = $row['bus_lat'];
            $long = $row['bus_long'];
            $bus_name = $row['BusinessName'];
            $bus_add = $row['BusinessAddress'];
        }
        // echo $lat;
        // echo $long;

    }
}

$sql1 = "SELECT *
FROM business_applicant AS bl
LEFT JOIN application_list AS ap ON ap.bus_app = bl.bus_applicant
LEFT JOIN business_list AS bll ON bl.bus_id = bll.bus_id
WHERE bl.bus_id = :id
AND (ap.app_id IS NULL OR ap.app_id != :app_id);";
$pdo = Database::connection();
$stmt1 = $pdo->prepare($sql1);
$stmt1->bindParam(':id', $id, PDO::PARAM_STR);
$stmt1->bindParam(':app_id', $_SESSION['ownerId'], PDO::PARAM_STR);
$stmt1->execute();
$datas = $stmt1->fetchAll();

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
    <link rel="stylesheet" href="css/star.css" type="text/css">
    <link rel="stylesheet" href="css/style1.css" type="text/css">
    <link rel="stylesheet" href="css/templatemo-plot-listing1.css" type="text/css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        /* Add this CSS to your stylesheet */
        .swal-confirm-button {
            width: 100px;
            /* Adjust the width as needed */
        }

        #map {
            display: flex;
            margin: auto;
            width: 600px;
            height: 450px;
        }
    </style>

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
            <a href="index.php">
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
                    <?php if (empty($_SESSION['email'])) { ?>
                        <div class="col-lg-9">
                            <div class="ht-widget">
                                <button onclick="document.getElementById('id01').style.display='block'">Login</a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-9">
                            <div class="ht-widget">
                                <div class="hs-nav">
                                    <nav class="nav-menu">
                                        <ul>
                                            <li class="profile-dropdown">
                                                <div class="user-profile">
                                                    <?php if (isset($_SESSION['photo'])) { ?>
                                                        <img src="img/testimonial-author/unknown.jpg" alt="User's Name">
                                                    <?php } else { ?>
                                                        <img src="img/testimonial-author/unknown.jpg" alt="User's Name">
                                                    <?php } ?>
                                                </div>
                                                <ul class="dropdown dropleft">
                                                    <li>
                                                        <h2><?php echo $_SESSION['lname'] . ' , ' . $_SESSION['fname'] ?></h2>
                                                    </li>
                                                    <li><a href="user.php">MY PROFILE</a></li>
                                                    <?php if ($_SESSION['role'] == 3) { ?>
                                                        <li><a href="user_module-main/index.php">CREATE RESUME</a></li>
                                                    <?php } ?>
                                                    <?php if ($_SESSION['role'] == 2) { ?>
                                                        <li><a href="manage.php">MANAGE BUSINESS</a></li>
                                                        <li><a href="listing-form.php">ADD BUSINESS</a></li>
                                                    <?php } ?>
                                                    <li><a href="logout.php">LOGOUT</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
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
                                <li class="active"><a href="index.php">Home</a></li>
                                <!-- <li><a href="./listing.php">Business Listing</a></li> -->
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
                                <!-- <form method="post"> -->
                                <span>Email</span>
                                <input type="text" name="txtEmail" id="email_log" required>
                            </div>
                            <div class="forms-inputs mb-4">
                                <span>Password</span>
                                <input type="password" name="txtUserPass" id="password_log" required>
                                <h6><a href="#">Forgot Password?</a></h6>
                            </div>
                            <div class="mb-3">
                                <button type="button" class="btn w-100" onclick="loginUser()">LOG IN</button>
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

    <!-- modal for user create -->
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
                                    <div class="forms-inputs mb-4"> <span>First Name</span> <input id="f_name" type="text">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="forms-inputs mb-4"> <span>Middle Name</span> <input id="m_name" type="text">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="forms-inputs mb-4"> <span>Last Name</span> <input id="l_name" type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="forms-inputs mb-4"> <span>Email</span> <input type="text" id="emailUser"> </div>
                                </div>
                            </div>
                            <div class="forms-inputs mb-4"> <span>Password</span> <input type="password" id="pass">
                            </div>
                            <div class="forms-inputs mb-4"> <span>Confirm Password</span> <input type="password" id="con_pass">
                            </div>
                            <!-- <div class="form-group form-check">
                              <input type="checkbox" class="form-check-input" id="exampleCheck1">
                              <p class="form-check-label" for="exampleCheck1">By clicking this, you are agreeing to the <a href="#">Terms & Conditions </a> and the <a href="#">Privacy Policy</a>.</p>
                            </div> -->
                            <div class="mb-3"> <button class="btn w-100" onclick="createUser()">SIGN UP</button> </div>
                        </div>
                        <!-- <div class="success-data" v-else>
                          <div class="text-center d-flex flex-column"> <i class='bx bxs-badge-check'></i> <h6 class="text-center fs-1">Already have an Account? <a href="#id01" data-toggle="modal">Sign In</a></h6> </div>
                      </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal for business create -->
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
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="forms-inputs mb-4"> <span>Email</span> <input type="email" name="email" id="ownerEmail"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="forms-inputs mb-4"> <span>First Name</span> <input type="text" name="firstname" id="ownerFname"></div>
                                    </div>
                                    <div class="col">
                                        <div class="forms-inputs mb-4"> <span>Middle Name</span> <input type="text" name="middlename" id="ownerMname"></div>
                                    </div>

                                    <div class="col">
                                        <div class="forms-inputs mb-4"> <span>Last Name</span> <input type="text" name="surname" id="ownerLname">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="forms-inputs mb-4"> <span>Birthday</span> <input type="date" name="birthday" required id="ownerBirthday"></div>
                                    </div>
                                    <div class="col">
                                        <div class="forms-inputs mb-4"> <span>Age</span> <input type="text" name="age" required id="ownerAge"></div>
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
                                        <div class="forms-inputs mb-4"> <span>Contact Number</span> <input type="tell" name="contactnumber" id="ownerNumber"></div>
                                    </div>
                                </div>
                                <div class="forms-inputs mb-4"> <span>Address</span> <input type="text" name="address" id="ownerAddress"></div>
                                <div class="forms-inputs mb-4"> <span>Password</span> <input type="password" name="password" id="ownerPass"></div>
                                <div class="forms-inputs mb-4"> <span>Confirm Password</span> <input type="password" name="passwordconfirm" id="ownerConPass"></div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="checkTerms">
                                    <p class="form-check-label" for="exampleCheck1">By clicking this, you are agreeing to the <a href="#">Terms & Conditions </a> and the <a href="#">Privacy Policy</a>.</p>
                                </div>
                                <div class="mb-3"> <button disabled class="btn w-100" id="signUp" onclick="createBusinessOwner()" name="btnbusiness" type="button">SIGN UP</button></div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->

    <!-- Property Details Section Begin -->
    <section class="property-section latest-property-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="section-title">
                        <h4>BUSINESS INFORMATION</h4>
                    </div>
                </div>
                <div class="container">
                    <div class="profile-agent-content">
                        <?php echo $disp ?>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="pd-text">
                                <div class="pd-board">
                                    <br>
                                    <div class="tab-board">
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Overview</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">FAQs</a>
                                            </li>
                                        </ul><!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                                <?php echo $overview; ?>
                                            </div>
                                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                                <?php echo $FAQs ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="pd-widget">
                                    <h4>GALLERYS</h4>
                                    <div class="fp-slider owl-carousel">
                                        <div class="fp-item set-bg" data-setbg="img/gallery/1.jpg">
                                            <div class="fp-text">
                                                <h5 class="title">Jollibee</h5>
                                                <p><span class="icon_pin_alt"></span> Maypajo, Caloocan City</p>
                                            </div>
                                        </div>
                                        <div class="fp-item set-bg" data-setbg="img/gallery/2.jpg">
                                            <div class="fp-text">
                                                <h5 class="title">Jollibee</h5>
                                                <p><span class="icon_pin_alt"></span> Maypajo, Caloocan City</p>
                                            </div>
                                        </div>
                                        <div class="fp-item set-bg" data-setbg="img/gallery/3.jpg">
                                            <div class="fp-text">
                                                <h5 class="title">Jollibee</h5>
                                                <p><span class="icon_pin_alt"></span> Maypajo, Caloocan City</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-widget">
                                    <h4>Map Location</h4>
                                    <div class="map">
                                        <div id="map"></div>
                                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7720.486527481873!2d120.96689102135043!3d14.642127909103934!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b54965fb6673%3A0x4c29f2c590dd763f!2sJollibee!5e0!3m2!1sen!2sph!4v1680867618471!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                                    </div>
                                </div>
                                <br>

                                <div class="blog-item-list"><br><br>
                                    <div class="pd-widget">
                                        <br>
                                        <h4>FEATURE POST</h4>
                                    </div>
                                    <div class="blog-item">
                                        <div class="bi-pic">
                                            <img src="img/post/1.jpg" alt="">
                                        </div>
                                        <div class="bi-text">
                                            <h5><a href="#">NEW PROMO: Mix & Match</a></h5>
                                            <ul>
                                                <li>April 30, 2023</li>
                                            </ul>
                                            <p>You can make your own combination. Enjoy the New Promo Combo Mix & Match for the first time for only 89 pesos!</p>
                                            <!-- <a href="#" class="read-more">Call Now! <span class="arrow_right"></span></a> -->
                                        </div>
                                    </div>
                                    <div class="blog-item">
                                        <div class="bi-pic">
                                            <img src="img/post/2.jpg" alt="">
                                        </div>
                                        <div class="bi-text">
                                            <h5><a href="#">Updated Price: Family Meal</a></h5>
                                            <ul>
                                                <li>June 29, 2023</li>
                                            </ul>
                                            <p>Enjoy the Updated Price of our Family Meal for only 1,099 pesos! Visit Jollibee Now!</p>
                                            <!-- <a href="#" class="read-more">Call Now! <span class="arrow_right"></span></a> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-details-content">
                                    <div class="bc-widget">
                                        <h4>3 REVIEWS</h4>
                                        <div class="comment-option">
                                            <div class="co-item">
                                                <div class="ci-pic">
                                                    <img src="img/testimonial-author/arceo.jpg" alt="">
                                                </div>
                                                <div class="ci-text">
                                                    <h5>Kenjie P. Arceo</h5>
                                                    <div class="pr-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <p>Basta may comment dito uwu</p>
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i> July 1, 2023</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- <div class="co-item reply-item">
                                                <div class="ci-pic">
                                                    <img src="img/testimonial-author/roy.jpg" alt="">
                                                </div>
                                                <div class="ci-text">
                                                    <h5>Roy Lewis Collo</h5>
                                                    <div class="pr-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <p>Tapos may reply dito uwu</p>
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i> July 1, 2023</li>
                                                    </ul>
                                                </div>
                                            </div> -->
                                            <div class="co-item">
                                                <div class="ci-pic">
                                                    <img src="img/testimonial-author/ramil.jpg" alt="">
                                                </div>
                                                <div class="ci-text">
                                                    <h5>Princess Angelica Ramil</h5>
                                                    <div class="pr-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <p>Comment to pero pangalawa naman </p>
                                                    <ul>
                                                        <li><i class="fa fa-clock-o"></i> July 1,2023</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-widget">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <h4>LEAVE A COMMENT</h4><br>
                                        </div>
                                        <div class="row">
                                            <fieldset class="rating">
                                                <input type="radio" id="star5" name="rating" value="5" />
                                                <label for="star5">5 stars</label>
                                                <input type="radio" id="star4" name="rating" value="4" />
                                                <label for="star4">4 stars</label>
                                                <input type="radio" id="star3" name="rating" value="3" />
                                                <label for="star3">3 stars</label>
                                                <input type="radio" id="star2" name="rating" value="2" />
                                                <label for="star2">2 stars</label>
                                                <input type="radio" id="star1" name="rating" value="1" />
                                                <label for="star1">1 star</label>
                                            </fieldset>
                                        </div>
                                    </div>
                                    <form action="#" class="review-form">
                                        <textarea placeholder="Leave a Comment"></textarea>

                                        <button type="submit" class="site-btn">Send</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="property-sidebar">
                                <div class="blog-sidebar">
                                    <div class="follow-us">
                                        <br><br>
                                        <?php echo $socialMedia; ?>
                                    </div>
                                </div>
                                <div class="section-title sidebar-title">
                                    <h5>We're Hiring!</h5>
                                </div>
                                <?php
                                // if ($_SESSION['ownerId'] == 3) {
                                    foreach ($datas as $index => $data) {
                                        $businessLogo = $data['Businesslogo'];
                                        $pos = $data['pos_vacant'];
                                        $jobDes = $data['job_desc'];
                                        $modalId = 'modal_' . $index; // Generate a unique modal ID
                                        $jobSpec = $data['job_spec'];
                                        $degree = $data['degree'];
                                        $yearExp = $data['year_exp'];
                                        $bus_applicant_id = $data['bus_applicant'];
                                ?>
                                        <div class="single-sidebar m-0 p-0">
                                            <div class="top-agent">
                                                <div class="ta-item">
                                                    <div class="ta-pic set-bg" data-setbg="img/job/381351858_340934731618300_4699644083071352903_n.png"></div>
                                                    <div class="ta-text">
                                                        <h6><a><?php echo $data['pos_vacant'] ?></a></h6>
                                                        <!-- Pass the JavaScript variables as separate parameters to openModal -->
                                                        <button onclick="openModal('<?php echo $businessLogo ?>', '<?php echo $pos ?>', '<?php echo $jobDes ?>', '<?php echo $modalId ?>', '<?php echo $jobSpec ?>', '<?php echo $degree ?>', '<?php echo $yearExp ?>', `<?php echo $bus_applicant_id ?>`)" class="btn btn-success">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="<?php echo $modalId ?>" style="z-index: 1000; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="modal">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content w-100">
                                                    <div class="modal-header">
                                                        <img src="img/company/jollibee.jpg" alt="Company Logo" class="circle-image" style="margin-right: 5px; border: 2px solid #355E3B;">
                                                        <h3 class="text-center mb-6 font-weight-bold" style="margin-top: 7px;">We're Hiring!</h3>
                                                        <span onclick="closeModal('<?php echo $modalId ?>')" class="close" title="Close Modal">&times;</span>
                                                    </div>
                                                    <div class="container mt-4">
                                                        <div class="card px-2" id="jobBoardForm">
                                                            <div class="job-board">
                                                                <!-- Job Listings -->
                                                                <div class="job-listing">
                                                                    <h4 class="jobTitle"><strong>Manager</strong></h4>
                                                                    <p id="des">The Restaurant Manager is responsible for the development and achievement of the store business objectives such as Sales and Profitability targets, customer satisfaction & Food, Safety and Cleanliness standards; People Management and Development; and Store’s adherence to operating systems and standards and compliance to all government requirements.</p>
                                                                    <h6><strong>Job Specification</strong></h6>
                                                                    <ul class="bullet-list">
                                                                    </ul>
                                                                </div>
                                                                <br>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <h6><strong>Additional Information</strong></h6>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <p class="degree"><strong>Degree:</strong> Bachelor's Degree</p>
                                                                    </div>
                                                                    <div class="col">
                                                                        <p class="experience"><strong>Years of Experience:</strong> 3 years</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="upload-button">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <br>
                                                                        <h4 style="margin-top: 7px;"><strong>Submit Application</strong></h4>
                                                                    </div>
                                                                    <div class="col text-right">
                                                                        <input type="hidden" id="app_id">
                                                                        <input type="hidden" id="user_id" value="<?php echo $_SESSION['ownerId'] ?>">
                                                                        <br><button class="btn btn-success" onclick="applyUser()" style="margin-bottom: 20px;">Submit Resume</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                <?php }
                               // } ?>
                                <div class="single-sidebar">
                                    <div class="section-title sidebar-title">
                                        <h5>Related Business</h5>
                                    </div>
                                    <div class="top-agent">
                                        <div class="ta-item">
                                            <div class="ta-pic set-bg" data-setbg="img/property/listing-08.jpg"></div>
                                            <div class="ta-text">
                                                <h6><a href="#">Mc Donalds</a></h6>
                                                <span>10th Avenue, Caloocan City</span>
                                                <div class="ta-num">123-456-789</div>
                                            </div>
                                        </div>
                                        <div class="ta-item">
                                            <div class="ta-pic set-bg" data-setbg="img/property/listing-09.jpg"></div>
                                            <div class="ta-text">
                                                <h6><a href="#">KFC</a></h6>
                                                <span>Grace Park, Caloocan City</span>
                                                <div class="ta-num">123-456-789</div>
                                            </div>
                                        </div>
                                        <div class="ta-item">
                                            <div class="ta-pic set-bg" data-setbg="img/property/listing-04.jpg"></div>
                                            <div class="ta-text">
                                                <h6><a href="#">Silver Crown</a></h6>
                                                <span>Sangandaan, Caloocan City</span>
                                                <div class="ta-num">123-456-789</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="fs-about">
                        <div class="fs-logo">
                            <a href="#">
                                <img src="img/logo-main.png" alt="">
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
    <!-- <script src="js/jquery-3.3.1.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-76614800-1"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([14.6577, 120.9842], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
                maxZoom: 18,
            }).addTo(map);

            var caloocanBoundary = L.geoJSON().addTo(map);

            // Load the boundary data and add it to the map
            $.getJSON('boundary.geojson1.json', function(data) {
                caloocanBoundary.addData(data);

                caloocanBoundary.setStyle(function(feature) {
                    return {
                        fillColor: 'transparent',
                        fillOpacity: 0,
                        color: 'black',
                        weight: 0.7
                    };
                });

                caloocanBoundary.eachLayer(function(layer) {
                    layer.bindPopup("Barangay " + layer.feature.properties.NAME_3);
                });

                // Add the marker to the map
                var lat = <?php echo $lat ?>;
                var long = <?php echo $long ?>;
                var name = "<?php echo $bus_name ?>";
                var address = "<?php echo $bus_add ?>";

                var marker = L.marker([lat, long]).addTo(map);

                // Customize the popup for the business marker
                var popupContent = "<b>" + name + "</b><br>Address: " + address;
                marker.bindPopup(popupContent);

                // Set the map view to the marker's coordinates with the desired zoom level (e.g., 15)
                map.setView([lat, long], 15);

            });






            // Get a reference to the checkbox element
            var checkbox = $("#checkTerms");
            var signUpButton = $("#signUp");

            // Add a change event handler
            checkbox.change(function() {
                // Check if the checkbox is checked
                if (checkbox.is(":checked")) {
                    // Checkbox is checked
                    // alert("Checkbox is checked!");
                    signUpButton.prop("disabled", false);
                    // You can add your code to handle the checked state here
                } else {
                    // Checkbox is unchecked
                    // alert("Checkbox is unchecked!");
                    signUpButton.prop("disabled", true);
                    // You can add your code to handle the unchecked state here
                }
            });
        });

        // Function to open the modal
        function openModal(logo, pos, des, modalId, jobspec, degree, exp, id) {
            // console.log(logo);
            // console.log(pos);
            // console.log(id);
            $('#app_id').val(id);

            var companyLogo = $("#" + modalId).find(".circle-image");
            companyLogo.attr("src", "img/logo/" + logo);

            var p = $("#" + modalId).find("#des");
            p.text(des);

            // Set the job title in the modal header
            var jobTitle = $("#" + modalId).find(".jobTitle");
            jobTitle.text(pos);

            // Clear existing list items in the ul
            var ul = $("#" + modalId).find(".bullet-list");
            ul.empty();

            // Split the jobspec string into an array of items using commas as the delimiter
            var jobspecItems = jobspec.split(",");

            // Loop through the items and create list items
            $.each(jobspecItems, function(index, item) {
                // Remove any leading/trailing whitespace
                item = item.trim();

                // Skip empty items
                if (item !== "") {
                    // Create a new list item and append it to the ul
                    var li = $("<li>").text(item);
                    ul.append(li);
                }
            });

            //note bawal parehas ng parameter yung sa var name
            var degreeElement = $("#" + modalId).find(".degree");
            degreeElement.html('<strong>Degree:</strong> ' + degree);

            var expElement = $("#" + modalId).find(".experience");
            expElement.html('<strong>Experience:</strong> ' + exp);




            // Show the modal using jQuery
            $("#" + modalId).modal("show");
        };

        function closeModal(modalId) {
            $("#" + modalId).modal("hide");
        };

        function applyUser() {
            var app_id = $('#app_id').val();
            var user_id = $('#user_id').val();
            // alert(user_id) 

            var payload = {
                app_id: app_id,
                user_id: user_id
            };

            $.ajax({
                type: "POST",
                url: 'controllers/users.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'applyJobUser'
                },
                success: function(response) {
                    data = JSON.parse(response);
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.icon,
                        customClass: {
                            confirmButton: 'swal-confirm-button',
                        },
                        showCancelButton: false,
                    });
                    //for normal UI AHAHAHHAHAHA
                    // swal.fire(data.title, data.message, data.icon);
                    window.location.reload();
                }
            });

        };



        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-76614800-1');

        function createUser() {
            var fname = $('#f_name').val();
            var mname = $('#m_name').val();
            var lname = $('#l_name').val();
            var email = $('#emailUser').val();
            var pass = $('#pass').val();
            var conpass = $('#con_pass').val();

            if (
                !fname ||
                !mname ||
                !lname ||
                !email ||
                !pass ||
                !conpass
            ) {
                Swal.fire({
                    title: 'Warning',
                    text: 'Please fill out all required fields.',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'swal-confirm-button',
                    },
                    showCancelButton: false,
                });
                return;
            }

            var payload = {
                fname: fname,
                mname: mname,
                lname: lname,
                email: email,
                pass: pass
            };

            if (pass == conpass) {
                // console.log(payload)
                $.ajax({
                    type: "POST",
                    url: 'controllers/users.php',
                    data: {
                        payload: JSON.stringify(payload),
                        setFunction: 'createUser'
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                            customClass: {
                                confirmButton: 'swal-confirm-button',
                            },
                            showCancelButton: false,
                        });
                        //for normal UI AHAHAHHAHAHA
                        // swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            } else {
                Swal.fire({
                    title: 'Warning',
                    text: 'Passwords didn\'t match',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'swal-confirm-button',
                    },
                    showCancelButton: false,
                });
            }
        };

        function createBusinessOwner() {
            var ownerEmail = $('#ownerEmail').val();
            var ownerFname = $('#ownerFname').val();
            var ownerMname = $('#ownerMname').val();
            var ownerLname = $('#ownerLname').val();
            var ownerBirthday = $('#ownerBirthday').val();
            var ownerAge = $('#ownerAge').val();
            var ownerSex = $("[name='sex']:checked").val();
            var ownerNumber = $('#ownerNumber').val();
            var ownerAddress = $('#ownerAddress').val();
            var ownerPass = $('#ownerPass').val();
            var ownerConPass = $('#ownerConPass').val();

            if (
                !ownerEmail ||
                !ownerFname ||
                !ownerMname ||
                !ownerLname ||
                !ownerBirthday ||
                !ownerAge ||
                !ownerSex ||
                !ownerNumber ||
                !ownerAddress ||
                !ownerPass ||
                !ownerConPass
            ) {
                Swal.fire({
                    title: 'Warning',
                    text: 'Please fill out all required fields.',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'swal-confirm-button',
                    },
                    showCancelButton: false,
                });
                return;
            }

            var payload = {
                ownerEmail: ownerEmail,
                ownerFname: ownerFname,
                ownerMname: ownerMname,
                ownerLname: ownerLname,
                ownerBirthday: ownerBirthday,
                ownerAge: ownerAge,
                ownerSex: ownerSex,
                ownerNumber: ownerNumber,
                ownerAddress: ownerAddress,
                ownerPass: ownerPass
            };

            if (ownerPass == ownerConPass) {
                // console.log(payload)
                $.ajax({
                    type: "POST",
                    url: 'controllers/users.php',
                    data: {
                        payload: JSON.stringify(payload),
                        setFunction: 'createOwner'
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        Swal.fire({
                            title: data.title,
                            text: data.message,
                            icon: data.icon,
                            customClass: {
                                confirmButton: 'swal-confirm-button',
                            },
                            showCancelButton: false,
                        });
                        //for normal UI AHAHAHHAHAHA
                        // swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                });
            } else {
                Swal.fire({
                    title: 'Warning',
                    text: 'Passwords didn\'t match',
                    icon: 'warning',
                    customClass: {
                        confirmButton: 'swal-confirm-button',
                    },
                    showCancelButton: false,
                });
            }
        };

        function loginUser() {
            var username = $("#email_log").val();
            var pass = $('#password_log').val();

            var payload = {
                username: username,
                pass: pass
            };

            $.ajax({
                type: "POST",
                url: 'controllers/users.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'loginUser'
                },
                success: function(response) {
                    data = JSON.parse(response);
                    Swal.fire({
                        title: data.title,
                        text: data.message,
                        icon: data.icon,
                        customClass: {
                            confirmButton: 'swal-confirm-button',
                        },
                        showCancelButton: false,
                    });
                    //for normal UI AHAHAHHAHAHA
                    // swal.fire(data.title, data.message, data.icon);
                    if (data.role == 1) {
                        setTimeout(function() {
                            window.location.href = "ceipo/index.php";
                        }, 2000);

                    } else {
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    }
                }
            });
        };
    </script>
</body>

</html>