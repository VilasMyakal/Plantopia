<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>Drope-down Profile Menu</title>
        <link rel="stylesheet" type="text/css" href="css/profile-design.css">
    </head>
    <body>
        <div class="hero">
            <nav>
                <img src="images/logo.png" class="logo">
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <img src="images/user.png" class="user-pic" onclick="toggleMenu()">

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                            <img src="images/user.png">
                            <h2>shahid maniyar</h2>
                        </div>
                        <hr>

                        <a href="#" class="sub-menu-link">
                            <img src="images/profile.png">
                            <p>Edit profile</p>
                            <span>> </span>
                            </a>

                        <a href="#" class="sub-menu-link">
                            <img src="images/logout.png">
                            <p>Logout</p>
                            <span>> </span>
                            </a>
                        </div>
                </div>

            </nav>

        </div>

            <script>
                let subMenu = document.getElementById("subMenu");

                function toggleMenu()
                {
                    subMenu.classList.toggle("open-menu");
                }
            </script>
    </body>
</html>