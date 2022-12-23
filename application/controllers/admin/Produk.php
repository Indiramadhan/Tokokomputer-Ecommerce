<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Modelproduk', 'barang');
    }

    public function index()
    {
        $data = [
            'title' => 'Produk',
            'user' => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array(),
            'kategori' => $this->barang->getkategori()
        ];
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/produk/index', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function loaddata()
    {
        $list = $this->barang->datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $barang) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($barang->gambar1) {
                $row[] = '<div class="row"><div class="col-sm-3 me-2"><img class="rounded-circle mt-4" src="' . base_url() . '/assets/img/gambar/' . $barang->gambar1 . '"></div><div class="col-sm-6"><h5>' . $barang->nama_brg . '</h5>' . $barang->created_date . '</div></div>';
            } else {
                $row[] = '<div class="row"><div class="col-sm-3 me-2">(Gambar Kosong)</div><div class="col-sm-10"><h5>' . $barang->nama_brg . '</h5>' . $barang->created_date . '</div></div>';
            }
            $row[] = $barang->stok . ' <i class="fas fa-box"></i>';
            $row[] = 'Rp ' . number_format($barang->harga_jual) . ' ;-';
            $row[] =  'Rp ' . number_format($barang->harga_beli) . ' ;-';
            $row[] = $barang->updated_date;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="edit(' . "'" . $barang->id . "'" . ')"><i class="fas fa-pencil"></i></a>
				  <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="hapus(' . "'" . $barang->id . "'" . ')"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;
        };

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->barang->count_all(),
            "recordsFiltered" => $this->barang->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function tambah()
    {
        $this->_validate();
        $data = array(
            'id' => $this->input->post('id'),
            'nama_brg' => $this->input->post('nama_brg'),
            'spesifikasi' => $this->input->post('spesifikasi'),
            'stok' => $this->input->post('stok'),
            'nick' => $this->input->post('nick'),
            'id_ktg' => $this->input->post('id_ktg'),
            'harga_beli' => $this->input->post('harga_beli'),
            'harga_jual' => $this->input->post('harga_jual'),
            'created_date' => $this->input->post('created_date'),
        );
        if (!empty($_FILES['gambar1']['name'])) {
            $upload = $this->_do_upload1();
            $data['gambar1'] = $upload;
        }
        if (!empty($_FILES['gambar2']['name'])) {
            $upload = $this->_do_upload2();
            $data['gambar2'] = $upload;
        }
        if (!empty($_FILES['gambar3']['name'])) {
            $upload = $this->_do_upload3();
            $data['gambar3'] = $upload;
        }
        if (!empty($_FILES['gambar4']['name'])) {
            $upload = $this->_do_upload4();
            $data['gambar4'] = $upload;
        }
        $insert = $this->barang->simpan($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit($id)
    {
        $data = $this->barang->getid($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'nama_brg' => $this->input->post('nama_brg'),
            'spesifikasi' => $this->input->post('spesifikasi'),
            'stok' => $this->input->post('stok'),
            'nick' => $this->input->post('nick'),
            'harga_jual' => $this->input->post('harga_jual'),
            'harga_beli' => $this->input->post('harga_beli'),
            'id_ktg' => $this->input->post('id_ktg'),
            'updated_date' => $this->input->post('updated_date'),
        );

        if ($this->input->post('remove_gambar1')) {
            if (file_exists('assets/img/gambar/' . $this->input->post('remove_gambar1')) && $this->input->post('remove_gambar1'))
                unlink('assets/img/gambar/' . $this->input->post('remove_gambar1'));
            $data['gambar1'] = '';
        }

        if (!empty($_FILES['gambar1']['name'])) {
            $upload = $this->_do_upload1();

            $barang = $this->barang->getid($this->input->post('id'));
            if (file_exists('assets/img/gambar/' . $barang->gambar1) && $barang->gambar1)
                unlink('assets/img/gambar/' . $barang->gambar1);

            $data['gambar1'] = $upload;
        }

        if ($this->input->post('remove_gambar2')) {
            if (file_exists('assets/img/gambar/' . $this->input->post('remove_gambar2')) && $this->input->post('remove_gambar2'))
                unlink('assets/img/gambar/' . $this->input->post('remove_gambar2'));
            $data['gambar2'] = '';
        }

        if (!empty($_FILES['gambar2']['name'])) {
            $upload = $this->_do_upload2();

            $barang = $this->barang->getid($this->input->post('id'));
            if (file_exists('assets/img/gambar/' . $barang->gambar2) && $barang->gambar2)
                unlink('assets/img/gambar/' . $barang->gambar2);

            $data['gambar2'] = $upload;
        }

        if ($this->input->post('remove_gambar4')) {
            if (file_exists('assets/img/gambar/' . $this->input->post('remove_gambar3')) && $this->input->post('remove_gambar3'))
                unlink('assets/img/gambar/' . $this->input->post('remove_gambar3'));
            $data['gambar3'] = '';
        }

        if (!empty($_FILES['gambar3']['name'])) {
            $upload = $this->_do_upload3();

            $barang = $this->barang->getid($this->input->post('id'));
            if (file_exists('assets/img/gambar/' . $barang->gambar3) && $barang->gambar3)
                unlink('assets/img/gambar/' . $barang->gambar3);

            $data['gambar3'] = $upload;
        }

        if ($this->input->post('remove_gambar4')) {
            if (file_exists('assets/img/gambar/' . $this->input->post('remove_gambar4')) && $this->input->post('remove_gambar4'))
                unlink('assets/img/gambar/' . $this->input->post('remove_gambar4'));
            $data['gambar4'] = '';
        }

        if (!empty($_FILES['gambar4']['name'])) {
            $upload = $this->_do_upload4();

            $barang = $this->barang->getid($this->input->post('id'));
            if (file_exists('assets/img/gambar/' . $barang->gambar4) && $barang->gambar4)
                unlink('assets/img/gambar/' . $barang->gambar4);

            $data['gambar4'] = $upload;
        }

        $this->barang->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        //delete file
        $barang = $this->barang->getid($id);
        if (file_exists('assets/img/gambar/' . $barang->gambar1) && $barang->gambar1)
            unlink('assets/img/gambar/' . $barang->gambar1);
        if (file_exists('assets/img/gambar/' . $barang->gambar2) && $barang->gambar2)
            unlink('assets/img/gambar/' . $barang->gambar2);
        if (file_exists('assets/img/gambar/' . $barang->gambar3) && $barang->gambar3)
            unlink('assets/img/gambar/' . $barang->gambar3);
        if (file_exists('assets/img/gambar/' . $barang->gambar4) && $barang->gambar4)
            unlink('assets/img/gambar/' . $barang->gambar4);

        $this->barang->hapus($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload1()
    {
        $config['upload_path']          = 'assets/img/gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar1')) //upload and validate
        {
            $data['inputerror'][] = 'gambar1';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload2()
    {
        $config['upload_path']          = 'assets/img/gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar2')) //upload and validate
        {
            $data['inputerror'][] = 'gambar2';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload3()
    {
        $config['upload_path']          = 'assets/img/gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar3')) //upload and validate
        {
            $data['inputerror'][] = 'gambar3';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _do_upload4()
    {
        $config['upload_path']          = 'assets/img/gambar/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar4')) //upload and validate
        {
            $data['inputerror'][] = 'gambar4';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('nama_brg') == '') {
            $data['inputerror'][] = 'nama_brg';
            $data['error_string'][] = 'Nama barang masih kosong !?';
            $data['status'] = FALSE;
        }

        if ($this->input->post('created_date') == '') {
            $data['inputerror'][] = 'created_date';
            $data['error_string'][] = 'Tanggal upload masih kosong !?';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
