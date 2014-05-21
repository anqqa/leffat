<?php namespace Crawlers;

class Finnkino extends Crawler {

	protected $crawlFormat = self::FORMAT_XML;
	protected $crawlURL    = 'http://www.finnkino.fi/xml/Schedule/';

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
	 * @param   object  $data
	 * @return  \Movie
	 */
	protected function _addMovie($data) {

		$movie = \Movie::create(
			array(
				'name'            => (string)$data->Title,
				'original_name'   => self::_parseName(trim($data->OriginalTitle)),
				'year'            => (string)$data->ProductionYear,
				'length'          => (string)$data->LengthInMinutes,
				'rating'          => (int)$data->Rating,
				'genres'          => explode(', ', (string)$data->Genres),
				'links'           => [ 'finnkino' => (string)$data->EventURL ],
				'image_portrait'  => (string)$data->Images->EventLargeImagePortrait,
				'image_landscape' => (string)$data->Images->EventLargeImageLandscape,
				'source_ids'      => [ 'finnkino' => (int)$data->EventID ],
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

		/* @XXX: Debug */
		$areas = array('1019' => 'Pori');

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
			if (!isset($_movies[(int)$_show->EventID])) {
				$movie = \Movie::ofSource('finnkino', $_show->EventID)->first();
				if (!$movie) {

					// Movie not found
					echo ' adding movie ' . (string)$_show->EventID . ' ';
					$movie = $this->_addMovie($_show);

				}
				$_movies[(int)$_show->EventID] = $movie;
			} else {
				$movie = $_movies[(int)$_show->EventID];
			}

			// Get show
			$show = array(
			);

		}

		return array(
			'fetched' => $fetched,
			'added'   => $added
		);
	}


	/**
	 * Remove extras from name.
	 *
	 * @param   string  $name
	 * @return  string
	 */
	protected static function _parseName($name) {
		$strip = "/(3D|2D|\(3D\)|\(2D\)|\(dub\)|\(orig\)|\-)$/";

		while (preg_match($strip, $name)) {
			$name = trim(preg_replace($strip, '', $name));
		}

		return $name;
	}

}

