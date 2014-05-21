<?php
/**
 * CityTableSeeder.
 *
 * @see  http://fi.wikipedia.org/wiki/Luettelo_Suomen_kuntien_koordinaateista
 */
class CityTableSeeder extends Seeder {

	/**
	 * Seed city table.
	 */
	public function run() {
		DB::table('cities')->delete();

		City::create(array(
			'name'      => 'Helsinki',
			'latitude'  => 60.170833,
			'longitude' => 24.937500,
		));

		City::create(array(
			'name'      => 'Espoo',
			'latitude'  => 60.205556,
			'longitude' => 24.655556,
		));

		City::create(array(
			'name'      => 'Vantaa',
			'latitude'  => 60.294444,
			'longitude' => 25.040278,
		));

		City::create(array(
			'name'      => 'Jyväskylä',
			'latitude'  => 62.240278,
			'longitude' => 25.744444,
		));

		City::create(array(
			'name'      => 'Kuopio',
			'latitude'  => 62.892500,
			'longitude' => 27.678333,
		));

		City::create(array(
			'name'      => 'Lahti',
			'latitude'  => 60.983333,
			'longitude' => 25.655556,
		));

		City::create(array(
			'name'      => 'Oulu',
			'latitude'  => 65.016667,
			'longitude' => 25.466667,
		));

		City::create(array(
			'name'      => 'Pori',
			'latitude'  => 61.484722,
			'longitude' => 21.797222,
		));

		City::create(array(
			'name'      => 'Tampere',
			'latitude'  => 61.498056,
			'longitude' => 23.760833,
		));

		City::create(array(
			'name'      => 'Turku',
			'latitude'  => 60.451389,
			'longitude' => 22.266667,
		));
	}

}

