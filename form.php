<?php
include "user.php";
session_start();
if(isset($_SESSION["username"])==TRUE){
  die("you are all ready signin");
}

if (isset($_GET["var"])){
    $mainvar=$_GET["var"];
}else{
  $mainvar="registrationform";
}

//from below if else condtions each input have different output but if the
// output is different from the defined four inputs then last else
// will be thrown

if ($mainvar=="signinformuser" ){
  echo '<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <link rel="shortcut icon" href="icon.png">
      <link rel="stylesheet" href="global/regestrationform.css">
      <script src="apiscripts/ajaxapi.js"></script>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body>
      <div class="form">

      <form class="regform" action="form?var=signinuser" method="post">
        <section id="errorbox"></section>
        <input type="text" name="username" placeholder="User Name">
        <input type="password" name="pass" placeholder="password">
        <input type="submit" name="submit" value="Signin" id="submit">
      </form>
      </div>
    </body>
  </html>';
  if (isset($_GET["error"])){
    $error1=$_GET["error"];
    if ($error1=="username") {
      echo '<script>
      var errorbox=document.querySelector("#errorbox")
      errorbox.innerHTML="Invalid Username or Password <a href=/new_website/form?var=signinformmail>Try mail istead</a>"
          </script>
          <style media="screen">
          form #errorbox{
            border:1px solid red;
            padding:10px;
            padding-left: 5px;
            padding-right: 5px;
          }

          </style>

          ';}
        }

  }

elseif ($mainvar=="signinformmail") {
  echo '<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <link rel="shortcut icon" href="icon.png">
      <link rel="stylesheet" href="global/regestrationform.css">
      <script src="apiscripts/ajaxapi.js"></script>
      <meta charset="utf-8">
      <link rel="stylesheet" href="global/htop_sidemenu.css"
      <title></title>
    </head>
    <body>
      <div class="form">
      <form class="regform" action="form?var=signinmail" method="post">
        <section id="errorbox"></section>
        <input type="text" name="mail" placeholder="Mail-id">
        <input type="password" name="pass" placeholder="password">
        <input type="submit" name="submit" value="Signin" id="submit">
      </form>
      </div>
      <scipt src="course/loadpage.js"></script>
    </body>
  </html>';
  if (isset($_GET["error"])){
    $error1=$_GET["error"];
    if ($error1=="mail") {
      echo '<script>
      var errorbox=document.querySelector("#errorbox")
      errorbox.innerHTML="Invalid Email id or Password <a href=/new_website/form?var=signinformuser>Try Username</a>"
          </script>

          <style media="screen">
          form #errorbox{
            border:1px solid red;
            padding:10px;
            padding-left: 5px;
            padding-right: 5px;
          }

          </style>';
            }
        }
}

elseif ($mainvar=="signinuser") {
  $user = $_POST["username"];
  $pass = $_POST["pass"];
  $connection = new mysqli($server,$username,$password);
  if ($connection->connect_error) {
      die("Connection failed :  " . $conn->connect_error);
  }
  $query2="SELECT user_name,password FROM $database.$table";
  if ($connection->query($query2)) {
    $login_check=$connection->query($query2);
    while ($row=$login_check->fetch_assoc()) {
      $blankarray=[];
      foreach ($row as $element) {
        array_push($blankarray,$element);
        // echo $blankarray[0];
      }

      if ($blankarray[0]==$user) {
        echo $blankarray[0];
        if ($blankarray[1]==$pass){
          $_SESSION["username"]=$blankarray[0];
          // echo isset($_SESSION["username"]="shiv");
          echo "signin successfully";
          break;
        }
      }
      // die(header("location:/new_website/form?var=signinformuser&error=username"));//this is ouside of while loop

    }
  }
  else{
    die("connection failed");
  }
}

elseif ($mainvar=="signinmail") {
  $mail = $_POST["mail"];
  $pass = $_POST["pass"];
  $connection = new mysqli($server,$username,$password);
  if ($connection->connect_error) {
      die("Connection failed :  " . $conn->connect_error);
  }
  $query2="SELECT mail_id,password FROM $database.$table";
  if ($connection->query($query2)) {
    $login_check=$connection->query($query2);
    while ($row=$login_check->fetch_assoc()) {
      $blankarray=[];
      foreach ($row as $element) {
        array_push($blankarray,$element);
      }

      if ($blankarray[0]==$mail) {
        if ($blankarray[1]==$pass){
          echo "login Successfully";
          break;
        }
      }
    }
    die(header("location:/new_website/form?var=signinformmail&error=mail"));//this is ouside of while loop
  }
  else{
    die("connection failed");
  }
}

