<style>
	#groups-table.table-bordered
	{
		width: auto !important;
	}
	</style>
<button class=" btn btn-primary" type="submit" onclick="delete_group()">Kustuta valitud</button>
<div id="right" style="float: right; width: 400px;display: inline-block">
<form id="add_group" method="POST"  style="margin: 0;padding: 0"><input type="text" id="add" style="float: left"></form>
<button class="btn  btn-primary" style="float: left;" onclick="add_group()">Lisa grupp</button>
</div>
	<table id="groups-table" class="table table-bordered table-striped" style="margin-top: 50px">
		<thead>
		<tr>
			<th><input type="checkbox" onClick="toggle(this)"style="margin-bottom: 4px">Select all </th>
			<th>Grupp</th>
			<th>Õpilaste arv</th>
		</tr>
		</thead>
		<tbody>

		<?if(isset($groups)):foreach( $groups as $group):?>

		<tr id="<?$group["group_id"]?>">
			<td><input name="checkbox" type="checkbox" class="checkbox" value="<?=$group['group_id']?>"></td>
				<td id="group_name1" style="padding-left: 20px;padding-right: 50px">
					<a href="<?BASE_URL?>groups/view/<?=$group["group_id"]?>"><?=$group["group_name"]?></a> </td>
			<td style="padding-left: 20px;padding-right: 50px"> <?if(!empty($group["number"])): echo $group["number"][0];endif;
				?></td>
		</tr>
		<?endforeach;endif?>
		</tbody>
	</table>



