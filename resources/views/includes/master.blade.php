<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Products</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

	<link id="favicon" type="image/x-icon" rel="icon" href="https://calendar.google.com/googlecalendar/images/favicons_2020q4/calendar_12.ico">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light" role="navigation">
	<span class="navbar-brand">Products</span>
	<span class="navbar-brand"> | </span>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="nav navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="">Products</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="">Events</a>
			</li>
		</ul>
		<ul class="nav navbar-nav navbar-right pr-4">
			<li class="nav-item">
				<a class="nav-link" href="">Logout</a>
			</li>
		</ul>
	</div>
</nav>

<div class="container" style="padding-bottom: 120px;">
	@yield('content')
</div>

<footer class="footer navbar-fixed-bottom" style="bottom: 0; background-color: #f5f5f5; width: 100%;">
	<div class="container-fluid text-center text-md-left">
		<div class="row">
			<hr class="clearfix w-100 d-md-none pb-3">
		</div>
	</div>
	<div class="footer-copyright text-center py-3">© 2021 Copyright:
		<a href="https://github.com/firewall004">Vivek Kumar</a>
	</div>
</footer>
