<!-- filepath: c:\xampp\htdocs\Projet Gestion Matreil\Vue\View_auth.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('../Assets/images/login-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 350px;
        }
        form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #b30000; /* Dark red */
            font-size: 24px;
        }
        label {
            font-weight: bold;
            color: #333;
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #b30000; /* Dark red */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #ff4d4d; /* Light red */
        }
        .form-footer {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
        .form-footer a {
            color: #b30000;
            text-decoration: none;
            font-weight: bold;
        }
        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="../Controleur/ControleAuth.php" method="post">
        <h2>Connexion</h2>
        <label for="login">Login:</label>
        <input type="text" name="login" id="login" placeholder="Entrez votre login">
        <label for="MDP">Mot de Passe:</label>
        <input type="password" name="pass" id="MDP" placeholder="Entrez votre mot de passe">
        <input type="submit" name="cnx" value="Se Connecter">
        <div class="form-footer">
            <p>Vous n'avez pas de compte ? <a href="#">Inscrivez-vous</a></p>
        </div>
    </form>
</body>
</html>