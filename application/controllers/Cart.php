<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Categories_model');
        $this->load->model('Products_model');
        $this->load->model('Order_model');
        $this->load->helper('cookie');
        if(!$this->session->userdata('login')){
            $cookie = get_cookie('e382jxndj');
            if($cookie == NULL){
                redirect(base_url() . 'login?redirect=cart');
            }else{
                $getCookie = $this->db->get_where('user', ['cookie' => $cookie])->row_array();
                if($getCookie){
                    $dataCookie = $getCookie;
                    $dataSession = [
                        'id' => $dataCookie['id']
                    ];
                    $this->session->set_userdata('login', true);
                    $this->session->set_userdata($dataSession);
                }else{
                    redirect(base_url() . 'login?redirect=cart');
                }
            }
        }
    }

    public function index(){
        $data['title'] = 'Keranjang - ' . $this->Settings_model->general()["app_name"];
        $data['css'] = 'cart';
        $data['responsive'] = '';
        $data['cart'] = $this->Order_model->getCartUser();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('page/cart', $data);
        $this->load->view('templates/footerv2');
    }

    public function add_to_cart(){
        $id = $this->input->post('id');
        $setting = $this->db->get('settings')->row_array();
        $result = $this->db->get_where('products', ['id' => $id])->row_array();
        $check = $this->db->get_where('cart', ['user' => $this->session->userdata('id'), 'id_product' => $result['id']])->row_array();
        $this->db->where('product', $id);
		$this->db->where('min <=', $check['qty'] + $this->input->post('qty'));
		$this->db->order_by('id', 'desc');
		$grosir = $this->db->get('grosir')->row_array();
        if($setting['promo'] == 1){
            if($result['promo_price'] == 0){
                if($grosir){
					$price = $grosir['price'];
				}else{
                    $price = $result['price'];
				}
            }else{
                $price = $result['promo_price'];
            }
        }else{
            if($grosir){
                $price = $grosir['price'];
            }else{
                $price = $result['price'];
            }
        }
        if($check){
            $qtyupdate = intval($check['qty']) + intval($this->input->post('qty')) ;
            $data = [
                'user' => $this->session->userdata('id'),
                'id_product' => $result['id'],
                'product_name' => $result['title'],
                'price' => $price,
                'qty' => $qtyupdate,
                'img' => $result['img'],
                'slug' => $result['slug'],
                'weight' => $result['weight']
            ];
            $this->db->where('id', $check['id']);
            $this->db->update('cart', $data);
        }else{
            $data = [
                'user' => $this->session->userdata('id'),
                'id_product' => $result['id'],
                'product_name' => $result['title'],
                'price' => $price,
                'qty' => $this->input->post('qty'),
                'img' => $result['img'],
                'slug' => $result['slug'],
                'weight' => $result['weight']
            ];
            $this->db->insert('cart', $data);
        }
    }

    public function add_ket(){
        $rowid = $this->input->post('rowid');
        $ket = $this->input->post('ket');
        $this->db->set('ket', $ket);
        $this->db->where('id', $rowid);
        $this->db->update('cart');
    }

    public function get_item(){
        $id = $this->input->post('id');
        $return = $this->db->get_where('cart', ['id' => $id])->row_array();
        echo json_encode($return);
    }

    public function delete($id){
        $this->db->where('user', $this->session->userdata('id'));
        $this->db->where('id', $id);
        $this->db->delete('cart');
        redirect(base_url() . 'cart');
    }

    public function delete_cart(){
        $this->db->where('user', $this->session->userdata('id'));
        $this->db->delete('cart');
        redirect(base_url() . 'cart');
    }

}
