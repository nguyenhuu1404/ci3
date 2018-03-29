<?php 
class Tests extends FrontendController{
	
	public function __construct(){
		parent::__construct();  
		$this->load->model('test');
	}
	public function showTest(){
		
		$this->data['layout'] = 'practice/test';
		$this->data['title'] = 'Test';
		$this->data['description'] = 'Test';
		$this->data['tests'] = $this->test->getAll();
		$this->load->view($this->data['masterPage'], $this->data);
	}
	public function showQuestion($categoryId){
		$this->load->model('question');
		$this->data['layout'] = 'practice/practice';
		$this->data['title'] = 'Test';
		$this->data['description'] = 'Test';
		$this->data['css'] = array('plugins', 'responsive');

		$showQuestions 	= $this->question->getQuestionByTestId($categoryId);
		//debug($showQuestions);
		// xu li questions
		$arrQuestionIds = array();
		foreach($showQuestions as $question) {
			$arrQuestionIds[] = $question['id'];
		}
		$processAnswer = $this->question->getAnswerByQuestionIds($arrQuestionIds);
		$this->data['categoryId'] = $categoryId;
		$this->data['showQuestions'] = $showQuestions;
		$this->data['processAnswer'] = $processAnswer;
		$this->data['time'] = 30;
		$this->load->view($this->data['masterPage'], $this->data);
	}
	function indexApi(){
		$tests = $this->test->getAll();
		echo json_encode($tests);
	}
}