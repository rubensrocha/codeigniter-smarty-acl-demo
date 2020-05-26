<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->library('smarty_acl');
        $this->load->helper('url');
        $this->load->library('form_validation');
    }

    protected function logged_in()
    {
        if (!$this->smarty_acl->logged_in(FALSE)) {
            return redirect('login');
        }
    }

	public function index()
	{
		$this->load->view('index');
	}

	public function account()
	{
        $this->logged_in();
		$this->load->view('account');
	}

	public function unauthorized()
    {
        echo 'UNAUTHORIZED ACCESS';
    }
	
	public function importdatabase()
	{
		$this->load->library('migration');

		if ($this->migration->latest() === FALSE)
		{
			echo $this->migration->error_string();
		}
                $this->session->set_flashdata('success_msg','Database migrated successfully!');
		return redirect('/');
	}
}
