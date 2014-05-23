angular.module('Controllers', [])
	.controller('mainController', [ '$scope', '$http', 'Show', function($scope, $http, Show) {
			$scope.loading = true;
			$scope.cities  = [];
			$scope.genres  = [];
			$scope.shows   = [];
			$scope.filterCity = null;
			$scope.filterGenre = null;


			/**
			 * Get a show.
			 *
			 * @param  {Number}  showId
			 */
			$scope.getShow = function(showId) {
				$scope.loading = true;

				Show.get(showId)
						.success(function(data) {
							$scope.loading = false;
						});
			};


			// Load all shows
			Show.getAll()

					.success(function(data) {
						$scope.shows   = data;
						$scope.loading = false;

						// Build filters
						angular.forEach(data || [], function(show) {
							if ($scope.cities.indexOf(show.theatre.city) < 0) {
								$scope.cities.push(show.theatre.city);
							}
							angular.forEach(show.movie.genres || [], function(genre) {
							if ($scope.genres.indexOf(genre) < 0) {
								$scope.genres.push(genre);
							}
							});
						});

					})

					.error(function(data) {

					});

		} ]);
