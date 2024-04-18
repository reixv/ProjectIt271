<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

if (!isset($_SESSION['ticket_data'])) {
    header("location: book_ticket.php"); // Redirect to booking if no data available
    exit;
}

$ticket = $_SESSION['ticket_data'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Details</title>
    <link rel="stylesheet" href="ticket_style.css"> <!-- Assume you have this CSS file -->
</head>
<body>
    <div class="ticket-container">
        <h1>Booking Confirmation</h1>
        <p>First Name: <?php echo htmlspecialchars($ticket['firstname']); ?></p>
        <p>Last Name: <?php echo htmlspecialchars($ticket['lastname']); ?></p>
        <p>Email: <?php echo htmlspecialchars($ticket['email']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($ticket['phone']); ?></p>
        <p>Age: <?php echo htmlspecialchars($ticket['age']); ?></p>
        <p>Bringing Guests: <?php echo htmlspecialchars($ticket['guests']); ?></p>
        <?php if ($ticket['guests'] == 'yes'): ?>
            <p>Number of Guests: <?php echo htmlspecialchars($ticket['guestNumber']); ?></p>
        <?php endif; ?>
        <p>Activity: <?php echo htmlspecialchars($ticket['to']); ?></p>
        <p>Date of Visit: <?php echo htmlspecialchars($ticket['date']); ?></p>
    </div>
</body>
</html>
