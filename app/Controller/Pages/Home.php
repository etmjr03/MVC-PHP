<?php

namespace App\Controller\Pages;

/**
 * Classe responsável por retornar o conteúdo (view) da nossa home
 * @author Juninho
 */

class Home {

  /**
   * @method responsável por retornar os conteúdos da home
   * @return string
   */
  public static function getHome() : string {
    return 'Olá mundo';
  }
}