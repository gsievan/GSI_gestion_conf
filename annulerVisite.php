<?php

include("_debut.inc.php");

// ANNULER UNE VISITE

// On récupère l'identifaint de visite du formulaire précédent
if(isset($_REQUEST['idvisite'])){
$idVisite=$_REQUEST['idVisite'];


// On récupère les informations de la visite pour les afficher
$req="select * from visite, entreprise, activite where entreprise.idActivite=activite.id
and visite.idEntreprise = entreprise.id and visite.id=$idVisite";
$rsVisite = mysql_query($req, $connexion);
$lgVisite = mysql_fetch_array($rsVisite);

$date=$lgVisite['dateV'];
//Utilisation d'une fonction de conversion de date pour l'afficher au format français
$date = dateAnglaisVersFrancais($date);
$heureDebut=$lgVisite['heureDebut'];
$nomEntreprise=$lgVisite['raisonSociale'];


	// Cas 1ère étape (on vient du formulaire detailVisite.php)

	if ($_REQUEST['action']=='AnnulationDemandee')
	{
	   echo "
	   <div id='corps'>
		<h5>Souhaitez-vous vraiment annuler la visite du $date par $nomEntreprise ?

	   <a href='annulerVisite.php?action=AnnulationConfirmee&idVisite=$idVisite'>
	   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
	   <a href='detailVisite.php?idVisite=$idVisite'>Non</a></h5>
	   </div>";
	}

	// Cas 2ème étape (on vient de demander à annuler la visite en cliquant sur 'oui')

	if ($_REQUEST['action']=='AnnulationConfirmee')
	{
	   // On modifie le champ 'etat' de la visite
	   $req = "update visite set visiteAnnulee='1' where visite.id =$idVisite";
		mysql_query($req, $connexion);
	   echo "<div id='corps'>
	   <br><br><center><h5>La visite du $date à $nomEntreprise été annulée</h5>
	   <br><br><center><h5><a href='listeVisiteursAPrevenir.php?idVisite=$idVisite'>Liste des inscrits à prévenir</a></h5>
	   <a href='index.php?'>Retour</a></div>";
	}
}

else {
	echo "<div id='corps'><p>Aucune valeur 'idVisite' dans la superglobale.</p></div>";
}

?>
