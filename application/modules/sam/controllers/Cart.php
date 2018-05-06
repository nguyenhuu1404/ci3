<?php
class Cart extends FrontendController{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('product');
	}
	public function addcart(){
		$productId = $this->input->post('productId');
		if(is_numeric($productId)){
			$product = $this->product->getOne($productId);
			$quantity = $this->input->post('quantity');

			if($product['price_sale']){
				$price = $product['price_sale'];
			}else{
				$price = $product['price'];
			}
			//ten san pham khong duoc chua ki tu la
			$data = array(
			        'id'      => $productId,
			        'qty'     => $quantity,
			        'price'   => $price,
			        'name'    => str_replace('/', '_', $product['name']),
			        'image'	  => $product['image'],
			        'slug'	  => $product['slug']	
			);
			
			$this->cart->save($data);
			$this->load->view('cart/cart');
		}
	}
	public function removeCartItemMenu(){
		$id = $this->input->post('id');
		if(is_numeric($id)){
			$rowids = $this->cart->getRowidById();
			$rowid = $rowids[$id];
			$this->cart->remove($rowid);
			$this->load->view('cart/cart');
			
		}
	}
	public function update(){
		//$this->load->helper('url');
		$data = $this->input->post();
		if(is_array($data) && count($data) > 0){
			$this->cart->update($data);
			redirect('/sam/cart/showCart', 'refresh');
		}
		
	}
	public function showCart(){
		$this->load->helper('form');
		$this->data['layout'] = 'cart/showcart';
		$this->data['title'] = 'Trang giỏ hàng nơi lưu giữ các sản phẩm bạn muốn mua tại tủ thuốc nam.';
		$this->data['seoType'] = 'article';
		$this->data['description'] = 'Trang giỏ hàng của tủ thuốc nam cung cấp các sản phẩm mà bạn muốn mua, giúp bạn dễ dàng trong việc mua hàng tại tủ thuốc nam.';
		
		$this->load->model('new_model');
		$this->data['newCategories'] = $this->category->getNewcategories();
		$this->data['topNews'] = $this->new_model->getTopNews();
		$this->data['newNews'] = $this->new_model->getNewNews();
		$this->load->view($this->data['masterPage'], $this->data);
		
	}
}
?>