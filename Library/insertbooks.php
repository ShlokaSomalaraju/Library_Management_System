<!DOCTYPE html>
<html>

<head>
    <title>Addbook_page</title>
    <link rel="stylesheet" type="text/css" href="../all_CSS/dstyle.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/jpg" href="../images/logo.png">
</head>

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
if (isset($_POST['insert_book'])) {
    $book_name = $_POST['bookname'];
    $book_author = $_POST['authorname'];
    $book_genre = $_POST['genre'];
    $num_copies = $_POST['copies'];

    $book_image = $_FILES['image']['name'];
    $book_temp_name = $_FILES['image']['tmp_name'];

    if (move_uploaded_file($book_temp_name, "./book_images/$book_image")) {
    } else {
        echo "<script>alert('Failure In Adding The Image')</script>";
    }
    $check_book = "SELECT * FROM `Books` WHERE book_name='$book_name' AND book_author='$book_author'";
    $check_book_result = mysqli_query($connect, $check_book);
    $number_check = mysqli_num_rows($check_book_result);
    if ($number_check == 0) {
        $insert_query = "INSERT INTO `Books`(book_name,book_author,book_image,book_genre,num_copies) VALUES ('$book_name','$book_author','$book_image','$book_genre','$num_copies')";
        $result_insert = mysqli_query($connect, $insert_query);
        if ($result_insert == false) {
            echo "<script>alert('Failure in adding the book')</script>";
        } else {
            echo "<script>alert('Book added successfully')</script>";
        }
    } else {
        $row = mysqli_fetch_assoc($check_book_result);
        $initial_num_copies = $row['num_copies'];
        $update_query = "UPDATE `Books`
            SET num_copies = $initial_num_copies+$num_copies
            WHERE book_name='$book_name' AND book_author='$book_author'";
        $result_update = mysqli_query($connect, $update_query);
        if ($result_update == false) {
            echo "<script>alert('Failure in adding the book')</script>";
        } else {
            echo "<script>alert('Book added successfully')</script>";
        }
    }
}

?>
<body class="icontainer">
    <div class="ibox">
        <img src="../images/iithlogo.png" alt="no-image" class="iith"><br>
    <!--  <p style="font-size: 2.3vw ; margin-left: 15%; display: inline;"><span style="color: blue;">B</span><span style="color: red;">o</span><span style="color: yellow;">o</span><span style="color: blue;">k</span> <span style="color: green;">t</span><span style="color: red;">r</span><span style="color:chocolate;">a</span><span style="color:aqua;">n</span><span style="color: rgb(255, 0, 0);">s</span><span style="color:mediumpurple;">a</span><span style="color:palevioletred;">c</span><span style="color: blue;">t</span><span style="color: rgb(17, 255, 0);">i</span><span style="color: rgba(0, 0, 0);">o</span><span style="color: rgb(106, 106, 246);">n</span><span style="color:gold;">s</span></p>-->
    <p style="font-size: 2.3vw ; margin-left: 15%; display: inline;"><span style="color: black; font-size: 2.5vw; font-weight: 600;">Add new Books</span></p>
        <form action="" method="post" enctype="multipart/form-data" >
            <br>
            

            <label for="Name" class="dheads">&nbsp;&nbsp;Book-Name:&nbsp;</label>
            <input type="name" id="bookname" name="bookname" required="required" placeholder="Enter name of book"
                class="dnbox"><br><br>

            <label for="AName" class="dheads">Author-Name:&nbsp;</label>
            <input type="name" id="authorname" name="authorname" required="required" placeholder="Enter Author name"
                class="dnbox"><br><br>

                <label for="Genre" class="dheads">&nbsp;&nbsp;Genre:&nbsp;</label>
            <input type="name" id="bookname" name="genre" required="required" placeholder="Enter type for genre"
                class="dnbox"><br><br>

            <label for="image" class="dheads">Upload Image:&nbsp;</label>
            <input type="file" id="image" name="image" class="dnbox1" onchange="fileChosen(this)">
            
            <br><br>
            
            
            <label for="copies"  class="dheads">Number of Copies:</label>
            <input type="number" id="copies" name="copies" min="1" max="100" class="dcopies" ><br><br><br>

            <a href="adminhome.php" class="dback">Back to admin page</a>
            <button class="dbutton" name="insert_book">Save changes</button>
            <br>

            
        </form>


    </div>

    <!--<script>
        function fileChosen(input) {
          if (input.files.length > 0) {
            var label = input.previousElementSibling;
            label.textContent = input.files[0].name;
            label.style.display = 'none';
          }
        }
      </script>-->


</body>

</html>