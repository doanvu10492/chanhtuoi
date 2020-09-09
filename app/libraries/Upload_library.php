<?php
class Upload_library 
{
    public function __construct()
    {
     	$this->CI = & get_instance();
    }

    /**
    ** Do upload file
    ** 
    ** param string $upload_path
    ** param string $file_name
    ** param array $thumbs
    ** param array $thumbs_small
    */
    public function do_upload_file( $upload_path = '', $file_name = '', $thumbs = array(), $thumbs_small = array())
    {
		$config = $this->config($upload_path, $file_name);
		$this->CI->load->library('upload', $config);

		if ($this->CI->upload->do_upload($file_name)) {
			//success upload
			$data = $this->CI->upload->data();
			if(count($thumbs) > 1) {
				$this->create_thumbs($upload_path, $data['file_name'], $thumbs, 'thumb');
			}
			if(count($thumbs_small) > 1) {
				
				$this->create_thumbs($upload_path, $data['file_name'], $thumbs_small, 'w130');
			}
		} else {
			//errors upload
			$data = $this->CI->upload->display_errors();
		}
		//return 
		unset($config);

		return $data;
    }


    public function create_thumbs($upload_path , $file_name, $thumbs, $directory = '')
    {
    
    	$config['image_library'] = 'gd2';
		$config['source_image'] = $upload_path.$file_name;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['thumb_marker'] = '';
		$config['width']     = $thumbs[0];
		$config['height']     = $thumbs[1];
		$config['new_image'] = $upload_path.$directory.'/'.$file_name;
		$this->CI->load->library('image_lib'); 
		$this->CI->image_lib->initialize($config);
		$this->CI->image_lib->resize();
		$this->CI->image_lib->clear();
		unset($config);
		
		$this->watermark($upload_path.$directory.'/'.$file_name, true);
		
		$this->watermark($upload_path.$file_name);
    }
	
	
	function watermark($file, $isSmall = false)
	{
		$this->CI->load->library('image_lib'); 
		$config['image_library'] = 'gd2';
        $config['source_image']	= $file;
		$config['create_thumb'] = FALSE;
		
		$config['wm_type'] = 'overlay';
        $config['wm_overlay_path'] = $isSmall ? '.' . $this->CI->config->item('bg_guide') :  '.' . $this->CI->config->item('logo_en');
        $config['wm_padding'] = '0';
        $config['wm_opacity'] = '27';
	
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '0';

		$this->CI->image_lib->initialize($config);
		$this->CI->image_lib->watermark();
		
		unset($config);
	}

    /**  
    ** Upload many file
    **
    ** @param string $upload_path
    ** @param string $file_name
    */
    public function multiple_upload( $upload_path = '', $file_name)
    {
    	$config = $this->config($upload_path, $file_name);
	    
	    $number_of_files_uploaded = count($_FILES[$file_name]['name']);

	    // Faking upload calls to $_FILE

	    $image_list = array(); // to save file images uploaded success

	    for ($i = 0; $i < $number_of_files_uploaded; $i++) {
			$_FILES['userfile']['name']     = $_FILES[$file_name]['name'][$i];
			$_FILES['userfile']['type']     = $_FILES[$file_name]['type'][$i];
			$_FILES['userfile']['tmp_name'] = $_FILES[$file_name]['tmp_name'][$i];
			$_FILES['userfile']['error']    = $_FILES[$file_name]['error'][$i];
			$_FILES['userfile']['size']     = $_FILES[$file_name]['size'][$i];
	        $this->CI->load->library('upload', $config);
	       if ( $this->CI->upload->do_upload()) {
				$data =  $this->CI->upload->data();		
				$image_list [] = $data['file_name'];		
			}
	        // Continue processing the uploaded data
	     
	    }
        // return list name file images;
        unset($config);

	    return $image_list;
     }

    /**
    * Config file upload 
    *
    * @param: upload_path ( path of file upload)
    * @param string $file_name
    * @return string
    */
    public function config( $upload_path = '', $file_name)
    {
    	$config = array();
    	$config['upload_path'] = $upload_path;
		$config['allowed_types'] = '*';
		$config['max_size']	= '20000';
		$config['max_width']  = '202422';
		$config['max_height']  = '200022';
		// handle unicode utf8
		$name_file = explode('.', $_FILES[$file_name]['name']);
		$config['file_name'] = url_alias($name_file[0]);

		return $config;
    }
}