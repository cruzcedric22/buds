<?php
session_start();
// echo $_SESSION['ownerId'];
if (empty($_SESSION['ownerId']) || empty($_GET['a'])) {
    header('Location: manage.php');
}
$bus_id = $_GET['a'];
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="plugins/assets/vendor/js/helpers.js"></script>
    <script src="plugins/assets/js/config.js"></script>
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
                    <li class="menu-item">
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
                    <li class="menu-item active">
                        <a href="<?php echo "requirement.php?a=" . $bus_id ?>" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-paperclip"></i>
                            <div data-i18n="Analytics">Requirements</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <div class="layout-page">
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mb-4 p-4">
                                    <h3 class="card-header"><strong>Requirements</strong></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Barangay Clearance</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="plugins/assets/img/elements/4.jpg" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="barangayClearance" class="form-control" id="fileUpload">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="button" onclick="editBrgyClearance()" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>DTI Permit</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="plugins/assets/img/elements/4.jpg" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="DTIPermit" class="form-control" id="fileUpload">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="butoon" onclick="editDTIPermit()" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Sanitary Permit</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="plugins/assets/img/elements/4.jpg" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" name="sanitaryPermit" class="form-control" id="fileUpload">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="button" onclick="editSanitaryPermit()" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Cedula</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="plugins/assets/img/elements/4.jpg" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" class="form-control" id="fileUpload">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-lg-4 mb-3">
                                            <div class="card p-4">
                                                <div class="card-body">
                                                    <h3 class="card-title"><b>Mayor's Permit</b></h3>
                                                    <img class="img-fluid d-flex mx-auto" src="plugins/assets/img/elements/4.jpg" alt="Card image cap" />
                                                    <br>
                                                    <div class="mb-3 row align-items-center">
                                                        <label for="fileUpload" class="form-label">Upload File</label>
                                                        <div class="col-sm-8">
                                                            <input type="file" class="form-control" id="fileUpload">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <button type="submit" class="btn btn-success">Submit</button>
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
                </div>
            </div>
        </div>
    </div>
    <script src="plugins/assets/vendor/js/bootstrap.js"></script>
    <script src="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="plugins/assets/vendor/js/menu.js"></script>
    <script src="plugins/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function editBrgyClearance() {
            var payload = {};

            var formData = new FormData();

            // Append payload data as JSON
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtBusinessBrgyClear');

            // Get the selected file (input element)
            var businessBrgyInput = $("input[name='barangayClearance']")[0]; // Assuming it's the first input element
            var businessBrgyFile = businessBrgyInput.files[0];

            formData.append('businessBrgyClearance', businessBrgyFile);

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
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);
        };

        function editDTIPermit() {
            var payload = {};

            var formData = new FormData();

            // Append payload data as JSON
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtDTIPermit');

            // Get the selected file (input element)
            var businessDTIInput = $("input[name='DTIPermit']")[0]; // Assuming it's the first input element
            var businessDTIFile = businessDTIInput.files[0];

            formData.append('businessDTIPermit', businessDTIFile);

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
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);
        };

        function editSanitaryPermit() {
            var payload = {};

            var formData = new FormData();

            // Append payload data as JSON
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'edtSanitaryPermit');

            // Get the selected file (input element)
            var businessSanitaryInput = $("input[name='sanitaryPermit']")[0]; // Assuming it's the first input element
            var businessSanitaryFile = businessSanitaryInput.files[0];

            formData.append('businessSanitaryPermit', businessSanitaryFile);

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
                        // setTimeout(function() {
                        //     window.location.reload();
                        // }, 2000);
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