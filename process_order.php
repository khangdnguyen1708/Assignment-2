<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Enquiry page">
    <meta name="keywords" content="HTML5/CSS/PHP">
    <meta name="author" content="Duy Khang Nguyen">
    <title>Payment page</title>

    <link href="styles/enquire.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    require_once("settingslocal.php");
    $conn = @mysqli_connect(
        $host,
        $user,
        $pwd,
        $sql_db
    );

    if (!$conn) {
        echo "<p>Database connection failure</p>";
    } else {
        echo "<p>Database connection success</p>";
    }

    // Sanitise function to remove leading/ trailing, backslashes and HTML control characters
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Checks if process was triggered by a form submit, if not return to payment.php
    /*if (isset($_POST["title"])) {
        $firstname = $_POST["title"];
    } else {
        header("location: payment.php");
    }*/
    
    /*if (isset($_POST["first_name"])) {
        $firstname = $_POST["first_name"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["last_name"])) {
        $firstname = $_POST["last_name"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["email"])) {
        $firstname = $_POST["email"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["phone_number"])) {
        $firstname = $_POST["phone_number"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["street_addr"])) {
        $firstname = $_POST["street_addr"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["city"])) {
        $firstname = $_POST["city"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["state"])) {
        $firstname = $_POST["state"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["postcode"])) {
        $firstname = $_POST["postcode"];
    } else {
        header("location: payment.php");
    }

    if (isset($_POST["postcode"])) {
        $firstname = $_POST["postcode"];
    } else {
        header("location: payment.php");
    }*/

    // Check if table orders exist
    $check_table = "orderstest";
    $result = mysqli_query($conn, "SHOW TABLES LIKE '$check_table'");
    if ($result->num_rows != 0) {
        echo "<p>table exists1</p>";
    } else {
        echo "<p>table not found1</p>";
        $create_table_query = "CREATE TABLE orderstest (order_id int(3) not null PRIMARY KEY AUTO_INCREMENT, order_time date not null, order_status varchar(255) DEFAULT 'PENDING', order_product varchar(255) not null, order_quantity int(11) not null, order_cost int(20) not null, card_type varchar(255) not null, card_name varchar(255) not null, card_number int(16) not null, card_expire varchar(5) not null, card_cvv int(3) not null, order_phone_number int(10) not null);";
        $result = mysqli_query($conn, $create_table_query);
    }

    // Check if table personal exist
    $check_table = "personaltest";
    $result = mysqli_query($conn, "SHOW TABLES LIKE '$check_table'");
    if ($result->num_rows != 0) {
        echo "<p>table exists2</p>";
    } else {
        echo "<p>table not found2</p>";
        $create_table_query = "CREATE TABLE personaltest ( title varchar(255) not null, first_name varchar(255) not null, last_name varchar(255) not null, email varchar(255) not null, phone_number int(10) not null PRIMARY KEY, street_addr varchar(255) not null, city varchar(255) not null, customer_state varchar(255) not null, postcode int(9) not null );";
        $result = mysqli_query($conn, $create_table_query);
    }

    // Sanitise all inputs --MANH NGUYEN--

    // Check input format using Regex (need to check) --MANH NGUYEN--
    $errMsg = "";
    if ($first_name == "") {
        $errMsg .= "<p>You must enter your first name.</p>";
    }
    if (!preg_match("/^[a-zA-Z]*$/", $first_name)) {
        $errMsg .= "<p>Only alpha letters allowed in your first name.</p>";
    }
    if ($lastname == "") {
        $errMsg .= "<p>You must enter your last name.</p>";
    }
    if (!preg_match("/^[a-zA-Z-]*$/", $lastname)) {
        $errMsg .= "<p>Only alpha letters and hyphen are allowed in your first name.</p>";
    }
    if (!is_numeric($age)) {
        $errMsg .= "<p>Age must be a numeric number.</p>";
    }
    if ($age < 18 || $age > 10000) {
        $errMsg .= "<p>Age must be between 18 and 10,000.</p>";
    }

    if ($errMsg != "") {
        echo "<p>$errMsg</p>";
    } else {
        echo "<p>all inputs are good</p>";
    }

    // Add all inputs to tables --KHANG NGUYEN--

    echo "<p>end</p>";
    ?>
</body>

</html>