<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content=" width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <link rel="stylesheet" type="text/css" href="../all_CSS/stylingUser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
<?php
  $connect = new mysqli('127.0.0.1', 'root', '', 'Library');
  if (!$connect) {
    die(mysqli_error($connect));
  }
  session_start();
  if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true) {
    $user_email = $_SESSION['user_email'];
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
  <div class="container">
    <header class="header">
      <div class="div-logo">
        <div class="dropdown">
          <i class="fas fa-user" style="font-size: 30px; color: white;"></i>
          <div class="dropdown-content">
            <a href="./history.php">History</a>
            <a href="./profile.php">Profile</a>
            <form action="" method="post">
              <button type="submit" name="logout">Logout</button>
            </form>
          </div>
        </div>
      </div>
      <nav class="user-nav">
        <ul>
          <li><a href="./userhome.php"><i class="fas fa-home" style="font-size: 20px; color: white;"></i></a></li>
          <li><a href="./about.php" style="font-size: 15px; color: white;">About</a></li>

        </ul>
        <form action="./all_search.php" method="post">
          <input type="text" id="searchInput" placeholder="Search by Author" name="search">
          <button type="submit" class="search-button">
            <i class="fas fa-search"></i>
          </button>
        </form>
      </nav>
    </header>
    <div id="back-to-top">
      <a href="#top"><i class="fas fa-arrow-up"></i></a>
    </div>
    <div class="profile-content">
      <p class="userText">User Profile</p>
      <div class="profile-box">
        <div class="img">
          <img src="../images/avatar3.png" alt="Avatar Image" width="250px" height="250px">
        </div>
        <?php
        $user_sql = "SELECT * FROM `Users` WHERE user_email='$user_email'";
        $user_sql_result = mysqli_query($connect, $user_sql);
        $user_row = mysqli_fetch_assoc($user_sql_result);
        echo '
    <div class="details">
       <p>Name: <span class="extraCSS">' . $user_row["user_name"] . '</span></p>
       <p>ID: <span class="extraCSS">' . $user_row["user_rollno"] . '</span></p>
       <p>email: <span class="extraCSS">' . $user_row["user_email"] . '</span></p>
    </div>';
        ?>
      </div>
    </div>
    <h3 class="text">Current Issued Books</h3>
    <div class="flex-container">
      <?php
      $present_date = date('Y-m-d');
      $present = "SELECT * FROM `Transactions` WHERE user_email='$user_email' AND transaction_status='issued' ORDER BY borrow_date DESC";
      $present_result = mysqli_query($connect, $present);
      $number = mysqli_num_rows($present_result);
      if ($number > 0) {
        while ($present_row = mysqli_fetch_assoc($present_result)) {
          $book_details = "SELECT * FROM `Books` WHERE book_name='" . $present_row['book_name'] . "' AND book_author='" . $present_row['book_author'] . "'";
          $book_details_result = mysqli_query($connect, $book_details);
          if (mysqli_num_rows($book_details_result) > 0) {
            while ($book_details_row = mysqli_fetch_assoc($book_details_result)) {
              echo '
   <div class="box">
   <img src="../images/book_images/' . $book_details_row["book_image"] . '" alt="' . $book_details_row["book_name"] . '">
     <div class="box-details">
       <p class="text-css">' . $book_details_row["book_name"] . '</p>
       <p>by <span class="text-css">' . $book_details_row["book_author"] . '</span></p>
       <p class="text-css">' . $book_details_row["book_genre"] . '</p>
       <p class="text-css">Issued: ' . $present_row["borrow_date"] . '</p>
       <p class="text-css">Return by: ' . $present_row["return_by_date"] . '</p>';
              $timestamp1 = strtotime($present_date);
              $timestamp2 = strtotime($present_row['return_by_date']);

              // Calculate the difference in seconds
              $diffInSeconds = $timestamp2 - $timestamp1;

              // Convert the difference to days
              $numberOfDays = floor($diffInSeconds / (60 * 60 * 24));
              if ($numberOfDays >= 0) {
                echo '<p class="text-css">' . $numberOfDays . ' days remaining</p>';
              } else {
                echo '<p class="text-css">Late by ' . -$numberOfDays . ' days</p>';
              }
              echo '</div>
       </div>';
            }
          }
        }
      }
      ?>

    </div>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var userIcon = document.getElementById('user-icon');
        var dropdownContent = document.querySelector('.dropdown-content');

        userIcon.addEventListener('click', function() {
          dropdownContent.classList.toggle('show');
        });

        userIcon.addEventListener('mouseenter', function() {
          dropdownContent.classList.add('show');
        });

        dropdownContent.addEventListener('mouseenter', function() {
          dropdownContent.classList.add('show');
        });

        userIcon.addEventListener('mouseleave', function() {
          dropdownContent.classList.remove('show');
        });

        dropdownContent.addEventListener('mouseleave', function() {
          dropdownContent.classList.remove('show');
        });
      });

      window.addEventListener("scroll", function() {
        var backToTop = document.getElementById("back-to-top");
        if (window.pageYOffset > 100) {
          backToTop.style.opacity = "1";
        } else {
          backToTop.style.opacity = "0";
        }
      });

      const searchInput = document.getElementById("searchInput");
      const placeholders = ["Author", "Genre", "Book"];
      let currentIndex = 0;

      function updatePlaceholder() {
        searchInput.placeholder = `Search by ${placeholders[currentIndex]}`;
        currentIndex = (currentIndex + 1) % placeholders.length;
      }

      setInterval(updatePlaceholder, 1500);
    </script>
  </div>
</body>

</html>