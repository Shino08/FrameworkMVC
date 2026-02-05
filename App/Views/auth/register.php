<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?>
    </title>
    <link rel="stylesheet" href="<?= $base_url ?>/Css/main.css">
    <style>
        .login-card {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark-color);
        }

        input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .error-msg {
            color: #e74c3c;
            background: #fde8e8;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="card login-card">
        <h1>Registro</h1>
        <p>Ingresa tus datos para hacer el registro</p>

        <?php if (isset($error)): ?>
            <div class="error-msg">
                <?= $error ?>
            </div>
        <?php endif; ?>

        <form action="<?= $base_url ?>/register" method="POST">

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="name" name="name" id="name" value="<?= $name ?>" placeholder="admin@test.com"
                    required>
            </div>

            <div class="form-group">
                <label for="lastname">Apellido</label>
                <input type="name" name="lastname" id="lastname" value="<?= $lastname ?>" placeholder="admin@test.com"
                    required>
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" value="<?= $email ?>" placeholder="admin@test.com"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" value="<?= $password ?>" placeholder="*****" required>
            </div>

            <button type="submit" class="btn" style="width: 100%; cursor: pointer;">Entrar</button>
        </form>

    </div>
</body>

</html>