<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Modelproduk', 'barang');
        $this->load->model('Modeltransaksi', 'transaksi');
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'stok' => $this->barang->totalstok(),
            'barang' => $this->barang->totalproduk(),
            'pesanan' => $this->transaksi->totalpesanan(),
            'proses' => $this->transaksi->totalpenjualan(),
            'user' => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
        ];
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function loaddata()
    {
        $list = $this->transaksi->datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $transaksi) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $transaksi->kode_checkout;
            if ($transaksi->status == 1) {
                $row[] = 'Belum diproses';
            } elseif ($transaksi->status == 2) {
                $row[] = 'Diproses';
            } elseif ($transaksi->status == 3) {
                $row[] = 'Dikirim';
            } elseif ($transaksi->status == 4) {
                $row[] = 'Selesai';
            }
            $row[] = $transaksi->created_date;
            if ($transaksi->status < 2) {
                $row[] = '<a class="btn btn-sm btn-primary me-2" href="javascript:void(0)" onclick="accept(' . "'" . $transaksi->kode_checkout . "'" . ')" data-bs-toggle="modal" data-bs-target="#acceptmodal"><i class="fas fa-check"></i></a><a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="kirim(' . "'" . $transaksi->kode_checkout . "'" . ')" data-bs-toggle="modal" data-bs-target="#kirimmodal"><i class="fas fa-truck-fast"></i></a>';
            } elseif ($transaksi->status < 3) {
                $row[] = '<a class="btn btn-sm btn-primary me-2 disabled" href="javascript:void(0)" onclick="accept(' . "'" . $transaksi->kode_checkout . "'" . ')" data-bs-toggle="modal" data-bs-target="#acceptmodal"><i class="fas fa-check"></i></a><a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="kirim(' . "'" . $transaksi->kode_checkout . "'" . ')" data-bs-toggle="modal" data-bs-target="#kirimmodal"><i class="fas fa-truck-fast"></i></a>';
            } else {
                $row[] = '<a class="btn btn-sm btn-primary me-2 disabled" href="javascript:void(0)" onclick="accept(' . "'" . $transaksi->kode_checkout . "'" . ')" data-bs-toggle="modal" data-bs-target="#acceptmodal"><i class="fas fa-check"></i></a><a class="btn btn-sm btn-primary disabled" href="javascript:void(0)" onclick="kirim(' . "'" . $transaksi->kode_checkout . "'" . ')" data-bs-toggle="modal" data-bs-target="#kirimmodal"><i class="fas fa-truck-fast"></i></a>';
            }

            $data[] = $row;
        };

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->transaksi->count_all(),
            "recordsFiltered" => $this->transaksi->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getprogress($kode_checkout)
    {
        $data = $this->transaksi->getdata($kode_checkout);
        echo json_encode($data);
    }

    public function teruskan()
    {
        $data = array(
            'kode_checkout' => $this->input->post('kode_checkout'),
            'status' => $this->input->post('status'),
        );
        $stok = array(
            'id' => $this->input->post('id_brg'),
            'stok' => $this->input->post('qty'),
        );
        $this->transaksi->kurangistok(array('id' => $this->input->post('id_brg')), $stok);
        $this->transaksi->proses(array('kode_checkout' => $this->input->post('kode_checkout')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function kirim()
    {
        $data = array(
            'kode_checkout' => $this->input->post('kode_checkout'),
            'status' => $this->input->post('status'),
            'resi_pengiriman' => $this->input->post('resi_pengiriman'),
        );
        $this->transaksi->update(array('kode_checkout' => $this->input->post('kode_checkout')), $data);
        echo json_encode(array("status" => TRUE));
    }
    public function role()
    {
        $data = ['title' => 'Role'];
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('tb_user_role')->result_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/auth/role', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function roleAccess($role_id)
    {
        $data = ['title' => 'Role Access'];
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get_where('tb_user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('tb_user_menu')->result_array();
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/auth/roleaccess', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('tb_user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('tb_user_access_menu', $data);
        } else {
            $this->db->delete('tb_user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           Access Changed!
          </div>');
    }

    public function data_grafik()
    {
        $grafik = $this->barang->data_grafik();
        echo $data = json_encode($grafik);
    }

    public function data_pie()
    {
        $pie = $this->barang->data_pie();
        echo $data = json_encode($pie);
    }
}
