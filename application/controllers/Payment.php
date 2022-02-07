<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Categories_model');
        $this->load->model('Payment_model');
        $this->load->model('Settings_model');
        $this->load->model('Order_model');
        $this->load->helper('cookie');
        $this->load->library('form_validation');
    }

    public function index(){
        if(!$this->session->userdata('login')){
            $cookie = get_cookie('ibq2cy38y');
            if($cookie == NULL){
                redirect(base_url() . 'login?redirect=payment');
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
                    redirect(base_url() . 'login?redirect=payment');
                }
            }
        }
        $data['title'] = 'Pembayaran - ' . $this->Settings_model->general()["app_name"];
        $data['css'] = 'payment';
        $data['cart'] = $this->Order_model->getCartUser();
        $data['provinces'] = $this->Payment_model->getProvinces();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('page/payment', $data);
        $this->load->view('templates/footerv2');
    }

    public function getLocation(){
        $id = $this->input->post('id');
        $getLocation = $this->Payment_model->getCity($id);
        $list = "<option></option>";
        foreach($getLocation as $d){
            $list .= "<option value='".$d['city_id']."'>".$d['type'].' '.$d['city_name']."";
        }
        echo json_encode($list);
    }

    public function getService(){
        $jne = $this->Payment_model->getService("jne");
        $pos = $this->Payment_model->getService("pos");
        $tiki = $this->Payment_model->getService("tiki");
        $destination = $this->input->post('destination');
        $db = $this->db->get_where('cost_delivery', ['destination' => $destination])->row_array();
        $cod = $this->db->get_where('cod', ['regency_id' => $destination])->row_array();
        $list = "<option></option>";
        $cost = "";
        if($cod){
            $list .= '<option value="0-cod-cod">COD (Cash of Delivery)</option>';
        }
        if($db){
            $list .= '<option value="'.$db['price'].'-antar-antar">Diantar oleh Penjual</option>';
        }
        if(count($jne) > 0){
            foreach($jne as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-jne">'."JNE"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($pos) > 0){
            foreach($pos as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-pos">'."POS"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        if(count($tiki) > 0){
            foreach($tiki as $s){
                $list .= '<option value="'.$s['cost'][0]['value']."-".$s['service'].'-tiki">'."TIKI"." ".$s['description']." (".$s['service'].")".'</option>';
            };
        }
        echo json_encode($list);
    }

    public function succesfully(){
        if($this->input->post('name') == NULL){
            redirect(base_url());
        }
        $suc = $this->Payment_model->succesfully();
        
    }

    public function confirmation(){
        $this->form_validation->set_rules('invoice', 'Invoice', 'required', ['required' => 'Order ID wajib diisi']);
	    if($this->form_validation->run() == false){
            $data['title'] = 'Bukti Pembayaran - ' . $this->Settings_model->general()["app_name"];
            $data['css'] = '';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar');
            $this->load->view('page/payment_proof');
            $this->load->view('templates/footer_notmpl');
        }else{
            $invoice = $this->input->post('invoice', true);
            $check = $this->db->get_where('invoice', ['invoice_code' => $invoice, 'status' => 0])->row_array();
            if($check){
                $data = array();
                $upload = $this->Order_model->uploadFile();

                if($upload['result'] == 'success'){
                    $this->Order_model->insertPaymentConfirmation($upload);
                    $this->session->set_flashdata('success', "<script>
                        swal({
                        text: 'Bukti pembayaran berhasil dikirim',
                        icon: 'success'
                        });
                        </script>");
                        redirect(base_url() . 'profile/transaction/'.$invoice);
                }else{
                    $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                    Gagal mengirim bukti pembayaran, pastikan file berukuran maksimal 2mb dan berformat png, jpg, jpeg, atau pdf. Silakan ulangi lagi.
                    </div>");
                    redirect(base_url() . 'payment/confirmation');
                }
            }else{
                $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                    Order ID yang dimasukan tidak ada atau sudah terkonfirmasi!
                    </div>");
                    redirect(base_url() . 'payment/confirmation');
            }
        }
    }

}
