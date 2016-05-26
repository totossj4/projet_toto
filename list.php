<?php

require 'inc/db.php';

if(!empty($_GET['ses_id'])){
	$sessionID = $_GET['ses_id'];
} else{
	$sessionID='';
}

$valeurList= array(1,2,3,4,5,6);



$nbPages =4;
$currentOffset = 0;

if (isset($_GET['offset'])){
	$currentOffset= intval($_GET['offset']);
}

$sql = '
	SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
	FROM student
	LEFT OUTER JOIN country ON country.cou_id = student.cou_id
	LEFT OUTER JOIN city ON city.cit_id = student.cit_id
	LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
	WHERE ses_id = :sessionIbra
	LIMIT :offset, :nbPerPage
';
$pdoStatement = $pdo->prepare($sql);

//Je donne la valeur au paramètre de requête
$pdoStatement->bindValue(':sessionIbra', $sessionID, PDO::PARAM_INT);
$pdoStatement->bindValue(':nbPerPage', $nbPages, PDO::PARAM_INT);
$pdoStatement->bindValue(':offset', $currentOffset, PDO::PARAM_INT);


// Si erreur
if ($pdoStatement->execute() === false) {
	print_r($pdo->errorInfo());

}else if ($pdoStatement->rowCount() > 0) {
	$etudiantListe = $pdoStatement->fetchAll();

}



require 'inc/header.php';
require 'inc/list_view.php';
require 'inc/footer.php';
