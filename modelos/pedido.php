<?php
    class Pedido{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos
        public function consulta(){
            $con = "SELECT v.*, c.nombre AS nombrecl, c.ident AS identcl, c.direccion AS direccion, 
                    c.celular AS celular, ci.nombre AS ciudad, d.nombre AS dpto, u.nombre AS vendedor 
                    FROM ventas v
                    INNER JOIN cliente c ON v.fo_cliente = c.id_cliente
                    INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                    INNER JOIN dpto d ON ci.fo_dpto = d.id_dpto
                    INNER JOIN usuario u ON v.fo_vendedor = u.id_usuario
                    ORDER BY v.fecha DESC, v.id_venta DESC";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function insertar($params){
            $ins = "INSERT INTO ventas(fecha, fo_cliente, productos, subtotal, total, fo_vendedor) 
                    VALUES('$params->fecha', $params->fo_cliente, '$params->productos', $params->subtotal, $params->total, $params->fo_vendedor)";
            mysqli_query($this->conexion, $ins);
            $vec = [];
            $vec['resultado'] = "OK";
            $vec['mensaje'] = "La venta ha sido guardada";
            return $vec;
        }

        public function consultap($id){
            $con = "SELECT productos from ventas WHERE id_venta = $id";
            $res = mysqli_query($this->conexion, $con);
            $row = mysqli_fetch_array($res);
            $vec = unserialize($row[0]);

            return $vec;
        }

        

    }

    
?>