<?php  

require 'inc/db.php';


if(!empty($_GET['search']) && strpos(($_GET['search']), ' ')){
	$rech = $_GET['search'];
	$search = explode(" ",$rech);
	$search1 = $search[0];
	$search2 = $search[1];

	$currentOffset = 0;
	$etudiantListe = array();

	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE stu_name LIKE :recherche OR stu_name LIKE :recherche1
	    OR stu_firstname LIKE :recherche OR stu_firstname LIKE :recherche1 
	    OR mar_name LIKE :recherche OR mar_name LIKE :recherche1
	    OR cit_name LIKE :recherche OR cit_name LIKE :recherche1
	    OR stu_email LIKE :recherche OR stu_email LIKE :recherche1
	';

	$pdoStatement = $pdo->prepare($sql);

	//Je donne la valeur au paramètre de requête
	$pdoStatement->bindValue(':recherche', '%'.$search1.'%');
	$pdoStatement->bindValue(':recherche1', '%'.$search2.'%');

	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());

	}else if ($pdoStatement->rowCount() > 0) {
		$etudiantListe = $pdoStatement->fetchAll();
		$nbRows= $pdoStatement->rowCount();

	}
} elseif(!empty($_GET['search'])) {
	$rech = $_GET['search'];

$currentOffset = 0;
	$etudiantListe = array();

	$sql = '
		SELECT stu_id, stu_name, stu_firstname, cou_name, cit_name, mar_name, stu_email, stu_birthdate AS birthdate
		FROM student
		LEFT OUTER JOIN country ON country.cou_id = student.cou_id
		LEFT OUTER JOIN city ON city.cit_id = student.cit_id
		LEFT OUTER JOIN marital_status ON marital_status.mar_id = student.mar_id
		WHERE stu_name LIKE :recherche
	    OR stu_firstname LIKE :recherche
	    OR mar_name LIKE :recherche
	    OR cit_name LIKE :recherche
	    OR stu_email LIKE :recherche
	';

	$pdoStatement = $pdo->prepare($sql);

	//Je donne la valeur au paramètre de requête
	$pdoStatement->bindValue(':recherche', '%'.$rech.'%');

	if ($pdoStatement->execute() === false) {
		print_r($pdo->errorInfo());

	}else if ($pdoStatement->rowCount() > 0) {
		$etudiantListe = $pdoStatement->fetchAll();
		$nbRows= $pdoStatement->rowCount();

	}


}


require 'inc/header.php';
require 'inc/list_view.php';
require 'inc/footer.php';





