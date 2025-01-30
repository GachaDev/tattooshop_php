<?php
    require_once "./models/TatuadorModel.php";

    class TatuadorController {
        private $tatuadorModel;


        public function __construct() {
            $this->tatuadorModel = new TatuadorModel();
        }

        public function showAltaTatuador($errores = []) {
            require_once "./views/tatuadoresViews/TatuadorAltaView.php";
        }

        public function insertTatuador($datos = []) {
            // EXTRAER LOS DATOS DEL FORMULARIO Y ALMACENARLOS EN VARIABLES
            $nombre = $datos["nombre"] ?? "";
            $email = $datos["email"] ?? "";
            $password = $datos["password"] ?? "";
            $foto = $datos["foto"] ?? "";


            // COMPROBAMOS SI LOS DATOS DEL FORMULARIO SON CORRECTOS -> SI NO VIENEN VACIOS
            $errores = [];
            if(!$nombre || !$email || !$password || !$foto) {

                // COMPROBAMOS QUÉ CAMPO ESTÁ VACÍO Y LO AÑADÁIS A UN ARRAY DE ERRORES
                if(!$nombre) {
                    $errores["error_nombre"] = "El campo nombre es obligatorio";
                }

                if(!$email) {
                    $errores["error_email"] = "El campo email es obligatorio";
                }

                if(!$password) {
                    $errores["error_password"] = "El campo password es obligatorio";
                }

                if(!$foto) {
                    $errores["error_foto"] = "El campo foto es obligatorio";
                }

            } else {
                if (!filter_var($foto, FILTER_VALIDATE_URL) || !preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $foto)) {
                    $errores["error_foto"] = "La URL de la foto no es válida o no es una imagen";
                }

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores["error_email"] = "El email no tiene un formato válido";
                }
            }

            // SI $errores NO ESTÁ EMPTY, SIGNIFICA QUE HA HABIDO ERRORES
            if(!empty($errores)) {
                $this->showAltaTatuador($errores);
            } else {
                $emailExist = $this->tatuadorModel->emailExist($email);

                if (!$emailExist) {
                    $operacionExitosa = $this->tatuadorModel->insertTatuador($nombre, $email, $password, $foto);


                    if($operacionExitosa) {
                        // LLAMAR A UNA PÁGINA QUE MUESTRE UN MENSAJE DE ÉXITO
                        require_once "./views/tatuadoresViews/TatuadorAltaCorrectaView.php";
                    } else {
                        // LLAMAR A ALGÚN SITIO Y MOSTRAR UN MENSAJE DE ERROR
                        $errores["error_db"] = "Error al insertar la cita, intentelo de nuevo más tarde";
                        $this->showAltaTatuador($errores);
                    }
                } else {
                    // LLAMAR A ALGÚN SITIO Y MOSTRAR UN MENSAJE DE ERROR
                    $errores["error_db"] = "Ya hay una cuenta usando ese email";
                    $this->showAltaTatuador($errores);
                }

            }

        }
    }
?>