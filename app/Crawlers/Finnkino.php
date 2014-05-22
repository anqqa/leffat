<?php namespace Crawlers;

class Finnkino extends Crawler {

	protected $crawlFormat = self::FORMAT_XML;
	protected $crawlURL    = 'http://www.finnkino.fi/xml/Schedule/';
	protected $eventsURL   = 'http://www.finnkino.fi/xml/Events/';

	protected $areas = array(
		'1002' => 'Helsinki',
		'1012' => 'Espoo',
		'1013' => 'Vantaa',
		'1015' => 'Jyväskylä',
		'1016' => 'Kuopio',
		'1017' => 'Lahti',
		'1018' => 'Oulu',
		'1019' => 'Pori',
		'1021' => 'Tampere',
		'1022' => 'Turku',
	);


	/**
	 * Add movie to database.
	 *
	 * @param   integer  $eventId
	 * @return  \Movie
	 */
	protected function _addMovie($eventId) {
		static $_movies = null;

		// Load event data if not available
		if ($_movies[$eventId] === null) {
			$_movies = array();
			$data = simplexml_load_file($this->eventsURL);
			foreach ($data->Event as $event) {
				$_movies[(int)$event->ID] = $event;
			}
		}

		if (!isset($_movies[$eventId])) {

			// Movie data not available!
			return null;

		}

		// Get trailer data
		$trailer       = null;
		$trailer_image = null;
		if (!empty($_movies[$eventId]->Videos)) {
			foreach ($_movies[$eventId]->Videos->EventVideo as $video) {
				if ((string)$video->MediaResourceSubType == 'EventTrailer') {
					$trailer       = (string)$video->Location;
					$trailer_image = (string)$video->ThumbnailLocation;
				}
			}
		}

		$movie = \Movie::create(
			array(
				'name'            => (string)$_movies[$eventId]->Title,
				'name_original'   => self::_parseName(trim($_movies[$eventId]->OriginalTitle)),
				'year'            => (string)$_movies[$eventId]->ProductionYear,
				'length'          => (string)$_movies[$eventId]->LengthInMinutes,
				'rating'          => (int)$_movies[$eventId]->Rating,
				'release_date'    => substr((string)$_movies[$eventId]->dtLocalRelease, 0, 10),
				'image_portrait'  => (string)$_movies[$eventId]->Images->EventLargeImagePortrait,
				'image_landscape' => (string)$_movies[$eventId]->Images->EventLargeImageLandscape,
				'trailer'         => $trailer,
				'trailer_image'   => $trailer_image,
				'synopsis'        => (string)$_movies[$eventId]->Synopsis,
				'synopsis_short'  => (string)$_movies[$eventId]->ShortSynopsis,
				'genres'          => explode(', ', (string)$_movies[$eventId]->Genres),
				'links'           => [ 'finnkino' => (string)$_movies[$eventId]->EventURL ],
				'source_ids'      => [ 'finnkino' => $eventId ],
			)
		);

		return $movie;
	}


	/**
	 * Crawl data.
	 *
	 * @param   array  $parameters
	 * @return  array  fetched, added
	 */
	public function crawl(array $parameters = null) {

		// Parse parameters
		if ($parameters['area'] == 'all') {
			$areas = $this->areas;
		} else {
			$areas = array();
			foreach ($this->areas as $area_id => $area) {
				if (in_array($area, $parameters['area'])) {
					$areas[$area_id] = $area;
				}
			}
		}

		$totalShows = array(
			'fetched' => 0,
			'added'   => 0,
		);
		foreach ($areas as $area_id => $area) {
			echo $area . ': ';
			$shows = parent::crawl(array(
				'nrOfDays' => 7,
				'area'     => $area_id
			));
			echo '(' . (int)$shows['added'] . '/' . (int)$shows['fetched'] . " shows)\n";
			$totalShows['fetched'] += $shows['fetched'];
			$totalShows['added']   += $shows['added'];
		}

		return $totalShows;
	}


	/**
	 * Parse data.
	 *
	 * @param   object  $data
	 * @return  array   fetched, added
	 */
	protected function _parse($data) {
		static $_movies = array();

		$fetched = count($data->Shows->Show);
		$added   = 0;

		foreach ($data->Shows->Show as $_show) {

			// Get show theatre
			$theatre = \Theatre::ofSource('finnkino', $_show->TheatreID)->first();
			if (!$theatre) {
				echo ' theatre not found: ' . $_show->TheatreID . ' ';
				continue;
			}

			// Get show movie
			$eventId = (int)$_show->EventID;
			if (!isset($_movies[$eventId])) {
				$movie = \Movie::ofSource('finnkino', $eventId)->first();
				if (!$movie) {

					// Movie not found
					echo ' adding movie ' . $eventId . ' ';
					$movie = $this->_addMovie($eventId);
					if (!$movie) {
						echo ' movie not found: ' . $eventId . ' ';
						continue;
					}

				}
				$_movies[$eventId] = $movie;
			} else {
				$movie = $_movies[$eventId];
			}

			// Get show
			if (!\Show::ofSource('finnkino', (int)$_show->ID)->first()) {

				// Not found, add
				echo ' adding show ' . (int)$_show->ID . ' ';
				\Show::create(array(
					'type'       => \Show::TYPE_THEATRE,
					'movie_id'   => $movie->id,
					'theatre_id' => $theatre->id,
					'auditorium' => (string)$_show->TheatreAuditorium,
					'starts'     => (string)$_show->dttmShowStart,
					'ends'       => (string)$_show->dttmShowEnd,
					'url'        => (string)$_show->ShowURL,
					'extra'      => empty($_show->PresentationMethod) ? null : (string)$_show->PresentationMethod,
					'language'   => self::_parseLanguage($_show),
					'source'     => 'finnkino',
					'source_id'  => (int)$_show->ID,
				));

				$added++;

			}

		}

		return array(
			'fetched' => $fetched,
			'added'   => $added
		);
	}


	/**
	 * Remove presentation method from languages.
	 *
	 * @param   object  $show
	 * @return  string
	 */
	static protected function _parseLanguage($show) {
		$extra     = (string)$show->PresentationMethod;
		$languages = explode(', ', (string)$show->PresentationMethodAndLanguage);

		// Remove extra from languages
		$language = array_filter($languages, function($_language) use ($extra) {
			return $_language != $extra;
		});

		return $language ? implode(', ', $language) : null;
	}


	/**
	 * Remove extras from name.
	 *
	 * @param   string  $name
	 * @return  string
	 */
	static protected function _parseName($name) {
		$strip = "/(3D|2D|\(3D\)|\(2D\)|\(dub\)|\(orig\)|\-)$/";

		while (preg_match($strip, $name)) {
			$name = trim(preg_replace($strip, '', $name));
		}

		return $name;
	}

}

