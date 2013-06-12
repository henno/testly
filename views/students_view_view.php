<p style="color: graytext;margin-top: 30px;font-size: 14px"><?if(isset($student_group)):foreach($student_group as
                                                                                                  $student_data)	echo
	$student_data["student_name"] ;?>,
	<?echo	$student_data["group_name"];endif?></p>
<table class="table table-bordered table-striped" style="width: 60%; margin-left: 5px;margin-top: 20px">
	<thead>
	<tr>
		<th>Määratud test</th>
		<th>Punkte</th>
	</tr>
	</thead>
	<tbody>
	<?if(isset($tests)):foreach( $tests as $test):?>

	<tr>
		<td><?=$test["name"]?></td>
		<td>100</td>
	</tr>
	<?endforeach;endif?>
	</tbody>
</table>