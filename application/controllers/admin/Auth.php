<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required', 'valid_email');

        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Tokokomputer Admin - Login';
            $this->load->view('admin/template/auth_header');
            $this->load->view('admin/auth/login');
            $this->load->view('admin/template/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
        if ($user) {
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        redirect('admin/app');
                    } else {
                        redirect('admin/user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Password!
          </div>');
                    redirect('admin/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            Email has not activated!
          </div>');
                redirect('admin/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered!
          </div>');
            redirect('admin/auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('admin/user');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Admin Tokokomputer - Register'
            ];
            $this->load->view('admin/template/auth_header', $data);
            $this->load->view('admin/auth/registration');
            $this->load->view('admin/template/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1
            ];

            $this->db->insert('tb_user', $data);

            // $this->_sendEmail();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation! your account has been created. Please Verify First!
          </div>');
            redirect('admin/auth');
        }
    }

    // private function _sendEmail()
    // {
    //     $config = [
    //         'protocol' => 'smtp',
    //         'smtp' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'tokokomputer230@gmail.com',
    //         'smtp_pass' => 'lxmaqcsinfegnfia',
    //         'smtp_port' => 587,
    //         'mailtype' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n"
    //     ];


    //     $this->load->library('email', $config);
    //     $this->email->initialize($config);
    //     $this->email->from('tokokomputer230@gmail.com', 'Tokokomputer');
    //     $this->email->to('indirmdn01@gmail.com');
    //     $this->email->subject('Testing');
    //     $this->email->message('Hello World!');
    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logged out!
          </div>');
        redirect('admin/auth');
    }

    public function blocked()
    {
        $this->load->view('admin/auth/blocked');
    }
}
