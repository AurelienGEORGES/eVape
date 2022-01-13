<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vape</title>
</head>
<body>

<!--formulaire pour ajouter une e-cigarette ou un e-liquide-->

<form action="index.php" method="get" style="border: solid yellow 2px;"> 
        <h2>Pour ajouter un nouveau produit rentrez les champs suivant</h2>
        <label>référence</label>
            <input name="reference"  type="text" placeholder="référence" required/>
             <br />
         <label>nom du produit</label>
            <input  name="nom" type="text" placeholder="nom du produit" required/>
            <br />
        <label >description de l'article</label>
             <input name="descr" type="text" placeholder="rentrez votre descrption" required/>
             <br />
         <label>Prix d'achat</label>    
            <input  name="prixAchat" type="number" placeholder="Prix d'achat"  required/>
            <br />
        <label>Prix de vente</label>
            <input  name="prixVente" type="number" placeholder="Prix de vente" required/>
            <br />
        <label>Quantité</label>
            <input  name="quantite" type="number" placeholder="Rentrez votre quantité souhaitée" required/>
            <br />       
        <input type="submit" value="Ajouter"></input>    
</form>

<br />

<!--formulaire pour modifier une e-cigarette ou un e-liquide-->

<br />

<form action="index.php" method="get" style="border: solid pink 2px;"> 
        <h2>Formulaire de modification d'e-cigarette</h2>
        <p>rentrez la référence de la e-cigarette à modifier<p>
        <label>référence à modifier</label>
            <input name="referenceDeChangement"  type="text" placeholder="référence à modifier" required/>
             <br />
        <label>nouvelle référence</label>
            <input name="referenceModifiee"  type="text" placeholder="nouvelle référence" required/>
             <br />
         <label>nom du produit</label>
            <input  name="nomModifiee" type="text" placeholder="nouveaux nom du produit" required/>
            <br />
        <label >description de l'article</label>
             <input name="descrModifiee" type="text" placeholder="rentrez votre nouvelle descrption" required/>
             <br />
         <label>Prix d'achat</label>    
            <input  name="prixAchatModifiee" type="number" placeholder="rentrez votre nouveau Prix d'achat"  required/>
            <br />
        <label>Prix de vente</label>
            <input  name="prixVenteModifiee" type="number" placeholder="rentrez votre nouveau Prix de vente" required/>
            <br />
        <label>Quantité</label>
            <input  name="quantiteModifiee" type="number" placeholder="Rentrez votre nouvelle quantité souhaitée" required/>
            <br />       
        <input type="submit" value="Modifier"></input>    
</form>

<br />

<!--formulaire pour supprimer une e-cigarette ou un e-liquide-->

<br />

<form action="index.php" method="get" style="border: solid orange 2px;">
        <h2>Rentrez la ref de la e-cigarette à supprimer</h2>
        <label>Supprimer</label>
            <input  name="supprimer" type="text" placeholder="Rentrez la référence de la e-cigarette à supprimer" required/>
            <br />
        <input type="submit" value="supprimer"></input>
</form>

<br/>

<!--récupération des données envoyées par les formulaires-->

<?php
if ( isset ($_GET['reference'])){
    $reference = $_GET['reference']; 
} 
if  ( isset ($_GET['nom'])){
    $nom = $_GET['nom'];
}
if  ( isset ($_GET['descr'])){
    $description = $_GET['descr'];
}
if  ( isset ($_GET['prixAchat'])){
    $prixAchat = $_GET['prixAchat'];
}
if  ( isset ($_GET['prixVente'])){
    $prixVente = $_GET['prixVente'];
}
if  ( isset ($_GET['quantite'])){
    $quantite = $_GET['quantite'];
}
if ( isset ($_GET['referenceModifiee'])){
    $referenceModifiee = $_GET['referenceModifiee']; 
} 
if  ( isset ($_GET['nomModifiee'])){
    $nomModifiee = $_GET['nomModifiee'];
}
if  ( isset ($_GET['descrModifiee'])){
    $descriptionModifiee = $_GET['descrModifiee'];
}
if  ( isset ($_GET['prixAchatModifiee'])){
    $prixAchatModifiee = $_GET['prixAchatModifiee'];
}
if  ( isset ($_GET['prixVenteModifiee'])){
    $prixVenteModifiee = $_GET['prixVenteModifiee'];
}
if  ( isset ($_GET['quantiteModifiee'])){
    $quantiteModifiee = $_GET['quantiteModifiee'];
}
if  ( isset ($_GET['referenceDeChangement'])){
    $referenceDeChangement = $_GET['referenceDeChangement'];
}
if  ( isset ($_GET['supprimer'])){
    $supprimer = $_GET['supprimer'];
}
?>

<br/>

<!--Affichage de la base de e-cigarettes-->
<?php
//connexion
try 
{
    $mysqlClient = new PDO('mysql:host=localhost:3306;dbname=Vape;charset=utf8','root','Ekinox7777+');
} 
catch (Exception $e) {
    die('erreur : '.$e->getMessage());
}
//requete pour récupérer toutes les données de la base
$sqlQuery = 'SELECT * FROM Produits';
$ProduitsStatement = $mysqlClient -> prepare($sqlQuery);
$ProduitsStatement -> execute();
$Produits = $ProduitsStatement -> fetchAll();
?>
<!--affichage de la base de données sur le navigateur-->

