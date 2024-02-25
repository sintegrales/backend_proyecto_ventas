<?php
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/cliente.php");

    $control = $_GET['control'];

    $cliente = new Cliente($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $cliente->consulta();
        break;
        case 'filtro':
            $dato = $_GET['dato'];
            $vec = $cliente->filtro($dato);
        break;
        case 'ccliente':
            $dato = $_GET['dato'];
            $vec = $cliente->consultar_cliente($dato);
        break;
    }

    $datosj = json_encode($vec);
    echo $datosj;
    header('Content-Type: application/json');

?>