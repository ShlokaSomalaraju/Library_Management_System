<!DOCTYPE html>
<html>

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
          <form action="../all_HTML/signup.html" method="POST" enctype="multipart/form-data">
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
            <p>Don't have an account?&nbsp;<a href="../all_HTML/signup.html" class="signup">Signup</a></p>
          </div>
        </div>

        <img src="../images/nside.jpg" alt="Image Description" class="sidepic">


      </div>


    </div>


  </div>
</body>

</html>