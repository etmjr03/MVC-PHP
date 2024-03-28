<?php

namespace App\Utils;

/**
 * Classe responsável por renderizar conteúdos das views
 * @author Juninho
 */

class View {

  /**
   * @method responsável por retornar o conteúdo de uma view
   * @param string $view (nome da view)
   * @return string
   */
  private static function getContentView($view) : string {
    //NAVEGA ATÉ ONDE FICA ARMAZENADA AS VIEW E CONCATENA COM O NOME DO ARQUIVO PARA RETORNA-LO
    $file = __DIR__.'/../../resources/view/'.$view.'.html';

    //VERIFICA SE O ARQUIVO EXISTE E RETORNA ELE, CASO NÃO EXISTA RETORNA UMA STRING VAZIA
    return file_exists($file) ? file_get_contents($file) : '';
  }

  /**
   * @method responsável por retornar o conteúdo renderizado de uma view
   * @param string $view (nome da view)
   * @return string
   */
  public static function render($view) : string {
    //CONTEÚDO DA VIEW
    $conteudoView = self::getContentView($view);

    //RETORNA O CONTEÚDO RENDERIZADO
    return $conteudoView;
  }
}