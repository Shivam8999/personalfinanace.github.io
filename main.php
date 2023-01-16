<?php
include 'conn_info.php';
error_reporting(0);//this will stop showing the error and only it will show the tings which have given to them
$mail = $_POST["subbar"];

if (strlen($mail)<1){
  die("<h1>Error please Enter a mail id to subscriber</h1>");
}

$mail = filter_var($mail,FILTER_SANITIZE_EMAIL);
if (filter_var($mail,FILTER_VALIDATE_EMAIL)===false){
  die("<script>alert('please enter proper mail id')</script>");
  // die("<h1>Invalid email address please enter a proper email address</h1>");
}


$conn = new mysqli($servername, $user, $pass ,$database);
if ($conn->connect_error) {
    die("Connection failed: ".$conn->error);
}


$sql = "INSERT INTO sublist(mail,sub_time) VALUES ('$mail',now())";
$sql1= "SELECT mail FROM sublist "; //this will return the list of all the elements in main column of sub_list table

if (mysqli_connect_errno()) {
 die("failed to connect please check your internet connection");
}


if ($result=$conn->query($sql1)){//connection name is con and query name is sql1
      while ($row=mysqli_fetch_assoc($result))//This will take all the various val mysqli_query
      {
          if (implode($row)==$mail){die("You are already subscribed");}//search for implode fon google
// this statement will return die if the given mailid matched with current assigned row value


          }
      }
      // after eneding this loop all the values of mail from sub_list will be checked and die statement will be thrown if value already existed

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    die( "<h1>Sorry unable to subscribe please click here to report a problem</h1>".$conn->error);
}

$conn->close();
 ?>
