<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application {

	function __construct() {
            parent::__construct();
            $this->load->view('welcome_message');
            $this->load->model('Timetable');
        }
        
	public function index()
	{
            $this->data['pagebody'] = 'Welcome'; 
            
            $this->render();
	}
}
