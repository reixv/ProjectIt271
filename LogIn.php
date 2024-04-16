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
            <img class="cart-illustration" src="img/cart-illustration.png" alt="">
          </div>
        </div>
        <div class="right-side">
          <div class="wrapper">
            <h2>Welcome Back!</h2>
            <form action="" method="post">
              <label for="email">Email address</label>
              <div class="email-input-container">
                <i class="fi fi-rr-envelope icon-email"></i>
                <input type="email" name="email" placeholder="Your email address" id="email">
              </div>
              <label for="password">Password</label>
              <div class="password-input-container">
                <i class="fi fi-rr-lock icon-password"></i>
                <input type="password" name="password" placeholder="Your password" id="password">
              </div>
              <button id="login-button" type="submit" name="login">Log in</button>
            </form>
            <a href="register.php">Back </a>

          </div>
        </div>
      </div>
    </div>

  </main>

</body>
</html>




<?php
session_start(); // بدء الجلسة لتخزين بيانات الجلسة

if(isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // الاتصال بقاعدة البيانات
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "login";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // التحقق من الاتصال
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // استعلام SQL لاسترداد بيانات المستخدم باستخدام البريد الإلكتروني
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // إذا كان هناك سجل متطابق مع البريد الإلكتروني
        $row = $result->fetch_assoc();
        // التحقق مما إذا كانت كلمة المرور صحيحة
        if (password_verify($password, $row["password"])) {
            // تسجيل الدخول بنجاح
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["user_email"] = $row["email"];
            // يمكنك إعادة توجيه المستخدم إلى الصفحة المناسبة هنا
            echo "Login successful!";
        } else {
            // كلمة المرور غير صحيحة
            echo "Invalid password!";
        }
    } else {
        // لم يتم العثور على مستخدم مع هذا البريد الإلكتروني
        echo "No user found with this email address!";
    }

    $conn->close();
}
?>