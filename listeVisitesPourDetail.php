<?php

include("_debut.inc.php");


echo "
<div id='corps'>
<h2>Liste des visites</h2>
<table class='tabNonQuadrille' width='70%'>
<tr><th>Date</th><th>Heure de début</th><th>Entreprise</th><th>Description</th><th>Détails</th><th>Nouvelle inscription</th></tr>
";

   $req="select visite.id as idVisite, visite.dateV, visite.heureDebut, visite.description, entreprise.raisonSociale
   from visite, entreprise where visite.idEntreprise=entreprise.id and not visite.visiteAnnulee
   and visite.nbPlacesMax > visite.nbVisiteursInscrits order by visite.dateV ";
   $rsVisite = mysql_query($req, $connexion);
   $lgVisite = mysql_fetch_array($rsVisite);
   // BOUCLE SUR LES VISITES
   while ($lgVisite != FALSE)
   {
      $idVisite = $lgVisite['idVisite'];
      $date = dateAnglaisVersFrancais($lgVisite['dateV']);
      $debut = $lgVisite['heureDebut'];
      $entreprise= $lgVisite['raisonSociale'];
      $description = $lgVisite['description'];

      echo "
		<tr>
	        <td width='10%'>$date</td>
	        <td width='10%'>$debut</td>
		    <td width='10%'>$entreprise</td>
     	    <td width='10%'>$description</td>
            <td width='10%'><a href='detailVisite.php?idVisite=$idVisite'>Voir détail</a></td>
			<td width='10%'><a href='creerInscription.php?idVisite=$idVisite&action=creationDemandee'>Inscription</a></td>
         </tr>";
      $lgVisite=mysql_fetch_array($rsVisite);
   }
   echo "</table></div>";
?>
