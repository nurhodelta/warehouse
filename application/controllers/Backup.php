<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_admin', 'ADM', TRUE);
		$this->load->model('M_config', 'CONF', TRUE);
	}
	
	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
            $this->load->dbutil();

            $prefs = array(     
                'format'      => 'zip',             
                'filename'    => 'backup_db.sql'
            );

            $backup =& $this->dbutil->backup($prefs); 

            $db_name = 'database-'. date("Y-m-d-H-i-s") .'.zip';
            $save = './database/'.$db_name;

            $this->load->helper('file');
            write_file($save, $backup); 


            $this->load->helper('download');
            force_download($db_name, $backup);

		} else {
			redirect("login");
		}
	 }
}