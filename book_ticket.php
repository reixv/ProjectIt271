<?php
session_start();

// التحقق من تسجيل الدخول
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // إذا لم يكن المستخدم مسجل الدخول، قم بتوجيهه إلى صفحة تسجيل الدخول
    header("location: login.php");
    exit;
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
                    <legend>Are you bringing any additional guests/friends & family:</legend>
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