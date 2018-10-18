<?php

require_once ('../../lib/jpgraph/src/jpgraph.php');
require_once ('../../lib/jpgraph/src/jpgraph_pie.php');

$apr = 40;
$rpr = 40;
$rj = 50;
$nsp = 50;

/*
 * grafico.php 
 * Genera un gráfico con los criterios del tipo de alerta de la matriz de riesgos
 */

$criterios = $_GET['criterios'];
$criterios = str_replace("'", '"', $criterios);
$data = JSON_decode($criterios);

$colores = $_GET['colores'];
$colores = str_replace("'", '"', $colores);
$criterios = JSON_decode($colores);
$legend = JSON_decode($colores);


$colors = array( "#828282","#5cb85c", "#f0ad4e","#d9534f");

$graph = new PieGraph(350, 350);
$graph->SetShadow();

$graph->title->Set("Tipos de amenazas");

$p1 = new PiePlot($data);
$p1->SetLegends($legend);

$graph->Add($p1);
$p1->SetSliceColors($colors);

$graph->Stroke();
