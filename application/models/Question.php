<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Question extends Grocery_Model {
	public $table = 'questions';
	
	public function getAnswerByQuestionId($id){
		$data = $this->db->select('*')->from('answers')->where('question_id', $id)->get()->result_array();
		return $data;
	}
	public function checkAnswerQuestion($questionsId){
		$data = $this->db->select('*')->from('answers')->where('question_id', $questionsId)->get()->result_array();
		if(count($data)> 0){
			return $data;
		}else{
			return false;
		}
	}
	public function getQuestionByCategoryId($categoryId){
		$data = $this->db->select('*')->from('questions')->like("CONCAT(',',category_ids,',')", $categoryId)->get()->result_array();
		return $data;
	}
	public function getQuestionByTestId($testId){
		$data = $this->db->select('*')->from('questions')->like("CONCAT(',',test_ids,',')", $testId)->get()->result_array();
		return $data;
	}
	//xu li cau tra loi
	public function getAnswerByQuestionIds($arrQuestionIds){
		$answers = $this->db->select('*')->from('answers')->where_in('question_id', $arrQuestionIds)->get()->result_array();
		$processAnswer = array();
		foreach($answers as $val) {
			$processAnswer[$val['question_id']][] = $val;
		}
		return $processAnswer;	
	}
	public function getAllTrueAnswerByQuestionIds($questionIds) {
		$data = $this->db->select('id, question_id, name')->from('answers')
	        	->where_in('question_id', $questionIds)
	            ->where('check', '1')
	            ->get()->result_array();
		return $data;			
	}
	public function getAllAnswerTrue($questionIds){
        $data = $this->db->select('q.id, q.explain, a.id as answerId')
			->from('questions q')
			->join('answers a', 'q.id = a.question_id')
            ->where_in('q.id', $questionIds)
			->where('a.check', 1)
            ->get()->result_array();
        return $data;
    }
	
}