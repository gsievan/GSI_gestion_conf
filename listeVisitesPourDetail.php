<?php

include("_debut.inc.php");


echo "
<table width='60%' cellspacing='0' cellpadding='0' align='center'
class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td colspan='5'>Visites</td>
   </tr>";

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
		<tr class='ligneTabNonQuad'>
	        <td width='10%'>$date</td>
	        <td width='10%'>$debut</td>
		    <td width='10%'>$entreprise</td>
     	    <td width='10%'>$description</td>
            <td width='16%'><a href='detailVisite.php?idVisite=$idVisite'>Voir détail</a></td>
         </tr>";
      $lgVisite=mysql_fetch_array($rsVisite);
   }
   echo "</table>";
?>
