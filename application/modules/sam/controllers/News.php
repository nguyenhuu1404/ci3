<?php 
class News extends FrontendController{
	public $perPage = 12;
	public function __construct(){
		parent::__construct();  
		$this->load->model('new_model');
	}
	public function index(){
		$this->data['layout'] = 'new/list';
		$this->data['title'] = 'News';
		$this->data['description'] = 'News';
		$this->data['news'] = $this->new_model->getAll();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function detail($slug){
		$new = $this->new_model->getOneField('slug', $slug, 'news');
		if($new){
			$this->data['layout'] = 'new/detail';
			$this->data['title'] = $new['title'];
			$this->data['seoImage'] = base_url('assets/sam/images/news/').$new['image'];
			$this->data['seoType'] = 'article';
			$this->data['name'] = $new['name'];
			$this->data['description'] = $new['description'];
			
			//$this->data['catNews'] = $this->new_model->getCategories();
			$parents = $this->category->getDataParents($new['category_id']);
			$breadcrumbs = array(
				array(
					'name' => 'Trang chủ',
					'url' => '/'
				)
			);
			$i = 1;
			foreach ($parents as $parent) {
				$breadcrumbs[$i]['name'] = $parent['name'];
				$breadcrumbs[$i]['url'] = '/category/'.$parent['slug'].'.html';
				$i++;
			}
			$breadcrumbs[$i]['name'] = $new['name'];
			$this->data['breadcrumbs']= $breadcrumbs;
			//views
			$views = $new['views'] + 1;
			$this->new_model->save('news', array('views' => $views), $new['id']);

			$this->load->model('product');
			$this->data['newProducts'] = $this->product->getNewProduct();
			$this->data['hotProducts'] = $this->product->getHotProduct();
			$this->data['viewProducts'] = $this->product->getViewProduct();
			$this->data['recommendProducts'] = $this->product->getRecommendProduct();
			$this->load->model('tag');
			$this->data['tags'] = $this->tag->getTags($new['tag_ids']);
			$this->data['new'] = $new;
			$this->data['relateNews'] = $this->new_model->getRelateNews($new['id'], $new['category_id']);
			$this->data['newCategories'] = $this->category->getNewcategories();
			$this->data['topNews'] = $this->new_model->getTopNews();
			$this->data['newNews'] = $this->new_model->getNewNews(); 
			$this->load->view($this->data['masterPage'], $this->data);
		}else{
			show_404();
		}	
	}
	public function category($slug){
		$dataCategory = $this->category->getCategoryBySlug($slug, 'new');
		if($dataCategory){
			$this->load->library('Ajax_pagination');

			$this->data['layout'] = 'new/list';
			$this->data['title'] = $dataCategory['title'];
			$this->data['seoType'] = 'object';
			$this->data['name'] = $dataCategory['name'];
			$this->data['description'] = $dataCategory['description'];

			//Pagination
			$this->new_model->conditions = array('category_id' => $dataCategory['id'], 'status' => 1);
	        $totalNews = $this->new_model->getCountItems();

	        //pagination configuration
	        $config['target']      = '#pageAjax';
	        $config['base_url']    = base_url().'sam/news/ajaxPagination';
	        $config['link_func']   = 'filterNew';
	        $config['total_rows']  = $totalNews;
	        $config['per_page']    = $this->perPage;
	        $this->ajax_pagination->initialize($config);

	        $this->new_model->pageSize = $this->perPage;
	        $this->new_model->pageNum = 0;
	        $this->data['paginations'] = $this->ajax_pagination->create_links();
			$this->data['news'] = $this->new_model->getItems();

			$this->data['categoryId'] = $dataCategory['id'];

			//$this->data['news'] = $this->new_model->getNewByCateId($cateId);
			$this->data['newCategories'] = $this->category->getNewcategories();
			$this->data['topNews'] = $this->new_model->getTopNews();
			$this->data['newNews'] = $this->new_model->getNewNews(); 
			$this->load->view($this->data['masterPage'], $this->data);
		}else{
			show_404();
		}
		
	}
	public function tag($slug){
		$dataTag = $this->new_model->getTagBySlug($slug, 'new');
		if($dataTag){
			$this->load->library('Ajax_pagination');

			$this->data['layout'] = 'new/list';
			$this->data['title'] = $dataTag['title'];
			$this->data['seoType'] = 'object';
			$this->data['name'] = $dataTag['name'];
			$this->data['description'] = $dataTag['description'];

			$this->new_model->likeConditions = array("CONCAT(',',tag_ids,',')" => $dataTag['id']);
			//Pagination
			$this->new_model->conditions = array('status' => 1);
	        $totalNews = $this->new_model->getCountItems();

	        //pagination configuration
	        $config['target']      = '#pageAjax';
	        $config['base_url']    = base_url().'sam/news/ajaxPagination';
	        $config['link_func']   = 'filterNew';
	        $config['total_rows']  = $totalNews;
	        $config['per_page']    = $this->perPage;
	        
	        $this->ajax_pagination->initialize($config);

	        $this->new_model->pageSize = $this->perPage;
	        $this->new_model->pageNum = 0;
	        $this->data['paginations'] = $this->ajax_pagination->create_links();
			$this->data['news'] = $this->new_model->getItems();
			$this->data['tagId'] = $dataTag['id'];

			//$this->data['news'] = $this->new_model->getNewByCateId($cateId);
			$this->data['newCategories'] = $this->category->getNewcategories();
			$this->data['topNews'] = $this->new_model->getTopNews();
			$this->data['newNews'] = $this->new_model->getNewNews(); 
			$this->load->view($this->data['masterPage'], $this->data);
		}else{
			show_404();
		}
		
	}
	public function ajaxPagination(){
		$this->load->library('Ajax_pagination');
		
		$page = $this->input->post('page');
		$categoryId = $this->input->post('categoryId');
		$tagId = $this->input->post('tagId');

        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        if(isset($categoryId) && is_numeric($categoryId)){
        	$this->new_model->conditions = array('category_id' => $categoryId, 'status' => 1);
		}

		if(isset($tagId) && is_numeric($tagId)){
        	$this->new_model->conditions = array('status' => 1);
			$this->new_model->likeConditions = array("CONCAT(',',tag_ids,',')" => $tagId);
		}
        //total rows count
        $totalNews = $this->new_model->getCountItems();
        
        //pagination configuration
        $config['target']      = '#pageAjax';
        $config['base_url']    = base_url().'sam/news/ajaxPagination';
        $config['link_func']   = 'filterNew';
        $config['total_rows']  = $totalNews;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = $offset;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->new_model->pageSize = $this->perPage;
        $this->new_model->pageNum = $offset;
        $this->data['paginations'] = $this->ajax_pagination->create_links();
        //debug($this->data['paginations']);
		$this->data['news'] = $this->new_model->getItems();
        
        //load the view
        $this->load->view('new/pageAjax', $this->data);
	}

}