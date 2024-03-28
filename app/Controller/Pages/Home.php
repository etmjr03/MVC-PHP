<?php

namespace App\Controller\Pages;

use App\Utils\View;

/**
 * Classe responsável por gerenciar a home
 * @author Juninho
 */

class Home {

  /**
   * @method responsável por retornar o conteúdo (view) da nossa home
   * @return string
   */
  public static function getHome() : string {
    $arrayVariaveis = [
      'nome'    => 'juninho',
      'campeao' => 'Nida Lee',
      'numero'  => 1
    ];

    return View::render('pages/home', $arrayVariaveis);
  }
}