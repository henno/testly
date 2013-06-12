<table class="table table-bordered table-striped" style="width: 60%; margin: 20px">
	<thead>
	<tr>
		<th>Nr</th>
		<th>Nimi</th>
		<th>Grupp</th>
	</tr>
	</thead>
	<tbody>
	<?if(isset($students)):foreach( $students as $student):?>

	<tr>
		<td><?=$no++?></td>
		<td><a href="<?BASE_URL?>students/view/<?=$student["student_id"]?>" ><?=$student["student_name"]?></a></td>
		<td><?=$student["group_name"]?></td>
	</tr>
	<?endforeach;endif?>
	</tbody>
</table>