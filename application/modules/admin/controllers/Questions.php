<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Questions extends AdminGrocery {
	protected $table = 'questions';
	protected $subject = 'Câu hỏi';
	protected $columns = 'id, name, created';
	protected $add_fields = 'name, category_ids, test_ids, explain, status, created, createdId';
	protected $edit_fields = 'name, category_ids, test_ids, explain, status, modified, modifiedId, modifiedIds';
	public function __construct(){
		parent::__construct();
		$this->load->model('question');
	}
	public function index(){
	
		$crud = $this->crud;

		$this->setGrocery();
		//auto created
		$this->callbackGrocery();
		$this->editFields();
		$this->addFields();
		$crud->required_fields('name');
		
		$crud->add_action('Đáp án', '', '', 'ui-icon-plus', array($this, 'linkDetail'));
		
		$categories = $this->question->getParentOptions('categories');
		$crud->field_type('category_ids', 'multiselect', $categories);
		
		$tests = $this->question->getOptionByField('name', 'tests');
		$crud->field_type('test_ids', 'multiselect', $tests);
		
		$crud->field_type('description', 'text');
		
		$output = $crud->render();
		//debug($crud);
		$this->_example_output($output);

	}
	public function linkDetail($primary_key , $row){
		return site_url('admin/questions/detail/').$row->id;
	}
	public function detail($questionId){
		
		$this->data['itemAnswers'] = $this->question->getAnswerByQuestionId($questionId);
		$this->data['question'] = $this->question->getOne($questionId);
		$this->load->view('questions/answer', $this->data);
		
		
	}
	public function addAnsers(){
		$posts = $this->input->post();
		$questionId = $posts['question_id'];
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		
		
		$this->form_validation->set_rules('name[]', 'Name', 'required');
		$this->form_validation->set_rules('check', 'Check', 'required');
		
		if ($this->form_validation->run() == TRUE){
							
			$AnswerByQuestionId = $this->question->checkAnswerQuestion($questionId);
			
			if($AnswerByQuestionId){
				$dataUpdate = array();
				$dataInsert = array();
				$postAnswer = $posts['name'];
				//echo '<pre>';print_r($AnswerByQuestionId);echo '</pre>';
				
				foreach($AnswerByQuestionId as $val){
					//xoa check = 1;
					if($val['check'] == 1){
						$this->db->where('id', $val['id']);
						$this->db->update('answers', array('check' => 0));
					}
					
					if(isset($postAnswer[$val['id']])){
						
						//cac dap an k bi xoa
						if($postAnswer[$val['id']] != $val['name']){
							
							$updateData['name'] = $postAnswer[$val['id']];
							$updateData['check'] = 0;
							if($val['id'] == $posts['check']){
								$updateData['check'] = 1;
							}
							
							$this->db->where('id', $val['id']);
							$this->db->update('answers', $updateData);
							
						}else{
							
							$this->db->where('id', $posts['check']);
							$this->db->update('answers', array('check' => 1));
						}
						//xoa cac cau da update
						unset($postAnswer[$val['id']]);
						
					}else{
						//xoa dap an bi xoa
						$this->db->delete('answers', array('id' => $val['id']));
					}
					
				}
				//debug($postAnswer);
				//them cac dap an moi
				if(count($postAnswer) > 0){
					$newAnswer = array();
					
					foreach($postAnswer as $key => $answer){
						$newAnswer[$key]['question_id'] = $questionId;
						$newAnswer[$key]['name'] = $answer;
						$newAnswer[$key]['check'] = 0;
						if($key == $posts['check']){
							$newAnswer[$key]['check'] = 1;
						}
						
					}
					
					$this->db->insert_batch('answers', $newAnswer); 
				}
				redirect($this->data['module'].'/questions');
			}else{
				
				$answers = $posts['name'];
				$multiAnswer = array();
				$i = 0;
				foreach($answers as $answer){
					$multiAnswer[$i]['question_id'] = $questionId;
					$multiAnswer[$i]['name'] = $answer;
					$multiAnswer[$i]['check'] = 0;
					if($i == $posts['check']){
						$multiAnswer[$i]['check'] = 1;
					}
					$i++;
				}
				
				$this->db->insert_batch('answers', $multiAnswer); 
				redirect($this->data['module'].'/questions');
			}	
			
		}else{
			
			$this->data['itemAnswers'] = $this->question->getAnswerByQuestionId($questionId);
			$this->data['question'] = $this->question->getOne($questionId);
			$this->load->view('questions/answer', $this->data);
		}
		
	}
	
}
?>