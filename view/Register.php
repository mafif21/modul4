<?php
// inisiasi session
session_start();

// cek apakaah terdapat session dengan key login
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
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <div class="container d-flex min-vh-100 justify-content-center align-items-center">
    <div class="card" style="width: 30rem;">
      <img src="../assets/photo.jpeg" class="card-img-top">
      <div class="card-body">
        <div class="title mb-4">
          <h3>Register Page</h3>
        </div>

        <div class="user-input">

          <!-- perhatikan bagian ini -->
          <form action="../config/RegisterController.php" method="POST">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="your username...">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="your email...">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="your password...">
            </div>
            <div class="mb-3">
              <label for="passwordValidate" class="form-label">Validate Password</label>
              <input type="password" class="form-control" id="passwordValidate" name="passwordValidate" placeholder="validate password...">
            </div>
            <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
          </form>
          <!-- perhatikan bagian ini -->

          <p class="pt-2 fs-6 text-center">
            Already have an account?
            <a href="./Login.php" class="text-decoration-none">Login Account</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
</body>

</html>