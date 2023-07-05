<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
{
    public function ambilData()
    {
        return $this->db->get('tb_kategori')->result();
    }

    public function ambilDataByID($id)
    {
        return $this->db->get_where('tb_kategori', ['kategori_id' => $id])->row();
    }

    public function tambahData()
    {
        $data = [
            'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori'))
        ];

        $this->db->insert('tb_kategori', $data);
    }

    public function ubahData($id)
    {
        $data = [
            'nama_kategori' => htmlspecialchars($this->input->post('nama_kategori'))
        ];

        $this->db->update('tb_kategori', $data, ['kategori_id' => $id]);
    }

    public function deleteData($id)
    {
        $this->db->delete('tb_kategori', ['kategori_id' => $id]);
    }
}
