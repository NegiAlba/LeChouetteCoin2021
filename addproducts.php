<?php require 'inc/header.php' ?>
<?php

$sqlCategory = 'SELECT * FROM categories';
$categories = $connect->query($sqlCategory)->fetchAll();

/**
 * ! Créer un nouvel article à partir du formulaire.
 * 
 * TODO : Vérification intro : si le bouton est cliqué et si le formulaire est rempli
 * 
 * TODO : Initialisation des variables & assainissement
 * 
 * TODO : Vérification du prix positif
 * 
 * TODO : Enregistrement
 */

//? Etape 1 : Vérification de la validité du formulaire et de l'appui sur le bouton envoi
if (isset($_POST['product_submit']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_description']) && !empty($_POST['product_category'])) {
}
?>

<main class="px-3">
    <div class="row">
        <div class="col-12">
            <form action="#" method="POST">
                <div class="form-group">
                    <label for="InputName">Nom de l'article</label>
                    <input type="text" class="form-control" id="InputName" placeholder="Nom de votre article" name="product_name" required>
                </div>
                <div class="form-group">
                    <label for="InputDescription">Description de l'article</label>
                    <textarea class="form-control" id="InputDescription" rows="3" name="product_description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="InputPrice">Prix de l'article</label>
                    <input type="number" min="1" max="999999" class="form-control" id="InputPrice" placeholder="Prix de votre article en €" name="product_price" required>
                </div>
                <div class="form-group">
                    <label for="InputCategory">Catégorie de l'article</label>
                    <select class="form-control" id="InputCategory" name="product_category" required>
                        <?php
                        //? On va boucler sur l'array categories, de façon à ce que chaque ligne de la boucle corresponde à une variable $category et aussi à une ligne de la BDD.
                        foreach ($categories as $category) {
                        ?>
                            <option value="<?php echo $category['categories_id']; ?>">
                                <?php echo $category['categories_name']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <button type="submit" class="btn btn-success" name="product_submit">Enregistrer l'article</button>
            </form>
        </div>
    </div>
</main>

<?php require 'inc/footer.php' ?>