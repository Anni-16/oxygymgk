<?php
// Step 1: Set up your API credentials and other keys
$authKey = '3634585947594d36363374'; // Authorization key
$messageKey = '1707173762578570448'; // Message key
$headerKey = 'OXYGRK'; // Header key

// Step 2: Prepare the recipient details and message content
$phoneNumber = '+918595308953'; // Replace with the recipient's phone number (with country code, e.g., +1234567890)
$name = 'aniket';
$messageContent = "Congratulations $name, your request for registration has been received. Thank you for registering on OxyGym. We have received your request for activating your profile. You will be able to login once we approve your request. Thank you for your patience! OxyGym Team.";

// Step 3: Create the API URL
$apiUrl = "http://smsportal.onlinesystemssolutions.com/api/sendhttp.php?authkey=$authKey&mobiles=$phoneNumber&message=" . urlencode($messageContent) . "&sender=$headerKey&route=2&country=0&DLT_TE_ID=$messageKey";

// Step 4: Send the GET request
$response = @file_get_contents($apiUrl);

// Step 5: Process the response
if ($response === false) {
    echo "Failed to Send SMS: Unable to connect to the API.\n";
} else {
    echo "SMS Sent Successfully:\n";
    // var_dump($response);
}
?>
