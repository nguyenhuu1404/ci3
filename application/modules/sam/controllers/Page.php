<?php 
class Page extends FrontendController{
	
	public function __construct(){
		parent::__construct(); 
		$this->load->model('product');
	}
	public function contact(){
		$this->load->library('form_validation');
		$this->data['layout'] = 'page/contact';
		$this->data['seoType'] = 'article';
		$this->data['title'] = 'Liên hệ';
		$this->data['description'] = 'Liên hệ ngay với tủ thuốc nam. Chúng tôi sẽ giúp bạn giúp đáp mọi thắc mắc về vấn đề sức khỏe';
		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['viewProducts'] = $this->product->getViewProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();
		
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
            	$post = $this->input->post();
            	$contact = $post;
            	$contact['ip'] = $this->input->ip_address();
            	$contact['created'] = date('Y-m-d H:i:s', time());
            	$userData = $this->session->userdata('userData');
	            if(isset($userData['id'])){
	            	$contact['user_id'] = $userData['id'];
	            }
            	$this->load->model('contact');
            	$this->contact->save('contacts', $contact);

            	redirect('sam/page/thank');
            }
		}

		
		
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function thank(){
		$this->data['layout'] = 'page/thank';
		$this->data['title'] = 'Cảm ơn';
		$this->data['description'] = 'Cảm ởn bạn đã liên hệ với chúng tôi.';
		
		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['viewProducts'] = $this->product->getViewProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function about(){
		
		$this->data['layout'] = 'page/about';
		$this->data['title'] = 'Về chúng tôi';
		$this->data['description'] = 'Giới thị về tủ thuốc nam. Trang web chuyên cung cấp thông tin về sức khỏe.';
		$this->data['seoType'] = 'article';
		
		$this->data['newProducts'] = $this->product->getNewProduct();
		$this->data['hotProducts'] = $this->product->getHotProduct();
		$this->data['viewProducts'] = $this->product->getViewProduct();
		$this->data['recommendProducts'] = $this->product->getRecommendProduct();
		$this->load->view($this->data['masterPage'], $this->data);
	}
}