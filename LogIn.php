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
<?php
session_start();
$error_message = ''; // Initialize the error message

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // بيانات الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $row["email"];
            header("location: VistSaudi.php");
            exit;
        } else {
            $error_message = "Incorrect email or password!";
        }
    } else {
        $error_message = "Incorrect email or password!";
    }
    $stmt->close();
    $conn->close();
}
?>
  <main>
    <div class="page-container">
      <div class="grid-container">
        <div class="left-side">
        </div>
        <div class="right-side">
          <div class="wrapper">
            <h2>Welcome Back!</h2>
            <form action="Login.php" method="post">
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
            <?php if (!empty($error_message)): ?>
                <p class="error"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <a href="register.php">Need an account? Register here.</a>
          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
