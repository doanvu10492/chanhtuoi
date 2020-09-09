<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Script extends Admin_Controller 
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
		$this->load->model('backend/script_model');
    }


    function index()
    {
        $list_category = $this->script_model->list_script()->result();
        //parse data
        $list_category = $this->script_model->parse_script_data($list_category);
    	$this->outputData = array(
			'pageTitle' => 'Danh sách thẻ',
			'currentPage' => 'script',
			'subPage'=> 'list_script',
			'pages' => $this->script_model->list_script()->result(),
			'list_category' => $this->table_list_script()
			
		);

	    $this->render('admin/script/list');

    }

   
    function updated($id)
    {
        
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	    if ($this->input->post('update_script'))
	    {
            
			$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
	    	if ($this->form_validation->run())
	    	{

	    		$data = array(
	    			
	                
	                'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
	                'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
	                
	                //VN
	                'name' => $this->input->post('name'),
	                'active' => 1,
	                'script' => $this->input->post('script'),
	              
	    		);
                if ($id == 0)
                {
                	//add
                    $this->script_model->insertData($data);
	    			$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 danh mục mới');
                }else{
                	//update
                	$key = array('id' => $id);
		    		$this->script_model->updateData($key, $data);
		    		$this->session->set_flashdata('flash_message','Cập nhật danh mục thành công !');
                }
	           
	    		redirect_admin('script');
	    	}

	    }
	    if ($id == 0){
	    	//add
	 		$this->outputData = array(
				'pageTitle' => 'Thêm danh mục mới',
				'currentPage' => 'script',
				'subPage'=> 'add_script',
				'id' => $id,
				'action' => 'Thêm mới',
				
			);

	    }else{
	    	//update
	    	$get_infor =  $this->script_model->get_infor(array('id'=>$id));
		  
		    $this->outputData = array(
				'pageTitle' => 'Chỉnh sửa danh mục bài viết',
				'currentPage' => 'script',
				'subPage'=> 'updated_script',
				'page' => $get_infor,
				'id' => $id,
				'action' => 'Cập nhật',
				
			);

	    }
	    
		$this->render('admin/script/update');

    }



    function delete($id)
    { 
		$this->script_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');
		redirect_admin('script/index');		

    }

    function table_list_script($id_parent = 0, $string = '', $i = 0)
    {
    	 $get_infor =  $this->script_model->list_script()->result();
    	 $get_infor = $this->script_model->parse_script_data($get_infor);

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
    	if ($this->script_model->check_exists(array('id' => $id))){
    		// click ok status
	    	if ($_POST['active'] == 1)
	    	{
	    		$this->script_model->updateData(array('id' => $id), array($action => 0));
	    		echo json_encode(array('result' => 'glyphicon-remove', 'num' => 0)); exit();
	    	}
	    	else{
	    		$this->script_model->updateData(array('id' => $id), array($action => 1));
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
    		$this->script_model->deleteData($list_id);
    	}else{
	    	foreach ($list_id as $id) {
	    		if ($this->script_model->check_exists(array('id' => $id))){
	    			$this->script_model->deleteData($id);
	    		}
	    		else{
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
			    
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục sản phẩm');   
        echo json_encode(array('result' => admin_url('script'))); exit(); 
    }






}