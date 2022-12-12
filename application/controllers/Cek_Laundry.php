<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek_Laundry extends CI_Controller {

	public function index()
	{
		$this->load->view('frondent/header');
		$this->load->view('frondent/cek_laundry');
		$this->load->view('frondent/footer');
	}
}
