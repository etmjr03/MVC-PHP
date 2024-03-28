<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Classe responsável por gerenciar a página default
 * @author Juninho
 */

class Page {

  /**
   * @method responsável por renderizar o header
   * @return string layout do header
   */
  private static function getHeader() : string {
    return View::render('pages/header', []);
  }

  /**
   * @method responsável por renderizar o footer
   * @return string layout do footer
   */
  private static function getFooter() : string {
    return View::render('pages/footer', []);
  }

  /**
   * @method responsável por retornar o título e o conteúdo da página default
   * @param string $title titulo da página
   * @param array $content conteúdo da página 
   * @return string
   */
  public static function getPage($title, $content) : string {
    $arrayVariaveis = [
      'titulo'   => $title,
      'header'   => self::getHeader(),
      'conteudo' => $content,
      'footer'   => self::getFooter(),
    ];

    return View::render('pages/page', $arrayVariaveis);
  }
}