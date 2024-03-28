<?php

//AUTOLOAD DAS CLASSES
require __DIR__.'/vendor/autoload.php';
require_once ('credenciais.php');

use \App\Controller\Pages\Home;
use \App\Model\Entity\Riot;

$apiKey = API_KEY;
$nomeInvocador = 'yoda';
if(isset($_POST['nomeInvocador'])) $nomeInvocador = $_POST['nomeInvocador'];

$obRiot              = new Riot;
$obInfosInvocador    = $obRiot->getDadosInvocador($nomeInvocador, $apiKey);
$obMaestriaInvocador = $obRiot->getMaioresMaestriasInvocador($nomeInvocador, $apiKey);
$obCampeoesLOL       = $obRiot->getCampoesLOL();

//MONTA AS INFORMAÇÕES DA MAESTRIA
foreach ($obMaestriaInvocador as $key => $MaestriaInvocador) {
  $imgChampion = '<img class="icone-campeao-maestria" src="'.$MaestriaInvocador['imagemCampeao'].'" alt="">';

  $informacaoMaestria = "<p class='m-2'>{$imgChampion} Campeão: {$MaestriaInvocador['nomeCampeao']}, Nível: {$MaestriaInvocador['nivelMaestria']} e pontos: {$MaestriaInvocador['pontoMaestria']} </p><br>";

  $todosOsCampeoesMaestria[] = $informacaoMaestria;
  $textoMaestria = implode(' ', $todosOsCampeoesMaestria);
}

$arrayVariaveis = [
  'nome'     => $obInfosInvocador['name'],
  'level'    => $obInfosInvocador['summonerLevel'],
  'urlIcone'    => Riot::getIconeUrlInvocador($nomeInvocador, $apiKey),
  'maestria' => $textoMaestria
];

echo Home::getHome('Invocador', $arrayVariaveis);