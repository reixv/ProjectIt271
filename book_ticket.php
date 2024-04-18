

<?php
session_start();//  بدء جلسة جديدة

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Ticket</title>
    <link rel="stylesheet" href="book_ticket.css">
</head>
<body>
    <div class="ticket-form">
        <h2>Book Ticket
            <br>
        Let’s create your entrance Ticket!</h2>
        <form action="book_ticket.php" method="post">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <fieldset>
                    <legend>Are you bringing any guests?</legend>
                    <label><input type="radio" name="guests" value="yes"> Yes</label>
                    <label><input type="radio" name="guests" value="no" checked> No</label>
                </fieldset>
            </div>
            <div class="form-group" id="guestsNumber" style="display: none;">
                <label for="guestNumber">Number of Guests:</label>
                <select id="guestNumber" name="guestNumber">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="to">choose  Activity:</label>
                <select id="to" name="to" required>
                    <option value="maraya">Maraya Alula</option>
                    <option value="wonder">Wonder Garden Riyadh</option>
                    <option value="Ithra">Ithra Alkhober</option>
                    <option value="bayada">Bayada Island Jeddah</option>
                    <option value="buraydah">Dates City Buraydah</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date">Date of Visit:</label>
                <input type="date" id="date" name="date" required>
            </div>
            
            <div class="form-group">
                <input type="submit" value="Book a Ticket">
            </div>
        </form>
    </div>

    <?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

$servername = "localhost"; 
$username = "root";
$password = ""; 
$dbname = "login"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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
    } else {
        $stmt = $conn->prepare("INSERT INTO tickets (firstname, lastname, email, phone, age, guests, guestNumber, to_activity, date_of_visit) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssisssi", $firstname, $lastname, $email, $phone, $age, $guests, $guestNumber, $to, $date);

        if ($stmt->execute()) {
            echo "<h1>Booking Confirmation</h1>";
            echo "<p>First Name: " . htmlspecialchars($firstname) . "</p>";
            echo "<p>Last Name: " . htmlspecialchars($lastname) . "</p>";
            echo "<p>Email: " . htmlspecialchars($email) . "</p>";
            echo "<p>Phone: " . htmlspecialchars($phone) . "</p>";
            echo "<p>Age: " . htmlspecialchars($age) . "</p>";
            echo "<p>Bringing Guests: " . htmlspecialchars($guests) . "</p>";
            if ($guests == 'yes') {
                echo "<p>Number of Guests: " . htmlspecialchars($guestNumber) . "</p>";
            }
            echo "<p>Activity: " . htmlspecialchars($to) . "</p>";
            echo "<p>Date of Visit: " . htmlspecialchars($date) . "</p>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
    $conn->close();
}
?>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const guestsYesRadio = document.querySelector('input[name="guests"][value="yes"]');
            const guestsNoRadio = document.querySelector('input[name="guests"][value="no"]');
            const guestsNumberDiv = document.getElementById("guestsNumber");

            function toggleGuestNumberDisplay() {
                if (guestsYesRadio.checked) {
                    guestsNumberDiv.style.display = "block";
                } else {
                    guestsNumberDiv.style.display = "none";
                }
            }

            guestsYesRadio.addEventListener("change", toggleGuestNumberDisplay);
            guestsNoRadio.addEventListener("change", toggleGuestNumberDisplay);
        });
    </script>
</body>
</html>
