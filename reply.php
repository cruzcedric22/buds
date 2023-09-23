<?php
session_start();
// echo $_SESSION['ownerId'];
if (empty($_SESSION['ownerId']) || empty($_GET['a'])) {
    header('Location: manage.php');
}
$bus_id = $_GET['a'];
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
  data-assets-path="plugins/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Business Dashboard | Gallery</title>
  <meta name="description" content="" />
  <link rel="icon" type="image/x-icon" href="plugins/assets/img/favicon/favicon.ico" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="plugins/assets/vendor/fonts/boxicons.css" />
  <link rel="stylesheet" href="plugins/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="plugins/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="plugins/assets/css/demo.css" />
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css">

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

            <li class="menu-item">
                <a href="<?php echo "bulletin.php?a=".$bus_id ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-pin"></i>
                    <div data-i18n="Analytics">Bulletin Board</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="<?php echo "BusinessPanel.php?a=".$bus_id ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-info-circle"></i>
                    <div data-i18n="Analytics">Details</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Business Content</span>
            </li>
            <li class="menu-item">
                <a href="<?php echo "feature-post.php?a=".$bus_id ?>" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-share"></i>
                    <div data-i18n="Analytics">Feature Post</div>
                </a>
            </li>
            
              <li class="menu-item">
                <a href="<?php echo "gallery.php?a=".$bus_id ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-photo-album"></i>
                  <div data-i18n="Analytics">Gallery</div>
                </a>
              </li>
              <li class="menu-item active">
                <a href="<?php echo "reply.php?a=".$bus_id ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-message-rounded"></i>
                  <div data-i18n="Analytics">Comments & Rating</div>
                </a>
              </li>
              <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Business Document</span>
            </li>
            <li class="menu-item">
                <a href="<?php echo "requirement.php?a=".$bus_id ?>" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-paperclip"></i>
                  <div data-i18n="Analytics">Requirements</div>
                </a>
              </li>
              <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Job Applicants</span>
          </li>
          <li class="menu-item">
            <a href="<?php echo "job-applicants.php?a=".$bus_id ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-detail"></i>
              <div data-i18n="Analytics">Jobs</div>
            </a>
          </li>
        </ul>
    </aside>
      <div class="layout-page">
        <div class="container-xxl flex-grow-1 mt-4">
          <div class="row">
            <div class="col-lg-8 order-0">
              <div class="card h-100">
                <div class="d-flex align-items-end row">
                  <div class="col-sm-7">
                    <div class="card-body">
                      <h5 class="card-title text-primary">Congratulations Owner! 🎉</h5>
                      <p class="mb-4">
                        You received <span class="fw-bold">4.8/5 ratings</span> and 20 comments to your business as of
                        today.
                      </p>
                    </div>
                  </div>
                  <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body px-md-4">
                      <img src="plugins/assets/img/avatars/logo.png" height="130" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 order-0">
              <div class="row h-100">
                <div class="col-lg-6 col-md-12 col-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img src="plugins/assets/img/icons/unicons/star.png" alt="chart success" class="rounded" />
                        </div>
                      </div>
                      <span class="fw-semibold d-block mb-1">Rating</span>
                      <h3 class="card-title mb-2">4.8 / 5</h3>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6">
                  <div class="card h-100">
                    <div class="card-body">
                      <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                          <img src="plugins/assets/img/icons/unicons/comment.png" alt="Credit Card" class="rounded" />
                        </div>
                      </div>
                      <span class="fw-semibold d-block mb-1">Total Comments</span>
                      <h3 class="card-title mb-2">20 </i></h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <div class="container d-flex justify-content-center mt-4">
          <div class="row">
            <div class="col-md-12">

              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Comments</h4>
                  <h6 class="card-subtitle">Latest Comments section by users</h6>
                </div>

                <div class="comment-widgets m-b-20">

                  <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="plugins/assets/img/avatars/1.png" alt="user"
                          width="50"></span></div>
                    <div class="comment-text w-100">
                      <h5 class="mb-0">Lalaking Random</h5>
                      <div class="pr-rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                      </div>
                      <div class="comment-footer">
                        <span class="date">July 01, 2023 </span>
                        <a data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false"
                          aria-controls="collapseExample">
                          <i class='bx bxs-chat'></i> Reply</a>
                        </span>
                      </div>
                      <p class="m-b-5 m-t-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it</p>

                      <div class="collapse" id="collapseExample1">
                        <div class="d-grid d-sm-flex p-3 border">

                          <div class="col mb-0">
                            <textarea class="form-control"></textarea>
                            <br>
                            <button type="button" class="btn btn-success">Reply</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="plugins/assets/img/avatars/1.png" alt="user"
                          width="50"></span></div>
                    <div class="comment-text w-100">
                      <h5 class="mb-0">Lalaking Random</h5>
                      <div class="pr-rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                      </div>
                      <div class="comment-footer">
                        <span class="date">July 01, 2023 </span>
                        <a data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false"
                          aria-controls="collapseExample">
                          <i class='bx bxs-chat'></i> Reply</a>
                        </span>
                      </div>
                      <p class="m-b-5 m-t-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it</p>

                      <div class="collapse" id="collapseExample2">
                        <div class="d-grid d-sm-flex p-3 border">

                          <div class="col mb-0">
                            <textarea class="form-control"></textarea>
                            <br>
                            <button type="button" class="btn btn-success">Reply</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="plugins/assets/img/avatars/1.png" alt="user"
                          width="50"></span></div>
                    <div class="comment-text w-100">
                      <h5 class="mb-0">Lalaking Random</h5>
                      <div class="pr-rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                      </div>
                      <div class="comment-footer">
                        <span class="date">July 01, 2023 </span>
                        <a data-bs-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false"
                          aria-controls="collapseExample">
                          <i class='bx bxs-chat'></i> Reply</a>
                        </span>
                      </div>
                      <p class="m-b-5 m-t-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it</p>

                      <div class="collapse" id="collapseExample3">
                        <div class="d-grid d-sm-flex p-3 border">

                          <div class="col mb-0">
                            <textarea class="form-control"></textarea>
                            <br>
                            <button type="button" class="btn btn-success">Reply</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex flex-row comment-row">
                    <div class="p-2"><span class="round"><img src="plugins/assets/img/avatars/1.png" alt="user"
                          width="50"></span></div>
                    <div class="comment-text w-100">
                      <h5 class="mb-0">Lalaking Random</h5>
                      <div class="pr-rating">
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                        <i class='bx bxs-star'></i>
                      </div>
                      <div class="comment-footer">
                        <span class="date">July 01, 2023 </span>
                        <a data-bs-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false"
                          aria-controls="collapseExample">
                          <i class='bx bxs-chat'></i> Reply</a>
                        </span>
                      </div>
                      <p class="m-b-5 m-t-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown
                        printer took a galley of type and scrambled it</p>

                      <div class="collapse" id="collapseExample4">
                        <div class="d-grid d-sm-flex p-3 border">

                          <div class="col mb-0">
                            <textarea class="form-control"></textarea>
                            <br>
                            <button type="button" class="btn btn-success">Reply</button>
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
        <div class="layout-overlay layout-menu-toggle"></div>
      </div>
      <script src="plugins/assets/vendor/js/bootstrap.js"></script>
      <script src="plugins/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
      <script src="plugins/assets/vendor/js/menu.js"></script>
      <script src="plugins/assets/js/main.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js"></script>

</html>
</body>

</html>