<?php
include('includes/config.php');
session_start();

if (isset($_SESSION['email'])) {
  $email = $_SESSION['email'];
  $sql = "SELECT * FROM `owner_list` WHERE email = '$email'";
  $row = $conn->query($sql);
  $data = $row->fetch_assoc();
}

if (isset($_POST['SubmitProperty'])) {

  $ownerId              = $_SESSION['ownerId'];
  $BusinessName         = $_POST['BusinessName'];
  $BusinessEmail        = $_POST['BusinessEmail'];
  $BusinessBranch       = $_POST['BusinessBranch'];
  $BusinessEstablish    = $_POST['BusinessEstablish'];
  $BusinessDescrip      = $_POST['BusinessDescrip'];
  $BusinessNumber       = $_POST['BusinessNumber'];
  $BusinessOpenHour     = $_POST['BusinessOpenHour'];
  $BusinessCloseHour    = $_POST['BusinessCloseHour'];
  $BusinessAddress      = $_POST['BusinessAddress'];
  $BusinessBrgy         = $_POST['BusinessBrgy'];
  $BusinessZone         = $_POST['BusinessZone'];
  $BusinessCategory     = $_POST['BusinessCategory'];
  $BusinessSubCategory  = $_POST['BusinessSubCategory'];
  $location             = $_POST['location'];

  $BusinessFb           = $_POST['BusinessFb'];
  $BusinessIg           = $_POST['BusinessIg'];

  $Latitude             = $_POST['Latitude'];
  $Longtitude           = $_POST['Longtitude'];

  $sql = "INSERT INTO business_list (ownerId, BusinessName, BusinessEmail, BusinessBranch, BusinessEstablish, BusinessNumber, BusinessDescrip, BusinessOpenHour, BusinessCloseHour, BusinessAddress, BusinessBrgy, BusinessZone, BusinessCategory, BusinessSubCategory, BusinessLocation)
            VALUES ('$ownerId', '$BusinessName', '$BusinessEmail','$BusinessBranch','$BusinessEstablish','$BusinessNumber', '$BusinessDescrip','$BusinessOpenHour','$BusinessCloseHour','$BusinessAddress','$BusinessBrgy','$BusinessZone','$BusinessCategory','$BusinessSubCategory','$location')";

  //upload business logo
  $targer_dir   = "img/logo/";
  $filename     = $_FILES['BusinessLogo']['name'];      // original file name
  $filetmpname  = $_FILES['BusinessLogo']['tmp_name']; // temporary file name
  $filesize     = $_FILES['BusinessLogo']['size']; // file size
  $targer_file  = $targer_dir . $filename;
  $filetype     = strtolower(strtolower(pathinfo($targer_file, PATHINFO_EXTENSION)));

  if ($filesize > 0) {
    if ($filesize > 512000) {
      // checking file size
      echo "File size out of range";
      return;
    }
    if ($filetype != "jpg" && $filetype != "png" && $filetype != "jpeg" && $filetype != "gif") {
      //file type checking
      echo "Invalid file type";
      return;
    }
    //upload file
    if (move_uploaded_file($filetmpname, $targer_file)) {

      $sql = "INSERT INTO business_list (BusinessLogo, ownerId, BusinessName, BusinessEmail, BusinessBranch, BusinessEstablish, BusinessNumber, BusinessDescrip, BusinessOpenHour, BusinessCloseHour, BusinessAddress, BusinessBrgy, BusinessZone, BusinessCategory, BusinessSubCategory, BusinessLocation)
      VALUES ('$targer_file','$ownerId', '$BusinessName', '$BusinessEmail','$BusinessBranch','$BusinessEstablish','$BusinessNumber', '$BusinessDescrip','$BusinessOpenHour','$BusinessCloseHour','$BusinessAddress','$BusinessBrgy','$BusinessZone','$BusinessCategory','$BusinessSubCategory','$location')";
    }
  }

  //uploading image requirements
  if ($conn->query($sql)) {

    //upload barangay clearance 
    $targer_dir1   = "img/requirements/";
    $filename1     = $_FILES['uploadBrgyClearance']['name'];      // original file name
    $filetmpname1  = $_FILES['uploadBrgyClearance']['tmp_name']; // temporary file name
    $filesize1     = $_FILES['uploadBrgyClearance']['size']; // file size
    $targer_file1  = $targer_dir1 . $filename1;
    $filetype1     = strtolower(strtolower(pathinfo($targer_file1, PATHINFO_EXTENSION)));

    //upload dti permit 
    $targer_dir2   = "img/requirements/";
    $filename2     = $_FILES['uploadDTIPermit']['name'];      // original file name
    $filetmpname2  = $_FILES['uploadDTIPermit']['tmp_name']; // temporary file name
    $filesize2     = $_FILES['uploadDTIPermit']['size']; // file size
    $targer_file2  = $targer_dir2 . $filename2;
    $filetype2     = strtolower(strtolower(pathinfo($targer_file2, PATHINFO_EXTENSION)));

    //upload sanitary permit 
    $targer_dir3   = "img/requirements/";
    $filename3     = $_FILES['uploadSanitaryPermit']['name'];      // original file name
    $filetmpname3  = $_FILES['uploadSanitaryPermit']['tmp_name']; // temporary file name
    $filesize3     = $_FILES['uploadSanitaryPermit']['size']; // file size
    $targer_file3  = $targer_dir3 . $filename3;
    $filetype3     = strtolower(strtolower(pathinfo($targer_file3, PATHINFO_EXTENSION)));

    //upload cedula
    $targer_dir4   = "img/requirements/";
    $filename4     = $_FILES['uploadCedula']['name'];      // original file name
    $filetmpname4  = $_FILES['uploadCedula']['tmp_name']; // temporary file name
    $filesize4     = $_FILES['uploadCedula']['size']; // file size
    $targer_file4  = $targer_dir4 . $filename4;
    $filetype4     = strtolower(strtolower(pathinfo($targer_file4, PATHINFO_EXTENSION)));

    //upload business permit
    $targer_dir5   = "img/requirements/";
    $filename5     = $_FILES['uploadBusinessPermit']['name'];      // original file name
    $filetmpname5  = $_FILES['uploadBusinessPermit']['tmp_name']; // temporary file name
    $filesize5    = $_FILES['uploadBusinessPermit']['size']; // file size
    $targer_file5  = $targer_dir5 . $filename5;
    $filetype5     = strtolower(strtolower(pathinfo($targer_file5, PATHINFO_EXTENSION)));

    if ($filesize1 > 0 && $filesize2 > 0 && $filesize3 > 0 && $filesize4 > 0 && $filesize5 > 0) {
      if ($filesize1 > 512000 && $filesize2 > 512000 && $filesize3 > 512000 && $filesize4 > 512000 && $filesize5 > 512000) {
        // checking file size
        echo "File size out of range";
        return;
      }
      if (
        $filetype1 != "jpg" && $filetype1 != "png" && $filetype1 != "jpeg" && $filetype1 != "gif"
        && $filetype2 != "jpg" && $filetype2 != "png" && $filetype2 != "jpeg" && $filetype2 != "gif"
        && $filetype3 != "jpg" && $filetype3 != "png" && $filetype3 != "jpeg" && $filetype3 != "gif"
        && $filetype4 != "jpg" && $filetype4 != "png" && $filetype4 != "jpeg" && $filetype4 != "gif"
        && $filetype5 != "jpg" && $filetype5 != "png" && $filetype5 != "jpeg" && $filetype5 != "gif"
      ) {
        //file type checking
        echo "Invalid file type";
        return;
      }
      //upload file
      if (
        move_uploaded_file($filetmpname1, $targer_file1)
        && move_uploaded_file($filetmpname2, $targer_file2)
        && move_uploaded_file($filetmpname3, $targer_file3)
        && move_uploaded_file($filetmpname4, $targer_file4)
        && move_uploaded_file($filetmpname5, $targer_file5)
      ) {

        $sql1 = "INSERT INTO business_requirement (bus_id, bus_brgyclearance, bus_dtipermit, bus_sanitarypermit,bus_cedula,bus_mayorpermit) 
        VALUES ('$ownerId','$targer_file1','$targer_file2','ssss$targer_file3','$targer_file4','$targer_file5')";
      }

      $sql2 = "INSERT INTO business_links (bus_id, bus_fb, bus_ig) 
      VALUES ('$ownerId','$BusinessFb','$BusinessIg')";

      $sql3 = "INSERT INTO business_location (`bus_id`, `bus_lat`, `bus_long`) 
      VALUES ('$ownerId','$Latitude','$Longtitude')";
    }
    if ($conn->query($sql1) && $conn->query($sql2) && $conn->query($sql3)) {
      echo "NICE";
    }
  } else {
    die("Error:" . $conn->error);
  }
}

