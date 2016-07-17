<section class='m-top-40'>
    <div class="container">
        <div class='col-lg-12'>
            <?php print $msg ?>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Modifier la fiche "<span class="text-info"><?php print stripslashes($_GET['title']) ?></span>"</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row m-top-40">
            <form method="post" class="text-center">
                <input type="hidden" name="id" value="<?php print $_GET['id'] ?>"/>
                <p>Titre de la fiche : <input type="text" name="ModifyTitle" value="<?php print stripslashes($_GET['title']) ?>"/></p>
                <p>Description : <textarea name="ModifyDescription" /><?php print stripslashes($_GET['description']) ?></textarea></p>
                <?php
                if (false === $categoryList):
                    print '<div class="alert alert-info text-center">Il n\'existe pas encore de catégorie</div>';
                else:
                    ?>
                    <p>Catégorie(s) associée(s) : </p>
                    <div class='checkbox'>
                        <?php
                        $fileId = $_GET['id'];
                        $ids = $file_manager->getAssociatedCategory($fileId);
                        $ArrayIds = array();
                        for ($i = 0; $i < count($ids); $i++):
                            array_push($ArrayIds, $ids[$i]['id_Category']);
                        endfor;
                        for ($i = 0; $i < count($categoryList); $i++):
                            ?>
                            <label class="checkbox-inline">
                                <input type='checkbox' 
                                       name='<?php print $i ?>' 
                                       value='<?php print $categoryList[$i]['id'] ?>'
                                       <?php
                                       if (in_array($categoryList[$i]['id'], $ArrayIds)):
                                           ?> checked='checked'
                                           <?php
                                       endif;
                                       ?>
                                       />
                                       <?php print stripslashes(ucfirst(substr($categoryList[$i]['name'], 1, -1))) ?>
                            </label>
                            <?php
                        endfor;
                        ?>
                    </div>
                <?php
                endif;
                ?>
                <p><input type="submit" value="Valider" class="btn btn-success"></p>
            </form>
        </div>
        <form method="get" class="pull-right">
            <button type="submit" name="action" value="comebackToList" class="btn btn-info">Retour à la liste des fiches</button>
        </form>
    </div>
</section>