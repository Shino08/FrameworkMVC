<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 2rem;
            background-color: #f4f4f4;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        h1 {
            color: #2c3e50;
        }

        p {
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>
            <?= $title ?>
        </h1>
        <p>
            <?= $message ?>
        </p>
        <p><small>Edita <code>App/Views/home.php</code> para cambiar esta vista.</small></p>
    </div>
</body>

</html>