
<h3>Vous êtes sur le dossier de <?= $etudiantListe[0]['stu_name'].' '.$etudiantListe[0]['stu_firstname'] ?></h3>

<?php if (isset($etudiantListe) && sizeof($etudiantListe) > 0) : ?>
	
<?php foreach ($etudiantListe as $currentEtudiant) : ?>
			
	Nom : <?= $currentEtudiant['stu_name'] ?></br>
	Prénom : <?= $currentEtudiant['stu_firstname'] ?></br>
	Email : <?= $currentEtudiant['stu_email'] ?></br>
	Ville : <?= $currentEtudiant['cit_name'] ?></br>
	Nationalité : <?= $currentEtudiant['cou_name'] ?></br>
	Statut marital : <?= $currentEtudiant['mar_name'] ?></br>
	Date de naissance : <?= $currentEtudiant['stu_birthdate'] ?></br>
	Signe Astro : <?= $traductionFr[$zodiacSign] ?>
<?php endforeach; ?>
		
<?php else :?>
	aucun étudiant
<?php endif; ?>

<?php 
require 'inc/footer.php';
 ?>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Retour à la page précédente</a>