var current_type_id = 1;
var ylakoma = "'";
var jutum2rk = '"';
var question_no;
var new_question_no;
var new_question_id;
var answer_keys = [];
var answer_values = [];
var answers_obj = {};
var selected_type;

var j = 0;
var jd = 'tekstikast_0';
function addMultipleChoice() {
	if ($('#' + jd).val().length > 0) {
		j = j+1;
		jd = 'tekstikast_'+j;
		$('#answer_options').append('<div><input type="radio" style="margin: 5px; margin-bottom: 10px" name="multiple_choice"><textarea oninput="addMultipleChoice()" id="tekstikast_'+j+'"></textarea></div>');
	}
	return false;
}
var i = 0;
var box_id = 'kast_0';
function addMultipleResponse() {
	if ($('#' + box_id).val().length > 0) {
		i = i+1;
		box_id = 'kast_'+i;
		$('#answer_options').append('<div><input type="checkbox" style="margin: 5px; margin-bottom: 10px"><textarea oninput="addMultipleResponse()" id="kast_'+i+'"></textarea></div>');
	}
	return false;
}
function removeMultipleChoice() {
	if ($('#multiple-choice-options textarea').length > 1) {
		$('#multiple-choice-options .answer-option:last').remove();
	}
	return false;
}
function removeMultipleResponse() {
	if ($('#multiple-response-answer-option textarea').length > 1) {
		$('#multiple-response-answer-option .answer-option:last').remove();
	}
	return false;
}

function add_textarea(id){
	var type = $('tr#'+id+' #change_answer input:last').attr('type');
	if (type == 'radio'){
		$('tr#'+id+' #change_answer div:last').after('<div><input style="margin: 5px; margin-bottom: 9px" type="radio"><textarea></textarea></div>');
	} else {
		$('tr#'+id+' #change_answer div:last').after('<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox"><textarea></textarea></div>');
	}
	return false;
}

function checkForm() {
	var elements = $('#question_type_id_' + current_type_id + 'input[type=checkbox]:not(.shuffle_answers), #question_type_id_' + current_type_id + 'input[type=radio]:not(#shuffle)');
	var textbox = $('#question_type_id_' + current_type_id + 'textarea');
	for (var i = 0; i < elements.length; i++) {
		if ($(elements[i]).attr('checked') && $.trim($(textbox[i]).val()) != "") {
			return true;
		}
	}
	alert("Palun märgi õige vastus");
	return false;
}
function save_test_changes() {
	$('#test_edit_form').submit();
}

