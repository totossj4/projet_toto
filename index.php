<?php
// Je me connecte à la DN
require 'inc/db.php';

//j'écris ma requête
$sql='
	SELECT ses_opening, ses_ending, ses_id
	FROM session
';
$pdoStatement = $pdo->query($sql);

//Si erreur
if($pdoStatement===false){
	print_r($pdo->errorInfo());
}

//sinon
else{
	//je récupère toutes les données
	$sessionList= $pdoStatement->fetchAll();
	//print_r($sessionList);
}

$sql1='
	SELECT COUNT(*) AS nb_etudiant,
	  city.cit_name
	FROM
	  student
	INNER JOIN
	  city ON city.cit_id = student.cit_id
	GROUP BY
	  cit_name
	';

$pdoStatement = $pdo->query($sql1);

if($pdoStatement===false){
	print_r($pdo->errorInfo());
}

//sinon
else{
	//je récupère toutes les données
	$triParCity= $pdoStatement->fetchAll();
	//print_r($sessionList);
}


//J'affiche ma page
require 'inc/header.php';
require 'inc/index_view.php';
require 'inc/footer.php';