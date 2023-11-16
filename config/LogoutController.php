<?php
// inisiasi session
session_start();

// hancurkan session
session_destroy();

// unset session
session_unset();

// hapus cookie dengan key id
setcookie('id', '', time() - 3600);

// hapus cookie dengan key 'key'
setcookie('key', '', time() - 3600);

// arahkan ke halaman view login
header("Location: ../view/Login.php");

// tutup
exit;
