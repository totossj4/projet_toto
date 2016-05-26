<?php

require '../inc/db.php';
require 'students_session2.php';

//je fais une première requête pour récupèrer tous les mails déja existants
$sql1='
	SELECT stu_email
	FROM student
';
//ici je crée un premier tableau (attention tableau a 2 dimensions!!!) qui va contenir les emails de ma requête SQL1 (faire un print_r après le fetchAll pour vérifier)
$emailListe = array();

//lancement de ma requête pour stocker mes mails dans mon tableau
$pdoStatement1 = $pdo->query($sql1);
$emailListe = $pdoStatement1->fetchAll();
//print_r($emailListe);

//je crée un deuxième tableau à une dimension qui stockera plus simplement grace a une boucle mes emails du premier au deuxieme tableau
$emailListeFinal= array();
//je crée une boucle qui va stocker les emails de $emailListe vers $emailListeFinal
for ($j=0; $j<sizeof($emailListe); $j++){
	$emailListeFinal[$j]=$emailListe[$j][0]; 
}
// un petit print_r pour debbug ^^
print_r($emailListeFinal);

//je lance une deuxieme requête SQL pour inserer mes nouvelles données (ne pas oublier de renseigner le ses_id!!!!!!!!)
$sql = ' INSERT INTO student (ses_id, stu_name, stu_firstname, stu_email, stu_birthdate, stu_sex, stu_with_experience, stu_is_leader) 
	VALUES (:session, :name, :firstname, :email, :birthdate, :sex, :experience, :leader)
';
//je fais une boucle for et NON un foreach car je comprends mieux le fonctionnement du for (simple choix)
for ($i=0; $i<sizeof($studentsList); $i++){
	// foreach ($studentsList as $key=>$value) {
	//$key = $i;
	//$value = $studentsList[$i];

	//a chaque fois je renseigne le nom de mes variables 
	$name = $studentsList[$i]['name']; // $value['name']
	$firstname = $studentsList[$i]['firstname'];
	$email = $studentsList[$i]['email'];
	$birthdate = $studentsList[$i]['birthdate'];
	$sex = $studentsList[$i]['sex'];
	$with_experience = $studentsList[$i]['with_experience'];
	$is_leader = $studentsList[$i]['is_leader'];

	//j'initialise une varibale à false
	$emailEx= false;
	
	//je vérifie si les emails insérés figurent dans mon tableau de stockage avec une petite fonction IN_ARRAY(à voir son utilité dans php.net)
	if(in_array($studentsList[$i]['email'], $emailListeFinal)){

		//si on trouve un email semblable notre variable devient true, donc on insert pas cette requête dans la BD
		$emailEx = true;
	}
	
	// si l'email n'existe pas on peut inserer nos données dans la boucle tranquilou
	if($emailEx == false){
		$pdoStatement = $pdo->prepare($sql);
		$pdoStatement->bindValue(':name',$name);
		$pdoStatement->bindValue(':firstname',$firstname);
		$pdoStatement->bindValue(':email',$email);
		$pdoStatement->bindValue(':birthdate',$birthdate);
		$pdoStatement->bindValue(':sex',$sex);
		$pdoStatement->bindValue(':experience',$with_experience, PDO::PARAM_INT);
		$pdoStatement->bindValue(':leader',$is_leader, PDO::PARAM_INT);
		$pdoStatement->bindValue(':session',2, PDO::PARAM_INT);
		$pdoStatement->execute();
	}
	
} // FIN DE NOTRE BOUCLE FOR
/*
On veut insérer la liste complète des étudiants de la session 2 dans la table student.
On dispose de certaines informations dans le tableau se trouvant dans students_session2.php.
Cependant, des étudiants sont déjà renseignés dans la table student. Il ne faut donc ajouter que les étudiants n'y figurant pas.
Pour savoir si un étudiant est déjà dans la table, on se basera sur le champ "email".
D'ailleurs, pour plus de sécurité, on va ajouter un attribut d'unicité sur ce champ, dans la table student.

Copiez ces 2 fichiers dans un répertoire batch de votre projet Toto, puis éditez ce fichier pour effectuer les insertions en DB.
*/