<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => $this->Settings_model->general()["server_api_midtrans"], 'production' => $this->config->item('midtrans_production'));
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    public function index()
    {
		$this->load->view('checkout_snap');
    }

    public function token()
    {
		$invoice = $_GET['invoice'];
		$gettransaction = $this->db->get_where('transaction', ['id_invoice' => $invoice]);
		$getinvoice = $this->db->get_where('invoice', ['invoice_code' => $invoice])->row_array();
		$getuser = $this->db->get_where('user', ['id' => $getinvoice['user']])->row_array();
		
        $total = intval($getinvoice['total_all']);
        
		$transaction_details = array(
		  'order_id' => intval($invoice),
		  'gross_amount' => $total
		);

		$items = [];
		foreach($gettransaction->result_array() as $c){
			$items[] = array(
				'id' => intval($c['id']),
				'price' => intval($c['price']),
				'quantity' => intval($c['qty']),
				'name' => substr($c['product_name'],0,50)
			);
		}

		$items[] = [
			'id' => 999,
			'price' => intval($getinvoice['ongkir']),
			'quantity' => 1,
			'name' => 'Ongkos Kirim (' . strtoupper($getinvoice['courier']) . ')'
		];

		$customer_details = array(
		  'first_name'    => $getinvoice['name'],
		  'email'         => $getuser['email'],
		  'phone'         => $getinvoice['telp']
		);

        $credit_card['secure'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'day', 
            'duration'  => 1
        );
        
        $payload = array(
            'transaction_details'=> $transaction_details,
            'item_details'		 => $items,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($payload));
		$snapToken = $this->midtrans->getSnapToken($payload);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish()
    {
		$invoice = $_GET['invoice'];
		if(!$invoice){
			redirect(base_url());
		}
		$result = json_decode($this->input->post('result_data'));
		$this->db->set('link_pay', $result->pdf_url);
		$this->db->set('pay_status', 'pending');
		$this->db->where('invoice_code', $invoice);
		$this->db->update('invoice');
		redirect(base_url() . 'profile/transaction/' . $invoice);
    }
}
