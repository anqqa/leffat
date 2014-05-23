<?php

class Show extends Eloquent {

	const TYPE_THEATRE = 'theatre';
	const TYPE_TV      = 'tv';

	protected $appends = array('starts', 'ends');
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
	 * Get end time in unix format.
	 *
	 * @return  integer
	 */
	public function getEndsAttribute() {
		return strtotime($this->ends_at);
	}


	/**
	 * Get end time in unix format.
	 *
	 * @return  integer
	 */
	public function getStartsAttribute() {
		return strtotime($this->starts_at);
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
	 * Scope: today.
	 *
	 * @param   \Illuminate\Database\Eloquent\Builder $query
	 * @return  \Illuminate\Database\Eloquent\Builder|static
	 */
	public function scopeToday(\Illuminate\Database\Eloquent\Builder $query) {
		return $query
			->whereRaw("ends_at >= date_trunc('day', now())")
			->whereRaw("starts_at < date_trunc('day', now() + interval '1 day')");
	}


	/**
	 * Scope: upcoming.
	 *
	 * @param   \Illuminate\Database\Eloquent\Builder $query
	 * @return  \Illuminate\Database\Eloquent\Builder|static
	 */
	public function scopeUpcoming(\Illuminate\Database\Eloquent\Builder $query) {
		return $query
			->where('ends_at', '>', 'now()');
	}


	/**
	 * Get source.
	 *
	 * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function sourceType() {
		return $this->belongsTo('Source', 'source');
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
