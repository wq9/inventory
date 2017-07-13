<?php

if ($db_name == '') {
    echo '<script> window.location = "installation.php"; </script>';
}
/* ----------------------------------------------
  MYSQL CONNTECT
  ---------------------------------------------- */
$db_connect = mysqli_connect($db_host, $db_user_name, $db_password, $db_name);
if (!$db_connect) {
    echo'<p></p><div class="row"><div class="alert-box alert">No connection to the server.</div></div>';
    exit;
}
if (!mysqli_set_charset($db_connect, 'utf8')) {
    echo'<p></p><div class="row"><div class="alert-box alert">Error loading character set utf8.</div></div>';
    exit;
}
$db_select = mysqli_select_db($db_connect, $db_name);
if (!$db_select) {
    echo '<p></p><div class="row"><div class="alert-box alert">The database was not found.</div></div>';
    exit;
}
?>