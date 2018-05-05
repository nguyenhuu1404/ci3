<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Cart extends CI_Cart {

    public $CI;

    function __construct()
    {
        parent::__construct();
        
    }

    // get in stock amount for every item in cart
    function save($items=array())
    {
        if ( ! is_array($items) OR count($items) === 0)
        {
            log_message('error', 'The insert method must be passed an array containing data.');
            return FALSE;
        }

        $cartIds = $this->getIdsInCart();
        $rowIdById = $this->getRowidById();
        //update 1 san pham
        if(isset($items['id'])){
            if(in_array($items['id'], $cartIds)){
                $items['rowid'] = $rowIdById[$items['id']];
                $dataByRowid = $this->get_item($items['rowid']);
                $items['qty'] = $items['qty'] + $dataByRowid['qty'];
                $this->update($items);
            }else{
                $this->insert($items);
            }
        }else{
            //update nhieu san pham
            foreach ($items as $item) {
                if(in_array($item['id'], $cartIds)){
                    $item['rowid'] = $rowIdById[$item['id']];
                    $dataByRowid = $this->get_item($item['rowid']);
                    $items['qty'] = $item['qty'] + $dataByRowid['qty'];
                    $this->update($item);    
                }else{
                    $this->insert($item);
                }
            }
        }
        
    }
    public function getIdsInCart(){
        $carts = $this->contents();
        $ids = array();
        if(count($carts > 0)){
            foreach ($carts as $cart) {
                $ids[] = $cart['id'];
            }
        }
        return $ids;
    }
    public function getRowidById(){
        $carts = $this->contents();
        $ids = array();
        if(count($carts > 0)){
            foreach ($carts as $cart) {
                $ids[$cart['id']] = $cart['rowid'];
            }
        }
        return $ids;
    }

}