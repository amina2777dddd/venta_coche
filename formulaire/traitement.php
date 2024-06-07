<?php
include_once("BDD/inc.php");

// Vérification des jetons

$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$coleur = isset($_POST["coleur"]) ? $_POST["coleur"] : "";
$marque = isset($_POST["marque"]) ? $_POST["marque"] : "";
$modele = isset($_POST["modele"]) ? $_POST["modele"] : "";
$km = isset($_POST["km"]) ? $_POST["km"] : "";
$etat_voiture = isset($_POST["etat_voiture"]) ? $_POST["etat_voiture"] : "";
$annee_sortie = isset($_POST["annee_sortie"]) ? $_POST["annee_sortie"] : "";
$prix= isset($_POST["prix"]) ? $_POST["prix"] : "";





$erreurs = [];

// Vérification du nom
if (!preg_match("/^[A-Za-z0-9\x{00c0}-\x{00ff}] {5,250}$/", $nom)) {
    $erreurs["nom"] = "Le format du nom est invalide";
}

if (!preg_match("/^[A-Za-z0-9\x{00c0}-\x{00ff}] {5,250}$/u", $prenom)) {
    $erreurs["prenom"] = "Le format du nom est invalide";
}




// Vérification de l'email
// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $erreurs["email"] = "L'email n'est pas valide";
// }

// Vérification du mot de passe
// if (!preg_match("/^[A-Za-z0-9_$]{8,}$/", $password)) {
//     $erreurs["password"] = "Le format du mot de passe n'est pas valide";
// }

// Protection XSS
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);
$email = htmlspecialchars($email);
$coleur= htmlspecialchars($coleur);
$marque= htmlspecialchars($marque);
$modele= htmlspecialchars($modele);
$km= htmlspecialchars($km);
$etat_voiture= htmlspecialchars($etat_voiture);
$annee_sortie= htmlspecialchars($annee_sortie);
$prix= htmlspecialchars($prix);


 
if (count($erreurs) > 0) {
    $_SESSION["donnees"]["nom"] = $nom;
    $_SESSION["donnees"]["prenom"] = $prenom;
    $_SESSION["donnees"]["email"] = $email;
    $_SESSION["donnees"]["coleur"] = $coleur;
    $_SESSION["donnees"]["marque"] = $marque;
    $_SESSION["donnees"]["modele"] = $modele;
    $_SESSION["donnees"]["km"] = $km;
    $_SESSION["donnees"]["etat_voiture"] = $etat_voiture;
    $_SESSION["donnees"]["annee_sortie"] = $annee_sortie;
    $_SESSION["donnees"]["prix"] = $prix;


    $_SESSION["erreurs"] = $erreurs;
    echo "Désolé, les champs ne sont pas corrects";
    echo "<a href='formulaire.php'>Vers la page formulaire</a>";
    exit(); // Ajouté pour arrêter l'exécution en cas d'erreurs
}

// Parcourir le tableau et valider les entrées
$tableauDonnes = [];
foreach ($_POST as $key => $val) {
    $tableauDonnes[":" . $key] = isset($val) && !empty($val) ? htmlspecialchars($val) : null;
}

// Cryptage du mot de passe
// $tableauDonnes[":password"] = password_hash($password, PASSWORD_BCRYPT);

include_once("BDD/inc.php");
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_password);
    // Options de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Préparation de la requête pour vérifier si l'email existe dans la base
    // $sql = "SELECT COUNT(*) as nb FROM venta WHERE email=?";
    // $qry = $pdo->prepare($sql);
    // $qry->execute([$tableauDonnes[":email"]]);
    // $row = $qry->fetch();

    // Vérification si l'email existe
    // if ($row["nb"] > 0) { 
    //     echo "L'email existe déjà dans la base de données";
    //     echo "<a href='formulaire.php'>Vers la page d'inscription</a>";
    // } else {


        $sql = "INSERT INTO venta (nom, prenom, email, coleur, marque, modele, km, etat_voiture, annee_sortie, prix) VALUES (:nom, :prenom,  :email, :coleur, :marque, :modele, :km, :etat_voiture, :annee_sortie, :prix)";
        $qry = $pdo->prepare($sql);
        $qry->execute($tableauDonnes);
        unset($pdo);
        echo "Vous êtes bien inscrit";
        echo "<a href='accueil.php'>Vers la page d'accueil</a>";


} 
catch (PDOException $err) {
    // Gestion des erreurs
    $_SESSION["compte-erreur-sql"] = $err->getMessage();
    header("location:pageerreur.php");
    exit();
}

?>

