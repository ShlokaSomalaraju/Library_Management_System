<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content=" width=device-width, initial-scale=1.0">
  <title>About</title>
  <link rel="stylesheet" type="text/css" href="../all_CSS/stylingUser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<?php
  $connect = new mysqli('localhost', 'root', '', 'Library');
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
<body>
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
    </header>
    <div id="back-to-top">
      <a href="#top"><i class="fas fa-arrow-up"></i></a>
    </div>
    <div class="about-content">

      <div class="about-box">
        <h1 class="aboutText">About our <span style="color: #BC267B;">Library Management sysytem</span></h1>

        <p>
          Our Library Management System is inspired from the IITH Library. We aimed to create a system for a physical library rather than an E-library.
        </p>
        <p>
          Our website starts with a Login page which checks if a user is registered earlier or not and
          also does password verification.In case a user is not registered then they will be redirected
          to a Signup page which takes the user details and validates the details (The email should be
          from IITH community,the first 14 digits of the email should match with ID and the fields in
          password and confirm password should match).Once the user is successfully logged in then they
          will be redirected to their respective pages.The ones who are registered in our Library are
          categorized into two.One is a regular user and the other is the Admin.
        </p>
        <h2 class="aboutText">Features for Regular User</h2>
        <p>
          All the pages accessible to Regular User have a navigation bar which has options like <a href="./userhome.php">Back to
            HomePage</a> , <a href="./about.php">About</a> , Search bar and Account(which contains user personalized options like <a href="./profile.php">Profile</a> and
          <a href="./history.php">History</a> along with Logout).And every page has a back to top button (displayed as an arrow in
          the bottom right).The <a href="./userhome.php">homepage</a> displays all the genres available in the Library and by
          clicking on a genre all the books of that particular genre will be displayed in a random order.
        </p>
        <p>
          The Search bar takes a request and all the books whose book name or author name or genre match
          with the request will be displayed in random order.The Profile page displays user details and
          the books which are currently with the user.History page displays the books which the user has
          returned in the past.Users are expected to find the available books from this website and then
          visit the Library physically to take books.
        </p>
        <h2 class="aboutText">Features for Admin</h2>
        <p>
          The Admin has two main functions. One is to add books to the library .For this the book details
          are to be given and these will be updated to the Books table of our database.The other function
          is to Issue/Reissue/Return books. For this user email, book name, author name are to be given
          and these details will be updated in the transaction table of our database. The status of the
          book,number of copies will be updated accordingly.
        </p>
      </div>
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
  <footer class="footer">
    <p>&copy; 2023 Library. All rights reserved.</p>
  </footer>

</body>

</html>