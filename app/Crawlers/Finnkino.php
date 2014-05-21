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
	 * Crawl data.
	 *
	 * @param   array    $parameters
	 * @return  integer  Shows
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

		$totalShows = 0;
		foreach ($areas as $area_id => $area) {
			echo $area . ': ';
			$totalShows += $shows = parent::crawl(array(
				'nrOfDays' => 7,
				'area'     => $area_id
			));
			echo " (" . $shows . " shows)\n";
		}

		return $totalShows;
	}

}

