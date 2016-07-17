<section class='m-top-40'>
    <div class="container">
        <div class='col-lg-12'>
            <?php print $msg ?>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Gérer Les catégories</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row m-top-40">
            <div class="col-lg-12 text-center">
                <h4>Créer une nouvelle catégorie</h4>
            </div>
            <form method="post" class="text-center m-top-10">
                <p>Titre de la catégorie : <input type="text" name="name" /></p>
                <p>Description : <textarea name="description" /></textarea></p>
                <p><input type="submit" value="Valider" class="btn btn-success"></p>
            </form>
        </div>
        <div class="row m-top-40">
            <?php
            if (false === $categoryList):
                ?>
                <div class="col-lg-12 text-center">
                    <h4>Liste des catégories</h4>
                </div>
                <div class="alert alert-info text-center m-top-40">Il n'existe pas encore de catégorie</div>'
                <?php
            else:
                ?>
                <div class="col-lg-12 text-center">
                    <h4>Modifier/Supprimer une catégorie</h4>
                </div>
                <div class="m-top-10">
                    <?php
                    for ($i = 0; $i < count($categoryList); $i++):
                        ?>
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                                <div class="caption">
                                    <h3><?php print stripslashes(substr($categoryList[$i]['name'], 1, -1)) ?></h3>
                                    <p><?php print stripslashes(substr($categoryList[$i]['description'], 1, -1)) ?></p>
                                    <form method='post'>
                                        <button type='submit' value='<?php print $categoryList[$i]['id'] ?>' name='clickToUpdate' class="btn btn-warning">Modifier</button>
                                        <button class="btn btn-danger pull-right" type='submit' value='<?php print $categoryList[$i]['id'] ?>' name='delete' OnClick="return confirm('Voulez-vous vraiment supprimer la catégorie \'<?php print stripslashes(substr($categoryList[$i]['name'], 1, -1)) ?>\' ?');" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    endfor;
                    echo '</div>';
                endif;
                ?>
            </div>
            <form method="get" class="pull-right">
                <button type="submit" name="action" value="comebackToList" class="btn btn-info">Retour à la liste des fiches</button>
            </form>
        </div>
</section>

