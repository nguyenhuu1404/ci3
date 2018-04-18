<?php 
class Products extends FrontendController{
	public $perPage = 1;
	
	public function __construct(){
		parent::__construct();  
		$this->load->model('product');   
	}
	public function index(){
		
		$this->load->library('Ajax_pagination');

		$this->data['layout'] = 'product/index';
		$this->data['title'] = 'School';
		$this->data['description'] = 'School';
		$this->data['productCategories'] = $this->category->getCategoriesByType('product');

		//Pagination
        $totalProduct = $this->product->getCountItems();
        //debug($totalRec);
        
        //pagination configuration
        $config['target']      = '#pageAjax';
        $config['base_url']    = base_url().'sam/products/ajaxPagination';
        $config['total_rows']  = $totalProduct;
        $config['per_page']    = $this->perPage;
        $this->ajax_pagination->initialize($config);

        $this->product->pageSize = $this->perPage;
        $this->product->pageNum = 0;
		$this->data['products'] = $this->product->getItems();

		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function detail($slug){
		$this->data['layout'] = 'product/detail';
		$this->data['title'] = 'School';
		$this->data['description'] = 'School';

		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function category($slug){
		$this->data['layout'] = 'product/category';
		$this->data['title'] = 'School';
		$this->data['description'] = 'School';

		$this->load->view($this->data['masterPage'], $this->data);
	}

	public function ajaxPagination(){
		$this->load->library('Ajax_pagination');
		
		$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalProduct = $this->product->getCountItems();
        
        //pagination configuration
        $config['target']      = '#pageAjax';
        $config['base_url']    = base_url().'sam/products/ajaxPagination';
        $config['total_rows']  = $totalProduct;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = $offset;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->product->pageSize = $this->perPage;
        $this->product->pageNum = $offset;
		$this->data['products'] = $this->product->getItems();
        
        //load the view
        $this->load->view('product/pageAjax', $this->data);
	}

	public function sortProduct(){

	}
}