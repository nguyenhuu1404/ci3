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
						//gui mail
						$dataOrder['id'] = $orderId;
						$this->sendMail($dataOrder, $order_items);
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
	public function sendMail($order, $orderItens){
		 if($order['payment_method'] == 'bacs'){
	        	$payment_method = 'Chuyển khoản ngân hàng';
	        	$note = ' Đơn hàng của bạn chỉ được xử lí khi chúng tôi nhận được thanh toán. Hãy chuyển khoản cho chúng tôi theo thông tin ngân hàng ở bên dưới.';
	        	$nganhang = '<h3>Tài khoản ngân hàng của chúng tôi</h3>
					<table cellspacing="0" cellpadding="6" class="table">
						<tbody>
							<tr>
								<td>Số tài khoản:</td>
								<td><b>007704060046435<b></td>
							</tr>
							<tr>
								<td>Chủ tài khoản:</td>
								<td><b>NGUYEN VAN HUU<b></td>
							</tr>
							<tr>
								<td>Ngân hàng:</td>
								<td><b>Vib(Ngân hàng quốc tế)</b></td>
							</tr>
							<tr>
								<td>Chi nhánh:</td>
								<td><b>Thanh Xuân - Hà Nội</b></td>
							</tr>
							<tr>
								<td>Nội dung chuyển khoản:</td>
								<td><b>Họ tên - Mã đơn hàng</b></td>
							</tr>

						</tbody>
					</table>';
	        }else if($order['payment_method'] =='cod'){
	        	$payment_method = 'Thanh toán khi giao hàng';
	        	$nganhang = '';
	        	$note = '';
	        }
		$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		    <meta http-equiv="Content-Type" content="text/html; charset="utf8" />
		    <title>Đặt hàng thành công</title>
		    <style type="text/css">
		        body {
		            font-family: "Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;
		            font-size: 16px;
		        }
		        .header{background: #f22738; font-weight: bold; font-size: 18px; color: white; padding: 20px;}
		        .table{
		        	width: 100%;
    				font-family: "Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;
    				color: #636363;
    				border: 1px solid #e5e5e5;
    			}
    			.table tr td, .table tr th{
    				    text-align: left;
					    vertical-align: middle;
					    border: 1px solid #eee;
					    word-wrap: break-word;
					    color: #636363;
					    padding: 12px;

    			}
    			.content{width: 100%;}
		    </style>
		</head>
		<body>

			<div style="border: 1px solid #eee; width: 600px; margin: 0px auto;">
				<div class="header">
					Cảm ơn bạn đã đặt hàng
				</div>
				<div style="padding: 15px;" >
					<section style="margin-bottom: 10px; font-size: 18px;">
					Đơn hàng của bạn đã được đặt thành công.'.$note.'
					</section>
					<h2>Mã hàng: <b style="color: #f22738;">'.$order['id'].'</b></h2>
					<h3>Chi tiết đơn hàng</h3>
					<table cellspacing="0" cellpadding="6" class="table">
						<tbody>
							<tr>
								<td><b>Sản phẩm</b></td>
								<td><b>Sỗ lượng</b></td>
								<td><b>Giá</b></td>
							</tr>';
							foreach ($orderItens as  $item) {
								$body .= '<tr>
									<td><a href="http://tuthuocnam.com/san-pham/' .$item['slug']. '.html">'.$item['name'].'</a></td>
									<td>'.$item['qty'].'</td>
									<td>'.$item['price'].'</td>
								</tr>';
							}
							

							$body .='<tr>
								<td colspan="2">Tổng tiền</td>
								<td><b class="main-color fs13">'.formatPrice($order['total_price']).'</b></td>
							</tr>
							<tr>
								<td colspan="2">Phương thức thanh toán</td>
								<td><b>'.$payment_method.'</b>
								</td>
							</tr>

						</tbody>
					</table>
					<h3>Chi tiết khách hàng</h3>
					<table cellspacing="0" cellpadding="6" class="table">
						<tbody>
							<tr>
								<td>Họ tên:</td>
								<td><b>'.$order['fullname'].'<b></td>
							</tr>
							<tr>
								<td>Số điện thoại:</td>
								<td><b>'.$order['phone'].'</b></td>
							</tr>
							<tr>
								<td>Địa chỉ giao hàng:</td>
								<td><b>'.$order['address_ship'].'</b></td>
							</tr>

						</tbody>
					</table>

					'.$nganhang.'

				</div>
				<div style="text-align: center; padding-top: 15px; padding-bottom: 30px;">
					Tủ thuốc nam - <a href="http://tuthuocnam.com">tuthuocnam.com</a>
				</div>
			</div>

		</body>
		</html>';
		$this->load->library('email');
		$this->email
		    ->from('gowebtut@gmail.com', 'TuThuocNam')
		    ->to('nguyenhuu140490@gmail.com')
		    ->subject('Đặt hàng thành công tại tuthuocnam.com')
		    ->message($body)
		    ->send();

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