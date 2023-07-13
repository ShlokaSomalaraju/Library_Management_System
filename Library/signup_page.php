<!DOCTYPE html>
<html>
<?php
$connect = new mysqli('localhost', 'root', '', 'Library');
if (!$connect) {
  die(mysqli_error($connect));
}
if (isset($_POST['submit'])) {
  $user_name = $_POST['name'];
  $user_email = $_POST['email'];
  $user_password = $_POST['password'];
  $user_rollno = $_POST['id'];
  $check = "SELECT * FROM `Users` WHERE user_email='$user_email'";
  $check_result = mysqli_query($connect, $check);
  $number = mysqli_num_rows($check_result);
  if ($number > 0) {
    echo
    "<script>
            alert('User already exists');
            window.location.href='./index.php';       
        </script>";
  } else {
    $insert_sql = "INSERT INTO `Users` VALUES ('$user_rollno','$user_name','$user_password','$user_email','user')";
    $result = mysqli_query($connect, $insert_sql);
    if ($result) {
      echo
      "<script>
            alert('Successfully registered');
            window.location.href='./index.php';
            </script>";
    } else {
      echo "Fail";
    }
  }
}


?>

<head>
  <title>Signup_page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../all_CSS/styling.css">
  <link rel="icon" type="image/jpg" href="../images/logo.png">

  <script>
    function validateForm() {
      var name = document.getElementById("name").value;

      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirmPassword").value;
      var id = document.getElementById("id").value.toUpperCase(); // Convert id to uppercase
      var email = document.getElementById("email").value;

      if (name === "" || id === "" || email === "" || password === "" || confirmPassword === "") {
        alert("Please fill in all fields!");
        return false;
      }

      var emailPattern = /^[a-zA-Z0-9._%+-]+@iith\.ac\.in$/;
      if (!emailPattern.test(email)) {
        alert("Please enter a valid IITH email address (e.g., cs22btech11039@iith.ac.in)!");
        return false;
      }



      if (password.length < 8) {
    alert("Password should be at least 8 characters long!");
    return false;
  }

      if (password !== confirmPassword) {
        alert("Passwords do not match!");
        return false;
      }

      if (id.substr(0, 14).toUpperCase !== email.substr(0, 14).toUpperCase) {
        alert("The first 14 characters of ID and email must match!");
        return false;
      }

      // Display success message
      var successMessage = document.getElementById('successMessage');
      successMessage.style.display = 'block';

      return true;
    }
  </script>
</head>

<body>
  <div class="container">
    <div class="back-image1">
      <img src="../images/rishi.jpg" alt="Image Description" class="sidepic1">
      <div class="box1">
        <div class="login1">
          <form action="" method="POST" enctype="multipart/form-data">
            <fieldset class="filed1">
              <legend class="loginbox">SignUp</legend>
              <div class="inbox">
                <label for="name">User-Name</label><br>
                <input type="text" id="name" name="name" required="required" placeholder="Enter your name" class="names"><br>

                <label for="id">ID</label><br>
                <input type="text" id="id" name="id" class="names" placeholder="Ex:CS22BTECH11000">

                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" placeholder="cs22btech11024@iith.ac.in" pattern="[a-zA-Z0-9._%+-]+@iith.ac.in" required="required" class="names">

                <br>

                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password" placeholder="At least 8 characters" required="required" class="names">

                <label for="confirmPassword">Confirm-Password:</label><br>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="At least 8 characters" required="required" class="names">

                <br><br>

                <button type="submit" name="submit" class="submit1" onclick="return validateForm()">Sign-in</button>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <!-- Success message -->
    <div id="successMessage" style="display: none; text-align: center;">
      <h3>Successfully Signed-up!</h3>
    </div>
  </div>
</body>

</html>
