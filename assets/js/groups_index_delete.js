function delete_group() {
	var check = new Array();
	$("input:checked").each(function()
		 {
			 check.push($(this).val());
	});
	alert(check);
	var ajaxOpts =
	{

		type   : "post",
		url    : BASE_URL + 'groups/delete/',
		data   : {group_id: check},
		success: function (data) {

			$.each(check,function(key,value)
			{
			var arv=$('#'+value);
				arv.remove();
				alert(value);
			});
		}

	};
	$.ajax(ajaxOpts);
}
function toggle(source) {
	var checkboxes = document.getElementsByName('checkbox');
	for(var i=0, n=checkboxes.length;i<n;i++) {
		checkboxes[i].checked = source.checked;
	}
}

