
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="registerStyle.css">
  
</head>
<body>
  <main>
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="registerStyle.css">
</head>
<body>
  <main>
    <div class="page-container">
      <!-- جزء الصورة -->
      <div class="left-side">
      </div>

      <!-- جزء الفورم -->
      <div class="right-side">
        <div class="wrapper">
          <h2>Get started.</h2>
          <p>Already have an account? <a href="LogIn.php">Log in</a></p>
          <p class="socials-divider"><span>or</span></p>
          <form action="register.php" method="post">
            <div class="input-container">
              <label for="first_name">First Name</label>
              <input type="text" name="first_name" placeholder="Your first name" id="first_name" required>
            </div>
            
            <div class="input-container">
              <label for="last_name">Last Name</label>
              <input type="text" name="last_name" placeholder="Your last name" id="last_name" required>
            </div>

            <div class="email-input-container">
              <label for="email">Email address</label>
              <input type="email" name="email_address" placeholder="example@gmail.com" id="email" required>
            </div>
            
            <div class="password-input-container">
              <label for="password">Password</label>
              <input type="password" name="password" placeholder="Your password" id="password" required>
            </div>
            
            <button id="register-button" type="submit" name="register">Create Account</button>
          </form>
          <div id="message-container"></div> <!-- هذا العنصر لعرض الرسائل -->
          <a href="VistSaudi.php">Back</a>
        </div>
      </div>
    </div>
  </main>
  <script>
if ($result->num_rows > 0) {
    echo "<script>document.getElementById('message-container').textContent = 'This email address is already registered.';</script>";
} else {
    if ($stmt->execute()) {
        echo "<script>document.getElementById('message-container').textContent = 'Account has been successfully registered';</script>";
    } else {
        echo "<script>document.getElementById('message-container').textContent = 'An error occurred while registering the account: " . addslashes($stmt->error) . "';</script>";
    }
}

</script>

  <?php
session_start();

if(isset($_POST["register"])) {
    // تعقيم ومعالجة البيانات المرسلة
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = htmlspecialchars($_POST["email_address"]);
    $password = $_POST["password"];

    // تشفير كلمة المرور
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $db_password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // استعلام SQL باستخدام prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "This email address is already registered.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);
        if ($stmt->execute()) {
            echo "Account has been successfully registered";
        } else {
            echo "An error occurred while registering the account: " . $stmt->error;
        }
    }
    $stmt->close();
    $conn->close();
}
?>


</body>
</html>

