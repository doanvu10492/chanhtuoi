<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Car extends Admin_Controller 
{
    public $limit = array();
    /*
    * String after link
    */
    public $queryString = null;

    /*
    * per_page
    */
    public $perPage;

	public $outputData;

    public $numberPage = 20;

    function __construct()
    {
    	parent::__construct();
        // to use $_GET
        parse_str(substr(strrchr($_SERVER['REQUEST_URI'], "?"), 1), $_GET);

        if(!isAdmin())
			redirect_admin('login');
    	$this->config->db_config_fetch();
		$this->lang->load('admin/validation',$this->config->item('language_code'));
		$this->load->library('select_option');
		$this->load->library('Upload_library');
		$this->load->model('backend/car_model');
    }

    function index()
    {
        $condition = [];

        if (isset($_GET['code']) && ($_GET['code'] !=' ')) {
            $code = $_GET['code'];
            $this->queryString .= '&code=' . $code;
            $condition[TB_PRODUCTS.'.code'] = $code;
        }

        $this->getLimit();
        $this->_total = count($this->car_model->list()->result());
        $collection = $this->car_model->list($condition, $this->limit)->result();
        $collectionData = $this->car_model->parseData($collection);
        $pagination = $this->getPagination();

    	$this->outputData = [
			'pageTitle' => 'Danh sách xe học',
			'currentPage' => 'categories',
			'subPage'=> 'car',
			'list' => $collectionData,
            'delAll' => admin_url('car/delListChoose'),
            'addNew' => admin_url('car/updated/0'),
            'pagination' => $pagination
		];

	    $this->render('admin/car/list');
    }
   
    function updated($id)
    {	
        $car =  $this->car_model->getDetailData(['id' => $id]);
	    if ($id) {
            $pageTitle = 'Chỉnh sửa';
            
            $action = 'Cập nhật';
	    } else {
            $pageTitle = 'Thêm mới';

            $action = 'Thêm mới';
	    }

        $this->outputData = [
            'pageTitle' => $pageTitle,
            'currentPage' => 'categories',
            'page' => $car,
            'id' => $id,
            'subPage' => 'car',
            'action' => $action,
            'option' => [],
            'linkSave' => admin_url('car/save')
        ];
	    
		$this->render('admin/car/update');
    }

    public function save()
    {
        $id = $this->input->post('id');

    	$this->form_validation->set_error_delimiters($this->config->item('field_error_start_tag'), $this->config->item('field_error_end_tag'));
		$this->form_validation->set_rules('name','lang:site_title_validation', 'trim|required|xss_clean');
       
    	if ( ! $this->form_validation->run()) {
            $this->updated($id);
            return true;
        }

		$data = $this->input->post();
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($id) {
            $key = array('id' => $id);
            $this->car_model->updateData($key, $data);
            $this->session->set_flashdata('flash_message','Cập nhật bài viết thành công !');
        } else {
            $data['created_at'] = date('Y-m-d H:i:s');
            $this->car_model->insertData($data);
            $this->session->set_flashdata('flash_message','Bạn vừa thêm 1 địa chỉ mới');
        }


		redirect_admin('car');   
    }

    function delete($id)
    { 
		$this->car_model->deleteData($id);
		$this->session->set_flashdata('flash_message','Bạn vừa xóa thành công một mẩu tin');

		redirect_admin('car');		
    }

    function updateStatus()
    {
        $resp = [
            'error' => '',
            'result' => '',
        ];

    	$id = $this->uri->segment(4);
    	$action = trim($_POST['action']);
    	//check product exist
    	if ($this->car_model->check_exists(array('id' => $id))) {
    		// click ok status
	    	if ($_POST['active'] == 1) {
	    		$this->car_model->updateData(array('id' => $id), array($action => 0));
                $resp = ['result' => 'glyphicon-move', 'num' => 0];
	    	} else {
	    		$this->car_model->updateData(array('id' => $id), array($action => 1));
                $resp = ['result' => 'glyphicon-ok', 'num' => 1];
	    	}
    	} else {
    		$resp['error'] = 'Bài viết này không tồn tại'; 
    	}

        echo json_encode($resp);
    }


    function delListChoose()
    {
    	$list_id = explode(',', $_POST['list_id']);

    	if (count($list_id) == 1) {
    		$this->car_model->deleteData($list_id);
    	} else {
	    	foreach ($list_id as $id) {
	    		if ($this->car_model->check_exists(array('id' => $id))) {
	    			$this->car_model->deleteData($id);
	    		} else {
	                echo json_encode(array('error' => 'Bạn là hacker ah !')); exit();
	    		}
			    
	    	}
        }

        $this->session->set_flashdata('flash_message','Bạn vừa xóa thành công các danh mục sản phẩm');
           
        echo json_encode(array('result' => admin_url('car'))); exit(); 
    }

    function getPagination()
    {
        $this->load->library('pagination');
        $limit = $this->limit;
        $perPage = $limit[0];
        $url = './admin/car'.$this->queryString;
        $config['page_query_string'] = TRUE;
        $config['base_url'] = $url;
        $config['total_rows'] = $this->_total;
        $config['per_page'] = $perPage;
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links(true, $url);
        
        return $pagination;     
    } 

    function getLimit() 
    {
        if (isset($_GET['per_page']) && $_GET['per_page'] != NULL) {
            $this->perPage = $_GET['per_page'];
        }

        $this->limit = array($this->numberPage, $this->perPage);
    }
}