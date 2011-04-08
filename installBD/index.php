<?php // installation automatique d'une base MySQL ©PCo2007

// paramètres de connexion
define('SERVEUR', 'localhost');
define('BD', 'jpe');
define('UTIL', 'root');


// paramètres d'installation
define('SCRIPT', BD.'.sql'); // [!] script au format UTF-8
define('REDIR', '../index.php');
define('AFFICHER', true);

$infos = array();
function afficheInfos() {
	global $infos;
	header('Content-Type: text/html; charset=utf-8');
	echo '<h4><a href="'.REDIR.'">Retour application</a></h4>';
	foreach($infos as $info) {
		echo $info.'<br/>';
	}
}

/**
 * Alternative iconv() function when original is missing.
 * @param string $from original charset
 * @param string $to destination charset
 * @param string $string to convert
 * @return string converted
 * @author Jean-Pierre Morfin
 * @license Creative Commons By
 * @license http://creativecommons.org/licenses/by/2.0/fr/
 */
if(!function_exists("iconv"))
{
  function iconv($from, $to, $string)
  {
    $converted = htmlentities($string, ENT_NOQUOTES, $from);
    $converted = html_entity_decode($converted, ENT_NOQUOTES, $to);
    return $converted;
  }
}

// recrée la base de données
@$cnn = mysql_pconnect(SERVEUR, UTIL) or die(mysql_error());
mysql_query('SET CHARACTER SET utf8');
mysql_query("DROP DATABASE `".BD."`");
mysql_query("CREATE DATABASE `".BD."`");
mysql_select_db(BD, $cnn);	

// crée les tables, FK, Index, INSERT...
if ($fd = fopen(SCRIPT, "r")) {
	$req="";
  	while (!feof($fd)) {
		$ligne = fgets($fd, 4096);
	   	$ligneTest = iconv("UTF-8", "ISO-8859-1", $ligne);
	    if (substr($ligneTest, 0, 2) != '--') {
			if (trim($ligne)!='') $infos[] = $ligne;
			$req.=$ligne;
			if(mb_eregi(";",$ligne)) {
				$req=mb_eregi_replace(";","",$req);
				if(mysql_query($req)) { $infos[] = '<hr/>'; } 
				else { die(mysql_error()); } 
				$req='';  
      		}
    	}	
  	}
  	@fclose($fd);
}

if (AFFICHER) {
	afficheInfos();
} else {
	header('Location: '.REDIR);
}

?>
