<?php
session_start(); // Start the session to store session data

if (isset($_POST["login"])) {
    $email = $_POST["email"]; // Retrieve email from form
    $password = $_POST["password"]; // Retrieve password from form

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $db_password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row["password"])) {
            // Login successful
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $row["email"];
            header("location: book_ticket.php"); // Redirect to the ticket booking page
            exit;
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No user found with this email address!";
    }

    $stmt->close(); // Close the statement
    $conn->close(); // Close the connection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="LogIn.css">
</head>
<body>
  <main>
    <div class="page-container">
      <div class="grid-container">
        <div class="left-side">
          <div class="img-and-text">
            <img class="cart-illustration" src="img/cart-illustration.png" alt="Cart Illustration">
          </div>
        </div>
        <div class="right-side">
          <div class="wrapper">
            <h2>Welcome Back!</h2>
            <form action="" method="post">
              <label for="email">Email address</label>
              <div class="email-input-container">
                <i class="fi fi-rr-envelope icon-email"></i>
                <input type="email" name="email" placeholder="Your email address" id="email" required>
              </div>
              <label for="password">Password</label>
              <div class="password-input-container">
                <i class="fi fi-rr-lock icon-password"></i>
                <input type="password" name="password" placeholder="Your password" id="password" required>
              </div>
              <button id="login-button" type="submit" name="login">Log in</button>
            </form>
            <a href="register.php">Need an account? Register here.</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
