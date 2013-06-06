function add_group() {
	//retrieve comments to display on page
	//add click handler for button
	//define ajax config object
	var ajaxOpts =
	{

		type   : "post",
		url    : BASE_URL + 'groups/add_group/',
		data   : "&group=" + document.getElementById('add').value,
		success: function (data) {

			var input=$("#add").val()
			$('tbody').innerHTML ="<td>"+input+"</td>";

		}
	};
	$.ajax(ajaxOpts);
}