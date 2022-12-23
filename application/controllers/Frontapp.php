<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontapp extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Modeluser', 'user');
		$this->load->model('Modelproduk', 'barang');
		$this->load->model('Modelcarousel', 'carousel');
		$this->load->model('Modelcart', 'cart');
	}
	public function index()
	{
		if ($this->session->logged_in == TRUE) {
			$where = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
			$cek = $where['id'];
			$input = $this->input->post('pilih');
			if (isset($_POST['cek']) == 1 && $input == 1) {
				$data = [
					'barang' => $this->barang->getproduk(),
					'find' => $this->barang->getAsc(),
					'kategori' => $this->barang->kategori(),
					'showktg' => $this->barang->getkategori(),
					'carousel' => $this->carousel->getcarousel(),
					'jumlah_brg' => $this->cart->totalbarang($cek),
					'user' => $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array()
				];
			} elseif (isset($_POST['cek']) == 2 && $input == 2) {
				$data = [
					'barang' => $this->barang->getproduk(),
					'find' => $this->barang->getDesc(),
					'kategori' => $this->barang->kategori(),
					'showktg' => $this->barang->getkategori(),
					'carousel' => $this->carousel->getcarousel(),
					'jumlah_brg' => $this->cart->totalbarang($cek),
					'user' => $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array()
				];
			} else {
				$data = [
					'barang' => $this->barang->getproduk(),
					'find' => $this->barang->search(),
					'kategori' => $this->barang->kategori(),
					'showktg' => $this->barang->getkategori(),
					'carousel' => $this->carousel->getcarousel(),
					'jumlah_brg' => $this->cart->totalbarang($cek),
					'user' => $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array()
				];
			}
			$this->load->view('template/header', $data);
			$this->load->view('index', $data,);
			$this->load->view('template/footer');
		} else {
			$keyword = $this->input->get('keyword');
			$input = $this->input->post('pilih');
			if (isset($_POST['cek']) == 1 && $input == 1) {
			} elseif (isset($_POST['cek']) == 2 && $input == 2) {
			} else {
			}
			if (isset($_POST['cek']) == 1 && $input == 1) {
				$blmlogin = [
					'keyword'	=> $keyword,
					'barang' => $this->barang->getproduk(),
					'find' => $this->barang->getAsc(),
					'kategori' => $this->barang->kategori(),
					'carousel' => $this->carousel->getcarousel(),
					'showktg' => $this->barang->getkategori()
				];
			} elseif (isset($_POST['cek']) == 2 && $input == 2) {
				$blmlogin = [
					'keyword'	=> $keyword,
					'barang' => $this->barang->getproduk(),
					'find' => $this->barang->getDesc(),
					'kategori' => $this->barang->kategori(),
					'carousel' => $this->carousel->getcarousel(),
					'showktg' => $this->barang->getkategori()
				];
			} else {
				$blmlogin = [
					'keyword'	=> $keyword,
					'barang' => $this->barang->getproduk(),
					'find' => $this->barang->search(),
					'kategori' => $this->barang->kategori(),
					'carousel' => $this->carousel->getcarousel(),
					'showktg' => $this->barang->getkategori()
				];
			}
			$this->load->view('template/header', $blmlogin);
			$this->load->view('index', $blmlogin,);
			$this->load->view('template/footer');
		}
	}

	public function harga_terendah()
	{
		$data = $this->barang->harga_terendah();
		echo json_encode($data);
	}

	public function profil()
	{
		if ($this->session->logged_in == TRUE) {
			$data['user'] = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
			$this->load->view('profil', $data);
		} else {
			redirect('authuser');
		}
	}

	public function edit()
	{
		$data['user'] = $this->db->get_where('tb_client', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('nama', 'Nama panjenengan mas !?', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat lengkap mas !', 'required|trim');
		if ($this->form_validation->run() == true) {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$alamat = $this->input->post('alamat');
			$upload_image = $_FILES['image']['nama'];
			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '2048';
				$config['upload_path'] = './img/profile/';

				$this->load->library('upload', $config);
				if ($this->upload->do_upload('image')) {
					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . './img/profile/' . $old_image);
					}
					$new_image = $this->upload->data('file_nama');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$this->db->set('nama', $nama);
			$this->db->set('alamat', $alamat);
			$this->db->where('email', $email);
			$this->db->update('tb_client');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been updated!
          </div>');
			redirect('frontapp/profil');
		}
	}

	public function changepassword()
	{
		$data['user'] = $this->db->get_where('tb_client', ['email' => $this->session->userdata('email')])->row_array();
		$this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');
		if ($this->form_validation->run() == true) {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Password salawase panjenengan mas !?
          </div>');
				redirect('frontapp/profil');
			} else {
				if ($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
					redirect('frontapp/profil');
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('tb_client');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
					redirect('frontapp/profil');
				}
			}
		}
	}

	public function detail($id)
	{
		if ($this->session->logged_in == TRUE) {
			$where = array('id' => $id);
			$iduser = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
			$cek = $iduser['id'];
			$data = [
				'produk' => $this->barang->getproduk(),
				'jumlah_brg' => $this->cart->totalbarang($cek),
				'detail' => $this->barang->getdata($where)->result(),
				'user' => $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array()
			];
			$this->load->view('template/header', $data);
			$this->load->view('detail', $data);
			$this->load->view('template/footer');
		} else {
			$where = array('id' => $id);
			$data = [
				'produk' => $this->barang->getproduk(),
				'detail' => $this->barang->getdata($where)->result(),
			];
			$this->load->view('template/header', $data);
			$this->load->view('detail', $data);
			$this->load->view('template/footer');
		}
	}

	public function hasil()
	{
		$data['find'] = $this->barang->search();
		$this->load->view('search-result', $data);
	}
}