//Category and sub-Category
$Category = "";
$sql = "SELECT * FROM category_list";
if ($rs = $conn->query($sql)) {
  if ($rs->num_rows > 0) { // record checking
    while ($row = $rs->fetch_assoc()) {
      $Category .= '<option value =' . $row['ID'] . '>' . $row['category'] . '</option>';
    }
  }
} else {
  die("Error:" . $conn->error);
}
//Category and sub-Category
$Barangay = "";
$sql = "SELECT * FROM barangay_list";
if ($rs = $conn->query($sql)) {
  if ($rs->num_rows > 0) { // record checking
    while ($row = $rs->fetch_assoc()) {
      $Barangay .= '<option value =' . $row['ID'] . '>' . $row['Barangay'] . '</option>';
    }
  }
} else {
  die("Error:" . $conn->error);
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
  <title>Add Listing</title>

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
  <link rel="stylesheet" href="css/richtext.min.css" type="text/css">
  <link rel="stylesheet" href="css/image-uploader.min.css" type="text/css">
  <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="css/style1.css" type="text/css">
  <link rel="stylesheet" href="css/templatemo-plot-listing1.css" type="text/css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <style>
    #map {
      display: flex;
      margin: auto;
      width: 700px;
      height: 300px;
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
      <a href="./index.php">
        <img src="img/logo-main.png" alt="">
      </a>
    </div>
    <div id="mobile-menu-wrap"></div>

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
              <div class="hs-nav">
                <nav class="nav-menu">
                  <ul>
                    <li class="profile-dropdown">
                      <div class="user-profile">
                        <img src="img/testimonial-author/blankpic.jpg" alt="User's Name">
                      </div>
                      <ul class="dropdown dropleft">
                        <li>
                          <h2><?php echo $_SESSION['lname'] . ' , ' . $_SESSION['fname'] ?></h2>
                        </li>
                        <li><a href="user.php">MY PROFILE</a></li>
                        <li><a href="manage.php">MANAGE BUSINESS</a></li>
                        <li><a href="listing-form.php">ADD BUSINESS</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
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
                <li><a href="./index.php">Home</a></li>
                <!-- <li><a href="./listing.html">BUSINESS LISTING</a></li> -->
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- Header End -->
  <section class="property-section latest-property-section spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-title">
            <h4>ADD LISTING FORM</h4>
          </div>
        </div>
        <div class="col-lg-12">

          <br>
          <div class="property-submit-form">

            <form action="listing-form.php" method="post" enctype="multipart/form-data">
              <!-- <div class="pf-title">
                              <h4>Location</h4>
                               <select name="loc" class="form-select form-select-sm mt-3">
                                <option value="" disabled selected > Select a Location. </option>
                                 <option value="1">North</option>
                                  <option value="2">South</option>
                               </select>
                            </div> -->
              <div class="pf-title">
                <h4>Business Name</h4>
                <input name="BusinessName" type="text" placeholder="Enter Business Name">
              </div>
              <div class="pf-title">
                <h4>Business Logo</h4>
                <input name="BusinessLogo" type="file">
              </div>
              <div class="pf-title">
                <h4>Business Email</h4>
                <input name="BusinessEmail" type="email" placeholder="Enter Business Email">
              </div>
              <div class="pf-title">
                <h4>Business Branch</h4>
                <input name="BusinessBranch" type="text" placeholder="Enter Business Branch">
              </div>
              <div class="pf-title">
                <h4>Business Year Established</h4>
                <input name="BusinessEstablish" type="date" placeholder="Enter Business Year Establish">
              </div>
              <div class="pf-summernote">
                <h4>Business Description</h4>
                <input name="BusinessDescrip" type="text" placeholder="Enter your Business Description">
              </div>
              <div class="pf-title">
                <h4>Business Contact Number</h4>
                <input name="BusinessNumber" type="tell" placeholder="Enter Business Contact Number">
              </div>
              <div class="pf-location">
                <h4>Business Office Hour</h4>
                <div class="location-inputs">
                  <h6>Opening & Closing Time:</h6>
                  <br>
                  <input name="BusinessOpenHour" placeholder="Opening Time" type="time">
                  <input name="BusinessCloseHour" type="time" placeholder="Closing Time">
                </div>
              </div>
              <div class="pf-location">
                <h4>Business Location</h4>
                <div class="pf-title">
                  <h6>ADDRESS: </h6>
                  <br>
                  <input name="BusinessAddress" type="text" placeholder="Enter your Complete Address - [Unit No] [Building Name] [Street No] [Street Name] [City]."><br>

                  <br>
                  <select id="filter" name="BusinessBrgy" onchange="get_barangay()">
                    <option value="" disabled selected>Select a Barangay</option>
                    <?php
                    for ($i = 1; $i <= 188; $i++) {
                      echo '<option value="Barangay ' . $i . '">Barangay ' . $i . '</option>';
                    }
                    ?>
                  </select>

                </div>
              </div>
              <div class="pf-map">
                <h4>Map Location</h4>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="map-inputs">
                      <br><input id="Zone" name="BusinessZone" type="text" placeholder="Zone" readonly>
                      <input id="lat" type="text" name="Latitude" placeholder="Latitude" readonly>
                      <input id="long" type="text" name="Longtitude" placeholder="Longitude" readonly>
                      <input id="location" type="text" name="location" placeholder="Location: North or South" readonly>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="g-map">
                      <div id="map"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="pf-location">
                <h4>Business Websites Links</h4>
                <h6>Note: Please input the link of your social media.</h6>
                <div class="pf-title">
                  <!-- <input type="text" placeholder="Enter your Complete Address - [Unit No] [Building Name] [Street No] [Street Name] [City]."> -->
                  <div class="location-inputs">
                    <br><input name="BusinessFb" type="text" placeholder="Facebook">

                    <input name="BusinessTwitter" type="text" placeholder="Twitter">
                    <input name="BusinessIg" type="text" placeholder="Instagram">
                  </div>
                </div>
              </div>

              <div class="pf-title">
                <h4>Category</h4>
                <select id="category" name="BusinessCategory" onchange="get_subcategory()">
                  <option value="">Select Category</option>
                  <?php echo $Category; ?>
                </select>
              </div>

              <div class="pf-title">
                <h4> Sub Category</h4>
                <div id="dispSubClass">
                  <select id="subcategory" name="BusinessSubCategory">
                    <option value="">Select Sub Category</option>
                  </select>
                </div>
              </div>

              <div class="pf-property-details">

                <div class="property-details-inputs">
                  <div class="property-details-inputs">
                    <h4>Upload Scan Picture of Barangay Clearance</h4>
                    <!-- <div type="file" class="feature-image-content" name="uploadBrgyClearance"></div> -->
                    <input type="file" class="feature-image-content" name="uploadBrgyClearance">
                  </div><br>
                  <div class="property-details-inputs">
                    <h4>Upload Scan Picture of DTI Permit</h4>
                    <!-- <div type="file" class="feature-image-content" name="uploadDTIPermit"></div> -->
                    <input type="file" class="feature-image-content" name="uploadDTIPermit">
                  </div><br>
                  <div class="property-details-inputs">
                    <h4>Upload Scan Picture of Sanitary Document</h4>
                    <!-- <div type="file"class="feature-image-content" name="uploadSanitaryPermit"></div> -->
                    <input type="file" class="feature-image-content" name="uploadSanitaryPermit">
                  </div><br>
                  <div class="property-details-inputs">
                    <h4>Upload Scan Picture of Cedula</h4>
                    <!-- <div type="file"class="feature-image-content" name="uploadSanitaryPermit"></div> -->
                    <input type="file" class="feature-image-content" name="uploadCedula">
                  </div><br>
                  <div class="property-details-inputs">
                    <h4>Upload Scan Picture of Business Permit</h4>
                    <!-- <div type="file" class="feature-image-content" name="uploadBusinessPermit"></div> -->
                    <input type="file" class="feature-image-content" name="uploadBusinessPermit">
                  </div>
                </div>
                <button name="SubmitProperty" type="submit" class="site-btn">Submit Property</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Property Submit Section End -->

  <!-- Footer Section Begin -->
  <footer class="footer-section">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    function get_subcategory() {
      var category = $('#category').val();
      $.ajax({
        url: 'dependentcat.php',
        method: 'POST',
        data: {
          category: category
        },
        success: function(data) {
          console.log("AJAX success:", data);
          $("#dispSubClass").html(data);
        }
      });
    }

    function get_barangay() {
      console.log('get_barangay() function called.');
      var barangay = $('#filter').val();
      $.ajax({
        url: 'barangaylist.php',
        method: 'POST',
        data: {
          barangay: barangay
        },
        success: function(response) {
          console.log("AJAX success:", response);
          var data = JSON.parse(response); // Parse the JSON response

          if (data.length > 0) {
            var zone = data[0].zone; // Assuming there's only one zone per barangay
            var location = data[0].location;

            $("#Zone").val(zone);
            $("#location").val(location); // Display the location
          } else {
            $("#Zone").val(''); // Clear the zone input if no data is found
            $("#location").val(''); // Clear the location input if no data is found
          }
        }
      });
    }
  </script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

  <script>
    var map = L.map('map').setView([14.6577, 120.9842], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
      maxZoom: 18,
    }).addTo(map);

    var caloocanBoundary = L.geoJSON().addTo(map);

    // Load the barangay GeoJSON or coordinates file
    $.getJSON('boundary.geojson.json', function(data) {
      caloocanBoundary.addData(data);

      caloocanBoundary.setStyle(function(feature) {
        var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
        return {
          fillColor: randomColor,
          fillOpacity: 0.7,
          color: 'black',
          weight: 1
        };
      });

      caloocanBoundary.eachLayer(function(layer) {
        layer.bindPopup(layer.feature.properties.NAME_3);
      });

      var draggableMarker = L.marker([14.6577, 120.9842], {
        draggable: true
      }).addTo(map);
      draggableMarker.on('dragend', function(event) {
        var marker = event.target;
        var position = marker.getLatLng();
        $('#lat').text(position.lat.toFixed(6));
        $('#long').text(position.lng.toFixed(6));
      });


      console.log()

      // $('#saveButton').click(function() {
      //   var savedLat = draggableMarker.getLatLng().lat.toFixed(6);
      //   var savedLong = draggableMarker.getLatLng().lng.toFixed(6);
      //   $('#savedLat').val(savedLat);
      //   $('#savedLong').val(savedLong);
      // });

      map.fitBounds(caloocanBoundary.getBounds());

      $('#filter').change(function() {
        var selectedBarangay = $(this).val();
        if (selectedBarangay) {
          caloocanBoundary.eachLayer(function(layer) {
            if (layer.feature.properties.NAME_3 === selectedBarangay) {
              var center = layer.getBounds().getCenter();
              draggableMarker.setLatLng(center);
              $('#lat').val(center.lat.toFixed(6));
              $('#long').val(center.lng.toFixed(6));
              // Update the map view to zoom in to the selected barangay's center
              map.setView(center, 20); // You can adjust the zoom level (14 in this case) as needed

              draggableMarker.bindPopup("Drag and pin this to your location").openPopup();
              return;
            }
          });
        } else {
          // If no barangay is selected, fit the map to the bounds of the entire area
          map.fitBounds(caloocanBoundary.getBounds());
        }
      });

    });
  </script>
</body>

</html>