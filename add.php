<?php

require 'inc/db.php';

// Gestion du POST
$errorList = array();
// Si le formulaire a été soumis
if (!empty($_POST)) {
	// Je récupère tous les champs du formulaires
	// si isset($_POST['studentName']) == true alors récupère la valeur de $_POST['studentName'], sinon, la valeur ''
	$name = isset($_POST['studentName']) ? $_POST['studentName'] : '';
	/*équivalent à
	if (isset($_POST['studentName'])) {
		$name = $_POST['studentName'];
	}
	else {
		$name = '';
	}*/
	$firstname = isset($_POST['studentFirstname']) ? $_POST['studentFirstname'] : '';
	$email = isset($_POST['studentEmail']) ? $_POST['studentEmail'] : '';
	$birthdate = isset($_POST['studentBirhtdate']) ? $_POST['studentBirhtdate'] : '';
	$cityID = isset($_POST['cit_id']) ? intval($_POST['cit_id']) : 0;
	$countryID = isset($_POST['cou_id']) ? intval($_POST['cou_id']) : 0;
	$maritalID = isset($_POST['mar_id']) ? intval($_POST['mar_id']) : 0;
	$sessionID = isset($_POST['ses_id']) ? intval($_POST['ses_id']) : 0;

	if (empty($name)) {
		$errorList[] = 'Le nom est vide';
	}
	if (empty($firstname)) {
		$errorList[] = 'Le prénom est vide';
	}
	if (empty($email)) {
		$errorList[] = 'L\'email est vide';
	}
	else if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$errorList[] = 'L\'email est incorrect';
	}
	if (empty($birthdate)) {
		$errorList[] = 'La date de naissance est vide';
	}
	if (empty($cityID)) {
		$errorList[] = 'La ville est manquante';
	}
	if (empty($countryID)) {
		$errorList[] = 'La nationalité est manquante';
	}

	if (empty($sessionID)) {
		$errorList[] = 'La session est manquante';
	}
	if (empty($errorList)) {
		//echo 'je peux insérer en DB<br />';
		// Sinon, afficher le contenu du tableau $errorList dans view.php



	$sql = '
			INSERT INTO student (stu_name, stu_firstname, stu_email, stu_birthdate, cou_id, cit_id, mar_id, ses_id) VALUES (:name, :firstname, :email, :birthdate, :country, :city, :marital, :session)';

	$pdoStatement = $pdo->prepare($sql);

	 $pdoStatement->bindValue(':name',$name);
	 $pdoStatement->bindValue(':firstname',$firstname);
	 $pdoStatement->bindValue(':email',$email);
	 $pdoStatement->bindValue(':birthdate',$birthdate);
	 $pdoStatement->bindValue(':country',$countryID, PDO::PARAM_INT);
	 $pdoStatement->bindValue(':city',$cityID, PDO::PARAM_INT);
	 $pdoStatement->bindValue(':marital',$maritalID, PDO::PARAM_INT);
	 $pdoStatement->bindValue(':session',$sessionID, PDO::PARAM_INT);

if($pdoStatement->execute()){
	echo 'Done!!!';
}else{
	print_r($pdo->errorInfo());
}
}
}

// Fin POST

$etudiantListe = array();
$citiesList = array(
	1 => 'Arlon',
	2 => 'Luxembourg',
	3 => 'Verdun',
	4 => 'Longwy',
	5 => 'Rodange',
	6 => 'Pissange',
	7 => 'Pétange',
);
$countriesList = array(
	1 => 'France',
	2 => 'Luxembourg',
	3 => 'Belgique',
	4 => 'Chine',
	6 => 'Allemagne',
);
$maritalStatusList = array(
	1 => 'Célibataire',
	2 => 'Marié(e)',
	3 => 'Divorcé(e)',
	4 => 'Veuf/veuve',
);

$sessionList = array(
	1 => '1',
	2 => '2',
	3 => '3',

);


require 'inc/header.php';
require 'inc/add_view.php';
require 'inc/footer.php';

