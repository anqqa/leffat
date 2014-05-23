<!doctype html>
<html lang="fi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Leffat</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">

	<!-- AngularJS -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular.min.js"></script>

	<!-- Leffat -->
	<link rel="stylesheet" href="css/leffat.css">
	<script src="js/controllers/mainController.js"></script>
	<script src="js/services/showService.js"></script>
	<script src="js/app.js"></script>

</head>

<body ng-app="leffatApp" ng-controller="mainController">

	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">

			<a class="navbar-brand" href="#">Leffat</a>

		</div>
	</nav>

	<div id="main" class="container">

		<p class="text-center" ng-show="loading">
			<i class="fa fa-5x fa-spinner fa-spin"></i>
		</p>

		<table class="shows table table-hover">
			<tbody>
				<tr ng-repeat="show in shows">

					<td class="col-md-1 h4">
						{{ (show.starts * 1000) | date:'HH:mm' }}<br>
						<small>- {{ (show.ends * 1000) | date:'HH:mm' }}</small>
					</td>

					<td class="col-md-7">
						<img src="{{ show.movie.image_portrait }}" class="img-responsive pull-left">
						<h4>
							{{ show.movie.title }}<br>
							<small>{{ show.movie.title_original }}</small>
						</h4>
						{{ show.theatre.name }}, {{ show.auditorium }} ({{ show.theatre.city }})
					</td>

					<td class="col-md-4 text-right">
						<span ng-if="!show.movie.rating" class="rating rating-g">S</span>
						<span ng-if="show.movie.rating" class="rating">{{ show.movie.rating }}</span>
						<br>
						<span class="genres">
							<span ng-repeat="genre in show.movie.genres"> {{ genre }} </span>
						</span>
					</td>

				</tr>
			</tbody>
		</table>

	</div>

</body>

</html>