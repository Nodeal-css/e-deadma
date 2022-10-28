<?php
session_start();
if(isset($_POST['logout']))
{
    unset($_SESSION['account_id']);
    unset($_SESSION['cemetery_id']);
    echo 'logout';
    exit();
}

if(isset($_SESSION['account_id']) && isset($_SESSION['cemetery_id'])){
  echo 'true'; // for adminDashboard.php
}else if(isset($_SESSION['account_id'])){
  echo 'pick'; // for adminCemetery.php
}else{
  echo 'false';
}


exit();