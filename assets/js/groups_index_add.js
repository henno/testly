function add_group() {
	//retrieve comments to display on page
	//add click handler for button
	//define ajax config object
	var ajaxOpts =
	{

		type   : "post",
		url    : BASE_URL + 'groups/index/',
		data   : "&group=" + document.getElementById('add').value,
		success: function (data) {

			var input=$("#add").val()
			var group_id = "<?=$group_id?>";
			//$('tbody').append.innerHTML ="<td>"+input+"</td>";
			$("tbody").append('<tr><td><input type="checkbox"></td><td><a href="'+BASE_URL+'groups/view/'+group_id+'">'+input+'</a></td>'+'<td>0</td></tr>');
			$("#add").val('')
		}
	};
	$.ajax(ajaxOpts);
}