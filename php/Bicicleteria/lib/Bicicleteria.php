<?php
/**
 * Cantidad de bicicletas te dice cuantas bicicletas podes armar.
 * Para armar una bicicleta necesitas 2 ruedas, 1 cuadro y 1 volante.
 */
class Bicicleteria {

    private $ruedas;
    private $cuadros;
    private $volantes;
    private $bicicletas;

    public function __construct() {
        $this->ruedas = 0;
        $this->cuadros = 0;
        $this->volantes = 0;
        $this->bicicletas = 0;
    }

    public function agregarRuedas($cantidad) {
        $this->ruedas += $cantidad;
    }

    public function sacarRuedas($cantidad) {
        if($cantidad >= $this->ruedas){
            $this->ruedas = 0;
        }else{
            $this->ruedas -= $cantidad;
        }
    }

    public function agregarCuadro($cantidad) {
        $this->cuadros += $cantidad;
    }

    public function sacarCuadro($cantidad) {
        if($cantidad >= $this->cuadros){
            $this->cuadros = 0;
        }else{
            $this->cuadros -= $cantidad;
        }
    }

    public function agregarVolante($cantidad) {
        $this->volantes += $cantidad;
    }

    public function sacarVolante($cantidad) {
        if($cantidad >= $this->volantes){
            $this->volantes = 0;
        }else{
            $this->volantes -= $cantidad;
        }
    }

    public function cantidadBicicletas() {
        $this->bicicletas = 0;

        $ruedas = $this->ruedas;
        $cuadros = $this->cuadros;
        $volantes = $this->volantes;

        while ($ruedas > 1 and $cuadros > 0 and $volantes > 0){
            $this->bicicletas += 1;
            $ruedas -= 2;
            $cuadros -= 1;
            $volantes -= 1;
        }
        return $this->bicicletas;
    }
}