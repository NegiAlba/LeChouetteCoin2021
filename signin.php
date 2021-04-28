<?php require 'inc/config.php'; ?>
<?php
    
    if(!empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['password2_signup']) && !empty($_POST['username_signup']) &&  isset($_POST['submit_signup'])){
        $email = htmlspecialchars($_POST['email_signup']);
        $password1 = htmlspecialchars($_POST['password1_signup']);
        $password2 = htmlspecialchars($_POST['password2_signup']);
        $username = htmlspecialchars($_POST['username_signup']);

        try {
            //? Etape 1 : Ajout d'un filtre pour la validation du format d'email
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                // echo "Etape 1 : Email ok <br>";
                //? Etape 2 : Vérification de la disponibilité de l'email dans la BDD
                $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
                $resultMail = $connect->query($sqlMail);
                // var_dump($resultMail);
                $countMail = $resultMail->fetchColumn();
                if(!$countMail){
                    // echo "Etape 2 : Email BDD ok <br>";
                    //? Etape 3 : Vérification de la disponibilité de l'username dans la BDD
                    $sqlUsername = "SELECT * FROM users WHERE username = '{$username}'";
                    $resultUsername = $connect->query($sqlUsername);
                    $countUsername = $resultUsername->fetchColumn();
                    if(!$countUsername){
                        // echo "Etape 3 : Username BDD ok <br>";
                        //? Etape 4 : Vérification de la concordance des mots de passe
                        if($password1 === $password2){
                            // echo "Etape 4 : Concordance Mdp ok <br>";
                            //? Etape 5 : Hashage du mot de passe
                            $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
                            // echo "Etape 5 : Hashage Mdp ok <br>";
                            //? Etape 6 : Enregistrement des données utilisateur
                            $sth = $connect->prepare("INSERT INTO users (email,username,password) VALUES (:email,:username,:password)");
                            $sth->bindValue(':email', $email);
                            $sth->bindValue(':username', $username);
                            $sth->bindValue(':password', $hashedPassword);
                            $sth->execute();
                            echo "L'utilisateur a bien été enregistré !";
                            //? Etape 7 : Ajout de messages d'erreurs adaptés.
                        } else {
                            echo "Les mots de passe ne sont pas concordants.";
                            unset($_POST);
                        }
                    } else {
                        echo " Ce nom d'utilisateur existe déja";
                        unset($_POST);
                    }
                }else{
                    echo "Un compte existe déja pour cette adresse mail";
                    unset($_POST);
                }
            } else {
                echo "L'adresse email saisie n'est pas valide";
                unset($_POST);
            }
            
        } catch (PDOException $error) {
            echo 'Error: ' . $error->getMessage();
        }
    }


    /**
     * ! Etapes logiques de l'inscription
     * 
     * // TODO Vérification intro
     * 
     * //  TODO : Initialisation variables
     * 
     * // TODO Verification email : Nécessaire et intéressant, pas sûr qu'on le mette en place pour l'instant
     * 
     * // TODO Vérification email dans la BDD : Pour que l'email ne soit pas existant
     * 
     * // TODO Vérification username dans la BDD : Pour que l'username ne soit pas existant
     * 
     * // TODO Vérification mdp : Concordance password
     * 
     * // TODO Hashage du mdp : Crypter le mot de passe
     * 
     * // TODO Enregistrement données utilisateur
     * 
     * // TODO Assainissement des variables
     * 
     * // TODO Message d'erreur
     */

    // var_dump($email,$password1, $password2, $username);
?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Chouette Coin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body class="d-flex h-100 text-center text-white bg-dark">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
        <h3 class="float-md-start mb-0">Le Chouette Coin</h3>
        <nav class="nav nav-masthead justify-content-center float-md-end">
            <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            <a class="nav-link" href="#">Produits</a>
            <a class="nav-link" href="#">Profil</a>
        </nav>
        </div>
    </header>
    <main class="px-3">
    <div class="row">
        <div class="col">
            <h3>S'inscrire</h3>
            <form
                action="#"
                method="POST">
                <div class="form-group">
                    <label for="InputEmail1">Adresse mail</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp"
                        name="email_signup" required>
                    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email avec qui que
                        ce soit.</small>
                </div>
                <div class="form-group">
                    <label for="InputUsername1">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="InputUsername1" aria-describedby="userHelp"
                        name="username_signup" required>
                    <small id="userHelp" class="form-text text-muted">Choisissez un nom d'utilisateur, il doit être unique
                        !</small>
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Choisissez un mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password1_signup" required>
                </div>
                <div class="form-group">
                    <label for="InputPassword2">Entrez votre mot de passe de nouveau</label>
                    <input type="password" class="form-control" id="InputPassword2" name="password2_signup" required>
                </div>
                <hr>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="Check1" required>
                    <label class="form-check-label" for="Check1">Accepter les <a href="#">termes et conditions</a></label>
                </div>
                <hr>
                <div class="form-group form-check">
                    <button type="submit" class="btn btn-primary" name="submit_signup" value="inscription">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
    </main>

    <footer class="mt-auto text-white-50">
        <p>Created by @NegiAlba </p>
    </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>