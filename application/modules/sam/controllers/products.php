<?php 
class Products extends FrontendController{
	public $perPage = 9;
	
	public function __construct(){
		parent::__construct();  
		$this->load->model('product');   
	}
	public function index(){

		$this->load->library('Ajax_pagination');

		$this->data['css'] = array('jquery-ui.min');
		$this->data['js'] = array(
			array(
				'name' => 'jquery-ui.min'
			)
			
		);
		$dataCategory = $this->product->getOneField('slug', 'san-pham', 'categories', 'title, description');
		$this->data['layout'] = 'product/index';
		$this->data['title'] = $dataCategory['title'];
		$this->data['seoType'] = 'object';
		$this->data['name'] = 'Sâm ngọc linh';
		$this->data['description'] = $dataCategory['description'];
		$this->data['productCategories'] = $this->category->getCategoriesByType('product');

		//Pagination
        $totalProduct = $this->product->getCountItems();
        //debug($totalRec);
        
        //pagination configuration
        $config['target']      = '#pageAjax';
        $config['base_url']    = base_url().'sam/products/filterProduct';
        $config['total_rows']  = $totalProduct;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'filterProduct';
        $this->ajax_pagination->initialize($config);

        $this->product->pageSize = $this->perPage;
        $this->product->pageNum = 0;

        $this->data['paginations'] = $this->ajax_pagination->create_links();
		$this->data['products'] = $this->product->getItems();

		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['viewProducts'] = $this->product->getViewProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();

		$this->data['maxPrice'] = $this->product->getMaxField('price');
		$this->data['minPrice'] = $this->product->getMinField('price');

		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function detail($slug){
		$product = $this->product->getOneField('slug', $slug, 'products');
		if($product){
			$this->data['layout'] = 'product/detail';
			$this->data['title'] = $product['title'];
			$this->data['seoType'] = 'article';
			$this->data['description'] = $product['description'];
			$this->data['seoImage'] = base_url('assets/sam/images/products/').$product['image'];
			$this->data['name'] = $product['name'];
			$this->data['product'] = $product;

			$this->data['newProducts'] = $this->product->getNewProduct();
			$this->data['hotProducts'] = $this->product->getHotProduct();
			$this->data['viewProducts'] = $this->product->getViewProduct();
			$this->data['recommendProducts'] = $this->product->getRecommendProduct();

			//views
			$views = $product['views'] + 1;
			$this->product->save('products', array('views' => $views), $product['id']);

			$this->load->model('tag');
			$this->data['tags'] = $this->tag->getTags($product['tag_ids']);
			$this->data['relateProducts'] = $this->product->getRelateProduct( $product['id'],  $product['category_ids']);

			$this->data['galleries'] = $this->product->getGalleries($product['id']);

			$parents = $this->category->getDataParents($product['category_ids']);
			$breadcrumbs = array(
				array(
					'name' => 'Trang chủ',
					'url' => '/'
				),
				array(
					'name' => 'Sản phẩm',
					'url' => '/san-pham.html'
				)
			);
			$i = 2;
			foreach ($parents as $parent) {
				$breadcrumbs[$i]['name'] = $parent['name'];
				$breadcrumbs[$i]['url'] = '/danh-muc/'.$parent['slug'].'.html';
				$i++;
			}
			$breadcrumbs[$i]['name'] = $product['name'];
			$this->data['breadcrumbs']= $breadcrumbs;

			$this->load->view($this->data['masterPage'], $this->data);	
		}else{
			show_404();
		}
		
	}
	public function category($slug){
		
		$dataCategory = $this->category->getCategoryBySlug($slug, 'product');
		if($dataCategory){

			$this->load->library('Ajax_pagination');

			$this->data['css'] = array('jquery-ui.min');
			$this->data['js'] = array(
				array(
					'name' => 'jquery-ui.min'
				)
				
			);
			
			$this->data['layout'] = 'product/index';
			$this->data['title'] = $dataCategory['title'];
			$this->data['name'] = $dataCategory['name'];
			$this->data['seoType'] = 'object';
			$this->data['description'] = $dataCategory['description'];
			$this->data['productCategories'] = $this->category->getCategoriesByType('product');

			$this->product->likeConditions = array("CONCAT(',',category_ids,',')" => $dataCategory['id']);
			//Pagination
	        $totalProduct = $this->product->getCountItems();
	        //debug($totalRec);
	        
	        //pagination configuration
	        $config['target']      = '#pageAjax';
	        $config['base_url']    = base_url().'sam/products/filterProduct';
	        $config['total_rows']  = $totalProduct;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'filterProduct';
	        $this->ajax_pagination->initialize($config);

	        $this->product->pageSize = $this->perPage;
	        $this->product->pageNum = 0;
	         $this->data['paginations'] = $this->ajax_pagination->create_links();
			$this->data['products'] = $this->product->getItems();

			$this->data['newProducts'] = $this->product->getNewProduct();
			$this->data['hotProducts'] = $this->product->getHotProduct();
			$this->data['viewProducts'] = $this->product->getViewProduct();
			$this->data['recommendProducts'] = $this->product->getRecommendProduct();

			$this->data['maxPrice'] = $this->product->getMaxField('price');
			$this->data['minPrice'] = $this->product->getMinField('price');
			$this->data['categoryId'] = $dataCategory['id'];

			$parents = $this->category->getDataParents($dataCategory['parents']);
			$breadcrumbs = array(
				array(
					'name' => 'Trang chủ',
					'url' => '/'
				),
				array(
					'name' => 'Sản phẩm',
					'url' => '/san-pham.html'
				)
			);
			$i = 2;
			foreach ($parents as $parent) {
				$breadcrumbs[$i]['name'] = $parent['name'];
				$breadcrumbs[$i]['url'] = '/danh-muc/'.$parent['slug'].'.html';
				$i++;
			}
			$this->data['breadcrumbs']= $breadcrumbs;

			$this->load->view($this->data['masterPage'], $this->data);
		}else{
			show_404();
		}
	}

	public function filterProduct(){

		$this->load->library('Ajax_pagination');

		$page = $this->input->post('page');
		$minPriceInput = $this->input->post('minPrice');
		$maxPriceInput = $this->input->post('maxPrice');
		$categoryId = $this->input->post('categoryId');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $maxPrice = $this->product->getMaxField('price');
		$minPrice = $this->product->getMinField('price');

		$name = $this->input->post('name');
		if($name != ''){
			$this->product->likeTexts = array("name" => $name);
		}
		
		if(isset($categoryId) && is_numeric($categoryId)){
			$this->product->likeConditions = array("CONCAT(',',category_ids,',')" => $categoryId);
		}

		if(isset($tagId) && is_numeric($tagId)){
			$this->product->likeConditions = array("CONCAT(',',tag_ids,',')" => $tagId);
		}


		if($minPriceInput > $minPrice || $maxPriceInput < $maxPrice){

			
			$this->product->conditions = array('price >=' => $minPriceInput, 'price <=' => $maxPriceInput);
		}
        
        //total rows count
        $totalProduct = $this->product->getCountItems();
        
        //pagination configuration
        $config['target']      = '#pageAjax';
        $config['base_url']    = base_url().'sam/products/filterProduct';
        $config['link_func']   = 'filterProduct';
        $config['total_rows']  = $totalProduct;
        $config['per_page']    = $this->perPage;
        $config['cur_page']    = $offset;
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $this->product->pageSize = $this->perPage;
        $this->product->pageNum = $offset;
        $this->data['paginations'] = $this->ajax_pagination->create_links();
		$this->data['products'] = $this->product->getItems();
        
        //load the view
        $this->load->view('product/filterProduct', $this->data);
	}
	
	public function tag($slug){

		$dataTag = $this->product->getTagBySlug($slug, 'product');
		if($dataTag){
			$this->load->library('Ajax_pagination');

			$this->data['css'] = array('jquery-ui.min');
			$this->data['js'] = array(
				array(
					'name' => 'jquery-ui.min'
				)
				
			);
			
			$this->data['layout'] = 'product/index';
			$this->data['title'] = $dataTag['title'];
			$this->data['name'] = $dataTag['name'];
			$this->data['seoType'] = 'object';
			$this->data['description'] = $dataTag['description'];
			$this->data['productCategories'] = $this->category->getCategoriesByType('product');

			$this->product->likeConditions = array("CONCAT(',',tag_ids,',')" => $dataTag['id']);
			//Pagination
	        $totalProduct = $this->product->getCountItems();
	        //debug($totalRec);
	        
	        //pagination configuration
	        $config['target']      = '#pageAjax';
	        $config['base_url']    = base_url().'sam/products/filterProduct';
	        $config['total_rows']  = $totalProduct;
	        $config['per_page']    = $this->perPage;
	        $config['link_func']   = 'filterProduct';
	        $this->ajax_pagination->initialize($config);

	        $this->product->pageSize = $this->perPage;
	        $this->product->pageNum = 0;
	        $this->data['paginations'] = $this->ajax_pagination->create_links();
			$this->data['products'] = $this->product->getItems();

			$this->data['newProducts'] = $this->product->getNewProduct();
			$this->data['hotProducts'] = $this->product->getHotProduct();
			$this->data['viewProducts'] = $this->product->getViewProduct();
			$this->data['recommendProducts'] = $this->product->getRecommendProduct();

			$this->data['maxPrice'] = $this->product->getMaxField('price');
			$this->data['minPrice'] = $this->product->getMinField('price');
			$this->data['tagId'] = $dataTag['id'];

			$this->load->view($this->data['masterPage'], $this->data);
		}else{
			show_404();
		}
	}
	public function tuvan(){
		$post = $this->input->post();
		if($post){
			$data['product_name'] = $post['productName'];
			$data['product_id'] = $post['productId'];
			$data['name'] = $post['tuvanName']; 
			$data['phone'] = $post['tuvanPhone'];
			$data['created'] = date('Y-m-d H:i:s', time());
			if($this->session->userdata('userData')){
				$user = $this->session->userdata('userData');
				$data['user_id'] = $user['id']; 
			}   
			$this->product->save('tuvan', $data);

			echo 1;
		}
		
	}
	public function search(){
		$name = $this->input->get('name');
		if($name != ''){
			$this->product->likeTexts = array("name" => $name);
		}
		$this->load->library('Ajax_pagination');

		$this->data['css'] = array('jquery-ui.min');
		$this->data['js'] = array(
			array(
				'name' => 'jquery-ui.min'
			)
			
		);
		
		$this->data['layout'] = 'product/index';
		$this->data['title'] = 'Tìm kiếm sản phẩm với tủ thuốc nam';
		$this->data['description'] = 'Trang tìm kiếm sản phẩm của website tủ thuốc nam';
		$this->data['name'] = 'Sâm ngọc linh';
		$this->data['seoType'] = 'object';
		$this->data['productCategories'] = $this->category->getCategoriesByType('product');

		//Pagination
        $totalProduct = $this->product->getCountItems();
        //debug($totalRec);
        
        //pagination configuration
        $config['target']      = '#pageAjax';
        $config['base_url']    = base_url().'sam/products/filterProduct';
        $config['total_rows']  = $totalProduct;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'filterProduct';
        $this->ajax_pagination->initialize($config);

        $this->product->pageSize = $this->perPage;
        $this->product->pageNum = 0;
         $this->data['paginations'] = $this->ajax_pagination->create_links();
		$this->data['products'] = $this->product->getItems();

		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['viewProducts'] = $this->product->getViewProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();

		$this->data['maxPrice'] = $this->product->getMaxField('price');
		$this->data['minPrice'] = $this->product->getMinField('price');

		$this->load->view($this->data['masterPage'], $this->data);
	}
}