<!DOCTYPE html>
<html>

<head>
    <title>Issue page</title>
    <link rel="stylesheet" type="text/css" href="../all_CSS/istyle.css">
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
if (isset($_POST['transaction'])) {
    $user_email = $_POST['email'];
    $book_name = $_POST['bookname'];
    $book_author = $_POST['authorname'];
    $purpose = $_POST['options'];
    //issue=purpose,user rows<=3 in transaction table with null return date

    if ($purpose == 'issue') {
        $check_issue = "SELECT * FROM `Transactions` WHERE user_email='$user_email' AND book_name='$book_name' AND book_author='$book_author' AND transaction_status='issued'";
        $check_issue_result = mysqli_query($connect, $check_issue);
        $number = mysqli_num_rows($check_issue_result);
        if ($number > 0) {
            echo "<script>alert('You have already taken a copy of this book')</script>";
        } else {
            //checking number of books user currently has
            $check_user = "SELECT * FROM `Transactions` WHERE user_email='$user_email' AND transaction_status='issued'";
            $check_user_result = mysqli_query($connect, $check_user);
            $num_books_with_user = mysqli_num_rows($check_user_result);
            if ($num_books_with_user < 4) {
                //checking if the book is currently available or not
                $check_book = "SELECT * FROM `Books` WHERE book_name='$book_name' AND book_author='$book_author'";
                $check_book_result = mysqli_query($connect, $check_book);
                $row = mysqli_fetch_assoc($check_book_result);
                $num_copies = $row['num_copies'];
                if ($num_copies > 0) {
                    $borrow_date = date("Y-m-d");
                    $return_by_date = date("Y-m-d", strtotime("+40 days", strtotime($borrow_date)));
                    $insert_transaction = "INSERT INTO `Transactions`(user_email ,book_name,book_author,borrow_date,return_by_date ,returned_date ,transaction_status) VALUES ('$user_email','$book_name','$book_author','$borrow_date','$return_by_date',NULL,'issued')";
                    $result_insert = mysqli_query($connect, $insert_transaction);
                    if ($result_insert === false) {
                        echo "Error: " . mysqli_error($connect);
                    }
                    if ($result_insert == false) {
                        echo "<script>alert('Failure in issuing the book')</script>";
                    } else {
                        $updated_num_copies = $num_copies - 1;
                        $update_copies = "UPDATE `Books`SET num_copies=$updated_num_copies WHERE book_name='$book_name' AND book_author='$book_author'";
                        $result_update = mysqli_query($connect, $update_copies);
                        echo "<script>alert('Book issued successfully')</script>";
                    }
                } else {
                    echo "<script>alert('Sorry book is currently unavailable')</script>";
                }
            } else if ($num_books_with_user >= 4) {
                echo "<script>alert('Books Limit Exceeded')</script>";
            }
        }
    } else if ($purpose == 'reissue') {
        $check_issue = "SELECT * FROM `Transactions` WHERE user_email='$user_email' AND book_name='$book_name' AND book_author='$book_author' AND transaction_status='issued'";
        $check_issue_result = mysqli_query($connect, $check_issue);
        $number = mysqli_num_rows($check_issue_result);
        if ($number > 0) {
            $current_date = date('Y-m-d'); // Example format: YYYY-MM-DD
            $row = mysqli_fetch_assoc($check_issue_result);
            $return_by_date = $row['return_by_date'];
            if ($current_date > $return_by_date) {
                echo "<script>alert('Book cannot be reissued, pay fine')</script>";
            }
            $updated_return_by_date = date("Y-m-d", strtotime("+40 days", strtotime($current_date)));
            $update_dates = "UPDATE `Transactions` SET borrow_date='$current_date', return_by_date='$updated_return_by_date' ";
            echo "<script>alert('Book reissued successfully')</script>";
        } else {
            echo "<script>alert('Reissue not possible as book is not issued earlier')</script>";
        }
    } else if ($purpose == 'return') {
        $check_issue = "SELECT * FROM `Transactions` WHERE user_email='$user_email' AND book_name='$book_name' AND book_author='$book_author' AND transaction_status='issued'";
        $check_issue_result = mysqli_query($connect, $check_issue);
        $number = mysqli_num_rows($check_issue_result);
        if ($number > 0) {
            $current_date = date('Y-m-d'); // Example format: YYYY-MM-DD
            $row = mysqli_fetch_assoc($check_issue_result);
            $return_by_date = $row['return_by_date'];
            if ($current_date > $return_by_date) {
                echo "<script>alert('Book cannot be returned, pay fine')</script>";
            }
            $update_status = "UPDATE `Transactions` SET returned_date='$current_date', transaction_status='returned' WHERE user_email='$user_email' AND book_name='$book_name' AND book_author='$book_author'";
            $update_status_result = mysqli_query($connect, $update_status);
            $update_books = "UPDATE `Books`SET num_copies=num_copies+1 WHERE book_name='$book_name' AND book_author='$book_author'";
            $update_books_result = mysqli_query($connect, $update_books);
            if ($update_status_result && $update_books_result) {
                echo "<script>alert('Book Returned Successfully')</script>";
            }
        } else {
            echo "<script>alert('Return not possible as book is not issued earlier')</script>";
        }
    }
}
?>


