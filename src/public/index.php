<?php 
require "../private/config/cfg.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Projekt</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="<?= host ?>featherlight/featherlight.js"></script>
    <link href="<?= host ?>featherlight/featherlight.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" />
</head>

<body>
    <nav>
        <ul>
            <?php  
            if(isset($_POST['logout'])) {
                // require finns i config filen
                $logout = new Login();
                $logout->logoutUser();
            }
            ?>
            <li><a href="">Curriculum vitae</a></li>
            <?php if(!isset($_SESSION['id'])) { 
            // echo '<li><a class="fl" id="reg-box" data-featherlight="#join">Registrera</a></li>';
            ?>
            <li><a class="fl" id="log-box" data-featherlight="#login">Logga in</a></li>
            <?php } else { ?>

            <li>
                <form method="post"><input class="pm_logout" type="submit" name="logout" value="Log out" />
                </form>
            </li>
            <?php } ?>
        </ul>
    </nav>
    <div class="wrapper">
        <section>
            <h1 class="welcome-header">Välkommen till Fredrics CV</h1>
            <p class="welcome-meta">Det här är mitt CV som är baserat på ett REST API där både Ajax och Fetch Api
                använts för att ta emot den data som hämtats från en MySQL databas. För att kunna redigera informationen
                behöver man logga in.</p>
        </section>
        <section class="curriculum-vitae">

        </section>
    </div>
    <script src="js/tabindex.js"></script>
    <script>
    // Url för rest
    const url_ = "http://localhost/DT173G%20-%20Projekt/build/public/api/cv/cv.php";
    const elem = document.getElementsByClassName("curriculum-vitae");
    let getData = () => {
        fetch(url_, {
                method: "GET"
            })
            .then(function(response) {
                if (response.status !== 200) {
                    console.log(response.status);
                    return;
                }
                response.text().then(function(data) {
                    elem[0].innerHTML = data;
                });
            })
            .catch(function(err) {
                console.log("Fetch Error:", err);
            });
    };
    getData();
    </script>
    <script src="js/fetch.js"></script>
    <?php 
    if(!isset($_SESSION['id'])) {
        require "includes/lightbox/join-screen.php"; 
        require "includes/lightbox/login-screen.php"; 
    } else {
        require "includes/lightbox/edit-screen.php"; 
    }
    ?>
</body>

</html>