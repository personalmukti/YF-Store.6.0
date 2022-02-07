<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => $this->Settings_model->general()["server_api_midtrans"], 'production' => $this->config->item('midtrans_production'));
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
		
    }

    public function process()
    {
    	$order_id = $this->input->post('order_id');
    	$action = $this->input->post('action');
    	switch ($action) {
		    case 'status':
		        $this->status($order_id);
		        break;
		    case 'approve':
		        $this->approve($order_id);
		        break;
		    case 'expire':
		        $this->expire($order_id);
		        break;
		   	case 'cancel':
		        $this->cancel($order_id);
		        break;
		}

    }

	public function status($order_id)
	{
		$status = $this->midtrans->status($order_id);
		$this->db->set('pay_status', $status->transaction_status);
		$this->db->where('invoice_code', $order_id);
		$this->db->update('invoice');
		$this->session->set_flashdata('status', "<div class='alert alert-secondary' role='alert'>
            Status pesanan dengan Order ID $order_id adalah $status->transaction_status
            </div>");
        redirect(base_url() . 'administrator/orders');
	}

	public function cancel($order_id)
	{
		$status = $this->midtrans->cancel($order_id);
		$this->db->set('pay_status', $status->transaction_status);
		$this->db->where('invoice_code', $order_id);
		$this->db->update('invoice');
		$this->session->set_flashdata('status', "<div class='alert alert-secondary' role='alert'>
            Status pesanan dengan Order ID $order_id telah dibatalkan
            </div>");
        redirect(base_url() . 'administrator/orders');
	}

	public function approve($order_id)
	{
		echo 'test get approve </br>';
		print_r ($this->midtrans->approve($order_id) );
	}

	public function expire($order_id)
	{
		$status = $this->midtrans->expire($order_id);
		$this->db->set('pay_status', $status->transaction_status);
		$this->db->where('invoice_code', $order_id);
		$this->db->update('invoice');
		$this->session->set_flashdata('status', "<div class='alert alert-secondary' role='alert'>
            Status pesanan dengan Order ID $order_id telah diubah ke expired
            </div>");
        redirect(base_url() . 'administrator/orders');
	}
}
