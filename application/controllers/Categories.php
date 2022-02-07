<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Categories_model');
		$this->load->model('Products_model');
	}

	public function index($c){
    $cat = $this->Categories_model->getIdCategoryBySlug($c);
		$ob = $_GET['ob'];
		$maxprice = $_GET['maxprice'];
		$minprice = $_GET['minprice'];
		$promo = $_GET['promo'];
		$condition = $_GET['condition'];
		if($ob != NULL){
			if($ob == "latest"){
				$data['titleHead'] = 'Urutkan > Terbaru';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "");
			}else if($ob == "az"){
				$data['titleHead'] = 'Urutkan > Abjad A-Z';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "az");
			}else if($ob == "za"){
				$data['titleHead'] = 'Urutkan > Abjad Z-A';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "za");
			}else if($ob == "pmin"){
				$data['titleHead'] = 'Urutkan > Harga Terendah';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "pricemax");
			}else if($ob == "pmax"){
				$data['titleHead'] = 'Urutkan > Harga Tertinggi';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "pricemin");
			}
		}else if($minprice != NULL || $maxprice != NULL){
			if($minprice == ""){
				$minprice = "0";
				$data['titleHead'] = 'Harga > ' . $minprice . ' - ' . $maxprice;
			}else if($maxprice == ""){
				$maxprice = "0";
				$data['titleHead'] = 'Harga > ' . $minprice . " -->";
			}else if($maxprice < $minprice){
				$maxprice = "0";
				$data['titleHead'] = 'Harga > ' . $minprice . " -->";
			}else{
                $data['titleHead'] = 'Harga > ' . $minprice . ' - ' . $maxprice;
            }
			$data['products'] = $this->Products_model->getAllProductsByCategoryPrice($cat, $minprice, $maxprice);
		}else if($promo != NULL && $promo == "true"){
			$data['titleHead'] = 'Penawaran > Promo';
			$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "promo");
		}else if($condition != NULL){
			if($condition == "1"){
				$data['titleHead'] = 'Kondisi > Baru';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "1");
			}else if($condition == "2"){
				$data['titleHead'] = 'Kondisi > Bekas';
				$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "2");
			}
		}else{
			$data['titleHead'] = '';
			$data['products'] = $this->Products_model->getAllProductsByCategory($cat, "");
		}
		$data['title'] = 'Kategori ' . $this->Categories_model->getNameCategoryBySlug($c) . ' - ' . $this->Settings_model->general()["app_name"];
		$data['css'] = 'products';
		$data['responsive'] = 'product-responsive';
        $data['slug'] = $c;
		$data['nameCat'] = $this->Categories_model->getNameCategoryBySlug($c);
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('page/categories', $data);
		$this->load->view('templates/footerv2');
	}

}
