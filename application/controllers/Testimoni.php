<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testimoni extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model("Categories_model");
        $this->load->model("Testi_model");
    }

    public function index(){
    $data['title'] = 'Testimoni - ' . $this->Settings_model->general()["app_name"];
    $data['css'] = 'products';
    $data['responsive'] = 'product-responsive';
    $data['testi'] = $this->Testi_model->getTesti();
    $this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('page/testi', $data);
		$this->load->view('templates/footerv2');
    }

}
