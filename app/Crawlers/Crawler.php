<?php namespace Crawlers;

abstract class Crawler {

	const FORMAT_HTML = 'html';
	const FORMAT_JSON = 'json';
	const FORMAT_XML  = 'xml';

	/**
	 * @var  string
	 */
	protected $crawlFormat;

	/**
	 * @var  string
	 */
	protected $crawlURL;


	/**
	 * Build crawl url.
	 *
	 * @param   array  $parameters
	 * @return  string
	 */
	protected function _buildUrl(array $parameters = null) {
		return $this->crawlURL . '?' . http_build_query($parameters);
	}


	/**
	 * Crawl data.
	 *
	 * @param   array  $parameters
	 * @return  array  fetched, added
	 */
	public function crawl(array $parameters = null) {
		$url     = $this->_buildUrl($parameters);
		echo $url . ":\n";

		$data = $this->_fetch($url);

		if (!$data) {
			echo " No data!\n";

			return 0;
		}

		$shows = $this->_parse($data);

		return array(
			'fetched' => (int)$shows['fetched'],
			'added'   => (int)$shows['added']
		);
	}


	/**
	 * Fetch data.
	 *
	 * @param   $url
	 * @return  object
	 */
	protected function _fetch($url) {
		$data = null;
		switch ($this->crawlFormat) {

			case self::FORMAT_XML:
				$data = simplexml_load_file($url);
				break;

		}

		return $data;
	}


	/**
	 * Parse data.
	 *
	 * @param   object   $data
	 * @return  array    fetched, added
	 */
	abstract protected function _parse($data);

}
