<?php


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// Include database connection
include("admin/include/connection1.php");

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if (isset($_POST['submit'])) {
    // Collect and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $Email = mysqli_real_escape_string($conn, $_POST['Email']);
    $Phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $dob = $_POST['dob'];
    $age = isset($_POST['age']) ? intval($_POST['age']) : 0;
    $medical_history = mysqli_real_escape_string($conn, $_POST['medical_history']);
    $current_status = isset($_POST['current_status']) ? mysqli_real_escape_string($conn, $_POST['current_status']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $trainer = mysqli_real_escape_string($conn, $_POST['trainer']);

    // File upload handling
    $document = '';
    $allowed_file_types = ['jpg', 'jpeg', 'png', 'pdf'];
    if (isset($_FILES['document']) && $_FILES['document']['error'] === UPLOAD_ERR_OK) {
        $document = basename($_FILES['document']['name']);
        $file_extension = strtolower(pathinfo($document, PATHINFO_EXTENSION));
        $target_dir = "./uploads/";
        $target_file = $target_dir . $document;

        if (in_array($file_extension, $allowed_file_types)) {
            if (move_uploaded_file($_FILES['document']['tmp_name'], $target_file)) {
                echo "<script>alert('File uploaded successfully.');</script>";
            } else {
                echo "<script>alert('File upload failed.');</script>";
                $document = ''; // Reset document if upload fails
            }
        } else {
            echo "<script>alert('Invalid file type. Allowed types: JPG, PNG, PDF.');</script>";
            $document = '';
        }
    }

    // Check if email is already registered
    $email_check_sql = "SELECT * FROM user WHERE Phone = '$Phone'";
    $email_check_result = mysqli_query($conn, $email_check_sql);
    if (mysqli_num_rows($email_check_result) > 0) {
        echo "<script>
                alert('This phone is already registered. Please use a different phone.');
                window.location.href = 'registration.php';
              </script>";
        exit();
    }

    // Insert data into the database
    $sql = "INSERT INTO user(username, Email, Phone, address, dob, age, medical_history, current_status, trainer, document, gender)
            VALUES ('$username', '$Email', '$Phone', '$address', '$dob', '$age', '$medical_history', '$current_status', '$trainer', '$document', '$gender')";
    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        $login_id = "OXY" . $last_id;
        $update_query = "UPDATE user SET login_id = '$login_id' WHERE user_id = '$last_id'";
        if (mysqli_query($conn, $update_query)) {
            // Send confirmation email
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'info@oxygymgk.com';
                $mail->Password = 'gvmzwjuqvtxzmjws';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('info@oxygymgk.com', 'OxyGym');
                $mail->addAddress($Email);
                $mail->isHTML(true);
                $mail->Subject = 'Thank you for Registering with OxyGym';
                $mail->Body = "
            <html>
            <head>
                <title>Thank you for Registering with OxyGym</title>
            </head>
            <body>
                <p>Congratulations $username, your request for registration has been received.</p>
                <p><b>Thank you for registering on OxyGym. We have received your request for activating your profile. You will be able to login once we approve your request.</b></p>
                <p>Thank you for your patience!</p>
                <p>OxyGym Team</p>
            </body>
            </html>";

                $mail->AltBody = 'Welcome to OxyGym!';

                $mail->send();

                $mail->clearAddresses();
                $mail->addAddress('info@oxygymgk.com');
                $mail->Subject = 'New User Registration';
                $mail->Body = "<html>
                <head>
                    <title>New User Registration</title>
                </head>
                <body>
                    <p>A new user has registered:</p>
                    <p><strong>Name:</strong> $username</p>
                    <p><strong>Email:</strong> $Email</p>
                    <p><strong>Contact:</strong> $Phone</p>
                    <p><strong>Address:</strong> $address</p>
                    <p><strong>DOB:</strong> $dob</p>
                    <p><strong>Age:</strong> $age</p>
                    <p><strong>Gender:</strong> $gender</p>
                    <p><strong>Medical History:</strong> $medical_history</p>
                    <p><strong>Current Status:</strong> $current_status</p>
                    <p><strong>Trainer:</strong> $trainer</p>
                </body>
                </html>";

                $mail->send();

                // SMS Sending
                $authKey = '3634585947594d36363374'; // Authorization key
                $messageKey = '1707173831291121535'; // Message key
                $headerKey = 'OXYGRK'; // Header key
                $messageContent = "Congratulations $username, Thank you for registering at OxyGym. We have received your request for activating your profile. You will be able to login once we approve your request. Thank you for your patience! OxyGym Team.";
                $apiUrl = "http://smsportal.onlinesystemssolutions.com/api/sendhttp.php?authkey=$authKey&mobiles=$Phone&message=" . urlencode($messageContent) . "&sender=$headerKey&route=2&country=0&DLT_TE_ID=$messageKey";

                

                $response = @file_get_contents($apiUrl);
                if ($response === false) {
                    echo "<script>alert('Failed to send SMS.');</script>";
                }

                echo "<script>
                        alert('Registration successful! A confirmation Email & SMS has been sent.');
                        window.location.href = 'index.php';
                      </script>";
            } catch (Exception $e) {
                echo "<script>
                        alert('Registration successful, but the email could not be sent.');
                        window.location.href = 'index.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Registration successful, but login ID update failed.');
                  </script>";
        }
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
                window.location.href = 'registration.php';
              </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php include("include/head.php"); ?>

<body>
    <!--=============== Loader ==================-->

    <!--=================================
       Loader -->
    <!--=================================
       Header -->
    <?php
    include("include/header.php");
    ?>
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
                        Registration
                    </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home mr-2"></i>Home</a>
                            </li>
                            <li class="breadcrumb-item text-white" aria-current="page">
                                Registration
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--=================================
            Banner -->

    <!--  Registration From Start -->
    <form id="my_form" method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-md-12 col-sm-12 col-12" id="my_form_hide"></div>
                <div class="col-lg-10 col-md-12 col-sm-12 col-12">
                    <h2 style="margin-bottom: 40px; margin-top: 60px;">Registration Form</h2>
                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Name
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="text" id="first" name="username" placeholder="Name" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Date Of Birth
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="date" id="date-input" name="dob" placeholder="Date Of Birth" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Age
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="text" id="date-of-birth" name="age" placeholder="Enter Your Age" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Gender
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <select class="form-select" id="first" style="margin-top: 20px;" name="gender">
                                <option selected>Gender</option>
                                <option value="Male" name="gender">Male</option>
                                <option value="Female" name="gender">Female</option>
                                <option value="Others" name="gender">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Address
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="text" id="first" name="address" placeholder="Address" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Tel.
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="text" id="first" name="Phone" placeholder="Phone" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 30px;">
                            Email
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="email" id="first" name="Email" placeholder="Email" required>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 30px;">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 0px;">
                            History of Medical Problems(if Any)
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <textarea placeholder="Type Here" id="first" name="medical_history"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 10px;">
                            Current Status
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="radio" id="student" name="current_status" value="Student">
                            <label for="student">Student</label>
                            <input type="radio" id="business" name="current_status" value="Business">
                            <label for="business">Business</label>
                            <input type="radio" id="professional" name="current_status" value="Professional">
                            <label for="professional">Professional</label>
                            <input type="radio" id="others" name="current_status" value="Others">
                            <label for="others">Others</label>
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 20px;"> Trainer </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="select" id="first" name="trainer" placeholder="">
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-lg-4 col-md-2 col-sm-12 col-12" style="padding-top: 20px;">
                            Upload Documents/ Photo *
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                            <input type="file" id="select" name="document" placeholder="" required>
                        </div>
                    </div>

                    <div class=" row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12" id="checkbox-1">
                            <div id="check-select">
                                <input type="checkbox" required>
                                <labe>I accept the <a href="term.php"> Terms & Conditions. </a></labe>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 40px; margin-bottom: 60px;">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="col-lg-4 col-md-2 col-sm-12 col-12">
                                <span class="pt-button-line-left"><button type="submit" name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12"></div>
                </div>
            </div>
        </div>
    </form>
    <!-- Registration From End -->
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

    <script>
        document.getElementById('date-input').addEventListener('input', function() {
            var selectedDate = this.value;
            var yearsDifference = calculateYearsDifference(selectedDate);

            document.getElementById('date-of-birth').value = yearsDifference;
        });


        function calculateYearsDifference(dateString) {
            var selectedDate = new Date(dateString);
            var currentDate = new Date();


            var years = currentDate.getFullYear() - selectedDate.getFullYear();
            var monthDifference = currentDate.getMonth() - selectedDate.getMonth();

            // Adjust if the current date hasn't reached the anniversary of the selected date yet
            if (monthDifference < 0 || (monthDifference === 0 && currentDate.getDate() < selectedDate.getDate())) {
                years--;
            }

            return years;
        }
    </script>


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
    })
</script>
<script src='../../../../img1.wsimg.com/signals/js/clients/scc-c2/scc-c2.min.js'></script>

</html>