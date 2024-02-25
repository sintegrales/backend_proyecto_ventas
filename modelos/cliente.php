<?php
    class Cliente{
        //atributo
        public $conexion;

        //metodo constructor
        public function __construct($conexion) {
            $this->conexion = $conexion;
        }

        //metodos
        public function consulta(){
            $con = "SELECT c.*, ci.nombre AS ciudad, d.nombre AS dpto FROM cliente c
                    INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                    INNER JOIN dpto d ON ci.fo_dpto = d.id_dpto
                    ORDER BY c.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function filtro($dato){
            $con = "SELECT c.*, ci.nombre AS ciudad, d.nombre AS dpto FROM cliente c
                    INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                    INNER JOIN dpto d ON ci.fo_dpto = d.id_dpto
                    WHERE c.ident LIKE '%$dato%' OR c.nombre LIKE '%$dato%' OR c.email LIKE '%$dato%'
                    ORDER BY c.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        public function consultar_cliente($dato){
            $con = "SELECT c.*, ci.nombre AS ciudad, d.nombre AS dpto FROM cliente c
                    INNER JOIN ciudad ci ON c.fo_ciudad = ci.id_ciudad
                    INNER JOIN dpto d ON ci.fo_dpto = d.id_dpto
                    WHERE c.ident = '$dato'
                    ORDER BY c.nombre";
            $res = mysqli_query($this->conexion, $con);
            $vec = [];

            while($row = mysqli_fetch_array($res)){
                $vec[] = $row;
            }

            return $vec;
        }

        

    }

    
?>