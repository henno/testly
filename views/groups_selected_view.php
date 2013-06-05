<div id="left" style="float: left; width: 400px;display: inline-block">
	<button class=" btn btn-primary" type="button">Kustuta valitud</button>
</div>

<div id="right" style="float: right; width: 400px;display: inline-block">
	<form method="POST" style="margin: 0;padding: 0"><input type="text" style="float: left"><input type="text" style="float: left"></form>
	<button class="btn  btn-primary" type="submit" style="float: left;">Lisa grupp</button>
</div>
<table id="selected_group_table" class="table table-bordered table-striped" style="margin-top: 50px">
	<thead>
	<tr>
		<th><input type="checkbox" style="margin-bottom: 4px">Select all </th>
		<th>Nimi</th>
		<th>E-mail</th>
	</tr>
	</thead>
	<tbody>
	<?if(!empty($students)):foreach( $students as $student):?>
		<tr>
			<td><input type="checkbox" style="margin-top: -2px"></td>
			<td style="padding-left: 20px;padding-right: 50px"> <?=$student["student_name"]?> </td>
			<td style="padding-left: 20px;padding-right: 50px"> <?if(!empty($number)): echo $number[0]["number"];endif;?></td>
		</tr>
	<?endforeach;endif?>
	</tbody>
</table>