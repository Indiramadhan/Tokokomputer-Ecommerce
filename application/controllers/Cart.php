<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modeluser', 'user');
        $this->load->model('Modelcart', 'cart');
        $this->load->model('Modelproduk', 'barang');
    }

    public function index()
    {
        if ($this->session->logged_in == TRUE) {
            $where = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
            $cek = $where['id'];
            $data = [
                'cart' => $this->cart->getcart($cek),
                'jumlah_brg' => $this->cart->totalbarang($cek),
                'barang' => $this->barang->getproduk(),
                'total' => $this->cart->gettotal()
            ];
            $this->load->view('template/header', $data);
            $this->load->view('cart', $data);
            $this->load->view('template/footer');
        } else {
            redirect('authuser');
        }
    }

    function tambah()
    {
        $data = array(
            'id_brg' => $this->input->post('id_brg'),
            'id_user' => $this->input->post('id_user'),
            'quantity' => $this->input->post('qty'),
            'stok_brg' => $this->input->post('stok'),
            'harga' => $this->input->post('harga'),
            'prev_harga' => $this->input->post('harga')
        );
        $stok = array(
            'id' => $this->input->post('id_brg'),
            'stok' => $this->input->post('stok')
        );
        if ($this->session->logged_in == TRUE) {
            $this->cart->stok(array('id' => $this->input->post('id_brg')), $stok);
            $insert = $this->cart->simpan($data);
            echo json_encode(array("status" => TRUE));
        } else {
            redirect('authuser');
        }
    }

    function tambahdet()
    {
        $data = array(
            'id_brg' => $this->input->post('id_brg'),
            'id_user' => $this->input->post('id_user'),
            'quantity' => $this->input->post('quantity'),
            'stok_brg' => $this->input->post('stok'),
            'harga' => $this->input->post('harga'),
            'prev_harga' => $this->input->post('prevharga')
        );
        $stok = array(
            'id' => $this->input->post('id_brg'),
            'stok' => $this->input->post('stok')
        );
        if ($this->session->logged_in == TRUE) {
            $insert = $this->cart->simpan($data);
            $this->cart->stok(array('id' => $this->input->post('id_brg')), $stok);
            echo json_encode(array("status" => TRUE));
        } else {
            redirect('authuser');
        }
    }

    public function updatetambah()
    {
        $data = array(
            'quantity' => $this->input->post('quantity'),
            'harga' => $this->input->post('harga'),
        );
        $stok = array(
            'id' => $this->input->post('id_brg'),
            'stok' => $this->input->post('qty'),
        );
        $this->cart->stok(array('id' => $this->input->post('id_brg')), $stok);
        $this->cart->update(array('id' => $this->input->post('id_cart')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function updatekurang()
    {
        $data = array(
            'quantity' => $this->input->post('quantity'),
            'harga' => $this->input->post('harga'),
        );
        $stok = array(
            'id' => $this->input->post('id_brg'),
            'stok' => $this->input->post('qty')
        );
        $this->cart->stok(array('id' => $this->input->post('id_brg')), $stok);
        $this->cart->update(array('id' => $this->input->post('id_cart')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function updatekembali()
    {
        $stok = array(
            'id' => $this->input->post('id_brg'),
            'stok' => $this->input->post('stokbrg')
        );
        $this->cart->kembalikanstok(array('id' => $this->input->post('id_brg')), $stok);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->cart->hapus($id);
        echo json_encode(array("status" => TRUE));
    }
}
