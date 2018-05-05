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
			$this->data['title'] = 'Thanh toán';
			$this->data['seoType'] = 'article';
			$this->data['description'] = 'Thanh toán cực kì dễ dàng với tủ thuốc nam.';
			$this->load->library('form_validation');
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
		                	$dataOrder['order_status'] = 'processing';
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
		

			$this->load->view($this->data['masterPage'], $this->data);	
		}else{
			redirect('/');
		}
		
	}
}
?>