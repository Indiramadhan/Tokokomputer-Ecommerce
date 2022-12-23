<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelproduk extends CI_Model
{

    var $table = 'tb_barang';
    var $column_order = array('id', 'id_brg', 'nama_brg', 'spesifikasi', 'stok', 'nick', 'harga_jual', 'harga_kulak', 'id_ktg', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'created_date',  'updated_date', null);
    var $column_search = array('id', 'id_brg', 'nama_brg', 'spesifikasi', 'stok', 'nick', 'harga_jual', 'harga_kulak', 'id_ktg', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'created_date',  'updated_date');
    var $order = array('id' => 'desc');

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function datatable_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function datatables()
    {
        $this->datatable_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->datatable_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function getid($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function simpan($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function search()
    {
        $find = $this->input->GET('find', TRUE);
        $data = $this->db->query("SELECT * from tb_barang where nama_brg like '%$find%'");
        return $data->result();
    }

    public function kategori()
    {
        $kategori = $this->input->GET('kategori', TRUE);
        $data = $this->db->query("SELECT * from tb_barang where id_ktg like '$kategori'");
        return $data->result();
    }

    public function getAsc()
    {
        $this->db->order_by('harga_jual', 'asc');
        return $this->db->get('tb_barang')->result();
    }

    public function getDesc()
    {
        $this->db->order_by('harga_jual', 'desc');
        return $this->db->get('tb_barang')->result();
    }

    function getkategori()
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->from('tb_kategori')
            ->get()
            ->result();
    }

    function getproduk()
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->from('tb_barang')
            ->get()
            ->result();
    }

    public function totalstok()
    {
        $sql = "SELECT sum(stok) as totalstok FROM tb_barang";
        $result = $this->db->query($sql);
        return $result->row()->totalstok;
    }

    public function totalproduk()
    {
        $sql = "SELECT count(id) as totalproduk FROM tb_barang";
        $result = $this->db->query($sql);
        return $result->row()->totalproduk;
    }

    public function data_grafik()
    {
        $this->db->select('sum(stok) as stok, nick');
        $this->db->from('tb_barang');
        $this->db->group_by('nick');
        return $this->db->get()->result();
    }

    public function data_pie()
    {
        $this->db->select('harga_beli, nick');
        $this->db->from('tb_barang');
        $this->db->group_by('nick');
        return $this->db->get()->result();
    }

    function getdata($where)
    {
        return $this->db->get_where($this->table, $where);
    }
}
