<?php
ob_start();
session_start();

define("host", "http://localhost/DT173G%20-%20Projekt/build/public/");      /* Host */
$site_title = "Projekt";                                                    /* Site Title */
$site_name = "Projekt";                                                     /* Site Meta */


spl_autoload_register(function($class) {
    require         "../private/app/Model/$class.php";
});

require "../private/functions/geo.php";