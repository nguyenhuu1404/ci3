<?php 
class Practice extends FrontendController{
	
	public function __construct(){
		parent::__construct();  
		$this->load->model('question');	
	}
	public function showQuestion($categoryId){
		$this->data['layout'] = 'practice/practice';
		$this->data['title'] = 'Practice';
		$this->data['description'] = 'Practice';
		$this->data['css'] = array('plugins', 'responsive');
		$this->data['js'] = array(
		);

		$showQuestions 	= $this->question->getQuestionByCategoryId($categoryId);
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
	public function showAnswers(){
		$request = $this->input->post();
    
    	$data_answers 		= $request['answers'];
    	 
    	$question_id 		= $data_answers['questions'];

        $totalQuestion = count($question_id);
    	
    	$result_answer = array();

        $answers 		= array();
        if(isset($data_answers['answers'])){
            $answers 		= $data_answers['answers'];
        }

		
		//tong so cau dung
        $totaltrue = 0;
	
		$dataAnswerTrue = $this->question->getAllTrueAnswerByQuestionIds($question_id);
		$customAnswerTrue = array();
		foreach($dataAnswerTrue as $val) {
			$customAnswerTrue[$val['question_id']] = $val['id'];
		}
		
		$answersFalse = array();
        foreach($question_id as $key => $value){

            if(!empty($answers[$key])){

                if($answers[$key] == $customAnswerTrue[$key]) {
                    $totaltrue++;
                }else{
					$answersFalse[] = $key;
				}
            }else{
				$answersFalse[] = $key;
			}
        }
		
		//xu ly phan show giai thich
		$dataExplant = $this->question->getAllAnswerTrue($question_id);
		
    	foreach($dataExplant as $key => $value){
            
    		$result_answer[] = array(
    				'questionId' 	=> $value['id'],
    				'recommend'		=> $value['explain'],
					'answerId' => $value['answerId']
    		);
    	}
		$result_answer['answersFalse'] = $answersFalse;
        $result_answer['total'] = $totaltrue;
        $result_answer['totalFalse'] = count($answersFalse);
    	
    	echo json_encode($result_answer);
	}
	public function lession($categoryId){
		$this->load->model('category');
		$this->data['layout'] = 'practice/lession';
		$this->data['title'] = 'Lession';
		$this->data['description'] = 'Lession';
		$this->data['lessions'] = $this->category->getCateByParentId($categoryId);
		$this->load->view($this->data['masterPage'], $this->data);
	}
}