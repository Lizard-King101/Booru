<?php
  session_start();
  if(isset($_POST)){
    foreach($_POST as $key => $value){
      $_SESSION[$key] = $value;
      echo $key.": ".$_SESSION[$key];
    }
  }
  echo json_encode($_POST);
?>