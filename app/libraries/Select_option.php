<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Select_option
{
    public $param = [];
    public $string = '---';


	public function __construct()
	{
		$this->CI = & get_instance();
	} 
    
    public function getSelect($params = array(), $id_parent = 0)
    {
    	$this->CI->db->select('*');

    	if (isset($params['where'])) {
    	    $this->CI->db->where($params['where']);
        }

        $this->CI->db->where('id_parent', $id_parent);

    	$this->data = $this->CI->db->get($params['table'])->result_array();
        
    }	

	public function dropdown($params = array(), $parentId = 0, $string = NULL, $activeId = NULL)
	{
		$this->getSelect($params, $parentId);
		$option = ! $parentId ? '<option value="">Chọn danh mục</option>' : '';
        $string .= $string ? $string : '---';

        if (count($this->data) > 0) {
			foreach ($this->data as $key => $val) {
			    $selected = $activeId == $val['id_cate'] ? 'selected' : '';
				
			    $option .= "<option  " . $selected ." value='".$val["id_cate"] . "'>|";
			    $option .= $string . $val['name'];
			    $option .= "</option>";

			    $option .= $this->dropdown($params, $val['id_cate'], $string, $activeId);
			}
        }

		return $option;
	}
	
	public function dropdown_pages($params = array(), $id_parent = 0, $string = NULL, $id_active = NULL)
	{

		$this->get($params, $id_parent);
		$option = ($id_parent == 0) ? ('<option>--Chọn bài viết cha--</option>') : ('');
        $string .= ($string != NULL) ? ($string) : ('---');

        if (count($this->data) > 0) {
            
			foreach ($this->data as $key => $val) {

			    $selected = (isset($id_active) && $id_active == $val['id']) ? ('SELECTED') : ('');
				
			    $option .= "<option  " . $selected ." value='".$val["id_cate"] . "'>|";
			    $option .= $string . $val['name'];
			    $option .= "</option>";

			    $option .= $this->dropdown_pages($params, $val['id'], $string, $id_active);
			}
        }

		return $option;
	}

	public function dropdownSelect($params = array() , $selectedId = NULL, $optionDefault = 'Chọn hạng xe', $checkActive = false, $hide = false)
	{
		$this->getCollection($params, true);

		$option = '<option value="">--' . $optionDefault . '--</option>';

        if (count($this->data) > 0) {
			foreach ($this->data as $key => $val) {
				   $selected = (isset($selectedId) && $selectedId == $val['id']) ? ('SELECTED') : ('');
				   $disabled = '';

				   if ($checkActive && ! $val['active']) {
				   		$disabled = 'disabled';
				   }

				   if ($hide == true && ! $val['active']) {
				   		continue;
				   }
				   
				   $option .= "<option  " . $selected . " value='".$val["id"] . "' {$disabled}>" . $val['name']."</option>";
				}
            }
		return $option;
	}

	public function getCollection($params = array(), $orderByActive = false)
    {
    	$this->CI->db->select('*');

    	if (isset($params['where'])) {
    	    $this->CI->db->where($params['where']);
        }

        if ($orderByActive) {
        	$this->CI->db->order_by('active', 'desc');
        	$this->CI->db->order_by('id', 'desc');
        }
        
    	$this->data = $this->CI->db->get($params['table'])->result_array();
    }	
} 
