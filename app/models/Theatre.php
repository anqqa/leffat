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
	 * Scope: source.
	 *
	 * @param   \Illuminate\Database\Eloquent\Builder  $query
	 * @param   string                                 $source
	 * @param   integer                                $source_id
	 * @return  \Illuminate\Database\Eloquent\Builder
	 */
	public function scopeOfSource(\Illuminate\Database\Eloquent\Builder $query, $source, $source_id) {
		return $query
			->where('source',    $source)
			->where('source_id', (int)$source_id);
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
