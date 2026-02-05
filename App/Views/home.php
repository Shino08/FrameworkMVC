<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?= $base_url ?>/Css/main.css">
</head>

<body>
    <div class="card">
        <h1><?= $title ?></h1>
        <p><?= $message ?></p>

        <?php if (isset($logged_in) && $logged_in): ?>
            <a href="<?= $base_url ?>/logout" class="btn" style="background-color: #e74c3c;">Cerrar Sesión</a>
        <?php else: ?>
            <a href="<?= $base_url ?>/register" class="btn">Iniciar Sesión</a>
        <?php endif; ?>

        <div style="margin-top: 2rem; border-top: 1px solid #eee; padding-top: 1rem;">
            <p><small>Esta vista está siendo renderizada por <code>HomeController</code> y utiliza archivos externos de
                    CSS y JS.</small></p>
            <a href="#" class="btn" style="background-color: #95a5a6; font-size: 0.8rem;">Probar JavaScript Externo</a>
        </div>
    </div>

    <script src="<?= $base_url ?>/Js/main.js"></script>
</body>

</html>