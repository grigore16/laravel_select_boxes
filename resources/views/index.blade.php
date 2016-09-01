<!DOCTYPE html>
<html>
<head>
	<title>Dependent select boxes in Laravel 5.1</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		select {
			width: 150px;
			padding: 5px;
			border-radius: 5px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
	<h3>Dependent select boxes in Laravel 5.1</h3>
	
	<table class='table table-bordered'>
		<tr>
			<td>Country</td>
			<td>City</td>
			<td>Street</td>
		</tr>
		<tr>
			<td>
				<select id="country" name="country">
					<option selected>Germany</option>
				</select>
			</td>
			<td>
				<select id="city" name="city">
					<option selected>Hamburg</option>
				</select>
			</td>
			<td>
				<select id="street" name="street">
					<option selected>h1</option>
				</select>
			</td>
		</tr>
	</table>
	<div>
	<script>
		var present_country = 'Germany';
		var present_city = 'Hamburg';
		var present_street = 'h1';
		
		$(document).ready(function(){

			$.ajax({
                url: 'http://localhost/laravel_select_boxes/public/ajax',
                method: "GET", 
                data: {countries:'test'},
                success: function (data) {
					 $(data.countries).each(function(index, country) {
						if(country !== present_country){
							 $("#country").append(new Option(country));
						}
                    });
					
					var country = $('#country').val();
					$.ajax({
						url: 'http://localhost/laravel_select_boxes/public/ajax',
						method: "GET", 
						data: {country:country},
						success: function (data) {
							$(data.cities).each(function(index, city) {
								if(city !== present_city){
									 $("#city").append(new Option(city));
								}
							});
							
							var city = $('#city').val();
							$.ajax({
								url: 'http://localhost/laravel_select_boxes/public/ajax',
								method: "GET", 
								data: {city:city},
								success: function (data) {
									 $(data.streets).each(function(index, street) {
										if(street !== present_street){
											 $("#street").append(new Option(street));
										}
									});
								}
							});
						}
					});
				}
				
			});
			
			$("#country").change(function() {
				
				$('#city').empty();
				$('#street').empty();
				
				var country = $('#country').val();
				$.ajax({
					url: 'http://localhost/laravel_select_boxes/public/ajax',
					method: "GET", 
					data: {country:country},
					success: function (data) {
						 $(data.cities).each(function(index, city) {
							$("#city").append(new Option(city));
						});
						
						var city = $('#city').val();
						$.ajax({
							url: 'http://localhost/laravel_select_boxes/public/ajax',
							method: "GET", 
							data: {city:city},
							success: function (data) {
								 $(data.streets).each(function(index, street) {
									$("#street").append(new Option(street));
								});
							}
						});
					}
				});
			});
			
			$("#city").change(function() {
				$('#street').empty();
				var city = $('#city').val();
				$.ajax({
					url: 'http://localhost/laravel_select_boxes/public/ajax',
					method: "GET", 
					data: {city:city},
					success: function (data) {
						 $(data.streets).each(function(index, street) {
							$("#street").append(new Option(street));
						});
					}
				});
			});
		});
	</script>
	
</body>
</html>

