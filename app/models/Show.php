<?php

class Show extends Eloquent {

	protected $guarded = array('id', 'movie_id', 'theatre_id', 'city_id');


	/**
	 * Get city.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function city() {
		return $this->belongsTo('City');
	}


	/**
	 * Get movie.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function movie() {
		return $this->belongsTo('Movie');
	}


	/**
	 * Get theatre.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theatre() {
		return $this->belongsTo('Theatre');
	}

}
