<?php require 'inc/config.php'; ?>
<?php
    $alert = false;

    //? Etape 1 : Vérification du remplissage du formulaire
    if(!empty($_POST['email_login']) && !empty($_POST['password_login']) && isset($_POST['submit_login'])){
        //? Etape 2 : Initialisation des variables + assainissement via htmlspecialchars
        $email = htmlspecialchars($_POST['email_login']);
        $password = htmlspecialchars($_POST['password_login']);
        // var_dump($password);
        try{
            $sqlMail = "SELECT * FROM users WHERE email = '{$email}'";
            $resultMail = $connect->query($sqlMail);
            $user = $resultMail->fetch(PDO::FETCH_ASSOC);
            // var_dump($user);
            if($user){
                $dbpassword = $user['password'];
                if(password_verify($password, $dbpassword)){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['username'] = $user['username'];

                    $alert = true;
                    $type = 'success';
                    $message = "Vous êtes désormais connectés";
                    unset($_POST);
                }else{
                    $alert = true;
                    $type = 'danger';
                    $message = "Le mot de passe est erroné";
                    unset($_POST);
                }
            }else{
                $alert = true;
                $type = 'warning';
                $message = "Ce compte n'existe pas";
                unset($_POST);
            }
        } catch(PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
    }

/**
 * ! Etapes logiques de la connexion :
 * 
 * TODO : Vérif intro
 * 
 * TODO : Vérification de l'email
 * 
 * TODO : Vérification du mot de passe associé à l'email
 * 
 * TODO : Connexion via création d'une session
 * 
 * TODO : Messages d'erreur
 */
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
            <h3>Se connecter</h3>
            <?php echo $alert ? "<div class='alert alert-{$type} mt-2'>{$message}</div>" : ''; ?>
            <form
                action="#"
                method="POST">
                <div class="form-group">
                    <label for="InputEmail1">Adresse mail</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp"
                        name="email_login" required>
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Entrez votre mot de passe</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password_login" required>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit_login" value="connexion">Se connecter</button>
                </div>
            </form>
            <hr>
            <div class="row">
                <div class="col">
                    <p>Vous ne possédez pas de compte ? <a href="./signin.php">Inscrivez-vous ici </a></p>
                </div>
            </div>
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