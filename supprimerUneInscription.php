<?php

include("_debut.inc.php");

// ANNULER UNE INSCRIPTION D'UN VISITEUR

$idInscription=$_REQUEST['idInscription'];

//On récupère le nom et le prénom du visiteur
$req ="select inscription.nom, inscription.prenom, inscription.idVisite
from inscription
where inscription.id =$idInscription";
$rsInscription=mysql_query($req, $connexion);
$lgInscription = mysql_fetch_array($rsInscription);

$nom=$lgInscription['nom'];
$prenom=$lgInscription['prenom'];
$idVisite=$lgInscription['idVisite'];

// Cas 1ère étape (on vient de listeInscrits.php)

if ($_REQUEST['action']=='suppressionDemandee')
{
   echo "
   <br><center><h5>Souhaitez-vous vraiment supprimer l'inscription de $nom $prenom ?
   <br><br>
   <a href='supprimerUneInscription.php?action=suppressionConfirmee&idInscription=$idInscription'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='listeInscrits.php?idVisite=$idVisite'>Non</a></h5></center>";
}

// Cas 2ème étape (on vient de demander à supprimer l'inscription)

if ($_REQUEST['action']=='suppressionConfirmee')
{
	// Pour supprimer une inscription il faut faire deux choses :
	// - D'abord modifier le nombre d'inscrits à la visite
	$req ="select inscription.nbPersonnes from inscription where inscription.id = $idInscription";
   	$rsInscription=mysql_query($req, $connexion);
   	$lgInscription = mysql_fetch_array($rsInscription);
   	$nbPersonnes = $lgInscription['nbPersonnes'];
   	$req ="update visite set nbVisiteursInscrits=nbVisiteursInscrits - $nbPersonnes where
   			visite.id = $idVisite";
   	mysql_query($req, $connexion);

   // - Ensuite supprimer le visiteur
   	$req = "delete from inscription where inscription.id =$idInscription";
	mysql_query($req, $connexion);
   echo "
   <br><br><center><h5>L'inscription de $nom $prenom a été supprimée</h5>
   <br><br><center><h5><a href='listeInscrits.php?idVisite=$idVisite'>Liste des inscrits</a></h5>
   <a href='index.php?'>Retour</a></center>";
}
else
{
echo "
   
   <a href='index.php?'>Retour</a></center>";
}
?>
