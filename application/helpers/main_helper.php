<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//debug
function debug($data){
	echo '<pre>';
		print_r($data);
	echo '</pre>';
	die();
}
//filler
function fillter($str){
	$str = str_replace("<", "&lt;", $str);
	$str = str_replace(">", "&gt;", $str);
	$str = str_replace("&", "&amp;", $str);
	$str = str_replace("|", "&brvbar;", $str);
	$str = str_replace("~", "&tilde;", $str);
	$str = str_replace("`", "&lsquo;", $str);
	$str = str_replace("#", "&curren;", $str);
	$str = str_replace("%", "&permil;", $str);
	$str = str_replace("'", "&rsquo;", $str);
	$str = str_replace("\"", "&quot;", $str);
	$str = str_replace("\\", "&frasl;", $str);
	$str = str_replace("--", "&ndash;&ndash;", $str);
	$str = str_replace("ar(", "ar&Ccedil;", $str);
	$str = str_replace("Ar(", "Ar&Ccedil;", $str);
	$str = str_replace("aR(", "aR&Ccedil;", $str);
	$str = str_replace("AR(", "AR&Ccedil;", $str);
	return htmlspecialchars($str);
}
function buildTree(array $elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $key1=>$element) {
            if ($element['parent'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
function showAdminMenu($array = array(), $parents){
    	echo '<ul class="drop">';
        foreach ($array as $item){
        	$class_action = "";
        	if( in_array($item['id'], $parents)){
        		$class_action = " class = 'action'";
        	}
            echo '<li'.$class_action.'>';
            if(!$item['router']){
                echo '<a href="javascript:void(0);" onclick="return: false;">';
            }else {
                echo '<a href="'.base_url().$item['router'].'/index">';
            }
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
                showAdminMenu($item['children'], $parents);
            }
            echo '</li>';
        }
        echo '</ul>';
    }
//show home menu
function showHomeMenu($array = array(), $parents){
        foreach ($array as $item){
        	$class_action = "";
        	if( in_array($item['id'], $parents)){
        		$class_action = " class = 'active'";
        	}
            echo '<li'.$class_action.'>';
            if(!$item['router']){
                echo '<a href="javascript:void(0);" onclick="return: false;">';
            }else {
				$type = $item['type'];
				switch ($type) {
					case "isId":
						$url = base_url().$item['module'].'/'.$item['router'].'/'.$item['id'];
						break;
					case "noId":
						$url = base_url().$item['module'].'/'.$item['router'];
						break;
					case "home":
						$url = base_url();
						break;
					default:
						$url = base_url().$item['module'].'/'.$item['router'];
				}
				
				
                echo '<a href="'.$url.'">';
            }
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
                echo '<ul class="sub-menu">';
					showHomeMenu($item['children'], $parents);
				echo '</ul>';
				
            }
            echo '</li>';
        }
    }

    //show home menu
function showHomeMenuBs($array = array(), $parents){
        foreach ($array as $item){
        	$child = $active = '';
        	if( in_array($item['id'], $parents)){
        		$active = 'active ';
        	}
        	if (!empty($item['children'])){
        		$child = 'children';	
        	}
            echo '<li class="'.$active.$child.'">';
            if(!$item['router']){
                echo '<a href="javascript:void(0);" onclick="return: false;">';
            }else {
				$type = $item['type'];
				switch ($type) {
					case "isId":
						$item['alias'] ? $url =  base_url().$item['alias'].'.html' : $url = base_url().$item['module'].'/'.$item['router'].'/'.$item['id'];	
						break;
					case "home":
						$url = base_url();
						break;
					default:
						$item['alias'] ? $url =  base_url().$item['alias'].'.html' : $url = base_url().$item['module'].'/'.$item['router'];
				}
				
				
                echo '<a href="'.$url.'">';
            }
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
               
                echo '<span class="dropdown-toggle ml-1 pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>';
                echo '<ul class="sub-menu dropdown-menu">';
					showHomeMenuBs($item['children'], $parents);
				echo '</ul>';
				
            }
            echo '</li>';
        }
    }

    function productCategories($array = array(), $parents){
        foreach ($array as $item){
        	$child = $active = '';
        	if( in_array($item['id'], $parents)){
        		$active = 'active ';
        	}
        	if (!empty($item['children'])){
        		$child = 'children';	
        	}
            echo '<li class="'.$active.$child.'">';
            if(!$item['router']){
                echo '<a href="javascript:void(0);" onclick="return: false;">';
            }else {
				$type = $item['type'];
				switch ($type) {
					case "isId":
						$item['alias'] ? $url =  base_url().$item['alias'].'.html' : $url = base_url().$item['module'].'/'.$item['router'].'/'.$item['id'];	
						break;
					case "home":
						$url = base_url();
						break;
					default:
						$item['alias'] ? $url =  base_url().'danh-muc/'.$item['alias'].'.html' : $url = base_url().'danh-muc/'.$item['module'].'/'.$item['router'];
				}
				
				
                echo '<a href="'.$url.'">';
            }
            echo $item['name'];
            echo '</a>';
            if (!empty($item['children']))
            {
               
                echo '<span class="dropdown-toggle ml-1 pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>';
                echo '<ul class="sub-menu dropdown-menu">';
					productCategories($item['children'], $parents);
				echo '</ul>';
				
            }
            echo '</li>';
        }
    }
   
 //ma hoa chuoi
    function encrypt($pure_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    /**
     * Returns decrypted original string
     */
    function decrypt($encrypted_string, $encryption_key) {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }
	
//recusive	
	function buildArr($data, $columnName, $parentValue = 0)
	{
		recursive($data, $columnName, $parentValue, 1, $resultArr);
		return $resultArr;
	}
	
	function recursive($data,$columnName = "",$parentValue = 0, $level = 1,&$resultArr)
	{
		if(count($data) > 0){
			foreach ($data as $key => $value) {
                if(isset($value['parent'])) {
                    if($value['parent'] == $parentValue){
                        $value['level'] = $level;
                        $resultArr[] = $value;
                        $newParent = $value['id'];
                        unset($data[$key]);
                        recursive($data,$columnName,$newParent,$level+1,$resultArr);
                    }
                }elseif(isset($value['parentId'])) {
                    if($value['parentId'] == $parentValue){
                        $value['level'] = $level;
                        $resultArr[] = $value;
                        $newParent = $value['id'];
                        unset($data[$key]);
                        recursive($data,$columnName,$newParent,$level+1,$resultArr);
                    }
                }

			}
		}
	}
	function makeTree(&$items) {
		$tree = array();
		$total = count($items);
		for($i = 0; $i < $total; $i++) {
			$items[$i]['itemIndex'] = $i;
			$items[$i]['hasParent'] = false;
		}
		for($i = 0; $i < $total; $i++) {
			for($j = $i + 1; $j < $total; $j++) {
				if($items[$j]['parent'] == $items[$i]['id']) {
					$items[$j]['hasParent'] = true;
					if(!isset($items[$i]['childrenIndexes'])) {
						$items[$i]['childrenIndexes'] = array();
					}
					$items[$i]['childrenIndexes'][] = $j;
				} else if($items[$i]['parent'] == $items[$j]['id']) {
					$items[$i]['hasParent'] = true;
					if(!isset($items[$j]['childrenIndexes'])) {
						$items[$j]['childrenIndexes'] = array();
					}
					$items[$j]['childrenIndexes'][] = $i;
				}
			}
		}
		
		for($i = 0; $i < $total; $i++) {
			if($items[$i]['hasParent'] == false) {
				$tree[] = $items[$i]['itemIndex'];
			}
		}
		
		return $tree;
	}
	function parseTree(&$items, $tree, &$result, $level = 1) {
		foreach($tree as $index) {
			$items[$index]['level'] = $level;
			$result[] = $items[$index];
			if(isset($items[$index]['childrenIndexes'])) {
				parseTree($items, $items[$index]['childrenIndexes'],$result, $level+1);
			}
		}
	}
	function treefy(&$items) {
		$tree = makeTree($items);
		$result = array();
		parseTree($items, $tree, $result);
		return $result;
	}
	
//end recusive
	function strToArr($str){
		$arr = array_map('trim', explode(',', $str));
		return $arr;
	}
	function formatPrice($price){
		return number_format($price, 3, "." , ".");
	}
?>