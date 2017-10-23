$("#ajax_post").click(function() {
	$.post("users.php",
	{
		inputName: $("#inputName").val(),
		inputLastName: $("#inputLastName").val(),
		inputPhone: $("#inputPhone").val(),
		inputEmail: $("#inputEmail").val(),
		inputPassword: $("#inputPassword").val()

	},
	function(data, status) {
		$("#alert").html("<div class='alert alert-" + data.message.type + "'>" + data.message.body + "</div>");

		$.getJSON("users.php", function(result){
			$("#user_table_body").html('');
			$.each(result['users'], function(i, field){
				$("#user_table_body").append("<tr><td>" + field.id + "</td><td>" + field.inputName + "</td><td>" + field.inputLastName + "</td><td>" + field.inputPhone + "</td><td>" + field.inputEmail + "</td><td>" + field.inputPassword + "</td></tr>");
			});
		});
	});		
});

$("#filter").keyup(function(){

	$.getJSON("users.php", 
	{
		filter: $("#filter").val()
	},
	function(result){
		$("#user_table_body").html('');
		$.each(result['users'], function(i, field){
			$("#user_table_body").append("<tr><td>" + field.id + "</td><td>" + field.inputName + "</td><td>" + field.inputLastName + "</td><td>" + field.inputPhone + "</td><td>" + field.inputEmail + "</td><td>" + field.inputPassword + "</td></tr>");
		});
	});

})

$.getJSON("users.php", function(result){
	$("#user_table_body").html('');
	$.each(result['users'], function(i, field){
		$("#user_table_body").append("<tr><td>" + field.id + "</td><td>" + field.inputName + "</td><td>" + field.inputLastName + "</td><td>" + field.inputPhone + "</td><td>" + field.inputEmail + "</td><td>" + field.inputPassword + "</td></tr>");
	});
});