<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="plugins/assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Business Dashboard</title>
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="plugins/assets/img/favicon/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">
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
                        <span
                            class="text-uppercase text-white app-brand-text demo menu-text fw-bolder ms-2">BUSINESS</span>
                    </a>
                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Business Profile</span>
                    </li>

                    <li class="menu-item active">
                        <a href="bulletin.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bxs-pin"></i>
                            <div data-i18n="Analytics">Bulletin Board</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="BusinessPanel.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-info-circle"></i>
                            <div data-i18n="Analytics">Details</div>
                        </a>
                    </li>

                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Business Content</span>
                    </li>
                    <li class="menu-item">
                        <a href="feature-post.php" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-share"></i>
                            <div data-i18n="Analytics">Feature Post</div>
                        </a>
                    </li>
                    
                      <li class="menu-item">
                        <a href="gallery.php" class="menu-link">
                          <i class="menu-icon tf-icons bx bx-photo-album"></i>
                          <div data-i18n="Analytics">Gallery</div>
                        </a>
                      </li>
                      <li class="menu-item">
                        <a href="reply.php" class="menu-link">
                          <i class="menu-icon tf-icons bx bx-message-rounded"></i>
                          <div data-i18n="Analytics">Comments & Rating</div>
                        </a>
                      </li>
                      <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Business Document</span>
                    </li>
                    <li class="menu-item">
                        <a href="requirement.php" class="menu-link">
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
                                <div class="card mb-4">
                                    <h3 class="card-header"><strong>Business Bulletin Board</strong></h3>
                                    <hr class="my-0">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="Ajax1" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Company</th>
                                                        <!-- <th>Needs Action</th> -->
                                                        <th>Status</th>
                                                        <th>Remarks</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align: center;">XYZ Company</td>
                                                        <!-- <td style="text-align: center;">DTR Business Permit</td> -->
                                                        <td style="text-align: center;"><span class="badge bg-warning text-dark"><strong>Invalid</strong></span></td>
                                                        <td style="text-align: center;">
                                                            Expired Document 
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                            <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="modalEditForm">Edit Post
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="title" class="form-label">Title</label>
                                                                    <input type="text" id="title" class="form-control"
                                                                        value=" NEW PROMO: Mix & Match">
                                                                </div>
                                                            </div>
                                                            <div class="row g-2">
                                                                <div class="col mb-0">
                                                                    <label id="captions"
                                                                        class="form-label">Caption</label>
                                                                    <textarea
                                                                        class="form-control">You can make your own combination. Enjoy the New Promo Combo Mix & Match for the first time for only 89 pesos!</textarea>
                                                                </div>
                                                                <div class="col-12">
                                                                    <br> <label for="upload"
                                                                        class="btn btn-primary me-2 mb-4" tabindex="0">
                                                                        <span class="d-none d-sm-block">Upload new
                                                                            photo</span>
                                                                        <i
                                                                            class="bx bx-upload d-block d-sm-none"></i></label>
                                                                    <input type="file" id="uploadEdit"
                                                                        class="form-control"
                                                                        accept="image/png, image/jpeg" hidden>
                                                                    <img id="previewimg" src="#" alt="Previewimg"
                                                                        style="max-height: 200px; display: none;">
                                                                </div>
                                                            </div>
                                                            <div class="d-flex modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Cancel
                                                                </button>
                                                                <button type="button"
                                                                    class="btn btn-primary">Upload</button>
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
                        <div class="content-backdrop fade"></div>
                    </div>
                </div>
            </div>
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
    </div>
    <script src="plugins/assets/vendor/js/bootstrap.js"></script>
    <script src="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="plugins/assets/vendor/js/menu.js"></script>
    <script src="plugins/assets/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#Ajax1').DataTable();
        });
    </script>
    <script>
        // Add an event listener for the "Add New Post" file input
        document.getElementById('upload').addEventListener('change', function (event) {
            previewImage(event, 'preview');
        });

        // Add an event listener for the "Edit Post" file input
        document.getElementById('uploadEdit').addEventListener('change', function (event) {
            uploadNewImage(event, 'previewimg');
        });

        function previewImage(event, preview) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(previewId).src = e.target.result;
                    document.getElementById(previewId).style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function uploadNewImage(event, previewimg) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById(previewimg).src = e.target.result;
                    document.getElementById(previewimg).style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
</body>


</html>