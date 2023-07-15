<!DOCTYPE html>
<html>
<?php
  $connect = new mysqli('localhost', 'root', '', 'Library');
  if (!$connect) {
    die(mysqli_error($connect));
  }
  session_start();
  if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true) {
    $admin_email = $_SESSION['admin_email'];
  }
  else {
    echo 
    "<script>
    alert('Please Login first');
    window.location.href='./index.php';       
    </script>";
    }
?>
  <?php
if (isset($_POST['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<head>
    <title>Admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../all_CSS/astyle.css">
</head>

<body class="acontainer">
    <div class="astart">
        <div class="aboxh">
            <br><h2 class="aheading">Welcome to Library Management System</h2>
            <form action="" method="post">
                <button type="submit" class="alogout" name ="logout">LogOut</button>
            </form>
        </div>
        <div class="arow">
            <div class="abox1">
                <img src="../images/addbook.jpeg" alt="no-image" class="a1img">
                <p class="atextinissue">Want to add a new book? <br>&nbsp;&nbsp;&nbsp;&nbsp;Click Here<span
                        class="aarrow">&#8595</span;< /p>
                        <button class="abutton1" onclick="add()">Add new books</button>
            </div>
            <div class="abox2">
                <img src="../images/bookissue.png" alt="no-image" class="a2img">
                <p class="atextinissue">Issue/Return/Reissue of books? <br>&nbsp;&nbsp;&nbsp;&nbsp;Click Here<span
                        class="aarrow">&#8595</span;< /p>
                        <button class="abutton2" onclick="issue()">Issue&nbsp;/&nbsp;return&nbsp;/&nbsp;reissue</button>
            </div>
        </div>
        <script>
        function add(){
            window.location.href='./insertbooks.php';
        }
        function issue(){
            window.location.href='./transaction.php';
        }
    </script>
    </div>
</body>

</html>