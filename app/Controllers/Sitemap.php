<?php

namespace App\Controllers;

class Sitemap extends BaseController
{
    public function __construct() {
        $this->sitemapmodel = new \App\Models\SitemapModel();
	}
	
	/**
	 * Generate a sitemap index file
	 * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
	 */
	public function index() {
		helper('filesystem');
		$this->sitemapmodel->add(base_url('/'), date('Y-m-d', time()));
		$this->sitemapmodel->add(base_url('services'), date('Y-m-d', time()));
		$this->sitemapmodel->add(base_url('blog'), date('Y-m-d', time()));
		$this->sitemapmodel->add(base_url('gallery'), date('Y-m-d', time()));
		// $this->sitemapmodel->add(base_url('sitemap/articles'), date('Y-m-d', time()));
		
		$data = $this->sitemapmodel->output('sitemapindex');
		if (! write_file(WRITEPATH.'../sitemap.xml', $data)) {
			echo 'Unable to write the file';
		} else {
			echo 'File written!';
		}
	}
	
}