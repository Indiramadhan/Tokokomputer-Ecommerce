<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carousel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('ModelCarousel', 'carousel');
    }

    public function index()
    {
        $data = [
            'title' => 'Carousel-Brand',
            'user' => $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array()
        ];
        $this->load->view('admin/template/header', $data);
        $this->load->view('admin/template/sidebar', $data);
        $this->load->view('admin/carousel/index', $data);
        $this->load->view('admin/template/footer', $data);
    }

    public function loaddata()
    {
        $list = $this->carousel->datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $carousel) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($carousel->gambar)
                $row[] = '<div class="row"><div class="col-sm-2 me-2"><img src="' . base_url() . '/assets/img/carousel/' . $carousel->gambar . '"></div><div class="col-sm-6"><h5>' . $carousel->nama_brand . '</h5>' . $carousel->created_date . '</div></div>';
            else
                $row[] = '<div class="row"><div class="col-sm-2 me-2">(Ikon Kosong)</div><div class="col-sm-6"><h5>' . $carousel->nama_brand . '</h5>' . $carousel->created_date . '</div></div>';
            $row[] = $carousel->updated_date;
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="edit(' . "'" . $carousel->id . "'" . ')"><i class="fas fa-pencil"></i></a>
				  <a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="hapus(' . "'" . $carousel->id . "'" . ')"><i class="fas fa-trash-alt"></i></a>';
            $data[] = $row;
        };

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->carousel->count_all(),
            "recordsFiltered" => $this->carousel->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function tambah()
    {
        $this->_validate();
        $data = array(
            'id' => $this->input->post('id'),
            'nama_brand' => $this->input->post('nama_brand'),
            'created_date' => $this->input->post('created_date'),
        );
        if (!empty($_FILES['gambar']['name'])) {
            $upload = $this->_do_upload();
            $data['gambar'] = $upload;
        }
        $insert = $this->carousel->simpan($data);
        echo json_encode(array("status" => TRUE));
    }

    public function edit($id)
    {
        $data = $this->carousel->getid($id);
        echo json_encode($data);
    }

    public function update()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'nama_carousel' => $this->input->post('nama_carousel'),
            'updated_date' => $this->input->post('updated_date'),
        );

        if ($this->input->post('remove_brand')) {
            if (file_exists('assets/img/carousel/' . $this->input->post('remove_brand')) && $this->input->post('remove_brand'))
                unlink('assets/img/carousel/' . $this->input->post('remove_brand'));
            $data['carousel'] = '';
        }

        if (!empty($_FILES['carousel']['name'])) {
            $upload = $this->_do_upload();

            $carousel = $this->carousel->getid($this->input->post('id'));
            if (file_exists('assets/img/carousel/' . $carousel->carousel) && $carousel->carousel)
                unlink('assets/img/carousel/' . $carousel->carousel);

            $data['carousel'] = $upload;
        }

        $this->carousel->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        //delete file
        $carousel = $this->carousel->getid($id);
        if (file_exists('assets/img/carousel/' . $carousel->gambar) && $carousel->gambar)
            unlink('assets/img/carousel/' . $carousel->gambar);

        $this->carousel->hapus($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']          = 'assets/img/carousel/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) //upload and validate
        {
            $data['inputerror'][] = 'gambar';
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

        if ($this->input->post('nama_brand') == '') {
            $data['inputerror'][] = 'nama_brand';
            $data['error_string'][] = 'Nama carousel masih kosong !?';
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