elseif ($mainvar=="registrationform") {

  echo '<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <link rel="shortcut icon" href="icon.png">
      <link rel="stylesheet" href="global/regestrationform.css">
      <link rel="stylesheet" href="global/top_sidemenu.css">
      <meta charset="utf-8">
      <script src="apiscripts/ajaxapi.js  "></script>
      <script src="global/sidemenu.js  "></script>

      <title></title>
    </head>
    <body>
    <div class="top"></div>
      <div class="form">
      <form class="regform" action="form?var=register" method="post">
      <section id="errorbox"></section>
        <input type="text" name="username" placeholder="User Name">
        <input type="text" name="mail_id" placeholder="Email">
        <input type="password" name="pass" placeholder="password">
        <input type="password" name="confirm_pass" placeholder="comfirm password">
        <input type="submit" name="submit" value="Register" id="submit">
      </form>
      </div>
      <script src="course/loadpage.js"></script>
      <div class="sidemenu" id="sidemenu"></div>
    </body>
    </html>';
  if (isset($_GET["error"])){
    $error1=$_GET["error"];
    if ($error1=="username") {
      echo '<script>
      var errorbox=document.querySelector("#errorbox")
      errorbox.innerHTML="Username Already Exist Use Another Username"
          </script>
      <style media="screen">
      form #errorbox{
        border:1px solid red;
        padding:10px;
        padding-left: 5px;
        padding-right: 5px;
      }

      </style>
          ';
    }elseif($error1=="mail"){
      echo '<script>
      var errorbox=document.querySelector("#errorbox")
      errorbox.innerHTML="Mail id Already Exist Signin"
          </script>
          <style media="screen">
          form #errorbox{
            border:1px solid red;
            padding:10px;
            padding-left: 5px;
            padding-right: 5px;
          }

          </style>
          ';
    }elseif($error1=="password"){
      echo '<script>
      var errorbox=document.querySelector("#errorbox")
      errorbox.innerHTML="Password and Confirm Password field does not match or less then 6 digit"
          </script>
          <style media="screen">
          form #errorbox{
            border:1px solid red;
            padding:10px;
            padding-left: 5px;
            padding-right: 5px;
          }

          </style>
          ';
    }elseif ($error1="invalidmail") {
      echo '<script>
      var errorbox=document.querySelector("#errorbox")
      errorbox.innerHTML="please enter proper mail id"
          </script>
          <style media="screen">
          form #errorbox{
            border:1px solid red;
            padding:10px;
            padding-left: 5px;
            padding-right: 5px;
          }

          </style>
          ';
    }
  }
  else{
    echo "string";
  }


}

elseif ($mainvar=="register"){
  if (isset($_POST["username"]) and isset($_POST["mail_id"]) and isset($_POST["pass"])){
    $user = $_POST["username"];
    $mail = $_POST["mail_id"];
    $pass = $_POST["pass"];
    $con_pass=$_POST["confirm_pass"];

    $mail = filter_var($mail,FILTER_SANITIZE_EMAIL);
    if (filter_var($mail,FILTER_VALIDATE_EMAIL)===false){
      die(header("location:/new_website/form?var=registrationform&error=invalidmail"));
      // die("<h1>Invalid email address please enter a proper email address</h1>");
    }
    if (($pass!=$con_pass) or strlen($pass)<6) {
      die(header("location:/new_website/form?var=registrationform&error=password"));
          }



    if(($pass==$con_pass)==FALSE){
      die(header("location:/new_website/form?var=registrationform&error=password"));
    }

  }else{
    die("please submit the register form instead of taking url directly");
  }

  $connection = new mysqli($server,$username,$password);
  if ($connection->connect_error) {
      die("Connection failed :  " . $conn->connect_error);
  }

  $query1="INSERT INTO $database.$table(user_name,mail_id,password) VALUES('$user','$mail','$pass')";
  $check_user_query="SELECT * FROM $database.$table";
  // $check_mail_query="SELECT * FROM $database.$table";
  if ($connection->query($check_user_query)){
      $user_data=$connection->query($check_user_query);
      while($row=$user_data->fetch_assoc()) {
        $blankarray=array();
        foreach ($row as $value) {
          array_push($blankarray,$value);
         }
         echo $blankarray[1];
         if($blankarray[1]==$user){
             die(header("location:/new_website/form?var=registrationform&error=username"));
          }
        if($blankarray[3]==$mail){
          die(header("location:/new_website/form?var=registrationform&error=mail"));
        }

      }
    }
  else   { die("Unable to connect try again after some time if you are
    facing this error from long time please here ");
  };

  if ($connection->query($query1) === TRUE) {
      echo "Regestered Successfully ";
    }
  else {
      echo "Error: " . $connection->error;
    }
  $connection->close();
}


else {
    echo "...  Invalid URL  .... ";
    }

?>
