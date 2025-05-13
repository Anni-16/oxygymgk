<?php
session_start();
include("admin/include/connection1.php");

if (!$conn) {
   die("Database connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
   $identifier = $_POST['identifier'] ?? null;

   if (!$identifier) {
      echo "<script>
                alert('Please enter your Login ID or Phone.');
                window.location.href = 'attend.php';
              </script>";
      exit;
   }

   $stmt = $conn->prepare("SELECT * FROM user WHERE Phone = ? OR login_id = ?");
   if (!$stmt) {
      die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
   }
   $stmt->bind_param("ss", $identifier, $identifier);

   if (!$stmt->execute()) {
      die("Execution failed: (" . $stmt->errno . ") " . $stmt->error);
   }

   $result = $stmt->get_result();
   if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      // Check if the user is active
      if ($row['active'] === 'yes') {
         $_SESSION['identifier'] = $identifier;

         // Redirect with PHP instead of JavaScript
         header("Location: details_summary.php");
         exit;
      } else {
         // Alert for inactive membership
         echo "<script>
                    alert('Your membership has expired. Please renew it to access our services.');
                    window.location.href = 'attend.php';
                  </script>";
         exit;
      }
   } else {
      echo "<script>
                alert('Wrong information. Please enter the correct Login ID or Phone.');
                window.location.href = 'attend.php';
              </script>";
      exit;
   }
}
?>



<!DOCTYPE html>
<html lang="en">
<?php include("include/head.php"); ?>

<body>
   <!-- Header -->
   <?php include("include/header.php"); ?>

   <!-- Banner -->
   <section class="pt-breadcrumb">
      <div class="pt-bg-overley1 pt-opacity2" style="background-image: url('images/main-home/26.jpg');"></div>
      <div class="container">
         <div class="row">
            <div class="col-sm-12 text-center">
               <h1 class="pt-breadcrumb-title">Attend</h1>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
                     <li class="breadcrumb-item text-white" aria-current="page">Attend</li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </section>

   <!-- Attend Form -->
   <form id="my_form" method="POST" action="" style="margin-bottom: 60px; margin-top: 50px;">
      <div class="container">
         <h2 style="margin-bottom: 40px;">Attend</h2>
         <div class="card">
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12 col-12" id="form_mg">
                  <img src="./images/main-home/002.jpg">
               </div>

               <div class="col-lg-6 col-md-6 col-sm-12 col-12" >
                  <h5 style="padding-top: 50px !important;">Attend</h5>
                  <p>Not an Account? <a href="registration.php">Register</a></p>
                  <section id="log-form" style="padding-top: 0px !important;">
                     <h3 class="h5">Enter Your Login Id OR Phone For Attend.</h3>
                     <input type="text" placeholder="Enter your Login ID or Phone" id="log-form2"
                        style="margin-bottom: 20px;" name="identifier" required>
                     <div class="row" style="margin-bottom: 60px;">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                           <div class="col-lg-4 col-md-2 col-sm-12 col-12">
                              <span class="pt-button-line-left">
                                 <button type="submit" name="submit">Submit</button>
                              </span>
                           </div>
                        </div>
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </form>

   <!-- Footer -->
   <?php include("include/footer.php"); ?>
   <div id="back-to-top">
      <a class="topbtn" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
   </div>
   <?php include("include/foot.php"); ?>

</body>
<script>
   'undefined' === typeof _trfq || (window._trfq = []);
   'undefined' === typeof _trfd && (window._trfd = []), _trfd.push({
      'tccl.baseHost': 'secureserver.net'
   }, {
      'ap': 'cpbh-mt'
   }, {
      'server': 'sg2plmcpnl492384'
   }, {
      'dcenter': 'sg2'
   }, {
      'cp_id': '9858662'
   }, {
      'cp_cache': ''
   }, {
      'cp_cl': '8'
   });
</script>
<script src='../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>

</html>