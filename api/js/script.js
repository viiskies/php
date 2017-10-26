var myArr = {
	last10: 'false',
	filter: '',
	search: ''
};

// var resultsToTable = 

$.getJSON("cars.php", function(result){
	$("cars_table_body").html('');
	$.each(result['cars'], function(i, field){
		$("#cars_table_body").append(
			"<tr><td>" + 
			field.id + "</td><td>" + 
			field.owner + "</td><td>" + 
			field.license + "</td><td>" + 
			field.model + "</td><td>" + 
			field.make + "</td><td>" + 
			field.date + "</td><td>" +
			'<a class="btn btn-danger" href="cars.php?id=' +  field.id  + '" role="button">Delete</a>' +  
			"</td></tr>"
			);
	});
});

$.getJSON("cars.php", function(result){
	$("#filter").html('');
	$("#filter").append("<option value=''></option>");
	$.each(result['makers'], 
		function(i, field){
			$("#filter").append("<option value= '" + field.make + "'>" + field.make + "</option>");
		});
});


$("#ajax_post").click(function(){
	$.post("cars.php",
	{
		owner: $("#owner").val(),
		license: $("#license").val(),
		model: $("#model").val(),
		make: $("#make").val()

	},
	function(data, status) {
		$("#alert").html("<div class='alert alert-" + data.message.type + "'>" + data.message.body + "</div>");

		$.getJSON("cars.php", function(result){
			$("#cars_table_body").html('');
			$.each(result['cars'], function(i, field){
				$("#cars_table_body").append(
					"<tr><td>" + 
					field.id + "</td><td>" + 
					field.owner + "</td><td>" + 
					field.license + "</td><td>" + 
					field.model + "</td><td>" + 
					field.make + "</td><td>" + 
					field.date + "</td><td>" +
					'<a class="btn btn-danger" href="cars.php?id=' +  field.id  + '" role="button">Delete</a>' +  
					"</td></tr>"
					);
			});
			$.getJSON("cars.php", function(result){
				$("#filter").html('');
				$.each(result['makers'], 
					function(i, field){
						$("#filter").append("<option value= '" + field.make + "'>" + field.make + "</option>");
					});
			});
		});
	});		
});

$("#filter").change(function(){
	myArr.filter = $("#filter").val();

	$.getJSON("cars.php", 
		myArr,
		function(result){
			$("#cars_table_body").html('');
			$.each(result['cars'], function(i, field){
				$("#cars_table_body").append(
					"<tr><td>" + 
					field.id + "</td><td>" + 
					field.owner + "</td><td>" + 
					field.license + "</td><td>" + 
					field.model + "</td><td>" + 
					field.make + "</td><td>" + 
					field.date + "</td><td>" +
					'<a class="btn btn-danger" href="cars.php?id=' +  field.id  + '" role="button">Delete</a>' +  
					"</td></tr>"
					);
			});
		});
})


$("#last10").click(function(){
	if (myArr.last10 == 'false') {
		myArr.last10 = 'true';
		$.getJSON("cars.php", 
			myArr,
			function(result){
				$("#cars_table_body").html('');
				$.each(result['cars'], function(i, field){
					$("#cars_table_body").append(
					"<tr><td>" + 
					field.id + "</td><td>" + 
					field.owner + "</td><td>" + 
					field.license + "</td><td>" + 
					field.model + "</td><td>" + 
					field.make + "</td><td>" + 
					field.date + "</td><td>" +
					'<a class="btn btn-danger" href="cars.php?id=' +  field.id  + '" role="button">Delete</a>' +  
					"</td></tr>"
						);
				});
			});

	} else {
		myArr.last10 = 'false';
		$.getJSON("cars.php", 
			myArr,
			function(result){
				$("#cars_table_body").html('');
				$.each(result['cars'], function(i, field){
					$("#cars_table_body").append(
					"<tr><td>" + 
					field.id + "</td><td>" + 
					field.owner + "</td><td>" + 
					field.license + "</td><td>" + 
					field.model + "</td><td>" + 
					field.make + "</td><td>" + 
					field.date + "</td><td>" +
					'<a class="btn btn-danger" href="cars.php?id=' +  field.id  + '" role="button">Delete</a>' +  
					"</td></tr>"
						);
				});
			});

	}
})

$("#search").keyup(function(){
	myArr.search = $("#search").val();

	$.getJSON("cars.php", 
		myArr,
		function(result){
			$("#cars_table_body").html('');
			$.each(result['cars'], function(i, field){
				$("#cars_table_body").append(
					"<tr><td>" + 
					field.id + "</td><td>" + 
					field.owner + "</td><td>" + 
					field.license + "</td><td>" + 
					field.model + "</td><td>" + 
					field.make + "</td><td>" + 
					field.date + "</td><td>" +
					'<a class="btn btn-danger" href="cars.php?id=' +  field.id  + '" role="button">Delete</a>' +  
					"</td></tr>"
					);
			});
		});
})


