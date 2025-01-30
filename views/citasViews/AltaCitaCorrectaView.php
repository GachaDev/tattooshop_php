<!-- Información que debe mostrarse
• Mensaje: Confirmación de alta de la cita.
• Fecha de la cita: Fecha y hora seleccionada por el usuario.
• Descripción de la cita: Texto ingresado por el usuario.
• Nombre del cliente: Nombre ingresado por el usuario.
• Nombre del tatuador: Extraído de la base de datos.
• Email del tatuador: Extraído de la base de datos.
• Foto del tatuador: Extraída de la base de datos. -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/citasStyles/styles_altaCorrecta.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>AltaCorrecta</title>
</head>

<body>

    <h1>ALTA CORRECTA</h1>
    <p>Fecha de la cita: <?=$input_fecha_cita?></p>
    <p>Descripción de la cita: <?=$input_descripcion?></p>
    <p>Nombre del cliente: <?=$input_cliente?></p>
    <p>Nombre del tatuador: <?=$tatuadorInfo[0]["nombre"]?></p>
    <p>Email del tatuador: <?=$tatuadorInfo[0]["email"]?></p>
    <img src="<?=$tatuadorInfo[0]["foto"]?>" alt="tatuador">

</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>