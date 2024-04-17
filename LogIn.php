<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // إذا لم يكن المستخدم مسجل الدخول، قم بتوجيهه إلى صفحة تسجيل الدخول
    header("location: login.php");
    exit;
}

// تحقق مما إذا تم إرسال بيانات الحجز
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال بيانات الحجز
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $guests = isset($_POST["guests"]) ? $_POST["guests"] : "no";
    $guestNumber = isset($_POST["guestNumber"]) ? $_POST["guestNumber"] : "";
    $from = $_POST["from"];
    $to = $_POST["to"];
    $date = $_POST["date"];
    $class = $_POST["class"];

    // عرض بيانات الحجز
    echo "<h2>Booking Details:</h2>";
    echo "<p>First Name: $firstname</p>";
    echo "<p>Last Name: $lastname</p>";
    echo "<p>Email: $email</p>";
    echo "<p>Phone Number: $phone</p>";
    echo "<p>Age: $age</p>";
    echo "<p>Bringing Guests: $guests</p>";
    if ($guests == "yes") {
        echo "<p>Number of Guests: $guestNumber</p>";
    }
    echo "<p>From: $from</p>";
    echo "<p>To Activity: $to</p>";
    echo "<p>Date of Visit: $date</p>";
    echo "<p>Class: $class</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Form</title>
    <link rel="stylesheet" href="T.css">
</head>
<body>
    <div class="ticket-form">
        <h2>Book Ticket</h2>
        <h2>Let’s create your entrance Ticket!</h2>
        <form action="book_ticket.php" method="post">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <!-- الحقول الأخرى لبيانات الحجز -->
            <!-- ... -->
            <div class="form-group">
                <input type="submit" value="Search">
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const guestsRadio = document.querySelector('input[name="guests"]');
            const guestsNumber = document.getElementById("guestsNumber");

            guestsRadio.addEventListener("change", function() {
                if (this.value === "yes") {
                    guestsNumber.style.display = "block";
                } else {
                    guestsNumber.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>