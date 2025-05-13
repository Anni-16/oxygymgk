<?php
include('admin/include/connection1.php');

date_default_timezone_set("Asia/Kolkata");   //India time (GMT+5:30)

// Import PHPMailer classes
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

session_start();

// Check if the session variable 'identifier' is set
if (!isset($_SESSION['identifier'])) {
    header("Location: index.php");
    exit();
}

// Retrieve user details based on session 'identifier'
$query = "SELECT * FROM user WHERE (Phone = ? OR login_id = ?) AND active = 'yes'";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $_SESSION['identifier'], $_SESSION['identifier']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row): ?>
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
                        <h1 class="pt-breadcrumb-title">User Information</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item text-white" aria-current="page">User Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <!-- User Details Form -->
        <form id="my_form" method="POST" enctype="multipart/form-data">
            <div class="container">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <h2 style="margin-bottom: 40px; margin-top: 60px;">User Information</h2>

                        <!-- User Information Fields -->
                        <?php
                        $fields = [
                            'login_id' => 'Login ID',
                            'username' => 'Name',
                            'dob' => 'Date Of Birth',
                            'age' => 'Age',
                            'gender' => 'Gender',
                            'address' => 'Address',
                            'Phone' => 'Tel.',
                            'Email' => 'Email',
                            'medical_history' => 'History of Medical Problems (if Any)'
                        ];

                        foreach ($fields as $field => $label) {
                            $value = htmlspecialchars($row[$field]);
                            $inputType = ($field === 'dob') ? 'date' : (($field === 'age') ? 'number' : 'text');

                            echo "<div class='form-group row'>
                                <label class='col-lg-4 col-form-label'>{$label}</label>
                                <div class='col-lg-8'>";
                            if ($field === 'medical_history') {
                                echo "<textarea class='form-control' name='{$field}'>{$value}</textarea>";
                            } else {
                                echo "<input type='{$inputType}' class='form-control' name='{$field}' value='{$value}' required>";
                            }
                            echo "</div></div>";
                        }
                        ?>

                        <div class="form-group row">
                            <div class="col-lg-8 offset-lg-4">
                                <button type="submit" name="submitAttend" class="btn btn-primary">Attend</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitAttend'])) {
            // Insert attendance record
           date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = date('Y-m-d H:i:s');

    // Insert attendance record
    $stmt = $conn->prepare("INSERT INTO attend (login_id, username, Email, Phone, address, dob, age, medical_history, gender, attend, join_dt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $attend = 'yes';
    $stmt->bind_param(
        "sssssssssss",
        $_POST['login_id'],
        $_POST['username'],
        $_POST['Email'],
        $_POST['Phone'],
        $_POST['address'],
        $_POST['dob'],
        $_POST['age'],
        $_POST['medical_history'],
        $_POST['gender'],
        $attend,
        $currentDateTime // Insert the current datetime
    );

            if ($stmt->execute()) {
                // Send email with PHPMailer
                // $mail = new PHPMailer(true);
                try {
                    // $mail->isSMTP();
                    // $mail->Host = 'smtp.gmail.com';
                    // $mail->SMTPAuth = true;
                    // $mail->Username = 'info@oxygymgk.com';
                    // $mail->Password = 'gvmzwjuqvtxzmjws';
                    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    // $mail->Port = 587;

                    // $mail->setFrom('info@oxygymgk.com', 'OxyGym');
                    // $mail->addAddress($_POST['Email'], $_POST['username']);

                    // $mail->isHTML(true);
                    // $mail->Subject = 'Attendance Confirmation';
                    // $mail->Body = "Dear " . htmlspecialchars($_POST['username']) . ",<br>Your attendance has been successfully recorded. Thank you!<br><br>Best Regards,<br>OxyGym Team";
                    // $mail->AltBody = "Dear " . htmlspecialchars($_POST['username']) . ",\nYour attendance has been successfully recorded. Thank you!\n\nBest Regards,\nOxyGym Team";

                    // $mail->send();


                    // SMS notification
                    $authKey = '3634585947594d36363374'; // Authorization key
                    $messageKey = '1707173762607981798'; // Message key
                    $headerKey = 'OXYGRK'; // Sender header
                    $phoneNumber = $_POST['Phone'];
                    $messageContent = "Dear " . htmlspecialchars($_POST['username']) . ", Your attendance has been successfully recorded. Thank you! Best Regards, OxyGym Team.";

                    $apiUrl = "http://smsportal.onlinesystemssolutions.com/api/sendhttp.php?authkey=$authKey&mobiles=$phoneNumber&message=" . urlencode($messageContent) . "&sender=$headerKey&route=2&country=0&DLT_TE_ID=$messageKey";

                    $response = @file_get_contents($apiUrl);

                    if ($response === false) {
                        echo "<script>alert('Attendance recorded, but SMS could not be sent.');</script>";
                    } else {
                        echo "<script>alert('Attendance recorded successfully! Confirmation Email and SMS sent.');</script>";
                    }
                } catch (Exception $e) {
                    echo "<script>alert('Attendance recorded, but Email could not be sent. Error: {$mail->ErrorInfo}');</script>";
                }

                // Redirect after successful attendance recording
                echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 3000);</script>";
            } else {
                echo "<script>alert('Error recording attendance: " . htmlspecialchars($stmt->error) . "');</script>";
            }

            $stmt->close();
        } ?>

        <!-- Footer -->
        <?php include("include/footer.php"); ?>

        <script>
            // Dynamically calculate age based on DOB
            document.getElementById('dob').addEventListener('change', function() {
                const dob = new Date(this.value);
                const diff = Date.now() - dob.getTime();
                const age = new Date(diff).getUTCFullYear() - 1970;
                document.getElementById('age').value = age;
            });
        </script>
    </body>

    </html>
<?php endif; ?>