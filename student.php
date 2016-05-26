<?php

require 'inc/db.php';

if(!empty($_GET['stu_id'])){
	$studentID = $_GET['stu_id'];
} else{
	$studentID='';
}


$sql = '
	SELECT *
	FROM student
	LEFT OUTER JOIN country ON country.cou_id = student.cou_id
	LEFT OUTER JOIN city ON city.cit_id = student.cit_id
	LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
	WHERE stu_id = :etudiant
';
$pdoStatement = $pdo->prepare($sql);
//Je donne la valeur au paramètre de requête
$pdoStatement->bindValue(':etudiant', $studentID, PDO::PARAM_INT);


// Si erreur
if ($pdoStatement->execute() === false) {
	print_r($pdo->errorInfo());

}else if ($pdoStatement->rowCount() > 0) {
	$etudiantListe = $pdoStatement->fetchAll();
}

require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

$maDateFromDB=$etudiantListe[0]['stu_birthdate'];
$jour =substr($maDateFromDB, 8,2);
$mois =substr($maDateFromDB, 5,2);


  $zodiacSign = $calculator->calculate(intval($jour),intval($mois));

$traductionFr = array(
	'aquarius' => 'verseau',
	'pisces' => 'poisson',
	'aries' => 'bélier',
	'taurus' => 'taureau',
	'gemini' => 'gemeaux',
	'cancer' => 'cancer',
	'leo' => 'lion',
	'virgo' => 'vierge',
	'libra' => 'balance',
	'scorpio' => 'scorpion',
	'sagittarius' => 'sagittaire',
	'capricorn' => 'capricorne',

	);


require 'inc/header.php';

require 'inc/student_view.php';

require 'inc/footer.php';


?>