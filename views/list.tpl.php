<section class='m-top-40'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Liste des fiches<br> pour la catégorie "<span class='text-info'><?php print stripslashes(substr($category['name'], 1, -1)) ?></span>"</h2>
                <hr class="star-primary">
            </div>
        </div>
        <div class="row m-top-40">
            <?php
            if (empty($fileList)):
                ?> 
                <div class="alert alert-info text-center" role="alert">Pas encore de fiche pour cette catégorie</div>
                <?php
            else:
                for ($i = 0; $i < count($fileList); $i++):
                    $fileId = $fileList[$i][0]['id'];
                    $ids = $file_manager->getAssociatedCategory($fileId);
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3><?php print stripslashes(substr($fileList[$i][0]['title'], 1, -1)) ?></h3>
                                <p><?php print stripslashes(substr($fileList[$i][0]['description'], 1, -1)) ?></p>
                                <p class="m-top-20"><h6>Catégorie(s) associée(s):</h6>
                                <?php
                                if (!empty($ids)):
                                    foreach ($ids as $key => $value):
                                        $catName = $category_manager->getName($value['id_Category']);
                                        print '<small>- ' . stripslashes(ucfirst(substr($catName['name'], 1, -1))) . '</small><br/>';
                                    endforeach;
                                else:
                                    print '<div class="alert alert-danger"><h5>Attention</h5>Pas de catégorie associée à cette fiche.</div>';
                                endif;
                                ?>
                                </p>
                                <hr/>
                                <form method='post'>
                                    <button type='submit' value='<?php print $fileList[$i][0]['id'] ?>' name='clickToUpdateFile' class="btn btn-warning">Modifier</button>
                                    <button type='submit' value='<?php print $fileList[$i][0]['id'] ?>' name='deleteFile' OnClick="return confirm('Voulez-vous vraiment supprimer la fiche \'<?php print stripslashes(substr($fileList[$i][0]['title'], 1, -1)) ?>\' ?');" class="btn btn-danger pull-right">Supprimer</button>
                                </form></div>
                        </div>
                    </div>
                    <?php
                endfor;

            endif;
            ?>
        </div>
        <?php include_once 'searchFiles.tpl.php'; ?>
        <form method="get" class="pull-right">
            <button type="submit" name="action" value="comebackToList" class="btn btn-info">Retour à la liste des fiches</button>
        </form>
</section>
