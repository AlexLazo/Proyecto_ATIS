<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body class="d-flex align-items-center justify-content-center"> <!-- Center the content vertically and horizontally -->

<div class="container">
    <div class="card card-container">
        <img id="profile-img" class="profile-img-card" src="img/htl.png" alt="Profile Image">
        
        <div class="result">
            <?php
            if (isset($_GET['empty'])){
                echo '<div class="alert alert-danger">Ingrese Usuario o Contraseña</div>';
            } elseif (isset($_GET['loginE'])){
                echo '<div class="alert alert-danger">Usuario o Contraseña no coinciden</div>';
            } ?>
        </div>
        <form class="form-signin" data-toggle="validator" action="ajax.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" name="username" class="form-control" placeholder="Ingrese su usuario" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Ingrese su contraseña" required>
                    <div class="input-group">
                        <button type="button" id="show-hide-password" class="btn btn-outline-secondary btn-show-hide-password" onclick="togglePasswordVisibility()">Mostrar</button>
                    </div>
                </div>
            </div>

            <button class="btn btn-lg btn-success btn-block btn-signin" type="submit" name="login">Iniciar Sesión</button>
        </form>
    </div>
</div>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordButton = document.getElementById("show-hide-password");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordButton.textContent = "Ocultar"; // Change button text
        } else {
            passwordInput.type = "password";
            passwordButton.textContent = "Mostrar"; // Change button text
        }
    }
</script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/validator.min.js"></script>
</body>
</html>
