<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modelcart extends CI_Model
{
    public function simpan($data)
    {
        $this->db->insert('tb_cart', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update('tb_cart', $data, $where);
        return $this->db->affected_rows();
    }

    public function getcart($cek)
    {
        $this->db->select('
          tb_cart.*, tb_barang.id AS id_brg, tb_kategori.nama_ktg, tb_barang.nick, tb_barang.gambar1, tb_barang.harga_jual, 
        ');
        $this->db->join('tb_barang', 'tb_cart.id_brg = tb_barang.id');
        $this->db->join('tb_kategori', 'tb_barang.id_ktg = tb_kategori.id');
        $this->db->from('tb_cart');
        $this->db->where('tb_cart.id_user', $cek);
        $query = $this->db->get();
        return $query->result();
    }

    public function stok($where, $stok)
    {
        $this->db->update('tb_barang', $stok, $where);
        return $this->db->affected_rows();
    }

    public function kembalikanstok($where, $stok)
    {
        $this->db->update('tb_barang', $stok, $where);
        return $this->db->affected_rows();
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_cart');
    }

    public function totalbarang($cek)
    {
        $sql = "SELECT count(id) as totalbarang  FROM tb_cart WHERE id_user = $cek ";
        $result = $this->db->query($sql);
        return $result->row()->totalbarang;
    }

    public function gettotal()
    {
        $sql = "SELECT sum(harga) as harga  FROM tb_cart";
        $result = $this->db->query($sql);
        return $result->result();
    }
}
