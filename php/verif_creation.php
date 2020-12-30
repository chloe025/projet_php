<?php
include('../model/bdd_connexion.php');
if (isset($_POST['mdp2']) AND isset($_POST['mdp'])){
    // on retire les balises html si elles sont rentrées
    $_POST['mdp'] = htmlspecialchars($_POST['mdp']);
    $_POST['mdp2'] = htmlspecialchars($_POST['mdp2']);
    // si les mots de passe correspondent et sont inférieurs à 8 caractères
    if ($_POST['mdp'] == $_POST['mdp2'] && strlen($_POST['mdp']) < 8){
        $_POST['mail'] = htmlspecialchars($_POST['mail']);
        // on vérifie si l'adresse mail contient le format demandé
        // [a-z0-9._-] on autorise les lettres, chiffres, . _ -
        // + signifie au moins un caractère
        // @ est attendu
        // [a-z0-9._-]{2,} on attend au minimum 2 caractères
        // \. on attend un point (le \ sert à échapper)
        // [a-z]{2,4} juste des lettres sont autorisées, min 2, max 4
        if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail'])){
            if (isset($_POST['nom']))
               $nom = htmlspecialchars(strtoupper($_POST['nom']));
            if (isset($_POST['prenom']))
                $prenom = htmlspecialchars(strtolower($_POST['prenom']));
            if (isset($_POST['mail']))
                $mail = htmlspecialchars($_POST['mail']);
            if (isset($_POST['mdp']))
                $mdp = password_hash(htmlspecialchars($_POST['mdp']), PASSWORD_DEFAULT);
            
            $req = $bdd->prepare('SELECT adressemail from redacteur where adressemail = ?');
            $req->execute(array($mail));
            $response = $req->fetch();
            if ($response['adressemail'] == $mail) {    
                ?>
                <script language="javascript" type="text/javascript">
                    alert("Adresse mail déjà existante!");
                    history.back(); //permet de retourner à la création du compte après l'alerte
                </script>
                <?php
            }
            else{
                $req->closeCursor();
                $req = $bdd->prepare('INSERT INTO redacteur(nom,prenom,adressemail,motdepasse) VALUES(:nom, :prenom, :adressemail, :motdepasse)');
                $req->execute(array(
                    'nom'=> $nom,
                    'prenom'=>$prenom,
                    'adressemail' => $mail,
                    'motdepasse' => $mdp
                ));

                // on autorise la connexion
                session_start();
                $req->closeCursor();
                $req = $bdd->prepare('SELECT idredacteur from redacteur where adressemail = ?');
                $req->execute(array($mail));
                $result = $req->fetch();
                $_SESSION['id_user'] = $result['idredacteur'];
                $req->closeCursor();
                header('Location: ../index.php');
            }
        }
        else{
        ?>
            <script language="javascript" type="text/javascript">
                alert("veuillez entrer une adresse mail valide");
                history.back();
            </script>
        <?php
        }
    }
    else{
    ?>
        <script language="javascript" type="text/javascript">
            alert("les mots de passe ne correspondent pas ou le mot de passe fait plus de 7 caractères");
            history.back();
        </script>
    <?php
    }
}