angular.module('Controllers', [])
	.controller('mainController', [ '$scope', '$http', 'Show', function($scope, $http, Show) {
			$scope.loading = true;
			$scope.shows   = [];


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
					})

					.error(function(data) {

					});

		} ]);
