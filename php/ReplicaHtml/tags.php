<?php
//Primero necesito una interfaz para las cosas dibujables

interface Dibujable{
    public function dibujar();
}

//Ahora creo las clases que van a hacer de tags de html

class Parrafo implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = $elemento;
    }

    public function dibujar(){
        echo "<p>";
        
        foreach($this->contenido as $elemento){

            if (is_string($elemento)){
                echo $elemento;

            }else{
                $elemento->dibujar();
            }
        }
        echo "</p>";
    }
}

class Negrita implements Dibujable{

    private $conteido;

    public function guardar($elemento){
        $this->contenido = "<b>".$elemento."</b>";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Italica implements Dibujable{

    private $conteido;

    public function guardar($elemento){
        $this->contenido = "<i>".$elemento."</i>";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Enter implements Dibujable{
    public function dibujar(){
        echo "<br>";
    }
}

class Imagen implements Dibujable{

    private $src;
    private $alt;
    private $height;
    private $width;

    public function __construct($source,$alternativo,$alto,$ancho){
        $this->src = $source;
        $this->alt = $alternativo;
        $this->height = $alto;
        $this->width = $ancho;
    }

    public function dibujar(){
        echo "<img src=".$this->src." alt=".$this->alt." height=".$this->height." width=".$this->width." >";
    }
}

class Cuerpo implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = $elemento;
    }

    public function dibujar(){
        echo "<body>\n";

        foreach($this->contenido as $elemento){
            $elemento->dibujar();
        }

        echo "\n</body>";
    }    
}

class Html implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = $elemento;
    }

    public function dibujar(){
        echo "<html>\n";

        foreach($this->contenido as $elemento){
            $elemento->dibujar();
        }

        echo "\n</html>";
    }    
}

class Encabezado1 implements Dibujable{

    private $contenido;

    public function guardar($elemento){
        $this->contenido = "<h1>".$elemento."</h1>\n";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Encabezado2 implements Dibujable{

    private $contenido;

    public function guardar($elemento){
        $this->contenido = "<h2>".$elemento."</h2>\n";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Encabezado3 implements Dibujable{

    private $contenido;

    public function guardar($elemento){
        $this->contenido = "<h3>".$elemento."</h3>\n";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Encabezado4 implements Dibujable{

    private $contenido;

    public function guardar($elemento){
        $this->contenido = "<h4>".$elemento."</h4>\n";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Encabezado5 implements Dibujable{

    private $contenido;

    public function guardar($elemento){
        $this->contenido = "<h5>".$elemento."</h5>\n";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Encabezado6 implements Dibujable{

    private $contenido;

    public function guardar($elemento){
        $this->contenido = "<h6>".$elemento."</h6>\n";
    }

    public function dibujar(){
        echo $this->contenido;
    }
}

class Title implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = $elemento;
    }

    public function dibujar(){

        echo "<title>\n";

        foreach ($this->contenido as $elemento){

            if (is_string($elemento)){
                echo $elemento;
            }else{
                $elemento->dibujar();
            }
        }
        echo "\n</title>";
    }
}

class ListaNoOrdenada implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = "<li>".$elemento."</li>";
    }

    public function dibujar(){
        echo "<ul>\n";

        foreach($this->contenido as $elemento){
            echo $elemento."\n";
        }

        echo "</ul>";
    }
}

class ListaOrdenada implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = "<li>".$elemento."</li>";
    }

    public function dibujar(){
        echo "<ol>\n";

        foreach($this->contenido as $elemento){
            echo $elemento."\n";
        }

        echo "</ol>";
    }
}

class Head implements Dibujable{

    private $contenido = array();

    public function guardar($elemento){
        $this->contenido[] = $elemento;
    }

    public function dibujar(){
        echo "<head>\n";

        foreach ($this->contenido as $elemento){

            if (is_string($elemento)){

                echo $elemento;

            }else{

                $elemento->dibujar();
            }
        }

        echo "</head>";
    }
}