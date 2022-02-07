<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('form_validation');
        $this->load->model('Categories_model');
        $this->load->model('Products_model');
        $this->load->model('Settings_model');
        $this->load->model('Promo_model');
        $this->load->model('Testi_model');
        $this->load->model('Order_model');

        if(!$this->session->userdata('admin')){
            $cookie = get_cookie('djehbicd');
            if($cookie == NULL){
                redirect(base_url());
            }else{
                $getCookie = $this->db->get_where('admin', ['cookie' => $cookie])->row_array();
                if($getCookie){
                    $this->session->set_userdata('admin', true);
                }else{
                    redirect(base_url());
                }
            }
        }
    }

    public function index(){
        $data['title'] = 'Dashboard - Admin Panel';
        $config['total_rows'] = $this->Order_model->getOrders("","")->num_rows();
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['orders'] = $this->Order_model->getOrders($config['per_page'], $from);
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/index');
        $this->load->view('templates/footer_admin');
    }

    public function users(){
        $data['title'] = 'Pengguna - Admin Panel';
        $config['base_url'] = base_url() . 'administrator/users/';
        $config['total_rows'] = $this->User_model->getUsers("","")->num_rows();
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['users'] = $this->User_model->getUsers($config['per_page'], $from);
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/users', $data);
        $this->load->view('templates/footer_admin');
    }

    public function active_user($id){
        $this->db->set('is_activate', 1);
        $this->db->where('id', $id);
        $this->db->update('user');
        redirect(base_url() . 'administrator/users');
    }

    public function nonactive_user($id){
        $this->db->set('is_activate', 0);
        $this->db->where('id', $id);
        $this->db->update('user');
        redirect(base_url() . 'administrator/users');
    }

    public function proof(){
        $data['title'] = 'Bukti Pembayaran - Admin Panel';
        $data['proof'] = $this->db->get_where('payment_proof', ['status' => 0]);
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/proof', $data);
        $this->load->view('templates/footer_admin');
    }

    public function confirm_proof($id){
        $this->db->set('status', 1);
        $this->db->where('invoice', $id);
        $this->db->update('payment_proof');
        $this->db->set('status', 1);
        $this->db->where('invoice_code', $id);
        $this->db->update('invoice');
        $get = $this->db->get_where('payment_proof', ['invoice' => $id])->row_array();
        unlink("./assets/images/confirmation/".$get['file']);
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Bukti pembayaran terverifikasi',
            icon: 'success'
            });
        </script>");
        redirect(base_url() . 'administrator/proof/');
    }

    // orders
    public function orders(){
        $data['title'] = 'Pesanan - Admin Panel';
        $config['base_url'] = base_url() . 'administrator/orders/';
        $config['total_rows'] = $this->Order_model->getOrders("","")->num_rows();
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['orders'] = $this->Order_model->getOrders($config['per_page'], $from);
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/orders', $data);
        $this->load->view('templates/footer_admin');
    }

    public function detail_order($id){
        if($this->Order_model->getDataInvoice($id)){
            $data['title'] = 'Detail Pesanan - Admin Panel';
            $data['orders'] = $this->Order_model->getOrderByInvoice($id);
            $data['invoice'] = $this->Order_model->getDataInvoice($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/detail_order', $data);
            $this->load->view('templates/footer_admin');
        }else{
            redirect(base_url() . 'administrator/orders');
        }
    }

    public function print_detail_order($id){
        if($this->Order_model->getDataInvoice($id)){
            $data['title'] = 'Detail Pesanan - Admin Panel';
            $data['orders'] = $this->Order_model->getOrderByInvoice($id);
            $data['invoice'] = $this->Order_model->getDataInvoice($id);
            $this->load->view('administrator/order_invoice', $data);
        }else{
            redirect(base_url() . 'administrator/orders');
        }
    }

    public function process_order($id){
        $buyer = $this->db->get_where('invoice', ['invoice_code' => $id])->row_array();
        $this->db->set('status', 2);
        $this->db->where('invoice_code', $id);
        $this->db->update('invoice');
        $transaction = $this->db->get_where('transaction', ['id_invoice' => $id]);
        foreach($transaction->result_array() as $t){
            $this->db->set('transaction', 'transaction+'.$t['qty'].'', FALSE);
            $this->db->set('stock', 'stock-'.$t['qty'].'', FALSE);
            $this->db->where('slug', $t['slug']);
            $this->db->update('products');
        }
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Status berhasil diubah menjadi Sedang Diproses',
            icon: 'success'
            });
        </script>");
        redirect(base_url() . 'administrator/order/'.$id);
    }

    public function finish_order_cod($id){
        $this->db->set('status', 4);
        $this->db->where('invoice_code', $id);
        $this->db->update('invoice');
        $transaction = $this->db->get_where('transaction', ['id_invoice' => $id]);
        foreach($transaction->result_array() as $t){
            $this->db->set('transaction', 'transaction+1', FALSE);
            $this->db->set('stock', 'stock-1', FALSE);
            $this->db->where('slug', $t['slug']);
            $this->db->update('products');
        }
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Pesanan selesai',
            icon: 'success'
            });
        </script>");
        redirect(base_url() . 'administrator/order/'.$id);
    }

    public function sending_order($id){
        $resi = $this->input->post('resi', true);
        if($resi == NULL){
            redirect(base_url() . 'administrator/orders');
        }
        $buyer = $this->db->get_where('invoice', ['invoice_code' => $id])->row_array();
        $this->db->set('status', 3);
        $this->db->where('invoice_code', $id);
        $this->db->update('invoice');
        $this->db->set('resi', $resi);
        $this->db->where('invoice_code', $id);
        $this->db->update('invoice');
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['useragent'] = $this->Settings_model->general()["app_name"];
        $config['smtp_crypto'] = $this->Settings_model->general()["crypto_smtp"];
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['smtp_host'] = $this->Settings_model->general()["host_mail"];
        $config['smtp_port'] = $this->Settings_model->general()["port_mail"];
        $config['smtp_timeout'] = '5';
        $config['smtp_user'] = $this->Settings_model->general()["account_gmail"];
        $config['smtp_pass'] = $this->Settings_model->general()["pass_gmail"];
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from($this->Settings_model->general()["account_gmail"], $this->Settings_model->general()["app_name"]);
        $this->email->to($buyer['email']);
        $this->email->subject('Pemesanan Telah Dikirim '.$id);
        $this->email->message(
            '<p><strong>Halo '.$buyer['name'].'</strong><br>
            Pesananmu telah kami kirim. <br/> Nomor Resi: <strong>'.$resi.'</strong> <br/> Jika ada pertanyaan silakan bisa menghubungi kami melalui Whatsapp'.$this->Settings_model->general()["whatsapp"].' atau <a href="https://wa.me/'.$this->Settings_model->general()["whatsappv2"].'">klik disini</a>.</p>
            ');
        $this->email->send();
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Pesanan sedang dikirim dan Resi telah di input',
            icon: 'success'
            });
        </script>");
        redirect(base_url() . 'administrator/order/'.$id);
    }

    public function delete_order($id){
        $buyer = $this->db->get_where('invoice', ['invoice_code' => $id])->row_array();
        $this->db->where('invoice_code', $id);
        $this->db->delete('invoice');
        $this->db->where('id_invoice', $id);
        $this->db->delete('transaction');
        $this->load->library('email');
        $config['charset'] = 'utf-8';
        $config['useragent'] = $this->Settings_model->general()["app_name"];
        $config['smtp_crypto'] = $this->Settings_model->general()["crypto_smtp"];
        $config['protocol'] = 'smtp';
        $config['mailtype'] = 'html';
        $config['smtp_host'] = $this->Settings_model->general()["host_mail"];
        $config['smtp_port'] = $this->Settings_model->general()["port_mail"];
        $config['smtp_timeout'] = '5';
        $config['smtp_user'] = $this->Settings_model->general()["account_gmail"];
        $config['smtp_pass'] = $this->Settings_model->general()["pass_gmail"];
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);
        $this->email->from($this->Settings_model->general()["account_gmail"], $this->Settings_model->general()["app_name"]);
        $this->email->to($buyer['email']);
        $this->email->subject('Pemesanan Anda Ditolak '.$id);
        $this->email->message(
            '<p><strong>Halo '.$buyer['name'].'</strong><br>
            Pesanan Anda kami tolak. <br/> Silakan hubungi kami melalui Whatsapp'.$this->Settings_model->general()["whatsapp"].' atau <a href="https://wa.me/'.$this->Settings_model->general()["whatsappv2"].'">klik disini</a>.</p>
            ');
        $this->email->send();
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Pesanan ditolak dan telah dihapus',
            icon: 'success'
            });
        </script>");
        redirect(base_url() . 'administrator/orders');
    }

    // email
    public function email(){
        $data['title'] = 'Kirim Email - Admin Panel';
        $data['email'] = '';
        $this->db->select("*, email_send.id AS sendId");
        $this->db->from("email_send");
        $this->db->join("subscriber", "email_send.mail_to=subscriber.id");
        $this->db->order_by('email_send.id', 'desc');
        $data['email'] = $this->db->get();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/email', $data);
        $this->load->view('templates/footer_admin');
    }

    public function detail_email($id){
        $data['title'] = 'Detail Email - Admin Panel';
        $data['email'] = '';
        $this->db->select("*, email_send.id AS sendId");
        $this->db->from("email_send");
        $this->db->join("subscriber", "email_send.mail_to=subscriber.id");
        $this->db->where('email_send.id', $id);
        $data['email'] = $this->db->get()->row_array();
        if(!$data['email']){
            redirect(base_url() . 'administrator/email');
        }
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/detail_email', $data);
        $this->load->view('templates/footer_admin');
    }

    public function send_mail(){
        $this->form_validation->set_rules('sendMailTo', 'sendMailTo', 'required', ['required' => 'Ke wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Kirim Email - Admin Panel';
            $data['email'] = $this->Settings_model->getEmailAccount();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/send_mail', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $to = $this->input->post('sendMailTo');
            $subjet = $this->input->post('subject');
            $message = $this->input->post('description');
            $data = [
                'mail_to' => $to,
                'subject' => $subjet,
                'message' => $message
            ];
            $this->db->insert('email_send', $data);

            if($to == 0){
                $data = $this->db->get('subscriber');
                foreach($data->result_array() as $d){
                    $this->load->library('email');
                    $config['charset'] = 'utf-8';
                    $config['useragent'] = $this->Settings_model->general()["app_name"];
                    $config['smtp_crypto'] = $this->Settings_model->general()["crypto_smtp"];
                    $config['protocol'] = 'smtp';
                    $config['mailtype'] = 'html';
                    $config['smtp_host'] = $this->Settings_model->general()["host_mail"];
                    $config['smtp_port'] = $this->Settings_model->general()["port_mail"];
                    $config['smtp_timeout'] = '5';
                    $config['smtp_user'] = $this->Settings_model->general()["account_gmail"];
                    $config['smtp_pass'] = $this->Settings_model->general()["pass_gmail"];
                    $config['crlf'] = "\r\n";
                    $config['newline'] = "\r\n";
                    $config['wordwrap'] = TRUE;

                    $message .= '<br/><br/><a href="'.base_url().'unsubscribe-email?email='.$d['email'].'&code='.$d['code'].'">Berhenti berlangganan</a>';

                    $this->email->initialize($config);
                    $this->email->from($this->Settings_model->general()["account_gmail"], $this->Settings_model->general()["app_name"]);
                    $this->email->to($d['email']);
                    $this->email->subject($subjet);
                    $this->email->message(nl2br($message));
                    $this->email->send();
                }
            }else{
                $this->load->library('email');
                $config['charset'] = 'utf-8';
                $config['useragent'] = $this->Settings_model->general()["app_name"];
                $config['smtp_crypto'] = $this->Settings_model->general()["crypto_smtp"];
                $config['protocol'] = 'smtp';
                $config['mailtype'] = 'html';
                $config['smtp_host'] = $this->Settings_model->general()["host_mail"];
                $config['smtp_port'] = $this->Settings_model->general()["port_mail"];
                $config['smtp_timeout'] = '5';
                $config['smtp_user'] = $this->Settings_model->general()["account_gmail"];
                $config['smtp_pass'] = $this->Settings_model->general()["pass_gmail"];
                $config['crlf'] = "\r\n";
                $config['newline'] = "\r\n";
                $config['wordwrap'] = TRUE;

                $dataEmail = $this->db->get_where('subscriber', ['id' => $to])->row_array();
                $message .= '<br/><br/><a href="'.base_url().'unsubscribe-email?email='.$dataEmail['email'].'&code='.$dataEmail['code'].'">Berhenti berlangganan</a>';
                $this->email->initialize($config);
                $this->email->from($this->Settings_model->general()["account_gmail"], $this->Settings_model->general()["app_name"]);
                $this->email->to($dataEmail['email']);
                $this->email->subject($subjet);
                $this->email->message(nl2br($message));
                $this->email->send();
            }
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Email berhasil dikirim',
                icon: 'success'
                });
            </script>");
            redirect(base_url() . 'administrator/email');
        }
    }

    public function detele_email($id){
        $this->db->where('id', $id);
        $this->db->delete('email_send');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Email berhasil dihapus',
            icon: 'success'
            });
        </script>");
        redirect(base_url() . 'administrator/email');
    }

    // categories
    public function categories(){
        $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama kategori wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Kategori - Admin Panel';
            $data['getCategories'] = $this->Categories_model->getCategories();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/categories', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $data = array();
            $upload = $this->Categories_model->uploadIcon();

            if($upload['result'] == 'success'){
                $this->Categories_model->insertCategory($upload);
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Kategori berhasil ditambahkan',
                    icon: 'success'
                    });
                    </script>");
                    redirect(base_url() . 'administrator/categories');
            }else{
                $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                Gagal menambah kategori, pastikan icon berukuran maksimal 2mb dan berformat png, jpg, jpeg. Silakan ulangi lagi.
              </div>");
                redirect(base_url() . 'administrator/categories');
            }
        }
    }

    public function category($id){
        $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama kategori wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Edit Kategori - Admin Panel';
            $data['category'] = $this->Categories_model->getCategoryById($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_category', $data);
            $this->load->view('templates/footer_admin');
        }else{
            if($_FILES['icon']['name'] != ""){
                $data = array();
                $upload = $this->Categories_model->uploadIcon();
                if($upload['result'] == 'success'){
                    $this->Categories_model->updateCategory($upload['file']['file_name'], $id);
                    $this->session->set_flashdata('upload', "<script>
                        swal({
                        text: 'Kategori berhasil diubah',
                        icon: 'success'
                        });
                        </script>");
                        redirect(base_url() . 'administrator/categories');
                }else{
                    $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                    Gagal mengubah kategori, pastikan icon berukuran maksimal 2mb dan berformat png, jpg, jpeg. Silakan ulangi lagi.
                  </div>");
                    redirect(base_url() . 'administrator/category/' . $id);
                }
            }else{
                $oldIcon = $this->input->post('oldIcon');
                $this->Categories_model->updateCategory($oldIcon, $id);
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Kategori berhasil diubah',
                    icon: 'success'
                    });
                    </script>");
                redirect(base_url() . 'administrator/categories');
            }
        }
    }

    public function deleteCategory($id){
        $this->db->where('id', $id);
        $this->db->delete('categories');
        $this->db->where('category', $id);
        $this->db->delete('products');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Kategori berhasil dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/categories');
    }

    // products
    public function products(){
        $data['title'] = 'Produk - Admin Panel';
        $config['base_url'] = base_url() . 'administrator/products/';
        $config['total_rows'] = $this->Products_model->getProducts("","")->num_rows();
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['getProducts'] = $this->Products_model->getProducts($config['per_page'], $from);
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/products', $data);
        $this->load->view('templates/footer_admin');
    }

    public function search_products(){
        $key = $_GET['q'];
        $data['title'] = 'Produk - Admin Panel';
        $config['base_url'] = base_url() . 'administrator/products/';
        $config['total_rows'] = $this->Products_model->getSearchProducts($key,"","")->num_rows();
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['getProducts'] = $this->Products_model->getSearchProducts($key,$config['per_page'], $from);
        $data['search'] = $key;
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/products', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_product(){
        $this->form_validation->set_rules('title', 'title', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Tambah Produk - Admin Panel';
            $data['categories'] = $this->Categories_model->getCategories();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_product', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $data = array();
            $upload = $this->Products_model->uploadImg();

            if($upload['result'] == 'success'){
                $this->Products_model->insertProduct($upload);
                if($this->input->post('sendemail') == 1){
                    $mail = $this->db->get('subscriber');
                    $title = $this->input->post('title');
                    function toSlugFromText($text='') {
                        $text = trim($text);
                        if (empty($text)) return '';
                        $text = preg_replace("/[^a-zA-Z0-9\-\s]+/", "", $text);
                        $text = strtolower(trim($text));
                        $text = str_replace(' ', '-', $text);
                        $text = $text_ori = preg_replace('/\-{2,}/', '-', $text);
                        return $text;
                    }
                    foreach($mail->result_array() as $d){
                        $this->load->library('email');
                        $config['charset'] = 'utf-8';
                        $config['useragent'] = $this->Settings_model->general()["app_name"];
                        $config['smtp_crypto'] = $this->Settings_model->general()["crypto_smtp"];
                        $config['protocol'] = 'smtp';
                        $config['mailtype'] = 'html';
                        $config['smtp_host'] = $this->Settings_model->general()["host_mail"];
                        $config['smtp_port'] = $this->Settings_model->general()["port_mail"];
                        $config['smtp_timeout'] = '5';
                        $config['smtp_user'] = $this->Settings_model->general()["account_gmail"];
                        $config['smtp_pass'] = $this->Settings_model->general()["pass_gmail"];
                        $config['crlf'] = "\r\n";
                        $config['newline'] = "\r\n";
                        $config['wordwrap'] = TRUE;
    
                        $message = '<p>
                        Hai
                        Gimana kabarnya? Kami punya produk terbaru nih. Ayo buruan dapatkan sebelum kehabisan stok.
                        <strong>'.$this->input->post('title').'</strong>
                        <stong>Rp '.number_format($this->input->post('price'),0,",",".").'</stong>
                        <a href="'.base_url().'p/'.toSlugFromText($title).'">Lihat Produk</a></p>
                        <br/><br/>
                        <a href="'.base_url().'unsubscribe-email?email='.$d['email'].'&code='.$d['code'].'">Berhenti berlangganan</a>
                        ';
                        $this->email->initialize($config);
                        $this->email->from($this->Settings_model->general()["account_gmail"], $this->Settings_model->general()["app_name"]);
                        $this->email->to($d['email']);
                        $this->email->subject($this->input->post('title'));
                        $this->email->message(nl2br($message));
                        $this->email->send();
                    }
                }
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Produk berhasil ditambahkan',
                    icon: 'success'
                    });
                    </script>");
                    redirect(base_url() . 'administrator/products');
            }else{
                $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                Gagal menambah produk, pastikan icon berukuran maksimal 2mb dan berformat png, jpg, jpeg. Silakan ulangi lagi.
              </div>");
                redirect(base_url() . 'administrator/product/add');
            }
        }
    }

    public function add_img_product($id){
        $this->form_validation->set_rules('help', 'help', 'required');
        if($this->form_validation->run() == false){
            $data['title'] = 'Tambah Gambar - Admin Panel';
            $data['product'] = $this->Products_model->getProductById($id);
            $data['img'] = $this->db->get_where('img_product', ['id_product' => $id]);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_img_product', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $data = array();
            $upload = $this->Products_model->uploadImg();
            if($upload['result'] == 'success'){
                $this->Products_model->insertImg($upload, $id);
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Gambar berhasil ditambahkan',
                    icon: 'success'
                    });
                    </script>");
                    redirect(base_url() . 'administrator/product/add-img/'.$id);
            }else{
                $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                Gagal menambah gambar, pastikan gambar berukuran maksimal 10mb dan berformat png, jpg, jpeg. Silakan ulangi lagi.
              </div>");
                redirect(base_url() . 'administrator/product/add-img/'.$id);
            }
        }
    }

    public function add_grosir_product($id){
        $this->form_validation->set_rules('min', 'min', 'required', ['required' => 'Jumlah min. harus diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Tambah Harga Grosir - Admin Panel';
            $data['product'] = $this->Products_model->getProductById($id);
            $this->db->order_by('id', 'desc');
            $data['grosir'] = $this->db->get_where('grosir', ['product' => $id]);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_grosir_product', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->db->order_by('id', 'desc');
            $check = $this->db->get_where('grosir', ['product' => $id]);
            $min = $this->input->post('min');
            $price = $this->input->post('price');
            $product = $this->Products_model->getProductById($id);
            if($check->num_rows() > 0){
                $jmlsebelumnya = $check->row_array()['min'] + 1;
                if($min < $jmlsebelumnya){
                    $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                    Gagal menambahkan harga grosir, pastikan jumlah minimal adalah $jmlsebelumnya
                  </div>");
                    redirect(base_url() . 'administrator/product/grosir/'.$id);
                }else{
                    $data = [
                        'min' => $min,
                        'price' => $price,
                        'product' => $id
                    ];
                    $this->db->insert('grosir', $data);
                    $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Harga grosir berhasil ditambahkan',
                    icon: 'success'
                    });
                    </script>");
                    redirect(base_url() . 'administrator/product/grosir/'.$id);
                }
            }else{
                if($min < 2){
                    $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                    Gagal menambahkan harga grosir, pastikan jumlah minimal adalah 2
                  </div>");
                    redirect(base_url() . 'administrator/product/grosir/'.$id);
                }else{
                    $data = [
                        'min' => $min,
                        'price' => $price,
                        'product' => $id
                    ];
                    $this->db->insert('grosir', $data);
                    $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Harga grosir berhasil ditambahkan',
                    icon: 'success'
                    });
                    </script>");
                    redirect(base_url() . 'administrator/product/grosir/'.$id);
                }
            }
        }
    }

    public function delete_img_other_product($id, $idp){
        $this->db->where('id', $id);
        $this->db->delete('img_product');
        $this->session->set_flashdata('upload', "<script>
        swal({
        text: 'Gambar berhasil dihapus',
        icon: 'success'
        });
        </script>");
        redirect(base_url() . 'administrator/product/add-img/'.$idp);
    }

    public function edit_product($id){
        $this->form_validation->set_rules('title', 'title', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Edit Produk - Admin Panel';
            $data['categories'] = $this->Categories_model->getCategories();
            $data['product'] = $this->Products_model->getProductById($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_product', $data);
            $this->load->view('templates/footer_admin');
        }else{
            if($_FILES['img']['name'] != ""){
                $data = array();
                $upload = $this->Products_model->uploadImg();

                if($upload['result'] == 'success'){
                    $this->Products_model->updateProduct($upload['file']['file_name'], $id);
                    $this->session->set_flashdata('upload', "<script>
                        swal({
                        text: 'Produk berhasil diubah',
                        icon: 'success'
                        });
                        </script>");
                        redirect(base_url() . 'administrator/products');
                }else{
                    $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                    Gagal mengubah produk, pastikan icon berukuran maksimal 2mb dan berformat png, jpg, jpeg. Silakan ulangi lagi.
                </div>");
                    redirect(base_url() . 'administrator/product/' . $id . '/edit');
                }
            }else{
                $oldImg = $this->input->post('oldImg');
                $this->Products_model->updateProduct($oldImg, $id);
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Produk berhasil diubah',
                    icon: 'success'
                    });
                    </script>");
                redirect(base_url() . 'administrator/products');
            }
        }
    }

    public function product($id){
        $data['title'] = 'Detail Produk - Admin Panel';
        $data['product'] = $this->Products_model->getProductById($id);
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/detail_product', $data);
        $this->load->view('templates/footer_admin');
    }

    public function delete_product($id){
        $this->db->where('id', $id);
        $this->db->delete('products');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Produk berhasil dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/products');
    }

    // promo
    public function promo(){
        $data['title'] = 'Promo Produk - Admin Panel';
        $config['base_url'] = base_url() . 'administrator/promo/';
        $config['total_rows'] = $this->Promo_model->getProducts("","")->num_rows();
        $config['per_page'] = 10;
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        $from = $this->uri->segment(3);
        $this->pagination->initialize($config);
        $data['getProducts'] = $this->Promo_model->getProducts($config['per_page'], $from);
        $data['setting'] = $this->Settings_model->getSetting();
        $data['promo'] = $this->Promo_model->getPromo();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/promo', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_promo(){
        $this->Promo_model->insertPromo();
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Produk berhasil dijadikan promo',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/promo');
    }

    public function delete_promo($id){
        $this->Promo_model->deletePromo($id);
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Produk untuk promo berhasil dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/promo');
    }

    // testimonials
    public function testimonials(){
        $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama kategori wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Testimosi - Admin Panel';
            $data['testi'] = $this->Testi_model->getTesti();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/testi', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Testi_model->insertTesti();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Testimoni berhasil ditambahkan',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/testimonials');
        }
    }

    public function testimonial($id){
        $this->form_validation->set_rules('name', 'Name', 'required', ['required' => 'Nama kategori wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Edit Testimosi - Admin Panel';
            $data['testi'] = $this->Testi_model->getTestiById($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_testi', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Testi_model->updateTesti($id);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Testimoni berhasil diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/testimonials');
        }
    }

    public function delete_testimonial($id){
        $this->db->where('id', $id);
        $this->db->delete('testimonial');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Testimoni berhasil dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/testimonials');
    }

    public function pages(){
        $data['title'] = 'Halaman - Admin Panel';
        $data['pages'] = $this->Settings_model->getPages();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/pages', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_page(){
        $this->form_validation->set_rules('title', 'Judul', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Tambah Halaman - Admin Panel';
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_page', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->insertPage();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Halaman berhasil ditambahkan',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/pages');
        }
    }

    public function edit_page($id){
        $this->form_validation->set_rules('title', 'Judul', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Edit Halaman - Admin Panel';
            $data['page'] = $this->Settings_model->getPageById($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_page', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->updatePage($id);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Halaman berhasil diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/pages');
        }
    }

    public function delete_page($id){
        $this->db->where('id', $id);
        $this->db->delete('pages');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Halaman Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/pages');
    }

    // settings
    public function settings(){
        $data['title'] = 'Pengaturan - Admin Panel';
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/settings', $data);
        $this->load->view('templates/footer_admin');
    }

    public function general_setting(){
        $this->form_validation->set_rules('title', 'Judul', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['setting'] = $this->db->get('settings')->row_array();
            $data['general'] = $this->db->get('general')->row_array();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/setting_general', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->updateGeneral();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Pengaturan umum berhasil diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/general');
        }
    }

    public function setting_change_logo(){
        $data = array();
        $upload = $this->Settings_model->uploadlogo();
        if($upload['result'] == 'success'){
            $this->Settings_model->updateLogo($upload);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Logo berhasil diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/general');
        }else{
            $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
            Gagal mengubah logo, pastikan logo berukuran maksimal 2mb, berformat png, jpg, jpeg.
            </div>");
            redirect(base_url() . 'administrator/setting/general');
        }
    }

    public function setting_change_favicon(){
        $data = array();
        $upload = $this->Settings_model->uploadlogo();
        if($upload['result'] == 'success'){
            $this->Settings_model->updateFavicon($upload);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Favicon berhasil diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/general');
        }else{
            $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
            Gagal mengubah favicon, pastikan favicon berukuran maksimal 2mb, berformat png, jpg, jpeg.
            </div>");
            redirect(base_url() . 'administrator/setting/general');
        }
    }

    public function navmenu_setting(){
        $data['title'] = 'Pengaturan - Admin Panel';
        $data['menu'] = $this->db->get('menu');
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_navmenu', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_navmenu_setting(){
        $this->form_validation->set_rules('title', 'Judul', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['menu'] = $this->db->get('menu');
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_setting_navmenu', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->addNavMenu();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Menu Berhasil Disimpan',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/navmenu');
        }
    }

    public function edit_navmenu_setting($id){
        $this->form_validation->set_rules('title', 'Judul', 'required', ['required' => 'Judul wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['menu'] = $this->db->get_where('menu', ['id' => $id])->row_array();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_setting_navmenu', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->editNavMenu($id);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Menu Berhasil Diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/navmenu');
        }
    }

    public function delete_navmenu($id){
        $this->db->where('id', $id);
        $this->db->delete('menu');
        $this->db->where('submenu', $id);
        $this->db->delete('submenu');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Menu Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/navmenu');
    }

    public function delete_navsubmenu($id){
        $this->db->where('id', $id);
        $this->db->delete('submenu');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Submenu Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/navmenu');
    }

    public function banner_setting(){
        $data['title'] = 'Pengaturan - Admin Panel';
        $data['banner'] = $this->Settings_model->getBanner();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_banner', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_banner_setting(){
        $data['title'] = 'Pengaturan - Admin Panel';
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/add_setting_banner', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_banner_setting_post(){
        $data = array();
        $upload = $this->Settings_model->uploadImg();
        if($upload['result'] == 'success'){
            $insert = $this->Settings_model->insertBanner($upload);
            if($insert){
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Banner berhasil ditambahkan',
                    icon: 'success'
                    });
                    </script>");
                redirect(base_url() . 'administrator/setting/banner');
            }else{
                $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
                Gagal menambah banner, gambar yang kamu upload tidak berukuran 1700x400px.
                </div>");
                redirect(base_url() . 'administrator/setting/banner/add');
            }
        }else{
            $this->session->set_flashdata('failed', "<div class='alert alert-danger' role='alert'>
            Gagal menambah banner, pastikan banner berukuran maksimal 2mb, berformat png, jpg, jpeg. Dan berukuran 1600x400px.
            </div>");
            redirect(base_url() . 'administrator/setting/banner/add');
        }
    }

    public function delete_banner($id){
        $this->db->where('id', $id);
        $this->db->delete('banner');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Banner Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/banner');
    }

    public function description_setting(){
        $data['title'] = 'Pengaturan - Admin Panel';
        $data['desc'] = $this->Settings_model->getSetting();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_description', $data);
        $this->load->view('templates/footer_admin');
    }

    public function edit_description_setting(){
        $this->Settings_model->editDescription();
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Deskripsi singkat berhasil diubah',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/description');
    }

    public function rekening_setting(){
        $data['title'] = 'Pengaturan - Admin Panel';
        $data['rekening'] = $this->Settings_model->getRekening();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_rekening', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_rekening_setting(){
        $this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Nama wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_setting_rekening', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->addRekening();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Rekening Berhasil Disimpan',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/rekening');
        }
    }

    public function edit_rekening_setting($id){
        $this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Nama wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['rekening'] = $this->Settings_model->getRekeningById($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_setting_rekening', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->editRekening($id);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Rekening Berhasil Diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/rekening');
        }
    }

    public function delete_rekening($id){
        $this->db->where('id', $id);
        $this->db->delete('rekening');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Rekening Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/rekening');
    }

    public function sosmed_setting(){
      $data['title'] = 'Pengaturan - Admin Panel';
      $data['sosmed'] = $this->Settings_model->getSosmed();
      $this->load->view('templates/header_admin', $data);
      $this->load->view('administrator/setting_sosmed', $data);
      $this->load->view('templates/footer_admin');
    }

    public function add_sosmed_setting(){
      $this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Nama wajib diisi']);
      if($this->form_validation->run() == false){
          $data['title'] = 'Pengaturan - Admin Panel';
          $this->load->view('templates/header_admin', $data);
          $this->load->view('administrator/add_setting_sosmed', $data);
          $this->load->view('templates/footer_admin');
      }else{
          $this->Settings_model->addSosmed();
          $this->session->set_flashdata('upload', "<script>
              swal({
              text: 'Sosial Media Berhasil Disimpan',
              icon: 'success'
              });
              </script>");
          redirect(base_url() . 'administrator/setting/sosmed');
      }
    }

    public function edit_sosmed_setting($id){
        $this->form_validation->set_rules('name', 'Nama', 'required', ['required' => 'Nama wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['sosmed'] = $this->Settings_model->getSosmedById($id);
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_setting_sosmed', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->editSosmed($id);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Sosmed Berhasil Diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/sosmed');
        }
    }

    public function delete_sosmed($id){
        $this->db->where('id', $id);
        $this->db->delete('sosmed');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Sosmed Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/sosmed');
    }

    public function address_setting(){
      $this->form_validation->set_rules('address', 'Alamat', 'required', ['required' => 'Alamat wajib diisi']);
      if($this->form_validation->run() == false){
        $data['title'] = 'Pengaturan - Admin Panel';
        $data['address'] = $this->Settings_model->getSetting();
        $data['regency'] = $this->Settings_model->getRegency();
        $data['selectRegency'] = $this->Settings_model->getRegencyById();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_address', $data);
        $this->load->view('templates/footer_admin');
      }else{
        $this->Settings_model->editAddress();
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Alamat Berhasil Diubah',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/address');
      }
    }

    public function delivery_setting(){
        $data['title'] = 'Biaya Antar - Admin Panel';
        $data['delivery'] = $this->Settings_model->getCostDelivery();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_delivery', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_delivery_setting(){
        $this->form_validation->set_rules('destination', 'Tujuan', 'required', ['required' => 'Tujuan wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['regency'] = $this->Settings_model->getRegency();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_setting_delovery', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->addDelivery();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Biaya Antar Berhasil Ditambah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/delivery');
        }
    }

    public function edit_delivery_setting($id){
        $this->form_validation->set_rules('destination', 'Tujuan', 'required', ['required' => 'Tujuan wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['delivery'] = $this->Settings_model->getCostDeliveryById($id);
            $data['regency'] = $this->Settings_model->getRegency();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/edit_setting_delivery', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->editDelivery($id);
            $destination = $this->input->post('destination', true);
            $price = $this->input->post('price', true);
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Biaya Antar Berhasil Diubah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/delivery');
        }
    }

    public function delete_delivery($id){
        $this->db->where('id', $id);
        $this->db->delete('cost_delivery');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Biaya Antar Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/delivery');
    }

    public function cod_setting(){
        $data['title'] = 'Cash on Delivery - Admin Panel';
        $data['cod'] = $this->Settings_model->getCOD();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_cod', $data);
        $this->load->view('templates/footer_admin');
    }

    public function add_cod_setting(){
        $this->form_validation->set_rules('destination', 'Tujuan', 'required', ['required' => 'Tujuan wajib diisi']);
        if($this->form_validation->run() == false){
            $data['title'] = 'Pengaturan - Admin Panel';
            $data['regency'] = $this->Settings_model->getRegency();
            $this->load->view('templates/header_admin', $data);
            $this->load->view('administrator/add_setting_cod', $data);
            $this->load->view('templates/footer_admin');
        }else{
            $this->Settings_model->addCOD();
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'COD Berhasil Ditambah',
                icon: 'success'
                });
                </script>");
            redirect(base_url() . 'administrator/setting/cod');
        }
    }

    public function delete_cod($id){
        $this->db->where('id', $id);
        $this->db->delete('cod');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'COD Berhasil Dihapus',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/cod');
    }

    public function footer_setting(){
      $this->form_validation->set_rules('page', 'Page', 'required', ['required' => 'Page wajib diisi']);
      if($this->form_validation->run() == false){
        $data['title'] = 'Pengaturan - Admin Panel';
        $data['footerhelp'] = $this->Settings_model->getFooterHelp();
        $data['footerinfo'] = $this->Settings_model->getFooterInfo();
        $data['pages'] = $this->Settings_model->getPages();
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/setting_footer', $data);
        $this->load->view('templates/footer_admin');
      }else{
        $this->Settings_model->addFooter();
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Navigasi Footer berhasil ditambah',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/setting/footer');
      }
    }

    public function off_promo_setting($type){
        if($type == 1){
            $this->db->set('promo', 0);
            return $this->db->update('settings');
        }else{
            $this->db->set('promo', 1);
            return $this->db->update('settings');
        }
    }

    public function set_time_promo(){
        $pdate = $this->input->post("pdate");
        $this->db->set('promo_time', $pdate);
        return $this->db->update('settings');
    }

    // ajax
    public function ajax_get_product_by_id($id){
        $return = $this->Products_model->getProductById($id);
        echo json_encode($return);
    }

    // edit
    public function edit(){
        $data['title'] = 'Edit Profil Admin - Admin Panel';
        $admin = $this->db->get('admin')->row_array();
        $data['admin'] = $admin;
        $this->load->view('templates/header_admin', $data);
        $this->load->view('administrator/edit', $data);
        $this->load->view('templates/footer_admin');
    }

    public function edit_username(){
        $this->db->set('username', $this->input->post('username'));
        $this->db->update('admin');
        $this->session->set_flashdata('upload', "<script>
            swal({
            text: 'Username berhasil diubah',
            icon: 'success'
            });
            </script>");
        redirect(base_url() . 'administrator/edit');
    }

    public function edit_pass(){
        $admin = $this->db->get('admin')->row_array();
        if(password_verify($this->input->post('oldPassword'), $admin['password'])){
            if($this->input->post('newPassword') ==  $this->input->post('confirmPassword')){
                $pass = password_hash($this->input->post('newPassword'), PASSWORD_DEFAULT);
                $this->db->set('password', $pass);
                $this->db->update('admin');
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Password berhasil diubah',
                    icon: 'success'
                    });
                    </script>");
                redirect(base_url() . 'administrator/edit');
            }else{
                $this->session->set_flashdata('upload', "<script>
                    swal({
                    text: 'Konfirmasi password tidak sama. Silakan coba lagi',
                    icon: 'error'
                    });
                    </script>");
                redirect(base_url() . 'administrator/edit');
            }
        }else{
            $this->session->set_flashdata('upload', "<script>
                swal({
                text: 'Password lama salah. Silakan coba lagi',
                icon: 'error'
                });
                </script>");
            redirect(base_url() . 'administrator/edit');
        }
    }

    public function logout(){
        $sess = ['admin'];
		$this->session->unset_userdata($sess);
        delete_cookie('djehbicd');
        redirect(base_url() . 'login/admin');
    }

    public function trxList(){

    // POST data
    $postData = $this->input->post();

    // Get data
    $data = $this->Order_model->getTrx($postData);

    echo json_encode($data);
  }

}