<body class="icontainer">
    <div class="ibox">
        <img src="../images/iithlogo.png" alt="no-image" class="iith"><br>
    <!--  <p style="font-size: 2.5vw ; margin-left: 15%; display: inline;"><span style="color: blue;">B</span><span style="color: red;">o</span><span style="color: yellow;">o</span><span style="color: blue;">k</span> <span style="color: green;">t</span><span style="color: red;">r</span><span style="color:chocolate;">a</span><span style="color:aqua;">n</span><span style="color: rgb(255, 0, 0);">s</span><span style="color:mediumpurple;">a</span><span style="color:palevioletred;">c</span><span style="color: blue;">t</span><span style="color: rgb(17, 255, 0);">i</span><span style="color: rgba(0, 0, 0);">o</span><span style="color: rgb(106, 106, 246);">n</span><span style="color:gold;">s</span></p>-->
    <p style="font-size: 2.5vw ; margin-left: 15%; display: inline;"><span style="color: black; font-size: 2.5vw; font-weight: 600;">Book Transactions</span></p>
        <form action="" method="post" enctype="multipart/form-data">
            <br>
            <label for="email" class="iheads">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email:&nbsp;</label>
            <input type="email" id="email" name="email" placeholder="student_id@iith.ac.in"
                pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}" required="required" class="inbox"><br><br>

            <label for="Name" class="iheads">&nbsp;&nbsp;Book-Name:&nbsp;</label>
            <input type="bookname" id="bookname" name="bookname" required="required" placeholder="Enter your name"
                class="inbox"><br><br>

            <label for="Name" class="iheads">Author-Name:&nbsp;</label>
            <input type="name" id="authorname" name="authorname" required="required" placeholder="Enter Author name"
                class="inbox"><br><br>

            <p style="display:inline" class="iheads">Purpose:</p>
            <ul class="circle-list">
                <li>
                    <input type="radio" id="option1" name="options" value="issue" >
                    <label for="option1" class="purposE"><span class="irr"></span>Issue</label>
                </li>
                <li>
                    <input type="radio" id="option2" name="options" value="return">
                    <label for="option2" class="purposE"><span class="irr"></span>Return</label>
                </li>
                <li>
                    <input type="radio" id="option3" name="options" value="reissue">
                    <label for="option3" class="purposE"><span class="irr"></span>Reissue</label>
                </li>
            </ul>
            <a href="adminhome.php" class="iback">Back to admin page</a>
            <button class="ibutton" name="transaction">Save changes</button>

            <!--<div class="custom-select" style="width:200px; display: inline;" >
            <select >
                <option value="" disabled selected>Select an option</option>
                <option value="issue">Issue</option>
                <option value="return">Return</option>
                <option value="reissue">Reissue</option>
              </select>
              </div>-->
        </form>


    </div>

</body>

</html>