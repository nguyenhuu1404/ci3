<?php
class Test extends MX_Controller{
	
	public function runModules(){
		echo Modules::run('admin/home/index');
	}
	public function index()
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode($temp);
	}
	
	private function set_barcode($code)
	{
		
		$this->zend->load('Zend_Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
}