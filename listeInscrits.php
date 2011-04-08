<?php

include("_debut.inc.php");

   $idVisite = $_REQUEST['idVisite'];
// AFFICHER LES INFORMATIONS SUR LA VISITE SAUF SI ON A SUPPRIME TOUTES LES INSCRIPTIONS (idVisite vide dans ce cas)

   if (!empty($idVisite))
   {
     
       $req1="select visite.dateV, visite.heureDebut,
	   visite.nbVisiteursInscrits, entreprise.raisonSociale
       from visite, entreprise
	   where entreprise.id=visite.idEntreprise and visite.id =$idVisite";
	   $rsVisite = mysql_query($req1, $connexion);
	   $lgVisite = mysql_fetch_array($rsVisite);

	   //Utilisation d'une fonction de conversion de date pour l'afficher au format français
	   $jour = dateAnglaisVersFrancais($lgVisite['dateV']);

	   $heureDebut = $lgVisite['heureDebut'];
	   $nbVisiteursInscrits = $lgVisite['nbVisiteursInscrits'];
	   $entreprise= $lgVisite['raisonSociale'];

	   // AFFICHE l'ENTETE DU TABLEAU
	   echo "
	   <table width='60%' cellspacing='0' cellpadding='0' align='center' class='tabNonQuadrille'>
	      <tr class='enTeteTabNonQuad'>
	         <td colspan='5'>$entreprise le $jour à $heureDebut inscrits : $nbVisiteursInscrits personnes </td>
	      </tr>";

// AFFICHER L'ENSEMBLE DES INSCRITS A UNE VISITE
// TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR  INSCRIT

// ON COMMENCE PAR TESTER S'IL Y A DES INCRITS A LA VISITE
	   if( $nbVisiteursInscrits != 0)
	   {
	   		$req2="select inscription.id as idInscription, inscription.nom, inscription.prenom, inscription.nbPersonnes
	   		from inscription
			where inscription.idVisite = $idVisite";
	   	    $rsInscription = mysql_query($req2, $connexion);
	   		$lgInscription = mysql_fetch_array($rsInscription);
// BOUCLE SUR LES INSCRIPTIONS
	   		while ($lgInscription != false)
	   		{
	      		$idInscription = $lgInscription['idInscription'];
	      		$nom = $lgInscription['nom'];
	      		$prenom = $lgInscription['prenom'];
	      		$nbPersonnes = $lgInscription['nbPersonnes'];
	      		echo "
					<tr class='ligneTabNonQuad'>
		        		<td width='10%'>$nom</td>
		        		<td width='10%'>$prenom</td>
						<td width='10%'>$nbPersonnes places</td>
	   		    		<td width='16%' >
	         				<a href='supprimerUneInscription.php?idInscription=$idInscription&action=suppressionDemandee'>
	         				Supprimer l'inscription</a></td>
	        		</tr>";
	       			$lgInscription=mysql_fetch_array($rsInscription);
	       	 }
	    }
	   echo "</table>";
   }
   
   echo "<table align='center'>
		<tr>
         	<td colspan='2' align='center'><a href='listeVisitesPourDetail.php'>Retour liste des visites</a>
         	</td>
      	</tr>
	</table>";
?>
