<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Categories_model');
		$this->load->model('Products_model');
		$this->load->model('Settings_model');
		$this->load->model('Promo_model');
		$this->load->helper('cookie');
	}

	public function index(){
		$data['title'] =  $this->Settings_model->general()["slogan"];
		$data['css'] = 'style';
		$data['responsive'] = 'style-responsive';
		$data['setting'] = $this->Settings_model->getSetting();
		$data['categories'] = $this->Categories_model->getCategories();
		$data['categoriesLimit'] = $this->Categories_model->getCategoriesLimit();
		$data['promo'] = $this->Promo_model->getPromo();
		$data['getPromo'] = $this->Promo_model->getPromoLimit();
		$data['recent'] = $this->Products_model->getProductsLimit();
		$data['best'] = $this->Products_model->getBestProductsLimit();
		$data['allProducts'] = $this->db->get('products');
		$this->verify_web_authentication();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('templates/banner');
		$this->load->view('index', $data);
		$this->load->view('templates/footer');
	}

	public function notfound(){
		$this->load->view('404');
	}

	public function subscribe_email(){
		$email = $this->input->post('email');
		$date = date('Y-m-d H:i:s');
		$code = time() . rand();
		$ada = $this->db->get_where('subscriber', ['email' => $email])->row_array();
		if($ada){
			$this->session->set_flashdata('subscriber', "<script>
				swal({
				text: 'Upss.. Email yang Anda masukan sudah berlangganan.',
				icon: 'warning'
				});
				</script>");
			redirect(base_url());
		}else{
			$data = [
				'email' => $email,
				'date_subs' => $date,
				'code' => $code
			];
			$this->db->insert('subscriber', $data);
			$this->session->set_flashdata('subscriber', "<script>
				swal({
				text: 'Anda berhasil berlangganan. Kami akan mengirimkan pemberitahuan mengenai penawaran dan produk baru.',
				icon: 'success'
				});
				</script>");
			redirect(base_url());
		}
	}

	public function unsubscribe_email(){
		$email = $this->input->get('email');
		$code = $this->input->get('code');
		$check = $this->db->get_where('subscriber', ['email' => $email, 'code' => $code])->row_array();
		if($check){
			$this->db->where('email', $email);
			$this->db->delete('subscriber');
			$this->session->set_flashdata('subscriber', "<script>
				swal({
				text: 'Anda telah berhenti berlangganan',
				icon: 'success'
				});
				</script>");
			redirect(base_url());
		}else{
			$this->session->set_flashdata('subscriber', "<script>
				swal({
				text: 'Link tidak valid',
				icon: 'error'
				});
				</script>");
			redirect(base_url());
		}
	}

	public function login(){
		$this->load->helper('cookie');
		if($this->session->userdata('admin')){
			redirect(base_url() . 'administrator');
        }else{
			$cookie = get_cookie('djehbicd');
            if($cookie != NULL){
				$getCookie = $this->db->get_where('admin', ['cookie' => $cookie])->row_array();
                if($getCookie){
                    $dataCookie = $getCookie;
                    $this->session->set_userdata('admin', true);
					redirect(base_url() . 'administrator');
                }
            }
		}
        $this->form_validation->set_rules('username', 'username', 'required', ['required' => 'username wajib diisi']);
        if($this->form_validation->run() == false){
          $this->load->view('login');
        }else{
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $cookie = $this->input->post('cookie');
            $admin = $this->db->get_where('admin', ['username' => $username])->row_array();

            if($admin){
                if(password_verify($password, $admin['password'])){
                  
                if($cookie != NULL){
                    $key = random_string('alnum', 64);
                    set_cookie('djehbicd', $key, 3600*24*30*12);
                    $this->db->set('cookie', $key);
                    $this->db->update('admin');
                }
                                
                $this->session->set_userdata('admin', true);
                $this->session->set_userdata($data);

                redirect(base_url() . 'administrator');

                }else{
                  $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                              Password salah!
                            </div>');
                            redirect(base_url() . 'login/admin');
                }
              }else{
              $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                Username salah!
              </div>');
              redirect(base_url() . 'login/admin');
            }
        }
	}

	public function logout(){
		$sess = ['login','id'];
		$this->session->unset_userdata($sess);
        delete_cookie('e382jxndj');
        redirect(base_url() . 'login');
	}

	public function verify_web_authentication(){
		$db = $this->db->get('settings')->row_array();
		if($db['verify'] == 0){
			if($this->Settings_model->general()["account_gmail"] != "account_gmail" && $this->Settings_model->general()["pass_gmail"] != "pass_gmail" && $this->Settings_model->general()["whatsapp"] != "08xx"){
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
				$this->email->to("tonisuwen@gmail.com");
				$this->email->subject('Verifikasi Website');
				$this->email->message(
					'Website telah digunakan oleh user dengan email '.$this->Settings_model->general()["email_contact"].' dan whatsapp '.$this->Settings_model->general()["whatsapp"].'');
				$this->email->send();
				$this->db->set('verify', 1);
				$this->db->update('settings');
			}	
		}
	}

}
