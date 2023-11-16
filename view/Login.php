<?php
// inisiasi session
session_start();

// tambahkan koneksi database
require "../config/connect.php";

// cek apakah terdapat cookie dengan key id dan 'key'
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
  // buat variable key berisi cookie dengan key 'key'
  $key = $_COOKIE["key"];

  // buat variable id berisi cookie dengan key 'id'
  $id = $_COOKIE["id"];

  // pencarian akun yang dimana mempunyai id yang sama dengan cookie key 'id'
  $findAccount = mysqli_query($db, "SELECT * FROM users WHERE id='$id'");

  // dapatkan semua data
  $account = mysqli_fetch_assoc($findAccount);

  // Jika nilai $key sama dengan hash SHA-256 dari alamat email pengguna
  if ($key === hash('sha256', $account["email"])) {
    // Set session bahwa pengguna telah berhasil login
    $_SESSION["login"] = true;

    // Simpan ID pengguna ke dalam session
    $_SESSION["id"] = $account["id"];

    // Simpan nama pengguna ke dalam session
    $_SESSION["username"] = $account["username"];
  }
}

// apakah sudah terdapat session yang mempunyai key login
if (isset($_SESSION["login"])) {
  // arahkan ke view dashboard
  header("Location: Dashboard.php");
  // keluar
  exit;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container d-flex min-vh-100 justify-content-center align-items-center">
    <div class="card" style="width: 30rem;">
      <img src="../assets/photo.jpeg" class="card-img-top" alt="we">
      <div class="card-body">
        <div class="title mb-4">
          <h3>Login Page</h3>
        </div>

        <div class="user-input">

          <!-- perhatikan bagian ini -->
          <form action="../config/LoginController.php" method="POST">
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="your email...">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="your password...">
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="rememberMe">
              <label class="form-check-label text-primary" for="rememberMe" name="rememberMe">Remember me?</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
          </form>
          <!-- perhatikan bagian ini -->

          <p class="pt-2 fs-6 text-center">
            Don't have an account?
            <a href="./Register.php" class="text-decoration-none">Create Account</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
</body>

</html>