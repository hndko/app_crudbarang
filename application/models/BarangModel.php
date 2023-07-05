<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangModel extends CI_Model
{
    public function serialNumber($sn)
    {
        return $this->db->get_where('tb_barang', ['serial_number' => $sn])->row();
    }

    public function ambilData($search = '', $limit, $offset)
    {
        if (!empty($search)) {
            return $this->db->like('serial_number', $search)->join('tb_kategori', 'tb_kategori.kategori_id = tb_barang.kategori_id')->get('tb_barang')->result();
        } else {
            return $this->db->limit($limit, $offset)->join('tb_kategori', 'tb_kategori.kategori_id = tb_barang.kategori_id')->get('tb_barang')->result();
        }
    }

    public function count_data($search = '')
    {
        if (!empty($search)) {
            $this->db->like('serial_number', $search);
        }
        return $this->db->count_all_results('tb_barang');
    }

    public function ambilDataByID($id)
    {
        return $this->db->join('tb_kategori', 'tb_kategori.kategori_id = tb_barang.kategori_id')->get_where('tb_barang', ['barang_id' => $id])->row();
    }

    public function tambahData($file_name)
    {
        $data = [
            'serial_number' => htmlspecialchars($this->input->post('serial_number')),
            'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
            'kategori_id' => htmlspecialchars($this->input->post('kategori_id')),
            'gambar' => $file_name,
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        ];

        $this->db->insert('tb_barang', $data);
    }

    public function ubahData($id, $file_name)
    {
        $data = [
            'serial_number' => htmlspecialchars($this->input->post('serial_number')),
            'nama_barang' => htmlspecialchars($this->input->post('nama_barang')),
            'kategori_id' => htmlspecialchars($this->input->post('kategori_id')),
            'gambar' => $file_name,
            'keterangan' => htmlspecialchars($this->input->post('keterangan'))
        ];

        $this->db->update('tb_barang', $data, ['barang_id' => $id]);
    }

    public function deleteData($id)
    {
        $this->db->delete('tb_barang', ['barang_id' => $id]);
    }
}
