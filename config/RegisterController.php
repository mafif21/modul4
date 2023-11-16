<?php
// tambahkan koneksi database
require "./connect.php";

// apakah tombol register sudah di pencet
if (isset($_POST["register"])) {
  // ambil user input username
  $username = $_POST["username"];

  // ambil user input email
  $email = $_POST["email"];

  // ambil user input password
  $password = $_POST["password"];

  // ambil user input passwordValidate
  $passwordValidate = $_POST["passwordValidate"];

  // pencarian email yang sama
  $checkEmail = mysqli_query($db, "SELECT * FROM users WHERE email='$email'");

  // check apakah email sudah terdaftar
  if (mysqli_fetch_assoc($checkEmail)) {
    // pesan error
    echo "
    <script>
      alert('Email already exists');
      document.location.href='../view/Login.php';
    </script>
    ";
    // kembalikan false
    return false;
  }

  // cek apakah password dan passwordValidate itu sama
  if ($password !== $passwordValidate) {
    // pesan error
    echo "
    <script>
      alert('Password is different');
      document.location.href='../view/Register.php';
    </script>
    ";
    // kembalikan false
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
