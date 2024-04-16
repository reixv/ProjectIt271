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
    <label for="first_name">First Name</label>
    <div class="input-container">
        <input type="text" name="first_name" placeholder="Your first name" id="first_name">
    </div>
    
    <label for="last_name">Last Name</label>
    <div class="input-container">
        <input type="text" name="last_name" placeholder="Your last name" id="last_name">
    </div>
    
    <label for="email">Email address</label>
    <div class="email-input-container">
        <i class="fi fi-rr-envelope icon-email"></i>
        <input type="email" name="email_address" placeholder="example@gmail.com" id="email">
    </div>
    
    <label for="password">Password</label>
    <div class="password-input-container">
        <i class="fi fi-rr-lock icon-password"></i>
        <input type="password" name="password" placeholder="Your password" id="password">
    </div>
    
    <div class="agreement-check">
        <input type="checkbox" name="terms_of_service_and_privacy_policy">
        <span class="terms-of-use-text">I agree to Platform's
            <a href="#">Terms of Service</a> and
            <a href="#">Privacy Policy</a>
        </span>
    </div>
    
    <button id="register-button" type="submit" name="register">Create Account</button>
</form>
<a href="VistSaudi.php">Back </a>

            <?php
            if(isset($_POST["register"])) {
                // استرجاع البيانات المرسلة من النموذج
                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $email = $_POST["email_address"];
                $password = $_POST["password"];

                // الاتصال بقاعدة البيانات
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "login";

                // إنشاء الاتصال
                $conn = new mysqli($servername, $username, $password, $dbname);

                // التحقق من الاتصال
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // تنفيذ استعلام SQL لإدراج البيانات في قاعدة البيانات
                $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$first_name', '$last_name', '$email', '$password')";

                if ($conn->query($sql) === TRUE) {
                    echo "Account has been successfully registered";
                } else {
                    echo "An error occurred while registering the account" . $conn->error;
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