<?php

namespace App\Model\Entity;

/**
 * Classe responsável por gerenciar as informações da api do LOL
 * @author Juninho
 */

class Riot {

  /**
   * Endpoint de informações de todos os campeões do LOL
   * @var string
   */
  const ENDPOINT_CAMPEOES = 'https://ddragon.leagueoflegends.com/cdn/14.6.1/data/en_US/champion.json';

  /**
   * Endpoint de informações do invocador pelo nome
   * @var string
   */
  const ENDPOINT_INVOCADOR = 'https://br1.api.riotgames.com/lol/summoner/v4/summoners/by-name/';

  /**
   * Endpoint de informações de maestria do invocador pelo PUUID
   * @var string
   */
  const ENDPOINT_MAESTRIA = 'https://br1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-puuid/';

  /**
   * Endpoint de informações de elo do invocador pelo seu id
   */
  const ENDPOINT_ELO = 'https://br1.api.riotgames.com/lol/league/v4/entries/by-summoner/';

  /**
   * @method responsável por retornar um array com id, nome e imagem de todos os campeções do LOL
   * @return array
   */
  public static function getCampoesLOL() : array {
    $campeoes = json_decode(file_get_contents(self::ENDPOINT_CAMPEOES), true);

    foreach ($campeoes['data'] as $key => $campeao) {
      $retornoCampeoes[] = [
        'championName'   => $campeao['name'],
        'championId'     => $campeao['key'],
        'imageChampion' => 'https://ddragon.leagueoflegends.com/cdn/14.6.1/img/champion/'.$campeao['image']['full']
      ];
    }

    return $retornoCampeoes;
  }

  /**
   * @method responsável por retornar as informações do invocador
   * @param string $nomeInvocador (nome do invocador)
   * @param string $apiKey (api key da sua conta riot)
   * @return array
   */
  public static function getDadosInvocador($nomeInvocador, $apiKey) : array {
    return json_decode(file_get_contents(self::ENDPOINT_INVOCADOR.''.$nomeInvocador.'?api_key='.$apiKey), true);
  }

  /**
   * @method responsável por retornar todas as maestrias dos campeões de um invocador
   * @param string $nomeInvocador (nome do invocador)
   * @param string $apiKey (api key da sua conta riot)
   */
  public static function getMaestriaCampeao($nomeInvocador, $apiKey) {
    //RECEBE AS INFORMAÇÕES DO INVOCADOR
    $dadosInvocador = self::getDadosInvocador($nomeInvocador, $apiKey);

    return json_decode(file_get_contents(self::ENDPOINT_MAESTRIA.''.$dadosInvocador['puuid'].'?api_key='.$apiKey));
  }

  /**
   * @method responsável por retornar os três maiores de campeões do invocador
   * @param string $nomeInvocador (nome do invocador)
   * @param string $apiKey (api key da sua conta riot)
   */
  public static function getMaioresMaestriasInvocador($nomeInvocador, $apiKey) {
    $maestriasInvocador = self::getMaestriaCampeao($nomeInvocador, $apiKey);

    //RETORNA TODOS OS CAMPEÇÕES DO LOL
    $campeoesLOL = self::getCampoesLOL();

    //RETORNA OS 3 MAIORES CAMPEÕES COM MAESTRIA
    $maioresMaestrias = [
      $maestriasInvocador[0],
      $maestriasInvocador[1],
      $maestriasInvocador[2]
    ];

    //COMPARA OS IDS E MONTA UM ARRAY CONTENDO O NOME DO CAMPEÃO, NIVEL DE MAESTRIA E PONTOS DE MAESTRIA
    foreach ($campeoesLOL as $key => $campeao) {
      foreach ($maioresMaestrias as $key => $maiorMaestria) {
        if($campeao['championId'] == $maiorMaestria->championId) {
          $maestria[] = [
            'nivelMaestria' => $maiorMaestria->championLevel,
            'pontoMaestria' => $maiorMaestria->championPoints,
            'nomeCampeao'   => $campeao['championName'],
            'imagemCampeao' => $campeao['imageChampion']
          ];
        }
      }
    }

    return $maestria;
  }

  /**
   * @method responsável por retornar o ícone de invocador
   * @param string $nomeInvocador (nome do invocador)
   * @param string $apiKey (api key da sua conta riot)
   * @return string imagem do icone de invocador
   */
  public static function getIconeUrlInvocador($nomeInvocador, $apiKey) : string {
    $dadosInvocador = self::getDadosInvocador($nomeInvocador, $apiKey);

    return 'https://ddragon.leagueoflegends.com/cdn/14.6.1/img/profileicon/'.$dadosInvocador['profileIconId'].'.png';
  }

  /**
   * @method responsável por retornar as informações de elo do invocador
   * @param string $nomeInvocador (nome do invocador)
   * @param string $apiKey (api key da sua conta riot)
   * @return array informações sobre elo do invocador
   */
  public static function getInformacoesElo($nomeInvocador, $apiKey) : array {
    $dadosInvocador = self::getDadosInvocador($nomeInvocador, $apiKey);

    return json_decode(file_get_contents(self::ENDPOINT_ELO.''.$dadosInvocador['id'].'?api_key='.$apiKey), true)[0];
  }

  /**
   * @method responsável por retornar o elo do invocador
   * @param string $nomeInvocador (nome do invocador)
   * @param string $apiKey (api key da sua conta riot)
   * @return string elo do invocador
   */
  public static function getElo($nomeInvocador, $apiKey) : string {
    $infosElo = self::getInformacoesElo($nomeInvocador, $apiKey);

    switch ($infosElo['tier']) {
      case 'CHALLENGER':
        $elo = 'Challenger';
        break;
      case 'GRAND':
        $elo = 'Grand';
        break;
      case 'MASTER':
        $elo = 'Master';
        break;
      case 'DIAMOND':
        $elo = 'Diamond';
        break;
      case 'EMERALD':
        $elo = 'Emerald';
        break;
      case 'PLATINUM':
        $elo = 'Platinum';
        break;
      case 'GOLD':
        $elo = 'Gold';
        break;
      case 'SILVER':
        $elo = 'Silver';
        break;
      case 'IRON':
        $elo = 'Iron';
        break;
    }

    return $elo;
  }
}