<?php
class Payment extends FrontendController{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('product');
		$this->load->model('order');
	}
	public function checkout(){
		if($this->cart->total_items() > 0){
			$this->data['layout'] = 'payment/checkout';
			$this->data['title'] = 'Trang thanh toán khi bạn mua hàng tại tủ thuốc nam';
			$this->data['name'] = 'Thanh toán';
			$this->data['seoType'] = 'article';
			$this->data['description'] = 'Trang thanh toán là nơi bạn nhập các thông tin cá nhân cần thiết để chúng tôi liên hệ xử lí đơn hàng của bạn khi bạn mua hàng tại tủ thuốc nam.';
			$this->load->library('form_validation');
			$this->load->model('new_model');
			if($this->input->post()){
				

				$config = array(
			        array(
			                'field' => 'fullname',
			                'label' => 'Họ tên',
			                'rules' => 'required',
			                'errors' => array(
			                        'required' => '%s không được để trống.'
			                ),
			        ),
			        array(
			                'field' => 'email',
			                'label' => 'Email',
			                'rules' => 'required|valid_email',
			                'errors' => array(
			                        'required' => '%s không được để trống.',
			                        'valid_email' => 'Email không đúng định dạng.'
			                ),
			        ),
			        array(
			                'field' => 'phone',
			                'label' => 'Điện thoại',
			                'rules' => 'required|regex_match[/^(01[2689]|02|09)/]|regex_match[/[0-9]$/]',
			                'errors' => array(
			                        'required' => '%s không được để trống.',
			                        'regex_match' => '%s không đúng định dạng.'
			                ),
			        )
				);

				$this->form_validation->set_rules($config);

				if ($this->form_validation->run() == FALSE){
					$this->data['newCategories'] = $this->category->getNewcategories();
					$this->data['topNews'] = $this->new_model->getTopNews();
					$this->data['newNews'] = $this->new_model->getNewNews(); 
	                $this->load->view($this->data['masterPage'], $this->data);
	            }else{

	            	if($this->cart->total_items() > 0){
		                $post = $this->input->post();
		                $payment_method = $post['payment_method'];
		                $dataOrder = $post;
		                $userData = $this->session->userdata('userData');
		                if(isset($userData['id'])){
		                	$dataOrder['user_id'] = $userData['id'];
		                	$user = $this->order->getOneField('id', $userData['id'], 'users', 'address_ship');
		                	if($user['address_ship'] == ''){
		                		$this->order->save('users', array('address_ship' => $dataOrder['address_ship']), $userData['id']);
		                	}
		                }
		                $dataOrder['total_price'] = $this->cart->total();
		                $dataOrder['ip'] = $this->input->ip_address();
		                $dataOrder['created'] = date('Y-m-d H:i:s', time());    
		                
						 if($payment_method == 'bacs'){
		                	$dataOrder['order_status'] = 'on-hold';
		                }else if($payment_method =='cod'){
		                	$dataOrder['order_status'] = 'received';
		                }
						
		                $this->load->library('encryption');
						$key = bin2hex($this->encryption->create_key(16));
						$dataOrder['key'] = $key;

						$orderId = $this->order->save('orders', $dataOrder);

						$order_items = $this->cart->contents();
						$dataOrderItems = array();
						foreach ($order_items as $item) {
							$dataOrderItems[$item['id']]['product_id'] = $item['id'];
							$dataOrderItems[$item['id']]['order_id'] = $orderId;
							$dataOrderItems[$item['id']]['qty'] = $item['qty'];
							$dataOrderItems[$item['id']]['price'] = $item['price'];
							$dataOrderItems[$item['id']]['subtotal'] = $item['subtotal'];
							$dataOrderItems[$item['id']]['name'] = $item['name'];
							$dataOrderItems[$item['id']]['slug'] = $item['slug'];
							$dataOrderItems[$item['id']]['image'] = $item['image'];
						}
						//debug($dataOrderItems);
						$this->order->insertMany('order_items', $dataOrderItems);
						//destroy
						$this->cart->destroy();
						redirect('sam/payment/received/'.$orderId.'/'.$key);
					}else{
						redirect('gio-hang.html');
					}	
	        	}

				
			}
			$this->data['newCategories'] = $this->category->getNewcategories();
			$this->data['topNews'] = $this->new_model->getTopNews();
			$this->data['newNews'] = $this->new_model->getNewNews(); 
			 $this->load->view($this->data['masterPage'], $this->data);
			
		}else{
			redirect('gio-hang.html');
		}
		
	}
	public function received($orderId, $orderKey){

		$order = $this->order->getOne($orderId);

		if(isset($orderKey) && $order['key'] == $orderKey){

			$this->data['layout'] = 'payment/thanks';
			$this->data['title'] = 'Thanh toán thành công';
			$this->data['description'] = 'Thanh toán thành công';
			$this->data['seoType'] = 'article';
			$this->data['order'] = $order;
			$this->data['products'] = $this->order->getOrderItems($orderId);
			
			$this->load->model('new_model');
			$this->data['newCategories'] = $this->category->getNewcategories();
			$this->data['topNews'] = $this->new_model->getTopNews();
			$this->data['newNews'] = $this->new_model->getNewNews(); 
			$this->load->view($this->data['masterPage'], $this->data);	
		}else{
			redirect('/');
		}
		
	}
}
?>