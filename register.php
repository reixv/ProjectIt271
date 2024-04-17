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
      <div class="grid-container">
        <div class="left-side">
          <div class="img-and-text">
            <img class="cart-illustration" src="img/cart-illustration.png" alt="Cart Illustration">
          </div>
        </div>
        <div class="right-side">
          <div class="wrapper">
            <h2>Get started.</h2>
            <p>Already have an account? <a href="LogIn.php">Log in</a></p>
            <div class="sign-up-buttons"></div>
            <p class="socials-divider"><span>or</span></p>

            <form action="register.php" method="post">
                <label for="first_name">First Name</label>
                <div class="input-container">
                    <input type="text" name="first_name" placeholder="Your first name" id="first_name" required>
                </div>
                
                <label for="last_name">Last Name</label>
                <div class="input-container">
                    <input type="text" name="last_name" placeholder="Your last name" id="last_name" required>
                </div>

                <label for="email">Email address</label>
                <div class="email-input-container">
                    <i class="fi fi-rr-envelope icon-email"></i>
                    <input type="email" name="email_address" placeholder="example@gmail.com" id="email" required>
                </div>
                
                <label for="password">Password</label>
                <div class="password-input-container">
                    <i class="fi fi-rr-lock icon-password"></i>
                    <input type="password" name="password" placeholder="Your password" id="password" required>
                </div>
                
                <button id="register-button" type="submit" name="register">Create Account</button>
            </form>
            <a href="VistSaudi.php">Back </a>

            <?php
            if(isset($_POST["register"])) {
                // استرجاع البيانات المرسلة من النموذج
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

                // إنشاء الاتصال
                $conn = new mysqli($servername, $username, $db_password, $dbname);

                // التحقق من الاتصال
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

                // إغلاق الاتصال بقاعدة البيانات
                $stmt->close();
                $conn->close();
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </main>
</body>
</html>
