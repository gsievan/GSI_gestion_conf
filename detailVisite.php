<?php

include("_debut.inc.php");
if (isset($_REQUEST['idVisite'])){
	
	$idVisite=$_REQUEST['idVisite'];

	// OBTENIR LE DÉTAIL DE L'ÉTABLISSEMENT SÉLECTIONNÉ

	$req="select * from visite, entreprise, activite
			where entreprise.idActivite=activite.id and visite.idEntreprise = entreprise.id
			and visite.id=$idVisite";
	$rsVisite = mysql_query($req, $connexion);
	$lgVisite = mysql_fetch_array($rsVisite);;

	$adresse=$lgVisite['adresse'];
	$ville=$lgVisite['ville'];
	$activite=$lgVisite['libelle'];
	$date = dateAnglaisVersFrancais($lgVisite['dateV']);
	$heureDebut=$lgVisite['heureDebut'];
	$nbPlacesMax=$lgVisite['nbPlacesMax'];
	$nbPlacesMin=$lgVisite['nbPlacesMin'];
	$description=$lgVisite['description'];
	$nbVisiteursInscrits=$lgVisite['nbVisiteursInscrits'];
	$nomEntreprise=$lgVisite['raisonSociale'];
	$nomContact=$lgVisite['nomContact'];
	$telContact=$lgVisite['telContact'];


	echo "
	<div id='corps'>
	<h2>Visite $idVisite : entreprise $nomEntreprise </h2>
	<table class='tabNonQuadrille'>
	   <tr class='ligneTabNonQuad'>
		  <td  width='20%'> Entreprise: </td>
		  <td>$nomEntreprise</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
			 <td  width='20%'> Activité: </td>
			 <td>$activite</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
		  <td> Adresse: </td>
		  <td>$adresse</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
		  <td> Ville: </td>
		  <td>$ville</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
		  <td> Jour: </td>
		  <td>$date</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
		  <td> heure: </td>
		  <td>$heureDebut</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
			 <td> Places reservées: </td>
			 <td>$nbVisiteursInscrits</td>
	   </tr>
	   <tr class='ligneTabNonQuad'>
		  <td> Nombre maximum de Places: </td>
		  <td>$nbPlacesMax</td>
	   </tr>
		<tr class='ligneTabNonQuad'>
			  <td> Nombre minimum de Places: </td>
			  <td>$nbPlacesMin</td>
	   </tr>

	   <tr class='ligneTabNonQuad'>
		  <td> contact : </td>
		  <td>$nomContact&nbsp; $telContact
		  </td>
	   </tr>

	</table>
	<p>
		<a href='listeVisitesPourDetail.php'>Retour liste des visites</a>
		<a href='listeInscrits.php?idVisite=$idVisite'>Liste des inscrits</a>
		<a href='annulerVisite.php?idVisite=$idVisite&action=AnnulationDemandee'>Annuler la visite</a>
	</p>
	</div>
	";
}
else {
	echo '<div id="corps">La superglobale est vide.<br><a href="index.php">Retour</a>.</p></div>'; 
}
?>
