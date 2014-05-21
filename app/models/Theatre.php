<?php

class Theatre extends Eloquent {

	public $incrementing = false;


	/**
	 * Get city.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	protected function city() {
		return $this->belongsTo('City', 'city', 'name');
	}


	/**
	 * Get shows.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	protected function shows() {
		return $this->hasMany('Show');
	}

}
