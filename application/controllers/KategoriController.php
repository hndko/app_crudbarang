<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('KategoriModel', 'kategoriModel');
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori',
            'result' => $this->kategoriModel->ambilData()
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('kategori/index', $data);
        $this->load->view('layout/footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|min_length[2]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Kategori'
            ];

            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('kategori/create', $data);
            $this->load->view('layout/footer');
        } else {
            $this->kategoriModel->tambahData();
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah tersimpan.');
            redirect('kategori');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'required|min_length[2]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Kategori',
                'res' => $this->kategoriModel->ambilDataByID($id)
            ];

            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('kategori/edit', $data);
            $this->load->view('layout/footer');
        } else {
            $this->kategoriModel->ubahData($id);
            $this->session->set_flashdata('success', true);
            $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah diubahkan.');
            redirect('kategori');
        }
    }

    public function delete($id)
    {
        $this->kategoriModel->deleteData($id);
        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah dihapuskan.');
        redirect('kategori');
    }
}
