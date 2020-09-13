<?php 
function dv_cutString($string, $limit, $string_after=NULL)
{

	if(strlen($string)<=$limit)
	{
	    return $string.$string_after;
	}
	else
	{
	
		if(strpos($string," ",$limit) > $limit){
			$new_limit=strpos($string," ",$limit);
			$result = substr($string,0,$new_limit).$string_after."...";
			return $result;
		}
		$result = substr($string,0,$limit).$string_after."...";
		return $result;
	}

}

function dv_vn_string ($str){
   $unicode = array(
	   'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
	   'd'=>'đ',
	   'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
	   'i'=>'í|ì|ỉ|ĩ|ị',
	   'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
	   'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
	   'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
	   'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
	   'D'=>'Đ',
	   'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
	   'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
	   'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
	   'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
	   'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
   );
  foreach($unicode as $nonUnicode=>$uni){
	   $str = preg_replace("/($uni)/i", $nonUnicode, $str);
  }
   return $str;
}

function dv_slug($str){
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '', $str);
	$str = preg_replace('/-+/', "-", $str);
	return $str;
}

if ( ! function_exists('url_alias'))
{
	//function convert name=>alias
	function url_alias($string)
	{
	   $result = dv_slug(dv_vn_string(dv_cutString(str_replace(" ","-",$string),'100','')));
	   return $result;
	}
}

/**
 * Get id from url
 *
 * @access	public
 * @param	string	$alias
 * @param	string	$character
 * @return	id
 */
if ( ! function_exists('getIdFromUrl'))
{
	function getIdFromUrl($alias, $character = '')
	{
        $id = explode('-', $alias);
        
        if ($character) {
	        $id = (int) str_replace($character, '', end($id));
        }

		return (int) $id;
	}
}