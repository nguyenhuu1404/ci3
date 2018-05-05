<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends AdminGrocery {
	protected $table = 'orders';
	protected $subject = 'Đơn hàng';
	protected $columns = 'id, fullname, email, phone, address_ship, total_price, payment_method, order_status, status, created';
	protected $edit_fields = 'status, order_status, user_id';

	public function index(){
		$this->setGrocery();
		$this->callbackGrocery();
		$crud = $this->crud;
		$this->load->model('order');
		$users = $this->order->getOptionByField('fullname', 'users');
		$order_status = array(
			'processing' => 'Đang xử lí',
			'completed'  => 'Thành công',
			'cancelled'  => 'Hủy',
			'refunded'	 => 'Hoàn tiền',
			'shipping'	 => 'Đang vận chuyển',
			'on-hold'    => 'Chờ thanh toán'
		);

		$this->editFields();
		$crud->field_type('order_status', 'dropdown', $order_status);
		$crud->field_type('user_id', 'dropdown', $users);
		$crud->unset_add();
		$output = $this->crud->render();
		$this->_example_output($output);
		
	}

}
