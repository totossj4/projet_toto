
<?php if(!empty($_GET['search'])) :?>
	<?php if(!isset($nbRows)): ?>
	<h3>Voici le résultat de votre recherche "<?= $rech ?>", il y a 0 élément trouvé ! </h3>

	<?php else: ?>
	<h3>Voici le résultat de votre recherche "<?= $rech ?>", il y a <?=  $nbRows ?> élément(s) trouvé(s) ! </h3>
	<?php endif; ?>
<?php else :?>
	<h3>Liste des étudiants de la Session <?= $_GET['ses_id'] ?></h3>

<?php endif ?>


<?php if (isset($etudiantListe) && sizeof($etudiantListe) > 0) : ?>
	<table >
		<thead>
			<tr>
				<td style="background-color: black; color: #D3CABF">Nom</td>
				<td style="background-color: black; color: #D3CABF">Prénom</td>
				<td style="background-color: black; color: #D3CABF">Email</td>
				<td style="background-color: black; color: #D3CABF">Ville</td>
				<td style="background-color: black; color: #D3CABF">Nationalité</td>
				<td style="background-color: black; color: #D3CABF">Statut marital</td>
				<td style="background-color: black; color: #D3CABF">Date de naissance</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach ($etudiantListe as $currentEtudiant) : ?>
			<tr>
				<td><a href="student.php?stu_id=<?= $currentEtudiant['stu_id']?>"><?= $currentEtudiant['stu_name'] ?></a></td>
				<td><a href="student.php?stu_id=<?= $currentEtudiant['stu_id']?>"><?= $currentEtudiant['stu_firstname'] ?></a></td>
				<td><?= $currentEtudiant['stu_email'] ?></td>
				<td><?= $currentEtudiant['cit_name'] ?></td>
				<td><?= $currentEtudiant['cou_name'] ?></td>
				<td><?= $currentEtudiant['mar_name'] ?></td>
				<td><?= $currentEtudiant['birthdate'] ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>

<?php else :?>
aucun étudiant
<?php endif; ?>

<br/>
<br/>
<form>
	<!-- pour continuer à fournir ses_id dans l'URL -->
	<input type="hidden" name="ses_id" value="<?=$sessionID?>">
	<select name="nbPerPage">
		<option value="1">1 par page</option>
		<option value="2">2 par page</option>
		<option value="3">3 par page</option>
		<option value="4">4 par page</option>
		<option value="5">5 par page</option>
		<option value="6">6 par page</option>
	</select>
	<input type="submit" value="OK">

<br/>
<br/>


<a class= "monLien" href="list.php?ses_id=<?= $sessionID ?>&offset=<?= ($currentOffset+$nbPages) ?>">Suivant</a>

<?php if($currentOffset > 0) : ?>
<a class= "monLien" href="list.php?ses_id=<?= $sessionID ?>&offset=<?= ($currentOffset-$nbPages) ?>">Précédent</a>
<?php endif; ?>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>

<a href="<?php echo $_SERVER["HTTP_REFERER"]; ?>">Retour à la page précédente</a>