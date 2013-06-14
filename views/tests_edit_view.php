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
		<li><a href="#tabs-3">Grupid</a></li>
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
		<table id="questions_table" class="table table-bordered table-striped">
			<tr>
				<th>Nr</th>
				<th style="min-width: 300px">Küsimus</th>
				<th>Tüüp</th>
				<th>Vastus/Vastused</th>
				<th style="max-width: 40px">&nbsp;</th>
			</tr>
			<tr>
				<td></td>
				<td><textarea id="question_text"></textarea></td>
				<td><select id="question_type_id">
						<option value="1" selected="selected">Tõene/Väär</option>
						<option value="2">Mitmikvalik</option>
						<option value="3">Mitmikvastus</option>
						<option value="4">Täida lüngad</option>
					</select></td>
				<td><div id="answer_options"></div></td>
				<td><button class="btn btn btn-primary" type="button" onclick="add_question()">Salvesta</button></td>
			</tr>
			<? $n = 1; if(!empty($questions)) foreach($questions as $question):?>
			<tr class="numbered_row" id="<?=$question['id']?>">
				<td><?=$n++?>.</td>
				<td><a href="#" onclick="edit_question(<?=$question['id']?>)"><?=$question['question_text']?></a></td>
				<td class="<?=$question['question_type_id']?>"><?=$question['question_type']?></td>
				<?$question_id=$question['question_id'];
				$answers = get_all("SELECT * FROM answer WHERE question_id='$question_id'");?>
				<td><div id="answer_options_<?=$question['id']?>"><?if(!empty($answers)) foreach($answers as $answer){
					if ($question['question_type_id']==1 || $question['question_type_id']==2) {
						if ($answer['correct']==1){
							echo '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" checked="checked">'
								.$answer['answer'].'</div>';
						} else {
							echo '<div><input style="margin: 5px; margin-bottom: 9px" type="radio">'
								.$answer['answer'].'</div>';
						}
					} elseif ($question['question_type_id']==3){
						if ($answer['correct']==1){
							echo '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox" checked="checked">'
								.$answer['answer'].'</div>';
						} else {
							echo '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox">'.$answer['answer'].'</div>';
						}
					}
				}?></div></td>
				<td><a href="#" onclick="if(!confirm('Oled kindel?')) return false;
						remove_question_ajax(<?= $question['id'] ?>); return false">
						<i class="icon-trash"></i></td>
			</tr>
			<? endforeach ?>
		</table>
	</div>
	<div id="tabs-3">
		<div style="margin: 15px">
			<form id="myform" method="post">
				<table class="table table-bordered table-striped" style="width: 40%">
					<tr>
						<th>Grupp</th>
						<th>Alustusaeg</th>
						<th>Tähtaeg</th>
					</tr>
					<tr>
						<td><select id="group_select" name="group_select">
								<? if (isset($group_names)) : foreach ($group_names as $group_name) :?>
								<option><?=$group_name['group_name']?></option>
								<? endforeach; endif?>
						</select>
						</td>
						<td>
							<input name="group_start_date" type="date""><br>
							<input name="group_start_time" type="time">
						</td>
						<td>
							<input name="group_finish_date" type="date""><br>
							<input name="group_finish_time" type="time">
						</td>
					</tr>
				</table>

			</form>
			<button class="btn btn-primary" onclick="add_group()">Lisa uus grupp</button>

		</div>
		<input type="hidden" name="test_id" value="<?=$request->params[0];?>">
		<table id="participants-table" class="table table-bordered table-striped" style="width: auto">
			<thead>
			<tr>
				<th>Kustuta:</th>
				<th>Grupp</th>
				<th>Alustusaeg</th>
				<th>Tähtaeg</th>
			</tr>
			</thead>
			<tbody>
				<? if(!empty($test_groups)) : foreach($test_groups as $test_group) :?>
					<tr id="group_row<?=$test_group['id']?>">
						<td><a href="#" onclick="if(!confirm('Oled kindel?')) return false;
								remove_group_ajax(<?= $test_group['id'] ?>); return false">
								<i class="icon-trash"></i></td>
						<td><?=$test_group['group_name']?></td>
						<td>Kuupäev: <?=$test_group['start_date']?><br>
						Kellaaeg: <?=$test_group['start_time']?></td>
						<td>Kuupäev: <?=$test_group['finish_date']?><br>
						Kellaaeg: <?=$test_group['finish_time']?></td>
					</tr>
				<? endforeach; endif?>
			</tbody>
		</table>
	</div>
</div>
<div>
	<?if (($get_last_id['MAX(id)']) == null){$last_id = '0';}else{$last_id = $get_last_id['MAX(id)'];}?>
</div>
<script>
	var id = '<?=$request->params[0]?>';
</script>
<script>
	var question_id = '<?=$last_id?>';
</script>
