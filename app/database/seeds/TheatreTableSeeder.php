<?php
/**
 * TheatreTableSeeder.
 */
class TheatreTableSeeder extends Seeder {

	/**
	 * Seed city table.
	 */
	public function run() {
		DB::table('theatres')->delete();

		/** Finnkino */
		/** @see  http://www.finnkino.fi/Cinemas/ */
		Theatre::create(array(
			'id'        => 'helsinki_tennispalatsi',
			'name'      => 'Tennispalatsi',
			'city'      => 'Helsinki',
			'address'   => 'Salomonkatu 15, 00100 Helsinki',
			'latitude'  => 60.169260,
			'longitude' => 24.931101,
			'homepage'  => 'http://www.finnkino.fi/cinemas/helsinki_tennispalatsi',
			'source'    => 'finnkino',
			'source_id' => 1038,
		));
		Theatre::create(array(
			'id'        => 'helsinki_kinopalatsi',
			'name'      => 'Kinopalatsi',
			'city'      => 'Helsinki',
			'address'   => 'Kaisaniemenkatu 2, 00100 Helsinki',
			'latitude'  => 60.171130,
			'longitude' => 24.946272,
			'homepage'  => 'http://www.finnkino.fi/cinemas/helsinki_kinopalatsi',
			'source'    => 'finnkino',
			'source_id' => 1034,
		));
		Theatre::create(array(
			'id'        => 'helsinki_maxim',
			'name'      => 'Maxim',
			'city'      => 'Helsinki',
			'address'   => 'Kuuvikatu 1, 00100 Helsinki',
			'latitude'  => 60.168361,
			'longitude' => 24.947625,
			'homepage'  => 'http://www.finnkino.fi/cinemas/helsinki_maxim',
			'source'    => 'finnkino',
			'source_id' => 1047,
		));
		Theatre::create(array(
			'id'        => 'espoo_omena',
			'name'      => 'Omena',
			'city'      => 'Espoo',
			'address'   => 'Piispansilta 11, 02230 Espoo',
			'latitude'  => 60.162071,
			'longitude' => 24.738533,
			'homepage'  => 'http://www.finnkino.fi/cinemas/espoo_omena',
			'source'    => 'finnkino',
			'source_id' => 1041,
		));
		Theatre::create(array(
			'id'        => 'espoo_sello',
			'name'      => 'Sello',
			'city'      => 'Espoo',
			'address'   => 'Ratsukatu 3, 02600 Espoo',
			'latitude'  => 60.218155,
			'longitude' => 24.807762,
			'homepage'  => 'http://www.finnkino.fi/cinemas/espoo_sello',
			'source'    => 'finnkino',
			'source_id' => 1050,
		));
		Theatre::create(array(
			'id'        => 'vantaa_flamingo',
			'name'      => 'Flamingo',
			'city'      => 'Vantaa',
			'address'   => 'Tasetie 8, 01510 Vantaa',
			'latitude'  => 60.290763,
			'longitude' => 24.969349,
			'homepage'  => 'http://www.finnkino.fi/cinemas/vantaa_flamingo',
			'source'    => 'finnkino',
			'source_id' => 1043,
		));
		Theatre::create(array(
			'id'        => 'jyvaskyla_fantasia',
			'name'      => 'Fantasia',
			'city'      => 'Jyväskylä',
			'address'   => 'Kauppakatu 29-31, 40100 Jyväskylä',
			'latitude'  => 62.242315,
			'longitude' => 25.746447,
			'homepage'  => 'http://www.finnkino.fi/cinemas/jyvaskyla_fantasia',
			'source'    => 'finnkino',
			'source_id' => 1044,
		));
		Theatre::create(array(
			'id'        => 'kuopio_scala',
			'name'      => 'Scala',
			'city'      => 'Kuopio',
			'address'   => 'Ajurinkatu 16, 70100 Kuopio',
			'latitude'  => 62.890845,
			'longitude' => 27.675971,
			'homepage'  => 'http://www.finnkino.fi/cinemas/kuopio_scala',
			'source'    => 'finnkino',
			'source_id' => 1049,
		));
		Theatre::create(array(
			'id'        => 'lahti_kuvapalatsi',
			'name'      => 'Kuvapalatsi',
			'city'      => 'Lahti',
			'address'   => 'Vapaudenkatu 13, 15110 Lahti',
			'latitude'  => 60.983657,
			'longitude' => 25.660385,
			'homepage'  => 'http://www.finnkino.fi/cinemas/lahti_kuvapalatsi',
			'source'    => 'finnkino',
			'source_id' => 1042,
		));
		Theatre::create(array(
			'id'        => 'oulu_plaza',
			'name'      => 'Plaza',
			'city'      => 'Oulu',
			'address'   => 'Torikatu 32, 90100 Oulu',
			'latitude'  => 65.010877,
			'longitude' => 25.465899,
			'homepage'  => 'http://www.finnkino.fi/cinemas/oulu_plaza',
			'source'    => 'finnkino',
			'source_id' => 1036,
		));
		Theatre::create(array(
			'id'        => 'pori_promenadi',
			'name'      => 'Promenadi',
			'city'      => 'Pori',
			'address'   => 'Yrjönkatu 17, 28100 Pori',
			'latitude'  => 61.484068,
			'longitude' => 21.795870,
			'homepage'  => 'http://www.finnkino.fi/cinemas/pori_promenadi',
			'source'    => 'finnkino',
			'source_id' => 1039,
		));
		Theatre::create(array(
			'id'        => 'tampere_cine_atlas',
			'name'      => 'Cine Atlas',
			'city'      => 'Tampere',
			'address'   => 'Hatanpään Valtatie 1, 33100 Tampere',
			'latitude'  => 61.495937,
			'longitude' => 23.767906,
			'homepage'  => 'http://www.finnkino.fi/cinemas/tampere_cine_atlas',
			'source'    => 'finnkino',
			'source_id' => 1040,
		));
		Theatre::create(array(
			'id'        => 'tampere_plevna',
			'name'      => 'Plevna',
			'city'      => 'Tampere',
			'address'   => 'Itäinenkatu 4, 33100 Tampere',
			'latitude'  => 61.501394,
			'longitude' => 23.757902,
			'homepage'  => 'http://www.finnkino.fi/cinemas/tampere_plevna',
			'source'    => 'finnkino',
			'source_id' => 1037,
		));
		Theatre::create(array(
			'id'        => 'turku_kinopalatsi',
			'name'      => 'Kinopalatsi',
			'city'      => 'Turku',
			'address'   => 'Kauppiaskatu 11, 20100 Turku',
			'latitude'  => 60.453727,
			'longitude' => 22.265841,
			'homepage'  => 'http://www.finnkino.fi/cinemas/turku_kinopalatsi',
			'source'    => 'finnkino',
			'source_id' => 1035,
		));

	}

}

