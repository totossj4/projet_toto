
<h3>Sessions à ESCH BELVAL</h3>

<ul>

<?php foreach($sessionList as $key=>$value) :?>

	<li><a href="list.php?ses_id=<?= $value['ses_id'] ?>">du <?= $value['ses_opening'] ?> au <?= $value['ses_ending'] ?> </a></li>

<?php endforeach; ?>

</ul>

<table>
	<thead>
		<tr>
			<td style="background-color: black; color: #D3CABF">Ville</td>
			<td style="background-color: black; color: #D3CABF">Nombre d'étudiants</td>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($triParCity as $key => $value) : ?>
		<tr>
			<td><?= $value['cit_name'] ?></td>
			<td><?= $value['nb_etudiant'] ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<br/>
<br/>
<br/>
<br/>

<a href="add.php">Ajouter des infos</a>
