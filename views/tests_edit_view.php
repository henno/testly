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
		<li><a href="#tabs-3">Aenean lacinia</a></li>
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
				<label>Sisesta kaks vastust ja märgi ära õige vastus</label>
				<input type="radio" id="answer_correctness[0]" value="0" checked="checked">
				<textarea id="answer_text[0]">True</textarea>
				<input type="radio" id="answer_correctness[1]" value="1">
				<textarea id="answer_text[1]">False</textarea>
			</div>
		<div style="clear: both; padding-bottom: 7px;">
			<button class="btn btn btn-primary" type="button" onclick="add_question()">Salvesta</button>
		</div>
	</div>
	<div id="tabs-3">
		<p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
		<p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
	</div>
</div>