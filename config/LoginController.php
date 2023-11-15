<?php
require "./connect.php";

if (isset($_POST['login'])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $findAccount = mysqli_query($db,  "SELECT * FROM users WHERE email='$email'");

  if (mysqli_num_rows($findAccount) === 1) {
    // check password
    $account = mysqli_fetch_assoc($findAccount);

    // apakah password input sama dengan penyimpanan database
    if (password_verify($password, $account["password"])) {
      // membuat session
      $_SESSION["login"] = true;
      $_SESSION["id"] = $account["id"];
      $_SESSION["username"] = $account["username"];

      if (isset($_POST["rememberMe"])) {
        setcookie("id", $account["id"], time() + 60);
        setcookie("key", hash('sha256', $account["email"]), time() + 60);
      }
      header("Location: ../view/Dashboard.php");
      exit;
    }
  }
}
