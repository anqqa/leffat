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
	 * @param   array    $parameters
	 * @return  integer  Shows
	 */
	public function crawl(array $parameters = null) {
		$url     = $this->_buildUrl($parameters);
		echo $url . "\n";
		$rawData = $this->_fetch($url);
		$data    = $this->_parse($rawData);

		return 0;
	}


	/**
	 * Fetch data.
	 *
	 * @param   $url
	 * @return  string
	 */
	protected function _fetch($url) {
		return '';
	}


	/**
	 * Parse data.
	 *
	 * @param   string  $data
	 * @return  string
	 */
	protected function _parse($data) {
		return '';
	}

}
