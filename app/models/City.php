<?php

class City extends Eloquent {
	public $incrementing = false;


	/**
	 * Get theatres.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function theatres() {
		return $this->hasMany('Theatre');
	}

}
