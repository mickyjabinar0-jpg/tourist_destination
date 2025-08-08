<?php
$conn = mysli_connect("localhost","root", "", "tourismdestination_db") or die(mysql_error());
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=tourismdestination_db", "root","");
$stmt = $pdo->prepare("SELECT * FROM admin_user_db WHERE username = ?");
$user = $stmt->fetch();

if(user&& password_verify($password,$user['password'])) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin_dashboard.php");
}else{
    "alert (Invalid Login Credentials.)";
}
$password = 'admin123' ; // your desired admin password
$hash = password_hash($password, PASSWORD_DEFAULT);

"INSERT INTO admin_user_db (username, password)
VALUES ('admin', 'password_default')";



if($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['username'] = $username;
        header("Location: admin_dashboard.php") ;
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Tourism Destination</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background: #f0f2f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
     background-image: url('https://storage.pixteller.com/designs/designs-images/2019-03-27/05/love-and-passion-background-backgrounds-love-1-5c9b994ec8376.png');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-position: center;
  }
  .login-container {
    background: white;
    padding: 40px 50px;
    border-radius: 8px;
    box-shadow: 0 0 10px lightcoral;
    width: 100%;
    max-width: 400px;
    text-align: center;
  }
  .login-container h2 {
    margin-bottom: 25px;
    color: #fa002aff;
  }
  .login-container label {
    text-align: left;
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    margin-top: 15px;
  }
  .login-container input {
    padding: 10px;
    width: 100%;
    border: 1px solid #de0c52ff;
    border-radius: 4px;
    margin-bottom: 10px;
    font-size: 16px;
  }
  .login-container button {
    margin-top: 15px;
    padding: 10px;
    width: 100%;
    background-color: #de0c52ff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
  }
  .login-container button:hover {
    background-color: #f20443ff;
  }
  .error-message {
    color: red;
    margin-top: 15px;
  }
  .signup-link {
    margin-top: 20px;
    font-size: 14px;
  }
  .signup-link a {
    color: #ff003cff;
    text-decoration: none;
  }
  .signup-link a:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>
  <form action="home.php" method="post">

<div class="login-container">
  <h2>Login to Tourism Destination</h2>
  <form method="POST" action="">
    <label for="username">Username</label>
    <input type="text" id="username" name="username" required autofocus />

    <label for="password">Password</label>
    <input type="password" id="password" name="password" required />

    <button type="submit">Login</button>
  </form>

  <p class="signup-link">
    Don't have an account? <a href="signup.php">Sign up here</a>
  </p>
</div>

</body>
</html>s