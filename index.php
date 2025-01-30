<?php

    /*
    El archivo más importante en un proyecto MVC es el index.php. Todas las peticiones URL que realice el usuario pasarán por este fichero.
    Toda acción que se ejecute en nuestra aplicación tendrá que llamar al index y este tendrá que cargar el controlador asociado a dicha acción,
    el modelo y la vista si procede.

    Responsabilidad principal: Es el punto de entrada de la aplicación.
    Detalles:
    - Se encarga de inicializar el entorno de la aplicación, como configurar constantes, cargar librerías e incluir el archivo de
    autoloading si se utiliza (por ejemplo, con Composer).
    - Maneja la lógica de enrutar las solicitudes al controlador correspondiente.
    - Es minimalista y delega todas las responsabilidades importantes a las capas lógicas del patrón MVC.
    */

    // Cargamos los controladores que necesitamos.
    require_once "./controllers/CitaController.php";
    require_once "./controllers/TatuadorController.php";

    $requestUri = $_SERVER["REQUEST_URI"] ?? "";
    $parseUri = parse_url($requestUri);

    // Como ya sabemos a qué URI quiere acceder el cliente, podemos cargar el Controller Asociado
    switch ($parseUri["path"]) {
        // 1er caso -> si llamamos a la uri de alta
        case "/tattooshop_php/citas/alta":
            $citaController = new CitaController();
            $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST

            if($requestMethod == "GET") {
                $citaController->showAltaCita();
            } elseif($requestMethod == "POST") {
                $datos = $_POST ?? [];
                $citaController->insertCita($datos);
            }
            break;
        case "/tattooshop_php/tatuadores/alta":
            $tatuadorController = new TatuadorController();
            $requestMethod = $_SERVER["REQUEST_METHOD"]; // va a ser GET o POST

            if($requestMethod == "GET") {
                $tatuadorController->showAltaTatuador();
            } elseif($requestMethod == "POST") {
                $datos = $_POST ?? [];
                $tatuadorController->insertTatuador($datos);
            }
            break;
        // caso por defecto -> llamamos a 404
        default:
            echo "<h1>PAGINA NO ENCONTRADA</h1>";
            break;
    }


?>