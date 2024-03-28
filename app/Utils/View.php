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
   * @param array $vars (array de valores somente de string e number)
   * @return string
   */
  public static function render($view, $vars = null) : string {
    //CONTEÚDO DA VIEW
    $conteudoView = self::getContentView($view);

    //CONCATENA AS CHAVES DO ARRAY DE VARIÁVEIS COM AS CHAVES QUE REPRESENTAM UMA VARIÁVEL NO LAYOUT
    $keys = array_keys($vars);
    $keys = array_map(function($item) {
      return '{{'.$item.'}}';
    }, $keys);

    //SUBSTITUI AS VARIÁVEIS DENTRO DO LAYOUT PELO VALOR DO ARRAY E RETORNA O CONTEÚDO RENDERIZADO
    return str_replace($keys, array_values($vars), $conteudoView);
  }
}