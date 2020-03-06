<?php

/**
 * Nos han pedido reemplazar la herramienta para mantener
 * el catalogo de peliculas de NotFlex porque el original
 * es muy malo. Pero como es un cambio muy grande en nuestra
 * primera entrega no hay que entregar todas las funcionalidades.
 * 
 * Las funcionalidades que nos piden son:
 *  - Agregar peliculas nuevas
 *  - Agregar series nuevas
 *  - Poder sacar peliculas
 *  - Poder sacar series
 *  - Listar por categoria
 *  - Una funcion que te dice si existe el id de pelicula/serie
 * 
 * Las categorias se van a ir creando a medida que se agregan
 * peliculas o series, entonces si se agrega una serie con la
 * categoria "ciencia misteriosa" esta categoría empieza a
 * existir en ese momento.
 * 
 * Tendremos que pasar todos los tests y tratemos de quedar
 * bien porque es nuestro primer cliente importante!
 */

class CatalogoNotFlex {

  private $catalogo = array(
    "series" => array(),
    "peliculas" => array()
  );
  /**
   * Esta funcion solo nos dice si existe la pelicula o serie con
   * el id que nos pasan
   */
  public function existeId($id) {
    if (array_key_exists($id,$this->catalogo["series"]) or array_key_exists($id,$this->catalogo["peliculas"])){
      return True;
    }
    return False;
  }

  public function agregarSerie($id, $nombre, $cantidadCapitulos, $categoria) {
    if (!array_key_exists($id,$this->catalogo["series"])){
      $this->catalogo["series"][$id] = array(
        "nombre" => $nombre,
        "capitulos" => $cantidadCapitulos,
        "categoria" => $categoria
      );
    }
  }

  public function agrearPelicula($id, $nombre, $tiempo, $categoria) {
    if (!array_key_exists($id,$this->catalogo["peliculas"])){
      $this->catalogo["peliculas"][$id] = array(
        "nombre" => $nombre,
        "tiempo" => $tiempo,
        "categoria" => $categoria
      );
    }
  }

  public function sacarSerie($id) {
    if(array_key_exists($id,$this->catalogo["series"])){
      unset($this->catalogo["series"][$id]);
      return True;
    }
    return False;
  }

  public function sacarPelicula($id) {
    if(array_key_exists($id,$this->catalogo["peliculas"])){
      unset($this->catalogo["peliculas"][$id]);
      return True;
    }
    return False;
  }

  public function listarContenidoDeLaCategoria($categoria) {
    $lista = array();
    $series = $this->catalogo["series"];
    $peliculas = $this->catalogo["peliculas"];

    foreach($series as $serie){
      if ($serie["categoria"] == $categoria){
        $lista[] = $serie;
      }
    }
    foreach($peliculas as $pelicula){
      if ($pelicula["categoria"] == $categoria){
        $lista[] = $pelicula;
      }
    }
    return $lista;
  }

}