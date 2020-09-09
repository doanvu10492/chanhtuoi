<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class System_branch extends Admin_Controller 
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
		$this->load->model('backend/system_branch_model');
    }


    function index()
    {
        $list = $this->system_branch_model->list_system_branch()->result();
        //parse data
        $list = $this->system_branch_model->parse_category_data($list);
    	$this->outputData = array(
			'pageTitle' => 'Danh sách danh mục',
			'currentPage' => 'system',
			'subPage'=> 'system_branch',
			'pages' => $this->system_branch_model->list_system_branch()->result(),
			'list' => $this->tableListCategory()
			
		);

	    $this->render('admin/system_branch/list');
    }

   
    function updated($id)
    {   
        $this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));

	    if ($this->input->post()) {
			$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');

	    	if ($this->form_validation->run()) {
	    		$data = [
	    			'id_parent' => $this->input->post('id_parent'),
	                
	                'updated_at' => ($this->input->post('updated_at')!=null) ? ($this->input->post('updated_at')) : (date('Y-m-d H:i:s')),
	                'created_at' => ($this->input->post('created_at')!=null) ? ($this->input->post('created_at')) : (date('Y-m-d H:i:s')),
	                'name' => $this->input->post('name'),
	                'image' => $this->input->post('image'),
	    			'alias' => ($this->input->post('alias')) ? ($this->input->post('alias')) : (url_alias($this->input->post('name'))),
	                'ordering' => $this->input->post('ordering'),
	                'description' =>$this->input->post('description'),
	                'brief' =>$this->input->post('brief'),
	                'distrist' =>$this->input->post('distrist'),
	                'address' =>$this->input->post('address'),
	                'map' =>$this->input->post('map'),
	    		];

                if ($id == 0) {
                	// add
                    $this->system_branch_model->insertData($data);
	    			$this->session->set_flashdata('flash_message','Bạn vừa thêm 1 danh mục mới');
                } else {
                	//update
                	$key = array('id_cate' => $id);
		    		$this->system_branch_model->updateData($key, $data);
		    		$this->session->set_flashdata('flash_message','Cập nhật danh mục thành công !');
                }
	           
	    		redirect_admin('system_branch');
	    	}
	    }

	    // add and update
	    if ($id == 0) {
	 		$this->outputData = [
				'pageTitle' => 'Thêm danh mục mới',
				'currentPage' => 'system',
				'subPage'=> 'system_branch',
				'id' => $id,
				'action' => 'Thêm mới',
				'option' => $this->select_option->dropdown(['table' => TB_SYSTEM_BRANCH])
			];
	    } else {
	    	$getInfo =  $this->system_branch_model->get_infor(array('id_cate'=>$id));
		    $parentId = (count($getInfo)>0 && $getInfo->id_parent > 0) ? ($getInfo->id_parent) : ('');
		    $this->outputData = [
				'pageTitle' => 'Chỉnh sửa danh mục bài viết',
				'currentPage' => 'system_branch',
				'subPage'=> 'updated_system`',
				'page' => $getInfo,
				'id' => $id,
				'action' => 'Cập nhật',
				'option' => $this->select_option->dropdown(['table' => TB_SYSTEM_BRANCH], '', '',$parentId)
			];
	    }
	    
		$this->render('admin/system_branch/update');
    }

    function delete($id)
    { 
		$this->system_branch_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('system_branch');		
    }

    function tableListCategory($id_parent = 0, $string = '', $i = 0, $root = '')
    {
		$get_infor =  $this->system_branch_model->list_system_branch('','','','',array('id_parent' => $id_parent))->result();
		$get_infor = $this->system_branch_model->parse_category_data($get_infor);
		$result = '';

    	if(count($get_infor) > 0) {
    	 	$string .= ($id_parent == 0) ? ('') : ("---");
    	 	$i = ($i > 0  ) ? (' ') : ($i);

    	 	foreach ($get_infor as $row) {

    	 		if($row->id_parent == 0 ) { 
    	 			$root = base_url().$row->alias.'/'; 
    	 		}

    	 		$i++;
                $result .='<tr>';
                $result .='<td><input type="checkbox" name="checklist"  value="'.$row->id.'"></td>';
				$result .=  '<td>'.$i.'</td>';
				$result .=  '<td>'.$string.' '.$row->name;
				$result .='</td>';
				$result .=  '<td>'.date('d-m-Y H:i', strtotime($row->created_at)).'</td>';		
				// highlight
				$result .=   '<td>';
				$result .= '<a href="';
			    $result .= $row->link_active;
			    $result .= '" data-action="isHighlight" rel="'.$row->isMenu.'" class="btn-status glyphicon ';
			    $result .= $row->icon_highlight;
			    $result .='">';
			    $result .= '</a>';
			    $result .= '</td>';				
				
			    // active
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

				if ($row->id != 27 || $row->id != 30) {
					$result .= '<a href="'.$row->link_delete.'" class="btn-action glyphicon glyphicon-trash btn-del"></a>';
				}

				$result   .= '</td>
					</tr>';

			   $result .= $this->tableListCategory($row->id, $string, $i, $root); 
    	 	}
    	}
    	
    	return $result;
    }


	function updateStatus()
    {
    	$id = $this->uri->segment(4);
    	// action is attribute such as : active, highlight...
    	$action = trim($_POST['action']);

    	// check product exist
    	if ($this->system_branch_model->check_exists(['id_cate' => $id])) {
    		// click ok status
	    	if ($_POST['active'] == 1) {
	    		$this->system_branch_model->updateData(['id_cate' => $id], [$action => 0]);
	    		echo json_encode(['result' => 'glyphicon-remove', 'num' => 0]); exit();
	    	} else {
	    		$this->system_branch_model->updateData(['id_cate' => $id], [$action => 1]);
	    		echo json_encode(['result' => 'glyphicon-ok', 'num' => 1]); exit();
	    	}
    	} else {
    		echo json_encode(['error' => 'Bài viết này không tồn tại']); exit();
    	}
    }


    function del_list_choose()
    {
    	$list_id = explode(',', $_POST['list_id']);

    	if (count($list_id) == 1) {
    		$this->system_branch_model->deleteData($list_id);
    	} else {
	    	foreach ($list_id as $id) {
	    		if ($this->system_branch_model->check_exists(['id_cate' => $id])){
	    			$this->system_branch_model->deleteData($id);
	    		} else {
	                echo json_encode(['error' => 'Bạn là hacker ah !']); exit();
	    		}
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục bài viết');   

        echo json_encode(['result' => admin_url('system_branch')]); exit(); 
    }
}