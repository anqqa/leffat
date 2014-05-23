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
	<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.16/angular-animate.min.js"></script>

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

			<form class="navbar-form" role="search">

				<div class="form-group">
					<input type="text" class="form-control" placeholder="Hae..." ng-model="search">
				</div>

				<div class="form-group">
					<select class="form-control" ng-model="filterCity" ng-options="city as city for city in cities | orderBy:'toString()'">
						<option value="">Kaupunki</option>
					</select>
				</div>

				<div class="form-group">
					<select class="form-control" ng-model="filterGenre" ng-options="genre as genre for genre in genres | orderBy:'toString()'">
						<option value="">Genre</option>
					</select>
				</div>

			</form>

		</div>
	</nav>

	<div id="main" class="container">

		<p class="text-center" ng-show="loading">
			<i class="fa fa-5x fa-spinner fa-spin"></i>
		</p>

		<table class="shows table table-hover">
			<tbody>
				<tr ng-repeat="show in shows | filter:filterCity | filter:filterGenre | filter:search" ng-init="open = false" ng-click="open = !open" ng-class="{ warning: show.starts < time && show.ends > time }">

					<td class="col-md-1 text-right">
						<p class="h4">
							{{ (show.starts * 1000) | date:'HH:mm' }}<br>
							<small>- {{ (show.ends * 1000) | date:'HH:mm' }}</small>
						</p>
						<small ng-show="open"><i class="fa fa-clock-o"></i> {{ show.movie.length }} min</small>
					</td>

					<td class="col-md-11">

						<img alt="Juliste" src="{{ show.movie.image_portrait }}" class="portrait img-responsive pull-left">

						<div class="pull-right text-right">
							<strong ng-if="!show.movie.rating" class="text-success">S</strong>
							<strong ng-if="show.movie.rating">{{ show.movie.rating }}</strong>
							<br>
							<span class="text-muted">
								<span ng-repeat="genre in show.movie.genres"> {{ genre }} </span>
							</span>
							<br>
							<em class="text-muted">{{ show.language }}</em>
						</div>

						<div>
							<h4>
								{{ show.movie.title }}<br>
								<small>{{ show.movie.title_original }}</small>
							</h4>
							{{ show.theatre.name }}, {{ show.theatre.city }} ({{ show.auditorium }})
							<div class="panel panel-default" ng-if="open">
								<div class="panel-body">
									<img alt="Kuva" src="{{ show.movie.image_landscape }}" class="landscape img-responsive">
									<p>{{ show.movie.synopsis }}</p>
									<em class="text-muted">Ensi-ilta: {{ show.movie.release_date | date:'d.M.yyyy' }}</em>
								</div>
								<div class="panel-footer">
									<a href="{{ show.url }}" class="btn btn-primary" target="_blank" title="Avautuu uuteen ikkunaan">
										<i class="fa fa-ticket"></i> Liput
									</a>
									<a href="{{ show.source_type.url }}" class="btn btn-link pull-right" target="_blank" title="Avautuu uuteen ikkunaan">&copy; {{ show.source_type.name }}</a>
								</div>
							</div>
						</div>

					</td>

				</tr>
			</tbody>
		</table>

	</div>

</body>

</html>
