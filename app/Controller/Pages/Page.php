<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Classe responsável por gerenciar a página default
 * @author Juninho
 */

class Page {

  /**
   * @method responsável por retornar o título e o conteúdo da página default
   * @param string $title titulo da página
   * @param array $content conteúdo da página 
   * @return string
   */
  public static function getPage($title, $content) : string {
    $arrayVariaveis = [
      'titulo'   => $title,
      'conteudo' => $content
    ];

    return View::render('pages/page', $arrayVariaveis);
  }
}