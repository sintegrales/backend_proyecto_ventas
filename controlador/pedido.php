<?php
    header('Access-Control-Allow-Origin: *'); 
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

    require_once("../conexion.php");
    require_once("../modelos/pedido.php");

    $control = $_GET['control'];

    $pedido = new Pedido($conexion);

    switch ($control) {
        case 'consulta':
            $vec = $pedido->consulta();
            $datosj = json_encode($vec);
            echo $datosj;
        break;
        case 'insertar':
            $json = file_get_contents('php://input');
            /* $json = '{
                "fecha": "2024-2-18",
                "fo_cliente": 1,
                "productos": [
                  [
                    "004",
                    "Arepa Burguer",
                    8000,
                    2,
                    16000
                  ],
                  [
                    "001",
                    "Coca cola 1.5 lts",
                    5500,
                    2,
                    11000
                  ]
                ],
                "subtotal": 27000,
                "total": 27000,
                "fo_vendedor": 1
              }'; */
            $params = json_decode($json);
            $texto_arreglo = serialize($params->productos);
            $params->productos = $texto_arreglo;
            $vec = $pedido->insertar($params);
            $datosj = json_encode($vec);
            echo $datosj;
            header('Content-Type: application/json');
        break;
        case 'productos':
          $id = $_GET['id'];
          $vec = $pedido->consultap($id);
          $datosj = json_encode($vec);
          echo $datosj;
          header('Content-Type: application/json');
        break;
    }

    

?>