<?php

require_once __DIR__ . "/DB.php";
require_once __DIR__ . "/helper.php";


$twig = requireTwig();
echo $twig->render('oppgave3.html', array());
