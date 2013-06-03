<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/smoothness/jquery-ui.css"/>
<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>
<div style="clear: both; padding-bottom: 7px;">
	<button class=" btn btn-primary" type="button" onclick="save_test_changes()">Salvesta</button>
</div>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Üldine</a></li>
		<li><a href="#tabs-2">Küsimused</a></li>
		<li><a href="#tabs-3">Osalejad</a></li>
	</ul>
	<div id="tabs-1">
		<form method="post" id="test_edit_form">
			<label>Testi nimi</label>
			<input type="text" name="test[name]" value="<?=$test['name']?>">
			<label>Sissejuhatus</label>
			<textarea name="test[introduction]"><??></textarea>
			<label>Kokkuvõte</label>
			<textarea name="test[conclusion]"><?=$test['conclusion']?></textarea>
			<label>Passcode</label>
			<input type="text" name="test[passcode]" value="<?=$test['passcode']?>">
		</form>
	</div>
	<div id="tabs-2">
		<table class="table table-bordered table-striped">
			<tr>
				<th>#</th>
				<th style="min-width: 300px">Küsimus</th>
				<th>Tüüp</th>
				<th style="max-width: 40px">&nbsp;</th>
			</tr>
			<? $n = 1; if(!empty($questions)) foreach($questions as $question):?>
			<tr>
				<td><?=$n++?>.</td>
				<td><?=$question['question_text']?></td>
				<td><?=$question['question_type']?></td>
				<td><i class="icon-pencil"></i><i class="icon-trash"></i></td>
			</tr>
			<? endforeach ?>
		</table>
		<label>Küsimus</label>
		<textarea id="question_text"></textarea>
		<label>Tüüp</label>
		<select id="question_type_id">
			<option value="1">True/false</option>
			<option value="2" selected="selected">Mitmikvalik</option>
			<option value="3">Multiple response</option>
			<option value="4">Fill in the blank</option>
		</select>
			<div id="answer_options">
			</div>
		<div style="clear: both; padding-bottom: 7px;">
			<button class="btn btn btn-primary" type="button" onclick="add_question()">Salvesta</button>
		</div>
	</div>
	<div id="tabs-3">
		<table id="participants-table" class="table table-bordered table-striped" style="width: auto">
			<thead>
			<tr>
				<th><input style="margin: 5px" type="checkbox">Vali kõik</th>
				<th>Isik</th>
				<th>Grupp</th>
				<th>Ajavahemik</th>
				<th>Punktid</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><input style="margin: 5px" type="checkbox"></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>