<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeltransaksi extends CI_Model
{
    var $table = 'tb_checkout';
    var $column_order = array('id', 'kode_checkout', 'id_user', 'resi_pengiriman', 'status', 'created_date', null);
    var $column_search = array('id', 'kode_checkout', 'id_user', 'resi_pengiriman', 'status', 'created_date');
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

    public function simpanpaket($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    public function hapus($cek)
    {
        $this->db->where('id_user', $cek);
        $this->db->delete('tb_cart');
    }

    public function totalpesanan()
    {
        $sql = "SELECT count(id) as totalpesanan FROM tb_checkout WHERE status='1'";
        $result = $this->db->query($sql);
        return $result->row()->totalpesanan;
    }

    public function totalpenjualan()
    {
        $tgl    = date("Y-m-d");
        $sql = "SELECT count(id) as totalpenjualan FROM tb_checkout WHERE status='4' AND created_date = '$tgl'";
        $result = $this->db->query($sql);
        return $result->row()->totalpenjualan;
    }

    public function proses($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function bayarkeranjang($data)
    {
        return $this->db->insert_batch('tb_pesanan', $data);
    }

    function getcheckout($cek)
    {
        $this->db->order_by('id', 'ASC');
        $this->db->where('id_user', $cek);
        return $this->db->from($this->table)
            ->get()
            ->result();
    }

    public function kurangistok($where, $stok)
    {
        $this->db->update('tb_barang', $stok, $where);
        return $this->db->affected_rows();
    }

    public function getdata($kode_checkout)
    {
        $this->db->select('tb_checkout.*, tb_pesanan.kode_checkout AS kode_checkout, tb_pesanan.qty, tb_pesanan.id_brg, tb_barang.nick, tb_barang.stok, tb_pesanan.qty ');
        $this->db->join('tb_pesanan', 'tb_checkout.kode_checkout = tb_pesanan.kode_checkout');
        $this->db->join('tb_barang', 'tb_pesanan.id_brg = tb_barang.id');
        $this->db->from('tb_checkout');
        $this->db->where('tb_pesanan.kode_checkout', $kode_checkout);
        $query = $this->db->get();
        return $query->row();
    }

    function getcheck($where)
    {
        return $this->db->get_where('tb_barang', $where);
    }
}
