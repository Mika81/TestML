<section class='m-top-40'>
    <div class="container">
        <div class='col-lg-12'>
            <?php print $msg ?>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Modifier la catégorie "<span class="text-info"><?php print stripslashes($_GET['name']) ?>"</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row m-top-40">
            <form method="post" class="text-center">
                <input type="hidden" name="id" value="<?php print $_GET['id'] ?>"/>
                <p>Titre de la catégorie : <input type="text" name="ModifyName" value="<?php print stripslashes($_GET['name']) ?>"/></p>
                <p>Description : <textarea name="ModifyDescription" /><?php print stripslashes($_GET['description']) ?></textarea></p>
                <p><input type="submit" value="Valider" class="btn btn-success"></p>
            </form>
        </div>
        <a href="<?php print $url ?>/?action=createCat" type="button" class="btn btn-info pull-right">Retour à la gestion des catégories</a>
    </div>
</section>
