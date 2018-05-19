<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sitemap extends FrontendController {
	public $dateFormat = 'Y-m-d';
	//page-sitemap.xml 1, post-sitemap.xml 0.64, category-sitemap 0.8, product-sitemap, tag-sitemap, attachment-sitemap
	public function __construct() {
		parent::__construct();
		$this->load->model('sitemapmodel');
		
		// Array of some articles for demonstration purposes
		$this->articles = array(
			array(
				'loc' => base_url('articles/lorem-ipsum-dolor-sit-amet'),
				'lastmod' => date('Y-m-d', time()),
				'changefreq' => 'monthly',
				'priority' => 0.5
			),
			array(
				'loc' => base_url('articles/consectetur-adipiscing-elit'),
				'lastmod' => date('Y-m-d', time()),
				'changefreq' => 'monthly',
				'priority' => '1'
			),
			array(
				'loc' => base_url('articles/nullam-nec-magna-eu-tellus-placerat-tempus'),
				'lastmod' => date('Y-m-d', time()),
				'changefreq' => 'monthly',
				'priority' => false
			)
		);
	}
	
	/**
	 * Generate a sitemap index file
	 * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
	 */
	public function index() {
		$this->sitemapmodel->add(base_url('page-sitemap.xml'), date($this->dateFormat, strtotime('2017-09-29 09:00')));
		$this->sitemapmodel->add(base_url('category-sitemap.xml'), date($this->dateFormat, strtotime('2017-09-29 09:00')));
		$this->sitemapmodel->add(base_url('tag-sitemap.xml'), date($this->dateFormat, strtotime('2017-09-29 09:00')));
		$this->sitemapmodel->add(base_url('product-sitemap.xml'), date($this->dateFormat, strtotime('2017-09-29 09:00')));
		$this->sitemapmodel->add(base_url('post-sitemap.xml'), date($this->dateFormat, strtotime('2017-09-29 09:00')));
		$this->sitemapmodel->output('sitemapindex');
	}
	
	/**
	 * Generate a sitemap both based on static urls and an array of urls
	 */
	public function page(){
		$pages = $this->sitemapmodel->getPages();
		
		foreach ($pages as $page) {
			$date = $page['created'];
			if($page['modified']){
				$date = $page['created'];
			}
			$lastmod = date($this->dateFormat, strtotime($date));
			if($page['slug'] == '/'){

				$this->sitemapmodel->add(base_url(), $lastmod, 'weekly', 1);
			}else{
				if($page['slug'] == 'san-pham'){
					$this->sitemapmodel->add(base_url($page['slug'].'.html'), $lastmod, 'weekly', 0.9);
				}else{
					$url = base_url($page['slug'].'.html');
					if($page['category_type'] == 'new'){
						$url = base_url('category/'.$page['slug'].'.html');
					}else if($page['category_type'] == 'product'){
						$url = base_url('danh-muc/'.$page['slug'].'.html');
					}	
					$this->sitemapmodel->add($url, $lastmod, null, 0.8);
				}

			}
		}
		$this->sitemapmodel->output();
	}
	public function post(){
		$posts = $this->sitemapmodel->getPosts();
		foreach ($posts as $post) {
			$date = $post['created'];
			if($post['modified']){
				$date = $post['created'];
			}
			$lastmod = date($this->dateFormat, strtotime($date));
			$this->sitemapmodel->add(base_url($post['slug'].'.html'), $lastmod, null, 0.7);
		}
		$this->sitemapmodel->output();
	}
	public function category(){
		$categories = $this->sitemapmodel->getCategories();
		foreach ($categories as $val) {
			$date = $val['created'];
			if($val['modified']){
				$date = $val['created'];
			}
			$lastmod = date($this->dateFormat, strtotime($date));
			if($val['category_type'] == 'new'){
				$url = base_url('category/'.$val['slug'].'.html');
			}else {
				$url = base_url('danh-muc/'.$val['slug'].'.html');
			}	
			$this->sitemapmodel->add($url, $lastmod, 'weekly', 0.8);
		}
		$this->sitemapmodel->output();
	}
	public function product(){
		$products = $this->sitemapmodel->getProducts();
		foreach ($products as $val) {
			$date = $val['created'];
			if($val['modified']){
				$date = $val['created'];
			}
			$lastmod = date($this->dateFormat, strtotime($date));
			$this->sitemapmodel->add(base_url('san-pham/'.$val['slug'].'.html'), $lastmod, null, 0.7);
		}
		$this->sitemapmodel->output();
	}
	public function tag(){
		$tags = $this->sitemapmodel->getTags();
		foreach ($tags as $val) {
			$date = $val['created'];
			if($val['modified']){
				$date = $val['created'];
			}
			$lastmod = date($this->dateFormat, strtotime($date));
			if($val['type'] == 'new'){
				$url = base_url('tag/'.$val['slug'].'.html');
			}else{
				$url = base_url('tu-khoa/'.$val['slug'].'.html');
			}	
			$this->sitemapmodel->add($url, $lastmod, 'weekly', 0.8);
		}
		$this->sitemapmodel->output();
	}
	
}