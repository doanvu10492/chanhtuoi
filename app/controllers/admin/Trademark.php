<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trademark extends Admin_Controller 
{
	public $outputData;

    function __construct()
    {
    	parent::__construct();

        // Check login admin
        if(!isAdmin())
			redirect_admin('login');
    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/trademark_model');
    }


    function index()
    {
        $list_category = $this->trademark_model->list_trademark()->result();
        //parse data
        $list_category = $this->trademark_model->parse_trademark_data($list_category);
    	$this->outputData = array(
			'page_title' => 'Danh sách trademark',
			'current_page' => 'trademark',
			'sub_page'=> 'list_trademark',
			'pages' => $this->trademark_model->list_trademark()->result(),
			'list_category' => $this->table_list_trademark()
			
		);

	    $this->render('admin/trademark/list');

    }

   
    function updated($id)
    {
        
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	    if ($this->input->post('update_trademark'))
	    {
            
			$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
	    	if ($this->form_validation->run())
	    	{

	    		$data = array(
	    			'id_parent' => $this->input->post('id_parent'),
	                
	                'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
	                'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
	                'ordering' => $this->input->post('ordering'),
	                'link' => ($this->input->post('link') != null) ? ( $this->input->post('link') ) : (url_alias($this->input->post('link'))),
	                //VN
	                'name' => $this->input->post('name'),
	                 'active' => 1,
	    			'alias' => ($this->input->post('alias')) ? ($this->input->post('alias')) : (url_alias($this->input->post('name'))),
	                'meta_title' => $this->input->post('meta_title'),
	                'meta_description' => $this->input->post('meta_description'),
	                'meta_keywords' => $this->input->post('meta_keywords'),
	                
	                //EN
	                'link_en' => ($this->input->post('link_en') != null) ? ( $this->input->post('link_en') ) : (url_alias($this->input->post('link_en'))),
	                'name_en' => $this->input->post('name_en'),
	                'alias_en' => ($this->input->post('alias_en')) ? ($this->input->post('alias_en')) : (url_alias($this->input->post('name_en'))),
	                'meta_title_en' => $this->input->post('meta_title_en'),
	                'meta_description_en' => $this->input->post('meta_description_en'),
	                'meta_keywords_en' => $this->input->post('meta_keywords_en')
	    		);
                if ($id == 0)
                {
                	//add
                    $this->trademark_model->insertData($data);
	    			$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 danh mục mới');
                }else{
                	//update
                	$key = array('id' => $id);
		    		$this->trademark_model->updateData($key, $data);
		    		$this->session->set_flashdata('flash_message','Cập nhật danh mục thành công !');
                }
	           
	    		redirect_admin('trademark');
	    	}

	    }
	    if ($id == 0){
	    	//add
	 		$this->outputData = array(
				'page_title' => 'Thêm danh mục mới',
				'current_page' => 'trademark',
				'sub_page'=> 'add_trademark',
				'id' => $id,
				'action' => 'Thêm mới',
				'option' => $this->select_option->dropdown_pages(array('table' => TB_TRADEMARK))
			);

	    }else{
	    	//update
	    	$get_infor =  $this->trademark_model->get_infor(array('id'=>$id));
		    $id_parent = (count($get_infor)>0 && $get_infor->id_parent > 0) ? ($get_infor->id_parent) : ('');
		    $this->outputData = array(
				'page_title' => 'Chỉnh sửa danh mục bài viết',
				'current_page' => 'category_trademark',
				'sub_page'=> 'updated_trademark',
				'page' => $get_infor,
				'id' => $id,
				'action' => 'Cập nhật',
				'option' => $this->select_option->dropdown_pages(array('table' => TB_TRADEMARK), '', '',$id_parent)
			);

	    }
	    
		$this->render('admin/trademark/update');

    }



    function delete($id)
    { 
		$this->trademark_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
		redirect_admin('trademark/index');		

    }

    function table_list_trademark($id_parent = 0, $string = '', $i = 0)
    {
    	 $get_infor =  $this->trademark_model->list_trademark('','','','',array('id_parent' => $id_parent))->result();
    	 $get_infor = $this->trademark_model->parse_trademark_data($get_infor);

    	 $result = '';

    	 if(count($get_infor) > 0)
    	 {
    	 	$string .= ($id_parent == 0) ? ('') : ("---");
    	 	$i = ($i > 0  ) ? (' ') : ($i);
    	 	foreach ($get_infor as $row)
    	 	{
    	 		$i++;
                $result .='<tr>';
                $result .='<td><input type="checkbox" name="checklist"  value="'.$row->id.'"></td>';
				$result .=  '<td>'.$i.'</td>';
					
				$result .=  '<td>'.$string.' '.$row->name.'</td>';
						
				$result .=  '<td>'.$row->created_at.'</td>';

				$result .=   '<td>';
			    $result .= '<a href="';
			    $result .= $row->link_active;
			     $result .= '" data-action="isTrademark" rel="'.$row->isTrademark.'" class="btn-status glyphicon ';
			   
			    $result .= $row->icon_trademark;

			    $result .='">';

			    $result .= '</a>';
                $result .= '</td>';


                $result .=   '<td>';
			    $result .= '<a href="';
			    $result .= $row->link_active;
			     $result .= '" data-action="isFooter" rel="'.$row->isFooter.'" class="btn-status glyphicon ';
			   
			    $result .= $row->icon_footer;

			    $result .='">';

			    $result .= '</a>';
                $result .= '</td>';


                $result .=   '<td>';
			    $result .= '<a href="';
			    $result .= $row->link_active;
			     $result .= '" data-action="isTop" rel="'.$row->isTop.'" class="btn-status glyphicon ';
			   
			    $result .= $row->icon_top;

			    $result .='">';

			    $result .= '</a>';
                $result .= '</td>';

						
				$result .=   '<td>';
			    $result .= '<a href="';
			    $result .= $row->link_active;
			     $result .= '" data-action="active" rel="'.$row->active.'" class="btn-status glyphicon ';
			   
			    $result .= $row->icon_active;

			    $result .='">';

			    $result .= '</a>';
                $result .= '</td>';

				$result .= '<td class="text-center">';
				$result .= '<a href="'.$row->link_update.'" class="btn-action glyphicon glyphicon-pencil"> </a>';
				$result .= '<a href="'.$row->link_delete.'" class="btn-action glyphicon glyphicon-trash"></a>
				        </td>
					</tr>';

			   $result .= $this->table_list_trademark($row->id, $string, $i); 

    	 	}
    	 	
    	 }
    	
    	return $result;
    }



    function updateStatus()
    {
    	$id = $this->uri->segment(4);
    	// action is attribute such as : active, highlight...
    	$action = trim($_POST['action']);
    	//check product exist
    	if ($this->trademark_model->check_exists(array('id' => $id))){
    		// click ok status
	    	if ($_POST['active'] == 1)
	    	{
	    		$this->trademark_model->updateData(array('id' => $id), array($action => 0));
	    		echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
	    	}
	    	else{
	    		$this->trademark_model->updateData(array('id' => $id), array($action => 1));
	    		echo json_encode(array('result' => 'glyphicon-ok', 'num' => 1)); exit();
	    	}
    	}else{
    		echo json_encode(array('error' => 'Bài viết này không tồn tại')); exit();
    	}
    }


    function del_list_choose()
    {
    	
    	$list_id = explode(',', $_POST['list_id']);
    	if (count($list_id) == 1)
    	{
    		$this->trademark_model->deleteData($list_id);
    	}else{
	    	foreach ($list_id as $id) {
	    		if ($this->trademark_model->check_exists(array('id' => $id))){
	    			$this->trademark_model->deleteData($id);
	    		}
	    		else{
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
			    
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục sản phẩm');   
        echo json_encode(array('result' => admin_url('trademark'))); exit(); 
    }






}