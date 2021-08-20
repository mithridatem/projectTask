<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./script/script.js" defer></script>
</head>
<body>
    <div id="global">
        <header>
            <h1>Ajouter un utilisateur</h1>
        </header>
        <form action="" method="post">
            <label for="name_user">Ajouter un nom :</label>
            <p><input type="text" name="name_user"></p>
            <label for="first_name_user">Ajouter un prenom :</label>
            <p><input type="text" name="first_name_user"></p>
            <label for="login_user">Ajouter un login :</label>
            <p><input type="text" name="login_user"></p>
            <label for="mdp_user">Ajouter un mot de passe :</label>
            <p><input type="text" name="mdp_user"></p>
            <p><input type="submit" value="Ajouter"></p> 
        </form>
        <script>
            //affiche les objets de liste actif
            let li = document.querySelector("li.comptes")
            li.classList.add('active')
        </script>
</body>
</html>