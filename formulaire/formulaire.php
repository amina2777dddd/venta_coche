<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<form action="traitement.php" method="post">
        <label for="nom">inserer votre nom:</label>
        <input type="text" name="nom" id="" pattern="[/^[A-Za-z0-9\x{00c0}-\x{00ff}] {5,250}$/u]">

        <label for="prenom">inserer votre prenom:</label>
        <input type="text" name="prenom" id="" pattern="[/^[A-Za-z0-9\x{00c0}-\x{00ff}] {5,250}$/u]">

        <label for="email">inserer votre email:</label>
        <input type="email" name="email" id="">

        <label for="coleur">coleur:</label>
        <input type="text" name="coleur" id="">

        <label for="marque">marque:</label>
        <input type="text" name="marque" id="">

        <label for="modele">modele:</label>
        <input type="text" name="modele" id="">

        <label for="km">km:</label>
        <input type="number" name="km" id="">

        <label for="etat_voiture">etat voiture:</label>
        <input type="text" name="" id="etat_voiture">

        <label for="annee_sortie"> annee sortie:</label>
        <input type="date" name="annee_sortie" id="">

        <label for="prix">prix:</label>
        <input type="number" name="prix" id="">

        <input type="submit" value="envoyer">
    </form>
</body>
</html>