function add_question() {
	new_question_id = parseInt(question_id, 10)+1;
	selected_type = $('#question_type_id').val();
	var question_type_id = $('#question_type_id option[value="'+selected_type+'"]').text();
	var question_text = $('#question_text').val();
	for (var i=2; i<$('#answer_options div').length+2; i++){
		var text = $('#answer_options').find('div:nth-child('+i+')').find('textarea').val();
		var text2 = $('#answer_options').find('div:nth-child('+i+')').text();
		var checked = $('#answer_options').find('div:nth-child('+i+')').find('input');
		if (text){
			answer_keys.push(text);
			if (checked.is(':checked')){
				answer_values.push('1');
			} else {
				answer_values.push('0');
			}
		} else if (text2) {
			answer_keys.push(text2);
			if (checked.is(':checked')){
				answer_values.push('1');
			} else {
				answer_values.push('0');
			}
		}
	}
	if ( answer_keys.length != answer_values.length) {
		return null;
	} else {
		for (var index in answer_keys){
			answers_obj[answer_keys[index]] = answer_values[index];
			console.log(answers_obj[answer_keys[index]]);
		}
	}
	JSON.stringify(answers_obj);
	$.ajax({
		type    : 'POST',
		dataType: 'html',
		data    : {
			questiontext: question_text,
			question_type_id: selected_type,
			newquestionid: new_question_id,
			answer_keys: answer_keys,
			answer_values: answer_values
		},
		url     : BASE_URL + 'tests/add_question/'+id,
		complete: function (data) {
			console.log(data);
			if (data.responseText>0) {
				$('#questions_table').each(function() {
					if ((question_no = ($(this).find("tr.numbered_row:last").find('td:first').html())) !== undefined){
						question_no = ($(this).find("tr.numbered_row:last").find('td:first').html()).slice(0,-1);
					} else {
						question_no = '0';
					}
					new_question_no = parseInt(question_no, 10)+1;
				});
				if (question_text.length > 0) {
					$("#questions_table").append('<tr class="numbered_row" id="'+new_question_id+'"><td>'+new_question_no+'.</td>'+
						'<td><a href="#" onclick="edit_question('+new_question_id+')">'+question_text+'</a></td>'+
						'<td class="selected_type">'+question_type_id+'</td>'+
						'<td><div id="answer_options_'+new_question_id+'">'+
						$.map(answers_obj, function(i, v){
							if (selected_type == 1 || selected_type == 2){
								if (i==='1'){
									return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" checked="checked">'+v+'</div>'
								} else {
									return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio">'+v+'</div>'
								}
							} else if (selected_type == 3){
								if (i==='1'){
									return '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox" checked="checked">'+v+'</div>'
								} else {
									return '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox">'+v+'</div>'
								}
							}
						}).join("")+
						'</div></td>'+
						'<td><a href="#" onclick="if(!confirm('+ylakoma+'Oled kindel?'+ylakoma+')) return false; '+
						'remove_question_ajax('+new_question_id+'); return false">'+
						'<i class="icon-trash"></i></td></tr>');
					question_id= parseInt(question_id, 10)+1;
					new_question_id = new_question_id+1;
					$("#question_text").val('');
					$('#answer_options div').remove();
					$('#answer_options p').remove();
					answer_keys.length = 0;
					answer_values.length = 0;
					answers_obj = {};
				} else {
					alert("Küsimuse nimi puudub!");
				}
			}
			else {
				alert("Viga küsimuse lisamisel baasi!" + ' ' + data.responseText.replace(/<(?:.|\n)*?>/gm, ''));
			}
		}
	})
}
function add_group() {
	var group_name = $('select[name="group_select"]').val();
	var start_date = $('input[name="group_start_date"]').val();
	var start_time = $('input[name="group_start_time"]').val();
	var finish_date = $('input[name="group_finish_date"]').val();
	var finish_time = $('input[name="group_finish_time"]').val();
	var gid = "<?= $test_group['id'] ?>";
	$.ajax({
		type    : 'POST',
		dataType: 'html',
		data    : {
			group_name: group_name,
			group_start_date: start_date,
			group_start_time: start_time,
			group_finish_date: finish_date,
			group_finish_time: finish_time
		},
		url     : BASE_URL + 'tests/add_group/'+id,
		complete: function (data) {
			if (!isNaN(data.responseText) && data.responseText > 0) {
				if (group_name.length > 0){
					$("#participants-table").append(
						'<tr><td><a href="#" onclick="if'+
						'(!confirm('+ylakoma+'Oled kindel?'+ylakoma+')) return false;'+
						'remove_group_ajax('+ylakoma+gid+ylakoma+')' +
						';return false"><i class='+ylakoma+'icon-trash'+ylakoma+'></i></td>'+
						'<td>'+group_name+'</td>'+
						'<td>Kuup&aumlev: '+start_date+'<br>'+
						'Kellaaeg: '+start_time+'</td>'+
						'<td>Kuup&aumlev: '+finish_date+'<br>'+
						'Kellaaeg: '+finish_time+'</td></tr>')
				}
			}

			else {
				alert("Viga grupi lisamisel testile!" + ' ' + data.responseText.replace(/<(?:.|\n)*?>/gm, ''));
			}
		}
	})
}
function edit_question(id){
	var row = $("#questions_table").find('tr#'+id);
	var question_no = row.find('td:first').text();
	var question_text = row.find('td:nth-child(2)').text();
	var option_value = row.find('td:nth-child(3)').attr('class');
	var option_text = row.find('td:nth-child(3)').text();
	var answers = row.find('td:nth-child(4) div');
	console.log($(answers).html());
	var answer_keys = [];
	var answer_values = [];
	var answers_obj = {};
	for (var i=1; i<$(answers).length; i++){
		answer_keys.push($(answers).find('div:nth-child('+i+')').text());
		if ($(answers).find('div:nth-child('+i+')').find('input').is(':checked')){
			answer_values.push('1');
		} else {
			answer_values.push('0');
		}
	}
	if ( answer_keys.length != answer_values.length) {
		return null;
	} else {
		for (var index in answer_keys){
			answers_obj[answer_keys[index]] = answer_values[index];
		}
	} alert(answer_keys);
	JSON.stringify(answers_obj);
	row.replaceWith('<tr class="numbered_row" id="'+id+'"><td>'+question_no+'</td>'+
	'<td><textarea id="question_text">'+question_text+'</textarea></td>'+
	'<td class="'+option_value+'">'+option_text+'</td>'+
	'<td id="change_answer">'+
		$.map(answers_obj, function(i, v){
			if (option_value == 1){
				if (i==='1'){
					return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" name="tfselected_'+id+'" checked="checked">'+v+'</div>'
				} else {
					return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" name="tfselected_'+id+'">'+v+'</div>'
				}
			} else if (option_value == 2){
				if (i==='1'){
					return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" name="multiple_choice_'+id+'" checked="checked"><textarea>'+v+'</textarea></div>'
				} else {
					return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" name="multiple_choice_'+id+'"><textarea>'+v+'</textarea></div>'
				}
			} else if (option_value == 3){
				if (i==='1'){
					return '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox" checked="checked"><textarea>'+v+'</textarea></div>'
				} else {
					return '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox"><textarea>'+v+'</textarea></div>'
				}
			}
		}).join("")+
		( option_value == 2 || option_value == 3 ? '<button id="add_button" onclick="add_textarea('+id+')">+</button>': '')+'</td>'+
	'<td><button class="btn btn-small" type="button" onclick="save_question_changes('+id+')">Salvesta</button>&nbsp;' +
		'<a href="#" onclick="if(!confirm('+ylakoma+'Oled kindel?'+ylakoma+')) return false; '+
		'remove_question_ajax('+id+'); return false">'+
		'<i class="icon-trash"></i></td>');

	$('#questions_table tr#'+id+' textarea').focus();
	return false;
}
function save_question_changes(id){
	var row = $("#questions_table").find('tr#'+id);
	var question_no = row.find('td:first').text();
	var question_text = row.find('#question_text').val();
	var option_value = row.find('td:nth-child(3)').attr('class');
	var option_text = row.find('td:nth-child(3)').text();
	var type = row.find('#change_answer div input').attr('type');
	var keys = [];
	var values = [];
	var answers_obj = {};
	for (var i=1; i<row.find('#change_answer div').length+1; i++){
		var text = row.find('#change_answer').find('div:nth-child('+i+')').find('textarea').val();
		var text2 = row.find('#change_answer').find('div:nth-child('+i+')').text();
		var checked = row.find('#change_answer').find('div:nth-child('+i+')').find('input');
		if (type == 'checkbox' && text && text.length !== 0){
			keys.push(text);
			if (checked.is(':checked')){
				values.push('1');
			} else {
				values.push('0');
			}
		} else if (type == 'radio' && text2) {
			keys.push(text2);
			if (checked.is(':checked')){
				values.push('1');
			} else {
				values.push('0');
			}
		}
	}
	if ( keys.length != values.length) {
		return null;
	} else {
		for (var index in keys){
			answers_obj[keys[index]] = values[index];
		}
	}
	JSON.stringify(answers_obj);
	$.ajax({
		type    : 'POST',
		dataType: 'html',
		data    : {
			questiontext: question_text,
			keys: keys,
			values: values
		},
		url     : BASE_URL + 'tests/edit_question/'+id,
		complete: function (data) {
			console.log(data);
			if (data.responseText>0){
				row.replaceWith('<tr class="numbered_row" id="'+id+'"><td>'+question_no+'</td>'+
					'<td><a href="#" onclick="edit_question('+id+')">'+question_text+'</a></td>'+
					'<td class="'+option_value+'">'+option_text+'</td>'+
					'<td><div id="change_answer">'+
					$.map(answers_obj, function(i, v){
						if (option_value == 1 || option_value == 2){
							if (i==='1'){
								return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio" checked="checked">'+v+'</div>'
							} else {
								return '<div><input style="margin: 5px; margin-bottom: 9px" type="radio">'+v+'</div>'
							}
						} else if (option_value == 3){
							if (i==='1'){
								return '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox" checked="checked">'+v+'</div>'
							} else {
								return '<div><input style="margin: 5px; margin-bottom: 9px" type="checkbox">'+v+'</div>'
							}
						}
					}).join("")+
					'</div></td>'+
					'<td><a href="#" onclick="if(!confirm('+ylakoma+'Oled kindel?'+ylakoma+')) return false; '+
					'remove_question_ajax('+id+'); return false">'+
					'<i class="icon-trash"></i></td></tr>');
				keys.length = 0;
				values.length = 0;
			}
		}
	})
}
function remove_group_ajax(id) {
	var test_id = $('input[name="test_id"]').val();
	$.post(BASE_URL + "tests/removegroup/"+test_id +"/" + id)
		.done(function (data) {
			if (data == 'OK') {
				$('table#participants-table>tbody>tr#group_row' + id).remove();
				alert("Grupp eemaldatud!")
			} else {
				console.log(data);
				alert("Viga\n\nServer vastas: '" + data + "'.\n\nKontakteeru arendajaga.");
			}
		});
}
function remove_question_ajax(id) {
	$.post(BASE_URL + "tests/remove_question/" + id)
		.done(function (data) {
			if (data == 'OK') {
				$('table#questions_table tr#' + id).remove();
				alert("Test kustutatud");
				for (var i=3; i<$('#questions_table tr').length+1; i++) {
					var indeks = i;
					var number = i-2;
					$('#questions_table').find('tr.numbered_row:nth-child('+indeks+')').find('td:first').html(number+'.');
				}
			} else {
				alert("Viga\n\nServer vastas: '" + data + "'.\n\nKontakteeru arendajaga.");
			}
		});
}
$(function () {

	$('#question_type_id').bind('change', function (event) {
		// change answer_option type
		switch ($(this).val().trim()) {
			case '1':
				// õige/vale
				$('#answer_options div').remove();
				$('#answer_options p').remove();
				$('#answer_options').append('<p>Märgi ära õige vastus:</p>');
				$('#answer_options').append('<div><input style="margin: 5px; margin-bottom: 9px" type="radio" id="answer_option[0]" name="tfselected" checked="checked">Jah</div>');
				$('#answer_options').append('<div><input style="margin: 5px; margin-bottom: 9px" type="radio" id="answer_option[1]" name="tfselected">Ei</div>');
				break;
			case '2':
				// mitmikvalik
				$('#answer_options div').remove();
				$('#answer_options p').remove();
				j = 0;
				jd = 'tekstikast_0';
				$('#answer_options').append('<p>Märgi ära õige vastus:</p>');
				$('#answer_options').append('<div><input class="input" type="radio" checked="checked" style="margin: 5px; margin-bottom: 10px" name="multiple_choice"><textarea oninput="addMultipleChoice()" id="tekstikast_0"></textarea></div>');
				break;
			case '3':
				// mitmikvastus
				$('#answer_options div').remove();
				$('#answer_options p').remove();
				i = 0;
				box_id = 'kast_0';
				$('#answer_options').append('<p>Märgi ära õiged vastused:</p>');
				$('#answer_options').append('<div><input class="input" type="checkbox" checked="checked" style="margin: 5px; margin-bottom: 10px"><textarea oninput="addMultipleResponse()" id="kast_0"></textarea></div>');

				break;
			case '4':
				// täida lüngad
				$('#answer_options div').remove();
				$('#answer_options p').remove();
				break;
			default:
				alert('Viga');
		}

		current_type_id = $(this).val();
	});

	$('#answer-template .answer-template').hide();
	$('#question_type_' + current_type_id).show();
	$('#question_type_id').bind('change', function (event) {
		if ($(this).val() != current_type_id) {
			$('#answer-template .answer-template').hide();
			current_type_id = $(this).val();
			$('#question_type_' + current_type_id).show();
		}
	});
	var list = $('#question_type_id option');
	for (var i = 0; i < list.length; i++) {
		if ($(list[i]).val() == current_type_id) {
			$(list[i]).attr('selected', 'selected');
		}
	}
	$('input:first').focus();
});
