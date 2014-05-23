<?php

class ShowController extends BaseController {

	/**
	 * Get shows.
	 *
	 * @return  Response
	 */
	public function index() {
		$shows = Show::with('movie', 'theatre', 'sourceType')
			->today()
			->upcoming()
			->orderBy('starts_at')
			->get();

		return Response::json($shows);
	}


	/**
	 * Get show.
	 *
	 * @param   integer  $id
	 * @return  Response
	 */
	public function show($id) {
		return Response::json(Show::with('movie')->find($id));
	}

}
