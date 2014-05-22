<?php

class Show extends Eloquent {

	const TYPE_THEATRE = 'theatre';
	const TYPE_TV      = 'tv';

	protected $guarded = array('id');


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
	 * Get theatre.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function theatre() {
		return $this->belongsTo('Theatre');
	}

}
