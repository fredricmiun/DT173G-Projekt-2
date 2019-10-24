<?php 
require "../private/config/cfg.php"; /* Config-fil */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?= $site_title ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="featherlight/featherlight.js"></script>
    <link href="featherlight/featherlight.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet" />
</head>

<body>
    <nav>
        <ul>
            <?php  
            /* Skapar en utloggningsfunktion */
            if(isset($_POST['logout'])) {
                // require finns i config filen
                $logout = new Login();
                $logout->logoutUser();
            }
            ?>
            <li>Curriculum vitae</li>
            <?php 
            /* 
            
            Skapa inloggningsmöjlighet
            Stängt av skapa konto-möjligheten efter att första kontot skapats. 

            */
            if(!isset($_SESSION['id'])) { 
            // echo '<li><a class="fl" id="reg-box" data-featherlight="#join">Registrera</a></li>';
            ?>
            <li><a class="fl" id="log-box" data-featherlight="#login">Logga in</a></li>
            <?php } else { 
                /* Väl inloggad visas logga ut knappen som anropar logout-funktionen ovan */
                ?>

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
    <?php 
    /* 
    
    Använder fetch api för att hämta innehållet. 
    
    Anledningen till varför den ligger öppet i koden är det problem jag stött på där session inte hänger med i innehållet om den kapslas in i egen fil. Har ej någon vetskap om varför detta sker, därför låter jag denna ligga här till dess att jag kommer på någon lösning.

    Istället för att ta emot information som JSON tar vi nu emot det som XML och lägger in allt i klassen cirruculum-vitae. 
    Det gör det lite enklare, för då kan vi hantera och göra data mer presentabelt på serversidan och därefter skicka det. 
    Jag hade kunnat ta emot det som JSON och med JavaScript bestämma var informationen ska visas och skapa element. Det kändes inte särskilt effektivt i det här fallet.
    

    */
    ?>
    <script>
    var url_ = "http://localhost:3000/DT173G%20-%20Projekt/src/private/api/cv/cv.php";
    var elem = document.getElementsByClassName("curriculum-vitae");

    function getData() {
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
                    console.log(data);
                });
            })
            .catch(function(err) {
                console.log("Fetch Error:", err);
            });
    }

    getData();
    </script>
    <?php /* Här lägger vi alla andra fetch anrop */ ?>
    <script src="js/fetch.js"></script>
    <?php 
    /* Lightbox för inloggning och join. Tar bort join möjligheten eftersom konto redan är skapat */
    if(!isset($_SESSION['id'])) {
        // require "includes/lightbox/join-screen.php"; 
        require "includes/lightbox/login-screen.php"; 
    } else {
        /* När vi är inloggade så ska denna lightbox göras tillgänglig, och de ovanstående tas bort, då de inte fyller någon funktion när vi väl är inloggade. */
        require "includes/lightbox/edit-screen.php"; 
    }
    ?>
</body>

</html>