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
$obEloInvocador      = $obRiot->getInformacoesElo($nomeInvocador, $apiKey);

//MONTA AS INFORMAÇÕES DA MAESTRIA
foreach ($obMaestriaInvocador as $key => $MaestriaInvocador) {
  $imgChampion    = '<img class="icone-campeao-maestria" src="'.$MaestriaInvocador['imagemCampeao'].'" alt="'.$MaestriaInvocador['pontoMaestria'].'">';
  $pontosMaestria = '<p class="pontos-maestria-invocador">Pontos: '.$MaestriaInvocador['pontoMaestria'].' | Nível: '.$MaestriaInvocador['nivelMaestria']. '</p>';

  $informacaoMaestria = "<div class='m-2'>{$imgChampion} {$pontosMaestria}</div>";

  $todosOsCampeoesMaestria[] = $informacaoMaestria;
  $textoMaestria = implode(' ', $todosOsCampeoesMaestria);
}

$arrayVariaveis = [
  'nome'     => $obInfosInvocador['name'],
  'level'    => $obInfosInvocador['summonerLevel'],
  'urlIcone' => Riot::getIconeUrlInvocador($nomeInvocador, $apiKey),
  'maestria' => $textoMaestria,
  'elo'      => Riot::getElo($nomeInvocador, $apiKey),
  'vitoria'  => $obEloInvocador['wins'],
  'divisao'  => $obEloInvocador['rank'],
  'pdl'      => $obEloInvocador['leaguePoints']
];

echo Home::getHome('Invocador', $arrayVariaveis);