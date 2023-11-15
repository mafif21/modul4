<?php
require "./connect.php";

if (isset($_POST["register"])) {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $passwordValidate = $_POST["passwordValidate"];

  // cek apakah email sudah terdaftar
  $checkEmail = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");

  // check apakah ada data yang sudah terdaftar
  if (mysqli_fetch_assoc($checkEmail)) {
    echo "
    <script>
      alert('Email already exists');
      document.location.href='../view/Login.php';
    </script>
    ";
    return false;
  }

  // cek apakah password dan passwordValidate
  if ($password !== $passwordValidate) {
    echo "
    <script>
      alert('Password is different');
      document.location.href='../view/Register.php';
    </script>
    ";
    return false;
  }

  // enkripsi password menjadi huruf random
  $newPass = password_hash($password, PASSWORD_DEFAULT);

  // buat query untuk memasukan data user
  $insertNewUser = "INSERT INTO users (username, email, password)
  VALUES ('$username', '$email', '$newPass')";

  // eksekusi query
  mysqli_query($db, $insertNewUser);

  // cek apakah terdapat perubahan pada database
  // 0 = false | 1 = true
  if (mysqli_affected_rows($db) > 0) {
    echo "
    <script>
      alert('Account has been added');
      document.location.href='../view/Login.php';
    </script>
    ";
  }
}
