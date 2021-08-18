    <body>
        <div id="global">
            <h2>Ajouter une tâche : </h2>
            <form action="" method="post">
                <p>Ajouter un nom de tâche:</p>
                <p><input type="text" name="name_task"></p>
                <p>contenu de la  tâche:</p>
                <p><textarea name="content_task" rows="5" cols="33"></textarea></p>
                <p>Type de  tâche:</p>
                <p><select name="id_cat">
                <?php
                    //création d'un objet category
                    $cat = new Cat("test");
                    //appel de la Méthode génération du menu déroulant liste des catégories
                    $cat->generateMenu($bdd);
                ?>
                </select></p>
                <p>date de fin:</p>
                <p><input type="date" name="date_task"></p>
                <p><input type="submit" value="Ajouter"></p> 
            </form>            
    </body>
</html>