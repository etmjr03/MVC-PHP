<?php

//AUTOLOAD DAS CLASSES
require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Home;

echo Home::getHome();