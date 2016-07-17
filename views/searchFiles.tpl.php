<div class="row m-top-20">
    <div class="col-lg-12 text-center">
        <hr class="star-primary">
        <h4>Rechercher des fiches par catégorie</h4>
    </div>
</div>
<div class="row">
    <?php
    if (false === $categoryList):
        print '<div class="alert alert-info text-center">Il n\'existe pas encore de catégorie</div>';
    else:
        ?>

        <form method='post' class="col-lg-12 text-center m-top-10">
            <fieldset class="form-group">
                <select class="select" name='category'>
                    <option selected>Sélectionner une catégorie</option>
                    <?php
                    for ($i = 0; $i < count($categoryList); $i++):
                        ?>
                        <option value="<?php print $categoryList[$i]['id'] ?>"><?php print stripslashes(ucfirst(substr($categoryList[$i]['name'], 1, -1))) ?></option>
                        <?php
                    endfor;
                    ?>
                </select>
            </fieldset>
            <button type="submit" class="btn btn-primary">Valider</button>
        </form>
    <?php
    endif;
    ?>
</div>
