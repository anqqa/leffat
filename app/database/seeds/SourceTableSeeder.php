<?php
/**
 * SourceTableSeeder.
 */
class SourceTableSeeder extends Seeder {

	/**
	 * Seed city table.
	 */
	public function run() {
		DB::table('sources')->delete();

		Source::create(array(
			'id'   => 'finnkino',
			'name' => 'Finnkino',
			'url'  => 'http://www.finnkino.fi',
		));
	}

}

