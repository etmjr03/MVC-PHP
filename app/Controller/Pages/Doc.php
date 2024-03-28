<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Classe responsável por gerenciar a documentação do projeto
 * @author Juninho
 */

class Doc extends Page {

  /**
   * @method responsável por retornar o conteúdo (view) da nossa documentação
   * @param string $title titulo da página
   * @param array $vars (array de valores somente de string e number)
   * @return string
   */
  public static function getDoc($title, $vars) : string {
    //VIEW DA DOC E SUAS VARIÁVEIS
    $content = View::render('pages/doc', $vars);

    //RETORNA A VIEW DA PÁGINA COM OS CONTEÚDOS DA DOC
    return parent::getPage($title, $content);
  }
}