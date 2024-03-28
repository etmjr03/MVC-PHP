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
    return View::render('pages/home');
  }
}