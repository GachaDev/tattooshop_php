<?php

    require_once "./models/CitaModel.php";
    require_once "./models/TatuadorModel.php";

    class CitaController {

        /*
        ATRIBUTOS DE CLASE.
        En este caso tenemos CitaModel -> Para poder acceder a la Base de Datos
        */
        private $citaModel;
        private $tatuadorModel;

        /*
        CONSTRUCTOR DE CLASE
        El constructor de clase lo utilizamos para inicializar el atributo
        $citaModel. (Recordemos que con Model realizaremos las operaciones CRUD con la Base de Datos)
        */
        public function __construct() {
            $this->citaModel = new CitaModel();
            $this->tatuadorModel = new TatuadorModel();
        }

        /**
         * Método para mostrar el view de AltaCita -> Contiene la página para dar de alta una cita
         */
        public function showAltaCita($errores = []) {
            $tatuadores = $this->tatuadorModel->getAllTatuadores();
            require_once "./views/citasViews/AltaCitaView.php";
        }

        public function insertCita($datos = []) {

            // EXTRAER LOS DATOS DEL FORMULARIO Y ALMACENARLOS EN VARIABLES
            $input_id = $datos["input_id"] ?? "";
            $input_descripcion = $datos["input_descripcion"] ?? "";
            $input_fecha_cita = $datos["input_fecha_cita"] ?? "";
            $input_cliente = $datos["input_cliente"] ?? "";
            $input_tatuador = $datos["input_tatuador"] ?? "";

            // COMPROBAMOS SI LOS DATOS DEL FORMULARIO SON CORRECTOS -> SI NO VIENEN VACIOS
            $errores = [];
            if($input_id == "" || $input_descripcion == "" || $input_fecha_cita == "" || $input_cliente == "" || $input_tatuador == "" ) {

                // COMPROBAMOS QUÉ CAMPO ESTÁ VACÍO Y LO AÑADÁIS A UN ARRAY DE ERRORES
                if($input_id == "") {
                    $errores["error_id"] = "El campo id es obligatorio";
                }

                if($input_descripcion == "") {
                    $errores["error_descripcion"] = "El campo descripcion es obligatorio";
                }

                if($input_fecha_cita == "") {
                    $errores["error_fechaCita"] = "La fecha de la cita es obligatoria";
                }

                if($input_cliente == "") {
                    $errores["error_cliente"] = "El campo cliente  es obligatorio";
                }

                if($input_tatuador == "") {
                    $errores["error_tatuador"] = "El campo tatuador es obligatorio";
                }

            }

            // SI $errores NO ESTÁ EMPTY, SIGNIFICA QUE HA HABIDO ERRORES
            if(!empty($errores)) {
                $this->showAltaCita($errores);
            } else {

                // REGISTRAMOS LA CITA
                // PARA REGISTRAR LA CITA NECESITAMOS ACCEDER A LA BASE DE DATOS -> NECESITAMOS LLAMAR A UN METODO QUE ACCEDA A LA BASE DE DATOS
                // ¿A QUÉ CLASE LLAMAMOS? -> CitaModel.php
                // ¿A QUÉ MÉTODO DE LA CLASE LLAMAMOS? -> insertCita($datosDeLaCita)
                $fecha_cita_formatted = date('Y-m-d H:i:s', strtotime($input_fecha_cita));
                $operacionExitosa = $this->citaModel->insertCita($input_id, $input_descripcion, $fecha_cita_formatted, $input_cliente, $input_tatuador);


                if($operacionExitosa) {
                    // LLAMAR A UNA PÁGINA QUE MUESTRE UN MENSAJE DE ÉXITO
                    $tatuadorInfo = $this->tatuadorModel->getTatuadorByName($input_tatuador);
                    require_once "./views/citasViews/AltaCitaCorrectaView.php";
                } else {
                    // LLAMAR A ALGÚN SITIO Y MOSTRAR UN MENSAJE DE ERROR
                    $errores["error_db"] = "Error al insertar la cita, intentelo de nuevo más tarde";
                    $this->showAltaCita($errores);
                }

            }

        }


    }

?>