<?php

include("_debut.inc.php");

// ANNULER UNE VISITE
if(isset($_REQUEST['idVisite'])) 
{
	$idVisite=$_REQUEST['idVisite'];
	// Cas 1ère étape (on vient de listeVisiteursAPrevenir.php)

	if ($_REQUEST['action']=='suppressionDemandee')
	{
	   echo "
		<div id='corps'>
			<h5>Souhaitez-vous vraiment supprimer les inscrits ?<br>
			<a href='supprimerLesInscritsAUnevisite.php?action=suppressionConfirmee&idVisite=$idVisite'>
			Oui</a>&nbsp; &nbsp; &nbsp; &nbsp; <a href='listeVisiteursAPrevenir.php?idVisite=$idVisite'>Non</a>
			</h5>
		</div>";
	}

	// Cas 2ème étape (on vient de demander la suppression des inscrits

	if ($_REQUEST['action']=='suppressionConfirmee')
	{
	  $req = "delete from inscription where inscription.idVisite = $idVisite";
	 mysql_query($req, $connexion);
	   echo "
		<div id='corps'>
			<h5>Les visiteurs ont &eacute;t&eacute; supprim&eacute;s</h5>
			<a href='listeVisitesPourDetail.php'>Retour</a>
		</div>";
	}
}
else {
	echo "<div id='corps'><p>Aucune valeur dans la superglobale.</p></div>";
}
?>

</body>
</html>