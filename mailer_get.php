<?php
$userid = $_GET['guest_id'];

$dealer = mysqli_query($con, "SELECT * FROM `register_dealer` WHERE `userid` = '$userid' ") or die(mysqli_error($con));
$d = mysqli_fetch_array($dealer);
if(isset($_POST['subscribe'])){
    $to = $_POST['email']; // this is your Email address
    $from = "info@scratchsoftwaresolutions.com"; // this is the sender's Email address
    $name = $d['userid'];
    $last_name = $d['name'];
    $subject = "hello";
    $subject2 = "hello";
    $message = $name . " " . $last_name . " wrote the following:" . "\n\n" . " Subscribe the equipride to get in touch and get the future update. ";
    $message2 = "hello1 " . $name . "\n\n" . " new news letter";

    $headers = "from:" . $from;
    $headers2 = "from:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    // echo "Mail Sent. Thank you " . $name . ", we will contact you shortly.";
    header('Location: dealer_panal.php');
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.
    }
    ?>