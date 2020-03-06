<?php

require_once("tags.php");

$h = new Encabezado1();
$h->guardar("Hola, soy un Header.");

$p = new Parrafo();
$p->guardar("Hola, soy un parrafo.");
//$p->dibujar();

$pAdicional = new Parrafo();
$pAdicional->guardar("Y yo soy su hermano.");

$ul = new ListaNoOrdenada();
$ul->guardar("Harina");
$ul->guardar("Huevos");
$ul->guardar("Leche");
$ul->guardar("Levadura");

$h3 = new Encabezado3();
$h3->guardar("Cuidado que viene una lista no ordenada:");

$h3a = new Encabezado3();
$h3a->guardar("Lista ordenada:");

$ol = new ListaOrdenada();
$ol->guardar("Primer lugar.");
$ol->guardar("Argentina.");
$ol->guardar("A nadie le importa el tercero.");

$bold = new Negrita();
$bold->guardar("negrita");

$italic = new Italica();
$italic->guardar("italica");

$pBoldItalic = new Parrafo();
$pBoldItalic->guardar("Palabras que definen su apariencia como ");
$pBoldItalic->guardar($bold);
$pBoldItalic->guardar(" e ");
$pBoldItalic->guardar($italic);

$SinkoPeso = new Imagen("sinkoPeso.jpeg","sinko peso","","");

$titulo = new Title();
$titulo->guardar("html escrito en php y leido por tu browser :)");

$head = new Head();
$head->guardar($titulo);

$c = new Cuerpo();
$c->guardar($head);
$c->guardar($h);
$c->guardar($p);
$c->guardar($pAdicional);
$c->guardar($h3);
$c->guardar($ul);
$c->guardar($h3a);
$c->guardar($ol);
$c->guardar($pBoldItalic);
$c->guardar($SinkoPeso);

$h = new html();
$h->guardar($c);
$h->dibujar();