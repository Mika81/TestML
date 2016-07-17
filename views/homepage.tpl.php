<section id="fiches" class='m-top-40'>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2>Les Fiches</h2>
                <hr class="star-primary">
                <?php
                if (false !== $lastThree):
                    ?>
                    <h4>Les 3 dernières fiches enregistrées</h4>
                    <?php
                endif;
                ?>
            </div>
        </div>
        <div class="row m-top-10">
            <?php
            if (false === $lastThree):
                print '<div class="alert alert-info text-center">Il n\'existe pas encore de fiche</div>';
            else:
                for ($i = 0; $i < count($lastThree); $i++):
                    $fileId = $lastThree[$i]['id'];
                    $ids = $file_manager->getAssociatedCategory($fileId);
                    ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <div class="caption">
                                <h3><?php print stripslashes(substr($lastThree[$i]['title'], 1, -1)) ?></h3>
                                <p><?php print stripslashes(substr($lastThree[$i]['description'], 1, -1)) ?></p>
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
                                <hr>
                                <script type="text/javascript">
                                    function DeleteOrNot(name) {
                                        if (confirm("Voulez vous vraiment supprimer la fiche" + name + " ?")) {
                                            window.location = 'index.php?x=del_comment&id=' + id
                                        }
                                        else {
                                            alert("Le commentaire n'a pas été supprimé.")
                                        }
                                    }
                                </script>
                                <form method='post'>
                                    <button type='submit' value='<?php print $lastThree[$i]['id'] ?>' name='clickToUpdateFile' class="btn btn-warning">Modifier</button>
                                    <button type='submit' value='<?php print $lastThree[$i]['id'] ?>' name='deleteFile' OnClick="return confirm('Voulez-vous vraiment supprimer la fiche \'<?php print stripslashes(substr($lastThree[$i]['title'], 1, -1)) ?>\' ?');" class="btn btn-danger pull-right">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                endfor;
            endif;
            ?>
        </div>
        <?php include_once 'searchFiles.tpl.php'; ?>
    </div>
</section>