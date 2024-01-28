<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css" type="text/css">
<title>MyPDP</title>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: #DADBDD;
  width: 800px;
  margin: auto;
  margin-top: 5%;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.loginbtn {
  background: #009dff;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  font-size: 15px;
}

.loginbtn:hover {
  opacity: 1;
}
.center {
    display: block;
    margin-left: auto;
    margin-right: auto;
    margin-top: 50px;
}
label{
  text-transform: uppercase;
}
a{text-decoration: none;}
a:hover{opacity: 0.6;}

</style>
</head>
<body>
<?php include 'header.php';?>
<?php include 'db.php';?>
<form action="" method="POST">
  <div class="container" id="field">
    <h1 style="text-align:center">MyPDP</h1>
    <hr>
    <?php
      if(ISSET($_POST["login"])){
          //get and set the input from user
          $email=$_POST['email'];
          $pwd = $_POST["pwd"];

          if($email === "admin" && $pwd === ("admin")){
              $_SESSION['admin']= 1;
              header("Location:admin\user.php");
          }elseif(checkEmail($conn, $email)>0){
              $sql = "SELECT * from user WHERE email = '$email'AND password = PASSWORD('$pwd')";
              $_SESSION['admin']= 0;

              $result = $conn->query($sql);

              if($result->num_rows>0){
                $row = $result->fetch_assoc();
                $id = $row['id'];
                // print_r($row);
                $_SESSION['id']= $id;
                setcookie("id",$id,time()+(86400));
                $_SESSION['username']=$row['username'];
                setcookie("username",$row["username"],time()+(86400));

                $updateStatus = "UPDATE `user` SET `status`= 1 WHERE `id`='$id' ";
                $conn->query($updateStatus);

                // echo $_SESSION['username'];
                // echo $_COOKIE["username"];
                // print_r($row);
                header("Location:selday.php");
              }else{
                echo '<script>alert("Email address or password no match!!");</script>';
                echo $conn->error;
              }
          }else{
              echo "The user does not exist. Please go to <a href='register.php'>register page</a>.";
          }



      }
  ?>
    <!-- <hr> -->

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pwd" id="pwd" required>

    <hr>

    <button type="submit" class="loginbtn" name="login">LOGIN</button>
    <p style="text-align: center"><a href="forgotpwd.php">FORGOT PASSWORD</a></p>
  </div>

</form>

</body>
</html>
