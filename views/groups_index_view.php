<style>
	#groups-table.table-bordered
	{
		width: auto !important;
	}
	</style>
<button class=" btn btn-primary" type="button">Kustuta valitud</button>
<div id="right" style="float: right; width: 400px;display: inline-block">
<form method="POST" style="margin: 0;padding: 0"><input type="text" style="float: left"></form>
<button class="btn  btn-primary" type="submit" style="float: left;">Lisa grupp</button>
</div>
	<table id="groups-table" class="table table-bordered table-striped" style="margin-top: 50px">
		<thead>
		<tr>
			<th><input type="checkbox" style="margin-bottom: 4px">Select all </th>
			<th>Grupp</th>
			<th>Õpilaste arv</th>
		</tr>
		</thead>
		<tbody>
		<?if(!empty($groups)):foreach( $groups as $group):?>
		<tr>
				<td><input type="checkbox" style="margin-top: -2px"></td>
				<td style="padding-left: 20px;padding-right: 50px"> <a href="<?BASE_URL?>groups/selected/<?$group["group_id"]?>"><?=$group["group_name"]?></a> </td>
			<td style="padding-left: 20px;padding-right: 50px"> <?if(!empty($number)): echo $number[0]["number"];endif;?></td>
		</tr>
		<?endforeach;endif?>
		</tbody>
	</table>

