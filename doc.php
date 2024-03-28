<?php

//AUTOLOAD DAS CLASSES
require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Doc;

echo Doc::getDoc('Documentação do projeto', []);