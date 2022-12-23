<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Modelcart', 'cart');
        $this->load->model('Modeluser', 'user');
        $this->load->model('Modeltransaksi', 'checkout');
    }

    public function index()
    {
        if ($this->session->logged_in == TRUE) {
            $where = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
            $cek = $where['id'];
            $data = [
                'cart' => $this->cart->getcart($cek),
                'jumlah_brg' => $this->cart->totalbarang($cek),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('checkout', $data);
            $this->load->view('template/footer');
        } else {
            redirect('authuser');
        }
    }

    public function transaksi()
    {
        if ($this->session->logged_in == TRUE) {
            $where = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
            $cek = $where['id'];
            $data = [
                'jumlah_brg' => $this->cart->totalbarang($cek),
                'checkout' => $this->checkout->getcheckout($cek),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('transaksi', $data);
            $this->load->view('template/footer');
        } else {
            redirect('authuser');
        }
    }

    public function checkout()
    {
        $where = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
        $cek = $where['id'];
        $data = [
            'cart' => $this->cart->getcart($cek),
            'jumlah_brg' => $this->cart->totalbarang($cek),
            'user' => $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array()
        ];
        $this->load->view('template/header', $data);
        $this->load->view('checkout', $data);
        $this->load->view('template/footer');
    }

    public function checkoutsolo($id)
    {
        if ($this->session->logged_in == TRUE) {
            $where = array('id' => $id);
            $iduser = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
            $cek = $iduser['id'];
            $data = [
                'data' => $this->checkout->getcheck($where)->result(),
                'jumlah_brg' => $this->cart->totalbarang($cek),
                'user' => $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array()
            ];
            $this->load->view('template/header', $data);
            $this->load->view('checkoutsolo', $data);
            $this->load->view('template/footer');
        } else {
            redirect('authuser');
        }
    }

    public function simpan()
    {
        $iduser = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
        $cek = $iduser['id'];
        $datapaket = array(
            'id_user' => $this->input->post('id_user'),
            'paket' => $this->input->post('paket'),
            'kode_checkout' => $this->input->post('kode_checkout'),
            'nama_lngkp' => $this->input->post('nama_lngkp'),
            'no_tlp' => $this->input->post('no_tlp'),
            'alamat' => $this->input->post('alamat'),
            'pengiriman' => $this->input->post('pengiriman'),
            'pembayaran' => $this->input->post('pembayaran'),
            'status' => $this->input->post('status'),
            'created_date' => $this->input->post('date'),
        );
        $idcart = $_POST['idcart'];
        $checkout = $_POST['kode_checkout'];
        $idbrg = $_POST['idbrg'];
        $qty = $_POST['qty'];
        $data = array();
        $index = 0;
        foreach ($idcart as $dataid) {
            array_push($data, array(
                'id_cart' => $dataid,
                'kode_checkout' => $checkout,
                'id_brg' => $idbrg[$index],
                'qty' => $qty[$index],
            ));
            $index++;
        }
        $this->checkout->simpanpaket($datapaket);
        $this->checkout->bayarkeranjang($data);
        $this->checkout->hapus($cek);
        redirect('transaksi/deal');
    }

    public function simpansolo()
    {
        $datapaket = array(
            'id_user' => $this->input->post('id_user'),
            'paket' => $this->input->post('paket'),
            'kode_checkout' => $this->input->post('kode_checkout'),
            'nama_lngkp' => $this->input->post('nama_lngkp'),
            'no_tlp' => $this->input->post('no_tlp'),
            'alamat' => $this->input->post('alamat'),
            'pengiriman' => $this->input->post('pengiriman'),
            'pembayaran' => $this->input->post('pembayaran'),
            'status' => $this->input->post('status'),
            'created_date' => $this->input->post('date'),
        );
        $idcart = $_POST['idcart'];
        $checkout = $_POST['kode_checkout'];
        $idbrg = $_POST['idbrg'];
        $qty = $_POST['qty'];
        $data = array();
        $index = 0;
        foreach ($idcart as $dataid) {
            array_push($data, array(
                'id_cart' => $dataid,
                'kode_checkout' => $checkout,
                'id_brg' => $idbrg[$index],
                'qty' => $qty[$index],
            ));
            $index++;
        }
        $this->checkout->simpanpaket($datapaket);
        $this->checkout->bayarkeranjang($data);
        redirect('transaksi/deal');
    }

    public function update()
    {
        $data = array(
            'status' => $this->input->post('status'),
        );

        $this->checkout->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function detail($kode_checkout)
    {
        $data = $this->checkout->getdata($kode_checkout);
        echo json_encode($data);
    }

    public function deal()
    {
        $where = $this->db->get_where('tb_client', ['email' => $this->session->nama])->row_array();
        $cek = $where['id'];
        $krnjng = ['jumlah_brg' => $this->cart->totalbarang($cek)];
        $this->load->view('template/header', $krnjng);
        $this->load->view('deal');
        $this->load->view('template/footer');
    }
}
