<?php

include("_debut.inc.php");

			/* CREATION D'UNE NOUVELLE INSCRIPTION */
// Récupération des variables provenant du formualaire précédent

$action=$_REQUEST['action'];
$idVisite=$_REQUEST['idVisite'];


// Recherche de quelle page on vient en évaluant la variable action passée
if($action == "creationDemandee")
{
	$nom='';
	$prenom='';
	$tel='';
	$cp='';
	$nbInscrits=0;
}
if ($action == "creationConfirmee")
{
	$nom=$_REQUEST['nom'];
	$prenom=$_REQUEST['prenom'];
	$tel=$_REQUEST['tel'];
	$cp=$_REQUEST['cp'];
	$nbInscrits=$_REQUEST['nbInscrits'];
	// Appel d'une fonction de vérification des valeurs saisies par l'utilisateur
	$nbErreurs = nbErreurs();
	verifierDonneesInscription($connexion, $idVisite,$nom, $prenom, $tel, $cp, $nbInscrits);
	if (nbErreurs()==0)
	 {
	 // enregistrement de la nouvelle inscription
		$nom=str_replace("'", "''", $nom);
	 	$prenom=str_replace("'", "''", $prenom);
	 	$req = "insert into inscription(nom,prenom,tel,cp,nbPersonnes,idVisite) values('$nom','$prenom','$tel','$cp',$nbInscrits,$idVisite)";
	 	mysql_query($req, $connexion);

	 // mise à jour du nombre d'inscrits pour la visite
	 	$req ="update visite set nbVisiteursInscrits=nbVisiteursInscrits + $nbInscrits where
	 		visite.id = $idVisite";
		mysql_query($req, $connexion);

	 }

}


// toujours
echo "
<form method='POST' action='creerInscription.php?idVisite=$idVisite&action=creationConfirmee'>


   <table width='85%' align='center' cellspacing='0' cellpadding='0'
  			 class='tabNonQuadrille'>
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Nouvelle inscription</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nom*: </td>
         <td><input type='text' name='nom' value='".$nom."' size='30'
         maxlength='45'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Prenom*: </td>
         <td><input type='text' name='prenom' value='".$prenom."' size='30'
         maxlength='45'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> teléphone*: </td>
         <td><input type='text' name='tel' value='".$tel."'
         size='10' maxlength='10'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Code Postal*: </td>
         <td><input type='text' name='cp'  value='".$cp."' size='5'
         maxlength='5'></td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Nombre de visiteurs à inscrire*: </td>
         <td><input type='text'  name='nbInscrits' value='$nbInscrits' size ='10'
         maxlength='10'></td>
      </tr> </table>";


   echo "
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='index.php'>Retour accueil</a>
         </td>
      </tr>
   </table>
</form>";

// En cas de validation du formulaire : affichage des erreurs ou du message de
// confirmation

   if ($action=='creationConfirmee' )
   {
      if (nbErreurs()!=0)
      {
         afficherErreurs();
      }
      else
      {
         echo "
         <h5><center>L'inscription a été effectuée</center></h5>";
		 echo "
		  <table align='center'>
			<tr>
			<td align='center'><a href='listeInscrits.php?idVisite=$idVisite'>Liste des inscrits</a>
			</td>
		</tr>
			</table>";
      }
}

?>
