<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('cookie');
		if($this->session->userdata('login')){
			redirect(base_url());
        }else{
			$cookie = get_cookie('e382jxndj');
            if($cookie != NULL){
				$getCookie = $this->db->get_where('user', ['cookie' => $cookie])->row_array();
                if($getCookie){
                    $dataCookie = $getCookie;
                    $dataSession = [
                        'id' => $dataCookie['id']
                    ];
                    $this->session->set_userdata('login', true);
					$this->session->set_userdata($dataSession);
					redirect(base_url());
                }
            }
		}
    }

    public function register(){
        $this->form_validation->set_rules('name', 'Name', 'required|max_length[40]', ['required' => 'Nama wajib diisi', 'max_length' => 'Panjang nama maksimal 40 karakter']);
        $this->form_validation->set_rules('email', 'Email', 'required|max_length[50]|valid_email', ['required' => 'Email wajib diisi', 'max_length' => 'Panjang email maksimal 50 karakter', 'valid_email' => 'Email tidak valid']);
        $this->form_validation->set_rules('password', 'Password', 'matches[password1]|required', ['matches' => 'password tidak sama', 'required' => 'Password wajib diisi'
	    ]);
	    $this->form_validation->set_rules('password1', 'Password', 'matches[password]', ['matches' => 'password tidak sama']);
	    if($this->form_validation->run() == false){
            $data['title'] = 'Daftar - ' . $this->Settings_model->general()["app_name"];
            $data['css'] = 'auth';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/footer_notmpl');
        }else{
            $this->User_model->register();
            $this->session->set_flashdata('success', "Berhasil Registrasi");
            redirect(base_url() . 'register');
        }
    }

    public function login(){
        $this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'Email wajib diisi']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password wajib diisi'
	    ]);
	    if($this->form_validation->run() == false){
            $data['title'] = 'Login - ' . $this->Settings_model->general()["app_name"];
            $data['css'] = 'auth';
            $data['redirect'] = $_GET['redirect'];
            $this->load->view('templates/header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('templates/footer_notmpl');
        }else{
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember');
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if($user){
                if(password_verify($password, $user['password'])){
                    if($user['is_activate'] == 0){
                        $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                            Akun belum aktif, silakan verifikasi email terlebih dahulu
                        </div>');
                        redirect(base_url() . 'login');
                    }else{
                        $data = [
                            'id' => $user['id']
                        ];
                        if($remember != NULL){
                            $key = random_string('alnum', 64);
                            set_cookie('e382jxndj', $key, 3600*24*30*12);
                            $this->db->set('cookie', $key);
                            $this->db->where('id', $user['id']);
                            $this->db->update('user');
                        }
                                        
                        $this->session->set_userdata('login', true);
                        $this->session->set_userdata($data);
        
                        redirect(base_url() . $_GET['redirect']);
                    }
                }else{
                    $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                        Password salah
                    </div>');
                    redirect(base_url() . 'login');
                }
            }else{
                $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                    Email tidak terdaftar
                </div>');
                redirect(base_url() . 'login');
            }
        }
    }

    public function verification(){
        $email = $_GET['email'];
        $token = $_GET['token'];

        $check = $this->db->get_where('user', ['email' => $email, 'token' => $token])->row_array();
        if($check['is_activate'] == 1){
            $this->session->set_flashdata('verification', "<script>
                swal({
                text: 'Akun Anda sudah aktif'
                });
            </script>");
            redirect(base_url() . 'login');
        }
        if($check){
            $this->db->set('is_activate', 1);
            $this->db->where('id', $check['id']);
            $this->db->update('user');
            $this->session->set_flashdata('verification', "<script>
                swal({
                text: 'Selamat, akun Anda telah aktif. Silakan login',
                icon: 'success'
                });
            </script>");
            redirect(base_url() . 'login');
        }else{
            $this->session->set_flashdata('verification', "<script>
                swal({
                text: 'Upss, gagal verifikasi akun. Token salah',
                icon: 'error'
                });
            </script>");
            redirect(base_url() . 'login');
        }
    }

    public function reset_password(){
		$this->form_validation->set_rules('email', 'email', 'required', ['required' => 'Isi kolom terlebih dahulu'
	    ]);
	    if($this->form_validation->run() == false){
            $data['title'] = 'Reset Password - ' . $this->Settings_model->general()["app_name"];
            $data['css'] = 'auth';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/reset', $data);
            $this->load->view('templates/footer_notmpl');
        }else{
            $email = $this->input->post('email');
            $token = sha1(rand());
            $user = $this->db->get_where('user', ['email' => $email])->row_array();
            if($user){
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
                $this->email->to($email);
                $this->email->subject('Konfirmasi Reset Password');
                $this->email->message(
                    '<p>Kami telah menerima permintaan kamu untuk reset password. Silakan klik link di bawah ini untuk reset passwordmu<br/>
                    <a href="'.base_url().'reset?email='.$email.'&token='.$token.'">'.base_url().'reset?email='.$email.'&token='.$token.'</a> <br/>
                    Terima kasih</p>
                    ');
                $this->email->send();
                $this->db->set('token_reset', $token);
                $this->db->where('email', $email);
                $this->db->update('user');
                $this->session->set_flashdata('verification', "<script>
                    swal({
                    text: 'Kami telah mengirimkan link untuk reset password ke email kamu. Cek folder inbox atau spam untuk menemukannya.',
                    icon: 'success'
                    });
                </script>");
                redirect(base_url() . 'login');
            }else{
                $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                    User dengan email tersebut tidak ada.
                </div>');
                redirect(base_url() . 'reset-password');
            }
        }
    }
    
    public function reset(){
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $user = $this->db->get_where('user', ['email' => $email, 'token_reset' => $token])->row_array();
        if($user){
            $data = [
                'email' => $email
            ];
            $this->session->set_userdata($data);
            $this->session->set_userdata('reset', true);
            redirect(base_url() . 'new-password');
        }else{
            $this->session->set_flashdata('verification', "<script>
                swal({
                text: 'Upps. Token reset password salah',
                icon: 'error'
                });
            </script>");
            redirect(base_url() . 'login');
        }
    }

    public function new_password(){
        if(!$this->session->userdata('reset')){
            redirect(base_url() . 'login');
        }
        $this->form_validation->set_rules('password', 'Password', 'matches[password1]|required', ['matches' => 'password tidak sama', 'required' => 'Password wajib diisi'
	    ]);
	    $this->form_validation->set_rules('password1', 'Password', 'matches[password]', ['matches' => 'password tidak sama']);
	    if($this->form_validation->run() == false){
            $data['title'] = 'Password Baru - ' . $this->Settings_model->general()["app_name"];
            $data['css'] = 'auth';
            $this->load->view('templates/header', $data);
            $this->load->view('auth/new-password', $data);
            $this->load->view('templates/footer_notmpl');
        }else{
            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $this->db->set('password', $password);
            $this->db->where('email', $this->session->userdata('email'));
            $this->db->update('user');
            $sess = ['reset','email'];
		    $this->session->unset_userdata($sess);
            $this->session->set_flashdata('verification', "<script>
                swal({
                text: 'Password berhasil diubah. Silakan login.',
                icon: 'success'
                });
            </script>");
            redirect(base_url() . 'login');
        }
    }

}