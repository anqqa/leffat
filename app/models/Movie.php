<?php

class Movie extends Eloquent {

	protected $guarded = array('id');

	public function getGenresAttribute($value) {
		return $value ? json_decode($value) : null;
	}


	public function setGenresAttribute($value) {
		$this->attributes['genres'] = is_array($value) && count($value) ? json_encode($value) : null;
	}


	public function getLinksAttribute($value) {
		return $value ? json_decode($value) : null;
	}


	public function setLinksAttribute($value) {
		$this->attributes['links'] = is_array($value) && count($value) ? json_encode($value) : null;
	}


	public function getSourceIdsAttribute($value) {
		return $value ? json_decode($value) : null;
	}


	public function setSourceIdsAttribute($value) {
		$this->attributes['source_ids'] = is_array($value) && count($value) ? json_encode($value) : null;
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
			->whereRaw("source_ids->>? = ?", array($source, (int)$source_id));
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
