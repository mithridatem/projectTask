<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajouter une categorie de tache</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="./script/script.js" defer></script>
</head>
    <body>
        <div id="global">
            <header>
                <h1>Ajouter une catégorie</h1>
            </header>
            <form action="" method="post">
                <label for="name_cat">Ajouter une catégorie</label>
                <p><input type="text" name="name_cat"></p>
                <p><input type="submit" value="Ajouter"></p> 
            </form>
    </body>
    <script>
        //affiche les objets de liste actif
        let li = document.querySelector("li.categories")
        li.classList.add('active')
    </script>
</html>