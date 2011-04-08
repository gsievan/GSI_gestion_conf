<?php
define('FPDF_FONTPATH','fpdf/font/');
require('fpdf/fpdf.php');

include("_fonctions.inc.php");


// CONNEXION AU SERVEUR MYSQL PUIS S�LECTION DE LA BASE DE DONN�ES jpe

$connexion=connect();
if (!$connexion)
{
   ajouterErreur("Echec de la connexion au serveur MySql");
   afficherErreurs();
   exit();
}
if (!selectBase($connexion))
{
   ajouterErreur("La base de donnéees jpe est inexistante ou non accessible");
   afficherErreurs();
   exit();
}

$pdf=new FPDF();

$req = "select  visite.id as visiteId, visite.dateV, visite.heureDebut, visite.nbPlacesMin, visite.nbPlacesMax,
visite.nbVisiteursInscrits, entreprise.raisonSociale, entreprise.nomContact, entreprise.telContact from visite, entreprise
where entreprise.id = visite.idEntreprise
and not visite.visiteAnnulee ";
$rsVisite = mysql_query($req, $connexion);
   $lgVisite = mysql_fetch_array($rsVisite);
// Boucle de parcours des visites
while($lgVisite !=FALSE)
{
	$pdf->SetFont('Arial','',12);
	$pdf->AddPage();		// une page par visite
	$idVisite= $lgVisite['visiteId'];
	$rais= $lgVisite['raisonSociale'];
	$nomContact =$lgVisite['nomContact'];
	$date = $lgVisite['dateV'];
	$date = dateAnglaisVersFrancais($date);
	$heure = $lgVisite['heureDebut'];
	$telContact = $lgVisite['telContact'];
	$enTete=array('Entreprise','date', 'Heure' ,' Nom du contact', utf8_decode('téléphone'));
	for($i=0;$i<5;$i++)
		$pdf->Cell(35,8,$enTete[$i],1,0,'C');
	$valeurEnTete = array($rais,$date,$heure,$nomContact,$telContact);
	$pdf->Ln();
	for($i=0;$i<5;$i++)
		$pdf->Cell(35,8,$valeurEnTete[$i],1,0,'C');

	$pdf->Ln();
	$pdf->Ln();
	$nbPlacesMin = $lgVisite['nbPlacesMin'];
	$nbPlacesMax = $lgVisite['nbPlacesMax'];
	$nbPlacesUtilisees = $lgVisite['nbVisiteursInscrits'];
	$enTeteSituation= array('Nombre minimum de places','Nombre maximum de places', utf8_decode('Nombre de places réservées'));
	for($i=0;$i<3;$i++)
		$pdf->Cell(55,8,$enTeteSituation[$i],1,0,'C');
	$pdf->Ln();
	$valeurEnTeteSituation = array($nbPlacesMin,$nbPlacesMax,$nbPlacesUtilisees);
	for($i=0;$i<3;$i++)
		$pdf->Cell(55,8,$valeurEnTeteSituation[$i],1,0,'C');
    $req = "select inscription.nom, inscription.prenom, inscription.nbPersonnes From inscription, visite
    where visite.id = inscription.idVisite and inscription.idVisite = $idVisite ";
    $pdf->Ln();
    $pdf->Ln();
    $pdf->SetFont('Arial','',10);
    //$data=$pdf->LoadRequete($connexion,$req);
    $header=array('Nom','Prenom','Nombre de personnes');
     
    $rs = mysql_query($req, $connexion);
	 $lg = mysql_fetch_array($rs);
	 while ($lg != FALSE)
	 {
	   for($i=0;$i<3;$i++)
		$pdf->Cell(50,8,utf8_decode($lg[$i]),1,0,'C');
	  $lg = mysql_fetch_array($rs);
	  $pdf->Ln();
	 }
$lgVisite = mysql_fetch_array($rsVisite);
}
$pdf->Output();
?>