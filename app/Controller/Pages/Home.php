<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Classe responsável por gerenciar a home
 * @author Juninho
 */

class Home extends Page {

  /**
   * @method responsável por retornar o conteúdo (view) da nossa home
   * @param string $title titulo da página
   * @param array $vars (array de valores somente de string e number)
   * @return string
   */
  public static function getHome($title, $vars) : string {
    //VIEW DA HOME E SUAS VARIÁVEIS
    $content = View::render('pages/home', $vars);

    //RETORNA A VIEW DA PÁGINA COM OS CONTEÚDOS DA HOME
    return parent::getPage($title, $content);
  }
}