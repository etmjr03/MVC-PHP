<?php

//AUTOLOAD DAS CLASSES
require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Home;

$arrayVariaveis = [
  'nome'    => 'juninho',
  'campeao' => 'Nida Lee',
  'numero'  => 1
];

echo Home::getHome('Início', $arrayVariaveis);