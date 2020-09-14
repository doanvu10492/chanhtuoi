<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Offline extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->config->db_config_fetch();
    } 

    public function index()
    {
       $status = $this->config->item('site_status');
        if ($status == 0) {
            $this->load->view('frontend/errors/offline');        
        } else {
            redirect(base_url());
        }
    }
}