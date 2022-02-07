<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => $this->Settings_model->general()["server_api_midtrans"], 'production' => $this->Settings_model->general()["midtrans_production"]);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->helper('url');
		
    }

	public function index()
	{
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
		$notif = $this->veritrans->status($result->order_id);
		}

		error_log(print_r($result,TRUE));

		$transaction = $notif->transaction_status;
		$type = $notif->payment_type;
		$order_id = $notif->order_id;
		$fraud = $notif->fraud_status;

		if ($transaction == 'capture') {
		  // For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
		    if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
		      } 
		      else {
		      // TODO set payment status in merchant's database to 'Success'
		      echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
		      }
		    }
		  }
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  	$this->db->set('pay_status', 'settlement');
			$this->db->where('invoice_code', $order_id);
			$this->db->update('invoice');
		  } 
		  else if($transaction == 'pending'){
		  // TODO set payment status in merchant's database to 'Pending'
		  	$this->db->set('pay_status', 'pending');
			$this->db->where('invoice_code', $order_id);
			$this->db->update('invoice');
		  } 
		  else if ($transaction == 'deny') {
		  // TODO set payment status in merchant's database to 'Denied'
		 	$this->db->set('pay_status', 'cancel');
			$this->db->where('invoice_code', $order_id);
			$this->db->update('invoice');
		}

	}
}
