<?php
session_start();
// echo $_SESSION['ownerId'];
require_once './includes/config.php';

if (empty($_SESSION['ownerId']) || empty($_GET['a'])) {
    header('Location: manage.php');
}
$bus_id = $_GET['a'];

$sql = "SELECT * FROM business_carousel WHERE bus_id = :id";
$pdo = Database::connection();
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $bus_id, PDO::PARAM_STR);
$stmt->execute();
$numRows1 = $stmt->rowCount();
$datas = $stmt->fetchAll();

foreach ($datas as $data) {
    $pic1 = $data['pic1'];
    $pic2 = $data['pic2'];
    $pic3 = $data['pic3'];
    $pic4 = $data['pic4'];
}
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="plugins/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Dashboard</title>
    <meta name="description" content="">

    <link rel="icon" type="image/x-icon" href="plugins/assets/img/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/assets/vendor/fonts/boxicons.css">
    <link rel="stylesheet" href="plugins/assets/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="plugins/assets/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="plugins/assets/css/demo.css">
    <link rel="stylesheet" href="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <script src="plugins/assets/vendor/js/helpers.js"></script>
    <style>
        .photo-gallery {
            color: #313437;
            background-color: #fff;
        }

        .photo-gallery p {
            color: #7d8285;
        }

        .photo-gallery h2 {
            font-weight: bold;
            margin-bottom: 40px;
            padding-top: 40px;
            color: inherit;
        }

        @media (max-width:767px) {
            .photo-gallery h2 {
                margin-bottom: 25px;
                padding-top: 25px;
                font-size: 24px;
            }
        }

        .photo-gallery .intro {
            font-size: 16px;
            max-width: 500px;
            margin: 0 auto 40px;
        }

        .photo-gallery .intro p {
            margin-bottom: 20px;
        }

        .photo-gallery .photos {
            padding-bottom: 20px;
        }

        .photo-gallery .item {
            padding-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="index.php" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="img/logo-main.png" alt="" class="brand-image" width="45" height="50">
                        </span>
                        <span class="text-uppercase text-white app-brand-text demo menu-text fw-bolder ms-2">BUSINESS</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Business Profile</span>
                    </li>

                    <li class="menu-item">
                        <a href="<?php echo "bulletin.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-pin"></i>
                            <div data-i18n="Analytics">Bulletin Board</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="<?php echo "BusinessPanel.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-info-circle"></i>
                            <div data-i18n="Analytics">Details</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Business Content</span>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo "feature-post.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-share"></i>
                            <div data-i18n="Analytics">Feature Post</div>
                        </a>
                    </li>

                    <li class="menu-item active">
                        <a href="<?php echo "gallery.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-photo-album"></i>
                            <div data-i18n="Analytics">Gallery</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo "reply.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-message-rounded"></i>
                            <div data-i18n="Analytics">Comments & Rating</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Business Document</span>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo "requirement.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-paperclip"></i>
                            <div data-i18n="Analytics">Requirements</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Job Applicants</span>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo "job_position.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-user"></i>
                            <div data-i18n="Analytics">Job Positions</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="<?php echo "job_applicant.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-user-detail"></i>
                            <div data-i18n="Analytics">Job Applicants</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="layout-page">
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <?php if ($_SESSION['photo'] != "") { ?>
                                            <img src="<?php echo "img/profile-picture/" . $_SESSION['photo'] ?>" alt="User's Name">
                                        <?php } else { ?>
                                            <img src="img/testimonial-author/unknown.jpg" alt="User's Name">
                                        <?php } ?>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <?php if ($_SESSION['photo'] != "") { ?>
                                                            <img src="<?php echo "img/profile-picture/" . $_SESSION['photo'] ?>" alt="User's Name">
                                                        <?php } else { ?>
                                                            <img src="img/testimonial-author/unknown.jpg" alt="User's Name">
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block"><?php echo $_SESSION['lname'] . ' , ' . $_SESSION['fname'] ?></span>
                                                    <small class="text-muted"><?php echo $_SESSION['userTypeDesc'] ?></small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="logout.php">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4 p-4">
                                    <h3 class="card-header"><strong>Gallery</strong></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Picture 1</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="<?php echo "img/gallery1/" . $pic1 ?>" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="pic1" class="form-control" id="fileUpload">
                                                        </div>
                                                    </div>
                                                    <?php if ($numRows1 == 1) { ?>
                                                        <div class="col-sm-2">
                                                            <button type="button" onclick="EdtPic1()" class="btn btn-success">Update</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Picture 2</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="<?php echo "img/gallery1/" . $pic2 ?>" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="pic2" class="form-control" id="fileUpload">
                                                        </div>
                                                    </div>
                                                    <?php if ($numRows1 == 1) { ?>
                                                        <div class="col-sm-2">
                                                            <button type="button" onclick="EdtPic2()" class="btn btn-success">Update</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Picture 3</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="<?php echo "img/gallery1/" .  $pic3 ?>" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="pic3" class="form-control" id="fileUpload">
                                                        </div>
                                                    </div>
                                                    <?php if ($numRows1 == 1) { ?>
                                                        <div class="col-sm-2">
                                                            <button type="button" onclick="EdtPic3()" class="btn btn-success">Update</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Picture 4</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="<?php echo "img/gallery1/" . $pic4 ?>" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="pic4" class="form-control" id="fileUpload">
                                                        </div>
                                                    </div>
                                                    <?php if ($numRows1 == 1) { ?>
                                                        <div class="col-sm-2">
                                                            <button type="button" onclick="EdtPic4()" class="btn btn-success">Update</button>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($numRows1 == 0) { ?>
                                    <div class="col-sm-2">
                                        <button type="button" onclick="AddPictures()" class="btn btn-success">Submit</button>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="plugins/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="plugins/assets/vendor/js/bootstrap.js"></script>
    <script src="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="plugins/assets/vendor/js/menu.js"></script>
    <script src="plugins/assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.thumbnail').click(function() {
                $('.modal-body').empty();
                $(this).clone().appendTo('.modal-body');
                $('#modal').modal('show');
            });

            $('#modal').on('show.bs.modal', function() {
                $('.col-6, .row .thumbnail').addClass('blur');
            });

            $('#modal').on('hide.bs.modal', function() {
                $('.col-6, .row .thumbnail').removeClass('blur');
            });
        });

        function AddPictures() {
            var formData = new FormData();
            var payload = {};


            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'addPics');

            // Get the selected files
            var picInputs = document.querySelectorAll('input[type="file"]');
            picInputs.forEach(function(input) {
                var files = input.files;
                if (files.length > 0) {
                    formData.append(input.name, files[0]);
                }
            });

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'controllers/business.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        // Handle success response
                        var data = JSON.parse(xhr.responseText);
                        console.log('Data received:', data); // For debugging
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        console.log('Error:', xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);
        };

        function EdtPic1(){
            var formData = new FormData();
            var payload = {};
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtPic1');

            var pic1Input = $("input[name='pic1']")[0]; // Assuming it's the first input element
            var pic1File = pic1Input.files[0];

            formData.append('pic1', pic1File);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/business.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("Server response:", xhr.responseText);
                    if (xhr.status === 200) {
                        // Handle success response
                        var data = JSON.parse(xhr.responseText);
                        // console.log("Data received:", data);
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);

        };

        function EdtPic2(){
            var formData = new FormData();
            var payload = {};
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtPic2');

            var pic2Input = $("input[name='pic2']")[0]; // Assuming it's the first input element
            var pic2File = pic2Input.files[0];

            formData.append('pic2', pic2File);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/business.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("Server response:", xhr.responseText);
                    if (xhr.status === 200) {
                        // Handle success response
                        var data = JSON.parse(xhr.responseText);
                        // console.log("Data received:", data);
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);

        };

        function EdtPic3(){
            var formData = new FormData();
            var payload = {};
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtPic3');

            var pic3Input = $("input[name='pic3']")[0]; // Assuming it's the first input element
            var pic3File = pic3Input.files[0];

            formData.append('pic3', pic3File);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/business.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("Server response:", xhr.responseText);
                    if (xhr.status === 200) {
                        // Handle success response
                        var data = JSON.parse(xhr.responseText);
                        // console.log("Data received:", data);
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);

        };

        function EdtPic4(){
            var formData = new FormData();
            var payload = {};
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtPic4');

            var pic4Input = $("input[name='pic4']")[0]; // Assuming it's the first input element
            var pic4File = pic4Input.files[0];

            formData.append('pic4', pic4File);

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/business.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    console.log("Server response:", xhr.responseText);
                    if (xhr.status === 200) {
                        // Handle success response
                        var data = JSON.parse(xhr.responseText);
                        // console.log("Data received:", data);
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);

        };
    </script>

</body>

</html>