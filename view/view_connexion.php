<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>se connecter</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./script/script.js" defer></script>
</head>
<body>    
        <div id="global">
            <header>
                <h1>Connexion</h1>
            </header>
            <h2>Saisir ces identifiants de connexion</h2>
            <form action="" method="post">
                <label for="login_user">Login:</label>
                <p class="champ"><input type="text" name="login_user"></p>
                <label for="mdp_user">Mot de passe:</label>
                <p class="champ"><input type="text" name="mdp_user"></p>
                <p class="champ"><input type="submit" value="Connexion"></p>
            </form>
            <p id="message"></p>
        </div>
        <script>
            //affiche les objets de liste actif
            let li = document.querySelector("li.connexion")
            li.classList.add('active')
        </script>
    </body>
</html>
