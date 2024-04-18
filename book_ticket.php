<?php
// Start session and check if the user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "login"; 

// Establish a new connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $conn->real_escape_string($_POST["firstname"]);
    $lastname = $conn->real_escape_string($_POST["lastname"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $age = $conn->real_escape_string($_POST["age"]);
    $guests = $conn->real_escape_string($_POST["guests"]);
    $guestNumber = isset($_POST["guestNumber"]) ? $conn->real_escape_string($_POST["guestNumber"]) : "N/A";
    $to = $conn->real_escape_string($_POST["to"]);
    $date = $conn->real_escape_string($_POST["date"]);
    $today = date("Y-m-d");

    if ($date < $today) {
        echo "<script>alert('Please select a future date for your visit.');</script>";
    } elseif (!preg_match("/^\+966\d{9}$/", $phone)) {
        echo "<script>alert('Please enter a valid Saudi phone number starting with +966.');</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO tickets (firstname, lastname, email, phone, age, guests, guestNumber, to_activity, date_of_visit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisssi", $firstname, $lastname, $email, $phone, $age, $guests, $guestNumber, $to, $date);
        if ($stmt->execute()) {
            $_SESSION['ticket_data'] = [
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'phone' => $phone,
                'age' => $age,
                'guests' => $guests,
                'guestNumber' => $guests == 'yes' ? $guestNumber : 'N/A',
                'to' => $to,
                'date' => $date
            ];
            header("Location: ticket_details.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $conn->close();
}
?>
