<?php
session_start();
  include "koneksi.php";

  if (!isset($_SESSION['id'])) {
    include"login.php";
  }else{

   $sqluser = $conn->query("SELECT*FROM user WHERE id='$_SESSION[id]'");
  $resultuser = $sqluser->fetch(PDO::FETCH_ASSOC);
?>


<?php
}
?>