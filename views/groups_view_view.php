<style>
	#selected_group_table.table-bordered
	{
		width: auto !important;
		float: left;
	}
</style>

<div id="right" style="float: right; width: 400px;">
	<form class="form-inline" method="POST"  >
		<input id="name" class="input-small" placeholder="Lisa nimi" type="text" ">
		<input id="email" class="input-small" placeholder="Lisa e-mail" type="text"">
	</form>
	<button class="btn  btn-primary" onclick="add_student()" >Lisa õpilane</button>

</div>
<div id="left" style="float: left; width: 400px;display: inline-block">

<button class=" btn btn-primary" type="button">Kustuta valitud</button>

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
			<td style="padding-left: 20px;padding-right: 50px"> <?=$student["email"]?></td>
		</tr>
	<?endforeach;endif?>
	</tbody>
</table>
	</div>