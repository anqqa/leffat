<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CrawlCommand extends Command {

	/**
	 * @var  string  The console command name.
	 */
	protected $name = 'crawl';

	/**
	 * @var  string  The console command description.
	 */
	protected $description = 'Crawl all data.';


	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct();
	}


	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {
		$parameters = array();
		switch ($this->argument('source')) {

			case 'finnkino':
				$crawler    = new \Crawlers\Finnkino();
				$parameters = array(
					'area' => in_array('all', $this->option('area')) ? 'all' : $this->option('area'),
				);
				break;

			default:
				$this->error('Invalid source');
				return;
		}

		$this->info('Starting to crawl ' . $this->argument('source'));
		$shows = $crawler->crawl($parameters);
		$this->info('Done! (' . $shows . ' shows)');
	}


	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments() {
		return array(
			array('source', InputArgument::REQUIRED, 'Source site.'),
		);
	}


	/**
	 * Get the console command options.
	 *
	 * @return  array
	 */
	protected function getOptions() {
		return array(
			array('area', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Theatre area', [ 'all' ]),
		);
	}

}
