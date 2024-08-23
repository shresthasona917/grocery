<?php
ini_set('session.cache_limiter', 'public');
session_cache_limiter(false);
session_start();
include("config.php");
if (!isset($_SESSION['uemail'])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta Tags -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="images/logo-icon.png">

    <!--	Fonts
    ========================================================-->
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,500,600,700&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:400,700" rel="stylesheet">

    <!--	Css Link
    ========================================================-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap-slider.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/layerslider.css">
    <link rel="stylesheet" type="text/css" href="css/color.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/flaticon/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">

    <!--	Title
    =========================================================-->
    <title>Find Me property</title>
</head>

<body>

    <!--	Page Loader
=============================================================
<div class="page-loader position-fixed z-index-9999 w-100 bg-white vh-100">
    <div class="d-flex justify-content-center y-middle position-relative">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
</div>
-->


    <div id="page-wrapper">
        <div class="row">
            <!--	Header start  -->
            <?php include("include/header.php"); ?>
            <!--	Header end  -->

            <!--	Banner   --->
            <div class="banner-full-row page-banner" style="background-image:url('images/breadcromb.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="page-name float-left text-white text-uppercase mt-1 mb-0"><b>User Booked
                                    Property</b></h2>
                        </div>
                        <div class="col-md-6">
                            <nav aria-label="breadcrumb" class="float-left float-md-right">
                                <ol class="breadcrumb bg-transparent m-0 p-0">
                                    <li class="breadcrumb-item text-white"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active">User Booked Property</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!--	Banner   --->


            <!--	Submit property   -->
            <div class="full-row bg-gray">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-lg-12">
                            <h2 class="text-secondary double-down-line text-center">User Booked Property</h2>
                            <?php
                            if (isset($_GET['msg']))
                                echo $_GET['msg'];
                            ?>
                        </div>
                    </div>
                    <table class="items-list col-lg-12" style="border-collapse:inherit;">
                        <thead>
                            <tr class="bg-primary">
                                <th class="text-white font-weight-bolder">Properties</th>
                                <th class="text-white font-weight-bolder">BHK</th>
                                <th class="text-white font-weight-bolder">Reason</th>
                                <th class="text-white font-weight-bolder">Booked Date</th>
                                <th class="text-white font-weight-bolder">Status</th>
                                <th class="text-white font-weight-bolder">Unbook</th>
                                <!-- <th class="text-white font-weight-bolder">Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $uid = $_SESSION['uid'];
                            // $query=mysqli_query($con,"SELECT * FROM `property` WHERE uid='$uid'");
                            // $query = mysqli_query($con, "SELECT booking.*, property.* FROM booking 
                            //  INNER JOIN property ON booking.pid = property.pid");

                            $query = mysqli_query($con, "SELECT booking.*, property.* FROM booking 
                            LEFT JOIN property ON booking.pid = property.pid
                            WHERE booking.uid = '$uid'");
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td>
                                        <img src="admin/property/<?php echo $row['pimage']; ?>" alt="pimage">
                                        <div class="property-info d-table">
                                            <h5 class="text-secondary text-capitalize"><a
                                                    href="propertydetail.php?pid=<?php echo $row['0']; ?>"><?php echo $row['title']; ?></a></h5>
                                            <span class="font-14 text-capitalize"><i
                                                    class="fas fa-map-marker-alt text-primary font-13"></i>&nbsp;
                                                <?php echo $row['14']; ?>
                                            </span>
                                            <div class="price mt-3">
                                                <span class="text-primary">Rs.&nbsp;
                                                    <?php echo $row['13']; ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <?php echo $row['bhk']; ?>
                                    </td>
                                    <td class="text-capitalize">For
                                        <?php echo $row['5']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['booking_date']; ?>
                                    </td>
                                    <td class="text-capitalize">
                                        <?php echo $row['status']; ?>
                                    </td>
                                    <!-- <form id="unbookForm" action="unbook_property.php" method="post">
                                        <td>
                                            <input type="hidden" name="property_id" id="property_id">
                                            <button type="button" class="btn btn-primary" onclick="unbookProperty(this)"
                                                data-property-id="<?php echo $row['0']; ?>">Unbook</button>
                                        </td>
                                    </form> -->
                                    <!-- <script>
                                        function unbookProperty(button) {
                                            // Get the property ID from the clicked button's data attribute
                                            var propertyId = button.getAttribute("data-property-id");

                                            // Set the property ID to the hidden input field
                                            document.getElementById("property_id").value = propertyId;

                                            // Submit the form
                                            document.getElementById("unbookForm").submit();
                                        }
                                    
                                    </script> -->

                                    <form id="unbookForm" action="unbook_property.php" method="post">
                                        <td>
                                            <input type="hidden" name="property_id" id="property_id">
                                            <button type="button" class="btn btn-primary" onclick="unbookProperty(this)"
                                                data-property-id="<?php echo $row['0']; ?>">Unbook</button>
                                        </td>
                                    </form>
                                    <script
                                        src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
                                    <script>
                                        function unbookProperty(button) {
                                            var propertyId = button.getAttribute("data-property-id");

                                            // Send the property ID to the server using AJAX
                                            var xhr = new XMLHttpRequest();
                                            xhr.open("POST", "unbook_property.php", true);
                                            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                                            xhr.onreadystatechange = function () {
                                                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                                                    // Handle the response from the server
                                                    var response = xhr.responseText;
                                                    if (response.trim() === "success") {
                                                        // If the response is "success", show an alert and update the page content
                                                        // alert("Property unbooked successfully.");
                                                        // Swal.fire({
                                                        //     icon: 'success',
                                                        //     title: 'Property UnBooked',
                                                        //     text: 'Property Unbooked successfully.',
                                                        //     confirmButtonText: 'OK',
                                                        //     confirmButtonColor: '#3085d6',
                                                        // });
                                                        // $(document).ajaxSuccess(function () {
                                                        //     window.location.reload();
                                                        // });
                                                        Swal.fire({
                                                            icon: 'success',
                                                            title: 'Property Unbooked',
                                                            text: 'Property Unbooked successfully.',
                                                            confirmButtonText: 'OK',
                                                            confirmButtonColor: '#3085d6',
                                                        }).then(function () {

                                                            location.reload();
                                                        });
                                                        // Here, you can perform any additional DOM updates to reflect the unbooking.
                                                    } else {
                                                        // Handle the case when unbooking fails
                                                        alert("Failed to unbook property.");
                                                    }
                                                }
                                            };
                                            xhr.send("property_id=" + propertyId);
                                        }
                                    </script>


                                    <!-- <td><a class="btn btn-primary" href="submitpropertydelete.php?id=<?php echo $row['0']; ?>">Delete</a></td> -->
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <!--	Submit property   -->


            <!--	Footer   start-->
            <?php include("include/footer.php"); ?>
            <!--	Footer   start-->

            <!-- Scroll to top -->
            <a href="#" class="bg-secondary text-white hover-text-secondary" id="scroll"><i
                    class="fas fa-angle-up"></i></a>
            <!-- End Scroll To top -->
        </div>
    </div>
    <!-- Wrapper End -->

    <!--	Js Link
============================================================-->
    <script src="js/jquery.min.js"></script>
    <!--jQuery Layer Slider -->
    <script src="js/greensock.js"></script>
    <script src="js/layerslider.transitions.js"></script>
    <script src="js/layerslider.kreaturamedia.jquery.js"></script>
    <!--jQuery Layer Slider -->
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/tmpl.js"></script>
    <script src="js/jquery.dependClass-0.1.js"></script>
    <script src="js/draggable-0.1.js"></script>
    <script src="js/jquery.slider.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>