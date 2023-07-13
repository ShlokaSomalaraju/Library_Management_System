<!DOCTYPE html>
<html>
<?php
$connect = new mysqli('localhost', 'root', '', 'Library');
if (!$connect) {
  die(mysqli_error($connect));
}
if (isset($_POST['submit'])) {
  $user_email = $_POST['email'];
  $user_password = $_POST['password'];
  $check_email = "SELECT * FROM `Users` WHERE user_email='$user_email'";
  $check_email_result = mysqli_query($connect, $check_email);
  $number_email = mysqli_num_rows($check_email_result);
  if ($number_email > 0) {
    $check_password = "SELECT * FROM `Users` WHERE user_email='$user_email' AND user_password='$user_password'";
    $check_password_result = mysqli_query($connect, $check_password);
    $number_password = mysqli_num_rows($check_password_result);
    if ($number_password > 0) {
      $check_admin = "SELECT * FROM `Users` WHERE user_email='$user_email' AND user_password='$user_password'AND role='admin'";
      $check_admin_result = mysqli_query($connect, $check_admin);
      $number_admin = mysqli_num_rows($check_admin_result);
      if ($number_admin > 0) {
        session_start();
        $_SESSION['admin_email'] = $user_email;
        $_SESSION['is_logged'] = true;
        echo
        "<script>
                    alert('Logged In successfully,Redirect to admin page');
                    window.location.href='./adminhome.php';       
                </script>";
      } else {
        session_start();
        $_SESSION['user_email'] = $user_email;
        $_SESSION['is_logged'] = true;
        echo
        "<script>
                    alert('Successfully Logged In');
                    window.location.href='./userhome.php';    
                </script>";
      }
    } else {
      echo
      "<script>
                alert('Incorrect Password');     
            </script>";
    }
  } else {
    echo
    "<script>
                alert('User not Registered');
                window.location.href='./signup_page.php';       
            </script>";
  }
}


?>

<head>
  <title>Our login Web page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/jpg" href="../images/logo.png">
  <link rel="stylesheet" type="text/css" href="../all_CSS/styling.css">
</head>

<body>
  <div class="container">
    <div class="back-image">
      <div class="box">
        <div class="login">
          <form action="" method="POST" enctype="multipart/form-data">
            <fieldset class="filed">

              <legend class="loginbox">Login</legend>
              <div class="inbox">
                <img src="../images/user1.jpeg" alt="Image.jpeg" class="userlogin"><br>


                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="student_id@iith.ac.in"
                  pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required="required" class="names">

                <br><br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" placeholder="Atleast 8 characters"
                  required="required" class="names">

                <br><br>

                <input type="submit" value="Login" class="submit">
              </div>

            </fieldset>
          </form>
          <div class="para">
            <p>Don't have an account?&nbsp;<a href="signup_page.php" class="signup">Signup</a></p>
          </div>
        </div>

        <img src="../images/nside.jpg" alt="Image Description" class="sidepic">


      </div>


    </div>


  </div>
</body>

</html>