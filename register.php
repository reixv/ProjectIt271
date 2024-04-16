<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="registerStyle.css">
</head>
<body>
  <main>
    <div class="page-container">
      <div class="grid-container">
        <div class="left-side">
          <div class="img-and-text">
            <img class="cart-illustration" src="img/cart-illustration.png" alt="">
          </div>
        </div>
        <div class="right-side">
          <div class="wrapper">
            <h2>Get started.</h2>
            <p>Already have an account? <a href="LogIn.php">Log in</a></p>
            <div class="sign-up-buttons"></div>
            <p class="socials-divider"><span>or</span></p>

            <form action="" method="post">
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
                $email = $_POST["email_address"];
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

                // استعلام SQL للتحقق من وجود مستخدم بنفس البريد الإلكتروني
                $check_email_query = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($check_email_query);

                if ($result->num_rows > 0) {
                    echo "This email address is already registered.";
                } else {
                    // استعلام SQL لإدراج البيانات في قاعدة البيانات
                    $insert_query = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";

                    if ($conn->query($insert_query) === TRUE) {
                        echo "Account has been successfully registered";
                    } else {
                        echo "An error occurred while registering the account" . $conn->error;
                    }
                }

                // إغلاق الاتصال بقاعدة البيانات
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