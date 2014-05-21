<?php

class Movie extends Eloquent {
	protected $guarded = array('id');


	/**
	 * Get shows.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	protected function shows() {
		return $this->hasMany('Show');
	}

}
