<?php
include("_debut.inc.php");


// AFFICHER L'ENSEMBLE DES INSCRITS A UNE VISITE
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// INSCRIT

	$idVisite = $_REQUEST['idVisite'];
   $req="select inscription.id as idInscription, inscription.nom, inscription.prenom,inscription.tel,
      inscription.nbPersonnes, visite.dateV, visite.heureDebut,visite.nbVisiteursInscrits, entreprise.raisonSociale from visite, inscription, entreprise
   where inscription.idVisite=visite.id and entreprise.id=visite.idEntreprise and visite.id =$idVisite";
   $rsInscription = mysql_query($req, $connexion);
   $lgInscription = mysql_fetch_array($rsInscription);
   $date = $lgInscription['dateV'];
   //Utilisation d'une fonction de conversion de date pour l'afficher au format français
	$date = dateAnglaisVersFrancais($date);
   $heureDebut = $lgInscription['heureDebut'];
	$nbVisiteursInscrits = $lgInscription['nbVisiteursInscrits'];
   $entreprise= $lgInscription['raisonSociale'];
echo "
<table width='60%' cellspacing='0' cellpadding='0' align='center'
class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad' >
      <td colspan='5'>$entreprise $date $heureDebut </td>
   </tr>
   <tr class='enTeteTabNonQuad' align='left'>
         <td >Nom</td>
         <td >Prenom</td>
         <td >téléphone</td>
         <td >Nb de personnes</td>
   </tr>
   ";


   // BOUCLE SUR LES VISITEURS
   while ($lgInscription != FALSE)
   {
      $idInscription = $lgInscription['idInscription'];
      $nom = $lgInscription['nom'];
      $prenom = $lgInscription['prenom'];
	  $tel = $lgInscription['tel'];
      $nbPersonnes = $lgInscription['nbPersonnes'];
      echo "
		<tr class='ligneTabNonQuad'>

         <td width='15%'>$nom</td>

         <td width='15%'>$prenom</td>
		<td width='15%'>$tel</td>
         <td width='16%' >$nbPersonnes personnes</td>


         </tr>";
      $lgInscription=mysql_fetch_array($rsInscription);
   }
   echo "

</table>
<table align='center'>
	<tr>
         <td colspan='2' align='center'><a href='index.php'>Retour</a>
         </td>";
 // on ne propose de supprimer les inscrits que s'il y en a
 if($nbVisiteursInscrits != 0)
 {
	 echo "
          <td colspan='2' align='center'><a href='supprimerLesInscritsAUneViste.php?idVisite=$idVisite&action=suppressionDemandee'>Supprimer ces inscriptions</a>
         </td>";
 }
 echo "
 	</tr>
</table>";



?>

</body>
</html>