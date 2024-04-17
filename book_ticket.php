<?php
session_start(); // بدء جلسة جديدة

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
                <label for="from">From:</label>
                <input type="text" id="from" name="from" required>
            </div>
            <div class="form-group">
                <label for="to">To Activity:</label>
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
                <label for="class">Class:</label>
                <select id="class" name="class" required>
                    <option value="economy">Economy</option>
                    <option value="business">Business</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Book a Ticket">
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const guestsYesRadio = document.querySelector('input[name="guests"][value="yes"]');
            const guestsNoRadio = document.querySelector('input[name="guests"][value="no"]');
            const guestsNumberDiv = document.getElementById("guestsNumber");

            // إظهار أو إخفاء حقل عدد الضيوف بناءً على اختيار الضيوف
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
<?php
session_start(); // بدء جلسة جديدة

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // استقبال البيانات من النموذج
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $age = $_POST["age"];
    $guests = $_POST["guests"];
    $guestNumber = isset($_POST["guestNumber"]) ? $_POST["guestNumber"] : "N/A";
    $from = $_POST["from"];
    $to = $_POST["to"];
    $date = $_POST["date"];
    $class = $_POST["class"];

    // هنا يمكنك إضافة كود لتخزين هذه البيانات في قاعدة البيانات أو إجراء معالجات أخرى
    // عرض معلومات المستخدم للتأكيد
    echo "<h2>User Information:</h2>";
    echo "<p><strong>First Name:</strong> $firstname</p>";
    echo "<p><strong>Last Name:</strong> $lastname</p>";
    echo "<p><strong>Email Address:</strong> $email</p>";
    echo "<p><strong>Phone Number:</strong> $phone</p>";
    echo "<p><strong>Age:</strong> $age</p>";
    echo "<p><strong>Bringing additional guests:</strong> $guests</p>";
    if ($guests == 'yes') {
        echo "<p><strong>Number of Guests:</strong> $guestNumber</p>";
    }
    echo "<p><strong>From:</strong> $from</p>";
    echo "<p><strong>To Activity:</strong> $to</p>";
    echo "<p><strong>Date of Visit:</strong> $date</p>";
    echo "<p><strong>Class:</strong> $class</p>";
}
?>
