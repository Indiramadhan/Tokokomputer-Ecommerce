<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Modelkategori', 'kategori');
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'user' => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
        ];
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/kategori/index', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function loaddata()
    {
        $list = $this->kategori->datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $kategori) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($kategori->ikon)
                $row[] = '<div class="row"><div class="col-sm-2 me-2"><img class="rounded-circle" src="' . base_url() . '/assets/img/ikon/' . $kategori->ikon . '"></div><div class="col-sm-6"><h5>' . $kategori->nama_ktg . '</h5>' . $kategori->created_date . '</div></div>';
            else
                $row[] = '<div class="row"><div class="col-sm-2 me-2">(Ikon Kosong)</div><div class="col-sm-6"><h5>' . $kategori->nama_ktg . '</h5>' . $kategori->created_date . '</div></div>';
            $row[] = $kategori->updated_date;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="edit(' . "'" . $kategori->id . "'" . ')"><i class="fas fa-pencil"></i></a>
				  <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="hapus(' . "'" . $kategori->id . "'" . ')"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;
        };

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->kategori->count_all(),
            "recordsFiltered" => $this->kategori->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function tambah()
    {
        $this->_validate();
        $data = array(
            'id' => $this->input->post('id'),
            'nama_ktg' => $this->input->post('nama_ktg'),
            'created_date' => $this->input->post('created_date'),
        );
        if (!empty($_FILES['ikon']['name'])) {
            $upload = $this->_do_upload();
            $data['ikon'] = $upload;
        }
        $insert = $this->kategori->simpan($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit($id)
    {
        $data = $this->kategori->getid($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'nama_ktg' => $this->input->post('nama_ktg'),
            'updated_date' => $this->input->post('updated_date'),
        );

        if ($this->input->post('remove_ikon')) {
            if (file_exists('assets/img/ikon/' . $this->input->post('remove_ikon')) && $this->input->post('remove_ikon'))
                unlink('assets/img/ikon/' . $this->input->post('remove_ikon'));
            $data['ikon'] = '';
        }

        if (!empty($_FILES['ikon']['name'])) {
            $upload = $this->_do_upload();

            $kategori = $this->kategori->getid($this->input->post('id'));
            if (file_exists('assets/img/ikon/' . $kategori->ikon) && $kategori->ikon)
                unlink('assets/img/ikon/' . $kategori->ikon);

            $data['ikon'] = $upload;
        }

        $this->kategori->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        //delete file
        $kategori = $this->kategori->getid($id);
        if (file_exists('assets/img/ikon/' . $kategori->ikon) && $kategori->ikon)
            unlink('assets/img/ikon/' . $kategori->ikon);

        $this->kategori->hapus($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/ikon/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('ikon')) //upload and validate
        {
            $data['inputerror'][] = 'ikon';
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

        if ($this->input->post('nama_ktg') == '') {
            $data['inputerror'][] = 'nama_ktg';
            $data['error_string'][] = 'Nama kategori masih kosong !?';
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
