angular.module('Services', [])
	.factory('Show', function($http) {

			/**
			 * Get one show.
			 *
			 * @param  {Number}  showId
			 */
			var get = function(showId) {

			};


			/**
			 * Get all shows.
			 *
 			 * @returns  {*}
			 */
			var getAll = function() {
				return $http.get('/api/shows');
			};

			// API
			return {
				get:    get,
				getAll: getAll
			}
		});
