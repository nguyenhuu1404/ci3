<?php 
class Users extends FrontendController{
	
	public function __construct(){
		parent::__construct(); 
		// Load facebook library
        $this->load->library('facebook');
        
        //Load user model
        $this->load->model('user');
	}
	public function login(){
		if($this->session->userdata('userData')){
            $this->data['layout'] = 'user/account';
            $this->data['title'] = 'Trang cá nhân';
            $this->data['description'] = 'Trang cá nhân';
                
            $this->load->view($this->data['masterPage'], $this->data);
        }else{
            $this->data['layout'] = 'user/login';
            $this->data['title'] = 'Đăng nhập/Đăng kí';
            $this->data['description'] = 'Đăng nhập/Đăng kí';
            $this->data['authURL'] =  $this->facebook->login_url();

            $this->load->library('form_validation');
            $key = config_item('encryption_key');



            if($this->input->post('signin') == 1){
                $post = $this->input->post();
                $pass = fillter($post['in_password']);
                $password = md5($key.$pass);
                $userdata = $this->user->loginEmail($post['in_email'], $password);
                if($userdata) {
                    $this->session->set_userdata('userData',$userdata);
                    $payment = $this->input->get('payment');
                    if(isset($payment) && $payment ==1){
                        redirect('thanh-toan.html');
                    }else{
                        redirect('my-account.html');
                    }
                    
                }else{
                    $errors[] = 'Email or mật khẩu không đúng';
                    $this->data['in_errors'] = $errors;
                }  
            }else if($this->input->post('signup') == 1){
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
                            'rules' => 'required|valid_email|is_unique[users.email]',
                            'errors' => array(
                                    'required' => '%s không được để trống.',
                                    'valid_email' => 'Email không đúng định dạng.',
                                    'is_unique'     => '%s đã được sử dụng.'
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
                    ),
                    array(
                            'field' => 'password',
                            'label' => 'Mật khẩu',
                            'rules' => 'required',
                            'errors' => array(
                                    'required' => '%s không được để trống.'
                            ),
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE){
                        $this->load->view($this->data['masterPage'], $this->data);
                }else{

                    $post = $this->input->post();
                    $pass = fillter($post['password']);
                    $password = md5($key.$pass);
                    $userData = array(
                        'fullname' => $post['fullname'],
                        'email' => $post['email'],
                        'phone' => $post['phone'],
                        'password' => $password,
                        'role_id' => 2,
                        'status' => 1,
                        'created' => date('Y-m-d H:i:s'),
                        'ip' => $this->input->ip_address()
                    );
                    $userId = $this->user->save('users', $userData);
                    $userSession = array(
                        'id' => $userId,
                        'fullname' => $post['fullname'],
                        'email' => $post['email'],
                        'phone' => $post['phone']
                    );
                    $this->session->set_userdata('userData', $userSession);
                    $payment = $this->input->get('payment');
                    if(isset($payment) && $payment ==1){
                        redirect('thanh-toan.html');
                    }else{
                        redirect('my-account.html');
                    }
                }

            }
           
            $this->load->view($this->data['masterPage'], $this->data);
        }
		
	}

    public function facebook(){
        $userData = array();
        
        // Check if user is logged in
        if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $fbUserProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,link,gender,locale,cover,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_uid'] = $fbUserProfile['id'];
            $userData['fullname'] = $fbUserProfile['first_name'].$fbUserProfile['last_name'];
            $userData['email'] = $fbUserProfile['email'];
            $userData['gender'] = $fbUserProfile['gender'];
            $userData['locale'] = $fbUserProfile['locale'];
            $userData['cover'] = $fbUserProfile['cover']['source'];
            $userData['picture'] = $fbUserProfile['picture']['data']['url'];
            $userData['link'] = $fbUserProfile['link'];
            
            // Insert or update user data
            $userID = $this->user->checkUserFacebook($userData);
            
            // Check user data insert or update status
            if(!empty($userID)){
                $data['userData'] = $userData;
                $this->session->set_userdata('userData',$userData);
            }else{
               $data['userData'] = array();
            }
            
            // Get logout URL
            $data['logoutURL'] = $this->facebook->logout_url();
            $payment = $this->input->get('payment');
            if(isset($payment) && $payment ==1){
                redirect('thanh-toan.html');
            }else{
                redirect('my-account.html');
            }
        }else{
            // Get login URL
            $data['authURL'] =  $this->facebook->login_url();
        }
        
