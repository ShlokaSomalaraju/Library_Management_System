<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content=" width=device-width, initial-scale=1.0">
  <title>User page</title>
  <link rel="stylesheet" type="text/css" href="../all_CSS/stylingUser.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
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
    header("Location: ./index.php");
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
    <div class="site-content">
      <h1>Unleash your<span class="attractive-text"> Genres</span></h1>
      <div class="genre-container">
        <a href="./display_by_genre.php?genre=All" class="genre-box">
          <img src="../images/All.jpg" alt="All">
          <span>All</span>
        </a>
        <a href="display_by_genre.php?genre=Sci-Fi" class="genre-box">
          <img src="../images/Sci-Fi.jpeg" alt="Sci-Fi">
          <span>Sci-Fi</span>
        </a>
        <a href="display_by_genre.php?genre=Adventure" class="genre-box">
          <img src="../images/Adventure.jpeg" alt="Adventure">
          <span>Adventure</span>
        </a>
        <a href="display_by_genre.php?genre=Comics" class="genre-box">
          <img src="../images/Comics.jpg" alt="Comics">
          <span>Comics</span>
        </a>
        <a href="display_by_genre.php?genre=Fantasy" class="genre-box">
          <img src="../images/Fantasy.jpeg" alt="Fantasy">
          <span>Fantasy</span>
        </a>
        <a href="display_by_genre.php?genre=History" class="genre-box">
          <img src="../images/History.jpg" alt="History">
          <span>History</span>
        </a>
        <a href="display_by_genre.php?genre=Horror" class="genre-box">
          <img src="../images/Horror.jpg" alt="Horror">
          <span>Horror</span>
        </a>
        <a href="display_by_genre.php?genre=Self-Help" class="genre-box">
          <img src="../images/Self Help.jpg" alt="Self Help">
          <span>Self Help</span>
        </a>
        <a href="display_by_genre.php?genre=Humour" class="genre-box">
          <img src="../images/Humour.jpeg" alt="Humour">
          <span>Humour</span>
        </a>
        <a href="display_by_genre.php?genre=Mystery" class="genre-box">
          <img src="../images/Mystery.jpeg" alt="Mystery">
          <span>Mystery</span>
        </a>
        <a href="display_by_genre.php?genre=Romance" class="genre-box">
          <img src="../images/Romance.jpg" alt="Romance">
          <span>Romance</span>
        </a>
        <a href="display_by_genre.php?genre=Programming" class="genre-box">
          <img src="../images/Programming.jpeg" alt="Programming">
          <span>Programming</span>
        </a>
        <a href="display_by_genre.php?genre=Maths" class="genre-box">
          <img src="../images/Math.jpeg" alt="Math">
          <span>Maths</span>
        </a>
        <a href="display_by_genre.php?genre=Science" class="genre-box">
          <img src="../images/Science.jpg" alt="Science">
          <span>Science</span>
        </a>
        <input type="hidden" name="hiddenValue" value="">
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
</body>

</html>