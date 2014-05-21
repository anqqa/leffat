<?php

class City extends Eloquent {

	public $incrementing  = false;

	protected $primaryKey = 'name';


	/**
	 * Get theatres.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function theatres() {
		return $this->hasMany('Theatre');
	}

}
