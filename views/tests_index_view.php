<style>
	#tests-table.table-bordered,
	{
		width: auto !important;

	}

	#tests-table.table-bordered,
	#tests-table.table-bordered tr td#date {
		width: auto !important;
	}
	#tests-table.table-bordered tr td#delete {
		width: auto !important;
	}

	#tests-table.table-bordered tr td#name {
		width: 400px !important;
	}

	#tests-table.table-bordered tr td#username {
		width: 400px !important;
	}


</style>
<p>
	<a class="btn btn-large btn-primary" href="#" id="add_test">Lisa uus test</a>
</p>
<table id="tests-table" class="table table-bordered table-striped">
	<thead>
	<tr>
		<th>Testi nimi</th>
		<th>Koostaja</th>
		<th>Aeg</th>
		<th>Kustuta</th>
	</tr>
	</thead>
	<tbody>
	<?if (! empty ($tests)): foreach ($tests as $test): ?>
		<tr id="test<?= $test['test_id'] ?>">
			<td id="name"><a href="/testly/tests/edit/<?= $test['test_id'] ?>"/><?=$test['name']?></td>
			<td id="username"><?=$test['username']?></td>
			<td id="date"><?= substr($test['date'], 0, 10) ?></td>
			<td id="delete">

				<a href="#" onclick="if(!confirm('Oled kindel?')) return false;
					remove_test_ajax(<?= $test['test_id'] ?>); return false">
					<i class="icon-trash"></i>
			</td>
		</tr>
	<? endforeach; endif ?>
	</tbody>
</table>
<link rel="stylesheet" type="text/css" href="<?= ASSETS_URL ?>css/jquery.confirm.css"/>
<div class="item" style="display:none">y
	<div class="delete">x</div>
</div>
