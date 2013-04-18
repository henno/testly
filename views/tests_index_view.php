<p>
	<a class="btn btn-large btn-primary" href="http://google.com">Lisa uus test</a>
</p>
<table id="tests-table" class="table table-bordered table-striped">
	<thead>
	<th>Testi nimi</th>
	<th>Koostaja</th>
	<th>Aeg</th>
	<th>Tegevused</th>
	</thead>
	<tbody>
	<?if ( !empty ($tests)): foreach($tests as $test):?>
	<tr id="test<?=$test['test_id']?>">
		<td><?=$test['name']?></td>
		<td><?=$test['username']?></td>
		<td><?=$test['date']?></td>
		<td><?="vaata"?><i class="icon-pencil"></i></td>
	</tr>
	<? endforeach; endif ?>
	</tbody>
</table>