<h1>Voici la base eVape avant suppression,ajout ou modification</h1>

<?php

//boucle pour afficher toute la base
foreach ($Produits as $Produit) {
?>
<p style="border: solid black 1px;"><?php echo 'ref = '.$Produit['ref'].' ; ', 'nom = '.$Produit['nom'].' ; ', 'description = '.$Produit['descr'].' ; ', 'prixAchat = '.$Produit['prixAchat'].' ; ', 'prixVente = '.$Produit['prixVente'].' ; ', 'quantite = '.$Produit['quantite'].' ; ', 'numéro = '.$Produit['numero']; ?></p>
<?php  
}

?>

<!--Commande supprimé--> 

<?php
if(isset($_GET['supprimer'])) {
?>
<h1>Voici la nouvelle base eVape après Suppression</h1>
<?php
$sql_select = 'SELECT * FROM Produits';
$sql_delete = "DELETE FROM Produits WHERE ref = '$supprimer'";

try {
$db = new PDO('mysql:host=localhost:3306;dbname=Vape;charset=utf8','root','Ekinox7777+');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$st = $db->prepare($sql_delete);
$st->execute();
$st = $db->prepare($sql_select);
$st->execute();
while ($ligne = $st->fetch()) {           
    echo "ref=$ligne[0] - nom=$ligne[1] - desc=$ligne[2] - prixAchat=$ligne[3] - prixVente=$ligne[4] - quantite=$ligne[5] - numero=$ligne[6]<br />\n";   
}
    $st = null;
    $db = null;
} catch (Exception $e) {
    die('erreur : '.$e->getMessage());
}
}
?>

<!--commande Ajouter-->
<?php
if(isset($_GET['nom'])) {
?>
<h1>Voici la nouvelle base eVape Après Ajout</h1>

<?php

$sql_select = 'SELECT * FROM Produits';
$sql_insert = 'INSERT INTO Produits(ref,nom,descr,prixAchat,prixVente,quantite) VALUES (:p1,:p2,:p3,:p4,:p5,:p6)';

try {
$db = new PDO('mysql:host=localhost:3306;dbname=Vape;charset=utf8','root','Ekinox7777+');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$st = $db->prepare($sql_insert);
$st->bindParam(':p1',$reference);
$st->bindParam(':p2',$nom);
$st->bindParam(':p3',$description);
$st->bindParam(':p4',$prixAchat);
$st->bindParam(':p5',$prixVente);
$st->bindParam(':p6',$quantite);
$reference = $_GET['reference'];
$nom = $_GET['nom'];
$description = $_GET['descr'];          
$prixAchat = $_GET['prixAchat'];
$prixVente = $_GET['prixVente'];
$quantite = $_GET['quantite'];
$st->execute();
$st = $db->prepare($sql_select);
$st->execute();
while ($ligne = $st->fetch()) {
             
    echo "ref=$ligne[0] - nom=$ligne[1] - descrption=$ligne[2] - prixAchat=$ligne[3] - prixVente=$ligne[4] - quantite=$ligne[5] - numero=$ligne[6]<br />\n";
  
}
    $st = null;
    $db = null;
} catch (Exception $e) {
    die('erreur : '.$e->getMessage());
}
}
?>

<!--commande Modifier-->
<?php
if(isset($_GET['referenceDeChangement'])) {
?>
<h1>Voici la nouvelle base eVape Après Modification</h1>

<?php

$sql_select = 'SELECT * FROM Produits';
$sql_modification = 'UPDATE Produits SET ref=:p1,nom=:p2,descr=:p3,prixAchat=:p4,prixVente=:p5,quantite=:p6 WHERE ref=:p7';

try {
$db = new PDO('mysql:host=localhost:3306;dbname=Vape;charset=utf8','root','Ekinox7777+');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$st = $db->prepare($sql_modification);
$st->bindParam(':p1',$referenceModifiee);
$st->bindParam(':p2',$nomModifiee);
$st->bindParam(':p3',$descriptionModifiee);
$st->bindParam(':p4',$prixAchatModifiee);
$st->bindParam(':p5',$prixVenteModifiee);
$st->bindParam(':p6',$quantiteModifiee);
$st->bindParam(':p7',$referenceDeChangement);
$referenceModifiee = $_GET['referenceModifiee'];
$nomModifiee = $_GET['nomModifiee'];
$descriptionModifiee = $_GET['descrModifiee'];          
$prixAchatModifiee = $_GET['prixAchatModifiee'];
$prixVenteModifiee = $_GET['prixVenteModifiee'];
$quantiteModifiee = $_GET['quantiteModifiee'];
$referenceDeChangement = $_GET['referenceDeChangement'];
$st->execute();
$st = $db->prepare($sql_select);
$st->execute();
while ($ligne = $st->fetch()) {
             
    echo "ref=$ligne[0] - nom=$ligne[1] - descrption=$ligne[2] - prixAchat=$ligne[3] - prixVente=$ligne[4] - quantite=$ligne[5] - numero=$ligne[6]<br />\n";
  
}
    $st = null;
    $db = null;
} catch (Exception $e) {
    die('erreur : '.$e->getMessage());
}
}
?>

</body>
</html>