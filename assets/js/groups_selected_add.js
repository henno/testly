function add_student() {
	//retrieve comments to display on page
	//add click handler for button
	//define ajax config object
	var ajaxOpts =
	{

		type   : "post",
		url    : BASE_URL + 'groups/selected/1',
		data   : {student_name: document.getElementById('name').value,student_email: document.getElementById('email').value},
		success: function (data) {
			var input1=$("#name").val();
			var input2=$("#email").val();

			//	var group_id = '<?=$student_id?>';
			//$('tbody').append.innerHTML ="<td>"+input+"</td>";
			$("tbody").append('<tr><td><input type="checkbox"></td><td>'+input1+'</td>'+'<td>'+input2+'</td></tr>');
			$("#name").val('');
			$("#email").val('');
		}
	};
	$.ajax(ajaxOpts);
}