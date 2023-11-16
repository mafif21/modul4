<?php
// inisiasi session
session_start();

// tambahkan koneksi database
require "./connect.php";

// apakah tombol login sudah di pencet
if (isset($_POST['login'])) {
  // ambil input user email
  $email = $_POST["email"];

  // ambil input user password
  $password = $_POST["password"];

  // cari akun dengan email
  $findAccount = mysqli_query($db,  "SELECT * FROM users WHERE email='$email'");

  // cek apakah terdapat data dari akun yang dicaro
  if (mysqli_num_rows($findAccount) === 1) {
    // check password
    $account = mysqli_fetch_assoc($findAccount);

    // apakah password input sama dengan penyimpanan database
    if (password_verify($password, $account["password"])) {
      // membuat session dengan key login
      $_SESSION["login"] = true;

      // membuat session dengan key id
      $_SESSION["id"] = $account["id"];

      // membuat session dengan key username
      $_SESSION["username"] = $account["username"];

      // apakah rememberMe di checklist
      if (isset($_POST["rememberMe"])) {
        // membuat cookie dengan key id
        setcookie("id", $account["id"], time() + 60);

        // membuat cookie dengan key "key"
        setcookie("key", hash('sha256', $account["email"]), time() + 60);
      }

      // arahkan ke halaman dashboard
      header("Location: ../view/Dashboard.php");

      // tutup halaman
      exit;
    }
  }
}