        // Load login & profile view
         debug($data);
    }

    public function logout() {
        // Remove local Facebook session
        $this->facebook->destroy_session();
        // Remove user data from session
        $this->session->unset_userdata('userData');
        // Redirect to login page
        redirect('my-account.html');
    }

    public function orders(){
        if($this->session->userdata('userData')){
            $userData = $this->session->userdata('userData');
            $this->data['layout'] = 'user/orders';
            $this->data['title'] = 'Danh sách các đơn hàng';
            $this->data['description'] = 'Danh sách các đơn hàng của bạn ở tủ thuốc nam';
            $this->load->model('order');
            $this->data['orders'] = $this->order->getOrderByUser($userData['id']);
                
            $this->load->view($this->data['masterPage'], $this->data);
        }else{
            redirect('my-account.html');
        }
    }
    public function view($orderId){
        if($this->session->userdata('userData')){
            $userData = $this->session->userdata('userData');
            $this->load->model('order');
            $checkOrderByUser = $this->order->checkOrderByUser($orderId, $userData['id']);
            if($checkOrderByUser){

                $this->data['layout'] = 'user/orderitems';
                $this->data['title'] = 'Chi tiết đơn hàng';
                $this->data['description'] = 'Chi tiết đơn hàng củ bạn khi mua hàng ở tủ thuốc nam';
                $this->data['order'] = $this->order->getOne($orderId);
                $this->data['orderItems'] = $this->order->getOrderItems($orderId);
                    
                $this->load->view($this->data['masterPage'], $this->data);

            }else{
                redirect('sam/users/orders');
            }
        }else{
            redirect('my-account.html');
        }
    }
    public function edit(){
        if($this->session->userdata('userData')){
            $this->load->library('form_validation');
            $this->data['layout'] = 'user/edit';
            $this->data['title'] = 'Sửa thông tin cá nhân';
            $this->data['description'] = 'Sửa thông tin cá nhân củ bạn để chúng tôi hiểu hơn về bạn.';
            
            if($this->input->post()){
                $key = config_item('encryption_key');
                $sUserData = $this->session->userdata('userData');
                $userData = $this->user->getOne($sUserData['id']);
                $post = $this->input->post();

                if($post['oldpassword'] != '' && $post['password'] != ''){
                    $pass = fillter($post['oldpassword']);
                    $password = md5($key.$pass);
                    if($password == $userData['password']){
                        $this->user->save('users', array('address_ship' => $post['address_ship'], 'password' => $password), $sUserData['id']);
                        $this->data['success'] = 'Cập nhật thành công. Thoát ra đăng nhập lại <a href="/sam/users/logout">đăng xuất</a>';
                    }else{
                        $this->data['error'] = 'Mật khẩu hiện tại không đúng'; 
                    }
                }else{
                    if($post['address_ship'] != '' && $post['address_ship'] != $userData['address_ship']){
                        $this->user->save('users', array('address_ship' => $post['address_ship']), $sUserData['id']);
                         $this->data['success'] = 'Cập nhật thành công. Thoát ra đăng nhập lại <a href="/sam/users/logout">đăng xuất</a>';

                    }
                }
                $this->load->view($this->data['masterPage'], $this->data);
            }
                
            $this->load->view($this->data['masterPage'], $this->data);
            
        }else{
            redirect('my-account.html');
        }
    }
}