<!DOCTYPE html>
<html>

<head>
    <title>Admin page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../all_CSS/astyle.css">
    <link rel="icon" type="image/jpg" href="../images/logo.png">
    <script>
        function validateForm() {
            window.location.href = "../all_HTML/login_page.html";

            return false;
        }
    </script>

</head>

<body class="acontainer">
    <div class="astart">
        <div class="aboxh">
            <br><h2 class="aheading">Welcome to Library Management System</h2>
            <button type="submit" class="alogout" onclick="return validateForm()">LogOut</button>
        </div>
        <div class="arow">
            <div class="abox1">
                <img src="../images/addbook.jpeg" alt="no-image" class="a1img">
                <p class="atextinissue">Want to add a new book? <br>&nbsp;&nbsp;&nbsp;&nbsp;Click Here<span
                        class="aarrow">&#8595</span;< /p>
                        <button class="abutton1">Add new books</button>
            </div>
            <div class="abox2">
                <img src="../images/bookissue.png" alt="no-image" class="a2img">
                <p class="atextinissue">Issue/Return/Reissue of books? <br>&nbsp;&nbsp;&nbsp;&nbsp;Click Here<span
                        class="aarrow">&#8595</span;< /p>
                        <button class="abutton2">Issue&nbsp;/&nbsp;return&nbsp;/&nbsp;reissue</button>
            </div>
        </div>




    </div>

</body>

</html>