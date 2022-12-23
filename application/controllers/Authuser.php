<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authuser extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeluser', 'user');
    }

    public function index()
    {
        $this->load->view('login');
    }

    public function Login()
    {
        $email       = $this->input->post('email');
        $password       = $this->input->post('password');

        $status         = $this->user->getDetail($email, md5($password));
        if ($status) {
            $session = array(
                'nama'          => $email,
                'logged_in'     => TRUE
            );
            $this->session->set_userdata($session);
            $this->session->unset_userdata('gagal');
            redirect('frontapp');
        } else {
            $session = array('gagal' => 1);
            $this->session->set_userdata($session);
            redirect('authuser');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Name', 'required|trim');
        $this->form_validation->set_rules('no_tlp', 'Name', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('register');
        } else {
            $data = [
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'alamat' => htmlspecialchars($this->input->post('alamat', true)),
                'no_tlp' => htmlspecialchars($this->input->post('no_tlp', true)),
                'is_active' => htmlspecialchars($this->input->post('is_active', true)),
            ];

            $this->db->insert('tb_client', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created. Please Verify First! </div>');
            redirect('authuser');
        }
    }

    public function Logout()
    {
        $this->session->sess_destroy();
        redirect('frontapp');
    }
}
