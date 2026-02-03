<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/Css/main.css">
</head>

<body>
    <div class="card">
        <h1><?= $title ?></h1>
        <p><?= $message ?></p>
        <p><small>Esta vista está siendo renderizada por <code>HomeController</code> y utiliza archivos externos de CSS
                y JS.</small></p>

        <a href="#" class="btn">Probar JavaScript Externo</a>
    </div>

    <script src="/Js/main.js"></script>
</body>

</html>