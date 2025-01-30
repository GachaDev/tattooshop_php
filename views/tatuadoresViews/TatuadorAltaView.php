<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/citasStyles/styles_altaCita.css">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- FLATPICKR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Alta Tatuador</title>
</head>

<body>

    <main class="body__main">
        <form class="main__form-plantilla <?= isset($errores) && !empty($errores) ? "main__form-plantilla-error" : "" ?>" action="/tattooshop_php/tatuadores/alta" method="post">
            <div class="form-plantilla__container">
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="nombre">Nombre</label>
                    <input type="text"
                        class="shadow form-control "
                        id="nombre" name="nombre"
                        aria-describedby="nombre"
                        placeholder="Introduce el nombre">
                    <?php if (!empty($errores) && isset($errores["error_nombre"])): ?><small id="nombreError" class="form-text text-danger fw-bold"><?= $errores["error_nombre"] ?></small><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="email">Email</label>
                    <input type="text"
                        class="shadow form-control "
                        id="email" name="email"
                        aria-describedby="email"
                        placeholder="Introduce el email">
                    <?php if (!empty($errores) && isset($errores["error_email"])): ?><small id="emailError" class="form-text text-danger fw-bold"><?= $errores["error_email"] ?></small><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="password">Contraseña</label>
                    <input type="password"
                        class="shadow form-control "
                        id="password" name="password"
                        aria-describedby="password"
                        placeholder="Introduce la contraseña">
                    <?php if (!empty($errores) && isset($errores["error_password"])): ?><small id="passwordError" class="form-text text-danger fw-bold"><?= $errores["error_password"] ?></small><?php endif; ?>
                </div>
                <div class="form-group">
                    <label class="fw-lighter text-lowercase text-white" for="foto">Foto</label>
                    <input type="text"
                        class="shadow form-control "
                        id="foto" name="foto"
                        aria-describedby="foto"
                        placeholder="Introduce la url de la foto">
                    <?php if (!empty($errores) && isset($errores["error_foto"])): ?><small id="fotoError" class="form-text text-danger fw-bold"><?= $errores["error_foto"] ?></small><?php endif; ?>
                </div>
                <div class="container__btns-form">
                    <button type="submit" class="btn btn-primary btns-form__btn-enviar">Enviar</button>
                    <button type="reset" class="btn btn-danger">Borrar</button>
                </div>
            </div>
        </form>
        <?php if (!empty($errores) && isset($errores["error_db"])): ?>
            <p id="bdError" class="text-danger"><?= $errores["error_db"] ?></p>
        <?php endif; ?>
    </main>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="../public/js/datepickerinitialzr.js"></script>