function remove_test_ajax(id) {
	$.post(BASE_URL + "tests/remove/" + id)
		.done(function (data) {
			if (data == 'OK') {
				$('table#tests-table>tbody>tr#test' + id).remove();
				alert("Test kustutatud")
			} else {
				alert("Viga\n\nServer vastas: '" + data + "'.\n\nKontakteeru arendajaga.");
			}
		});
}
$(document).ready(function () {
	$('#add_test').click(function () {
		var elem = $(this).closest('#confirmOverlay');
		$.confirm({
			'title'  : 'Lisa uue testi nimi:',
			'buttons': {
				'Salvesta': {
					'class' : 'blue',
					'action': function add() {
						return $.ajax({
							type    : 'POST',
							dataType: 'html',
							data    : {test_name: $('input[name="test_name"]').val() },
							url     : BASE_URL + 'tests/add',
							complete: function (data) {
								console.log(data);
								if (!isNaN(data.responseText) && data.responseText > 0) {
									window.location = BASE_URL + 'tests/edit/' + data.responseText
								}
								else {
									alert("Viga testi lisamisel baasi!" + ' ' + data.responseText)
								}
							}
						})
					}
				},
				'Loobu'   : {
					'class' : 'gray',
					'action': function () {
					}
					// Nothing to do in this case. You can as well omit the action property.
				}
			}
		});

	});
});

(function ($) {
	$.confirm = function (params) {
		if ($('#confirmOverlay').length) {
			// A confirm is already shown on the page:
			return false;
		}
		var buttonHTML = '';
		$.each(params.buttons, function (name, obj) {
			// Generating the markup for the buttons:
			buttonHTML += '<a href="#" class="button ' + obj['class'] + '">' + name + '<span></span></a>';
			if (!obj.action) {
				obj.action = function () {
				};
			}
		});
		var markup = [
			'<div id="confirmOverlay">',
			'<div id="confirmBox">',
			'<h1>', params.title, '</h1>',
			'<div style="text-align: center"><input style="margin: 30px" name="test_name" type="text"></div>',
			'<div id="confirmButtons">',
			buttonHTML,
			'</div></div></div>'
		].join('');
		$(markup).hide().appendTo('body').fadeIn();
		var buttons = $('#confirmBox .button'),
			i = 0;
		$.each(params.buttons, function (name, obj) {
			buttons.eq(i++).click(function () {
				obj.action();
				$.confirm.hide();
				return false;
			});
		});
	};

	$.confirm.hide = function () {
		$('#confirmOverlay').fadeOut(function () {
			$(this).remove();
		});
	};

})(jQuery);
