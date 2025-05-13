<?php
session_start(); 
include("admin/include/connection1.php");

if (isset($_POST['submit'])) {
    $Phone = $_POST['Phone'] ?? null;
    $login_id = $_POST['login_id'] ?? null;

    if (!$Phone && !$login_id) {
        echo "<script>
                alert('Please fill in either Phone or Login ID.');
                window.location.href = 'test.php';
              </script>";
        exit;
    }

    $stmt = null;
    if ($Phone) {
        $stmt = $conn->prepare("SELECT * FROM `user` WHERE `Phone` = ? AND `active` = 'yes'");
        $stmt->bind_param("s", $Phone);
    } elseif ($login_id) {
        $stmt = $conn->prepare("SELECT * FROM `user` WHERE `login_id` = ? AND `active` = 'yes'");
        $stmt->bind_param("s", $login_id);
    }

    if (!$stmt) {
        echo "<script>
                alert('Error in preparing query.');
                window.location.href = 'test.php';
              </script>";
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (isset($_SESSION['Phone'])) {
            echo "Phone stored in session: " . $_SESSION['Phone'];
        }
        if (isset($_SESSION['login_id'])) {
            echo "Login ID stored in session: " . $_SESSION['login_id'];
        }
        
        // if ($Phone) $_SESSION['Phone'] = $Phone;
        // if ($login_id) $_SESSION['login_id'] = $login_id;

        echo "<script>window.location.href='details_summary.php';</script>";
        exit;
    } else {
        echo "<script>
                alert('Wrong Information. Please fill your correct Phone or Login ID for login.');
                window.location.href = 'test.php';
              </script>";
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include("include/head.php"); ?>

<body>
   <!--=================================
     Header -->
   <?php include("include/header.php"); ?>
   <!--=================================
     Header -->

   <!--=================================
         Banner -->
   <section class="pt-breadcrumb">
      <div class="pt-bg-overley1 pt-opacity2" style="background-image: url('images/main-home/26.jpg');"></div>
      <div class="container">
         <div class="row">
            <div class="col-sm-12 text-center">
               <h1 class="pt-breadcrumb-title">
                  Attend
               </h1>
               <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
                     <li class="breadcrumb-item text-white" aria-current="page">
                        Attend
                     </li>
                  </ol>
               </nav>
            </div>
         </div>
      </div>
   </section>
   <!--=================================
            Banner -->

   <style>
      #mylog-form input {
         margin: 0 !important;
         padding: 0 !important;
      }

      #log-form {
         margin: 0 !important;
         padding: 0 !important;
      }

      #log-form p {
         text-align: center;
         margin: 0 !important;
         padding: 0 !important;
      }
   </style>


   <!-- Attend Form -->
   <form id="my_form" method="POST" action="" style="margin-bottom: 60px; margin-top: 50px;">
      <div class="container">
         <h2 style="margin-bottom: 40px;">Attend</h2>
         <div class="card">
            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-12 col-12" id="form_mg">
                  <img src="./images/main-home/002.jpg">
               </div>

               <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                  <h3>Attend</h3>
                  <p>Not an Account? <a href="registration.php">Register</a></p>
                  <section id="log-form">
                     <input type="text" placeholder="Enter your LOGIN ID" id="log-form2"
                        style="margin-bottom: 20px;" name="login_id">
                     <div id="break-input">
                        <p>OR</p>
                     </div>
                     <input type="number" placeholder="Enter your Phone here" id="log-form3"
                        style="margin-top: 20px; margin-bottom:40px;" name="Phone">
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

   <!-- Attend From End -->

   <!--=================================
         footer-->
   <?php include("include/footer.php"); ?>
   <!--=================================
           footer-->
   <!--=================================
         Back To Top-->
   <div id="back-to-top">
      <a class="topbtn" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
   </div>
   <!--=================================
       Back To Top-->
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
