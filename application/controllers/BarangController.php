<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BarangController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BarangModel', 'barangModel');
        $this->load->model('KategoriModel', 'kategoriModel');
    }

    public function index($offset = 0)
    {
        $search = $this->input->get('search');
        $limit = 2; // Jumlah data per halaman
        $total_rows = $this->barangModel->count_data($search);

        // Pagination configuration
        $config['base_url'] = base_url('barang/index');
        $config['total_rows'] = $total_rows; // Assuming your table name is 'products'
        $config['per_page'] = $limit; // Number of items to show per page
        $config['uri_segment'] = 3; // URL segment that contains the page number

        // Bootstrap pagination style
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data = [
            'title' => 'Barang',
            'result' => $this->barangModel->ambilData($search, $config['per_page'], $offset),
            'pagination' => $this->pagination->create_links()
        ];

        // die(var_dump($data['result']));

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('barang/index', $data);
        $this->load->view('layout/footer');
    }

    public function create()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        function generate_string($input, $strength = 20)
        {
            $input_length = strlen($input);
            $random_string = '';
            for ($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            return $random_string;
        }

        $sn = generate_string($permitted_chars, 20);
        $result = $this->barangModel->serialNumber($sn);

        if ($result == NULL) {
            $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|min_length[2]');
            $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|min_length[2]');
            $this->form_validation->set_rules('kategori_id', 'Nama Kategori', 'required');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[2]');

            if ($this->form_validation->run() == false) {
                $data = [
                    'title' => 'Barang',
                    'kategori' => $this->kategoriModel->ambilData(),
                    'sn' => $sn
                ];

                $this->load->view('layout/head', $data);
                $this->load->view('layout/navbar', $data);
                $this->load->view('barang/create', $data);
                $this->load->view('layout/footer');
            } else {
                $config['upload_path'] = './uploads/'; // Direktori penyimpanan file
                $config['allowed_types'] = 'gif|jpg|png|jpeg'; // Jenis file yang diizinkan
                $config['max_size'] = 2048; // Ukuran maksimum file (dalam kilobita)
                $config['encrypt_name'] = TRUE; // Mengenkripsi nama file

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    // Jika upload gagal, tampilkan pesan error
                    $error = $this->upload->display_errors();
                    echo $error;
                } else {
                    // Jika upload berhasil, ambil data file dan simpan ke database
                    $upload_data = $this->upload->data();
                    $file_name = $upload_data['file_name'];
                    $file_size = $upload_data['file_size'];

                    // Simpan data gambar ke dalam database
                    $this->barangModel->tambahData($file_name);
                    $this->session->set_flashdata('success', true);
                    $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah tersimpan.');
                    redirect('barang');

                    // $this->load->model('image_model');
                    // $this->image_model->save_image($file_name, $file_size);

                    // echo "Upload berhasil!";
                }
            }
        } else {
            redirect('barang/create');
        }
    }

    public function edit($id)
    {
        $this->form_validation->set_rules('serial_number', 'Serial Number', 'required|min_length[2]');
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|min_length[2]');
        $this->form_validation->set_rules('kategori_id', 'Nama Kategori', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|min_length[2]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Barang',
                'res' => $this->barangModel->ambilDataByID($id),
                'kategori' => $this->kategoriModel->ambilData(),
            ];

            $this->load->view('layout/head', $data);
            $this->load->view('layout/navbar', $data);
            $this->load->view('barang/edit', $data);
            $this->load->view('layout/footer');
        } else {

            $config['upload_path'] = './uploads/'; // Direktori penyimpanan file
            $config['allowed_types'] = 'gif|jpg|png|jpeg'; // Jenis file yang diizinkan
            $config['max_size'] = 2048; // Ukuran maksimum file (dalam kilobita)
            $config['encrypt_name'] = TRUE; // Mengenkripsi nama file

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('gambar')) {
                // Jika upload gagal, tampilkan pesan error
                $error = $this->upload->display_errors();
                echo $error;
            } else {
                // Jika upload berhasil, ambil data file dan simpan ke database
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $file_size = $upload_data['file_size'];

                // Simpan data gambar ke dalam database
                $this->barangModel->ubahData($id, $file_name);
                $this->session->set_flashdata('success', true);
                $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah diubahkan.');
                redirect('barang');
            }
        }
    }

    public function delete($id)
    {
        $this->barangModel->deleteData($id);
        $this->session->set_flashdata('success', true);
        $this->session->set_flashdata('message', '<strong>Berhasil!</strong> Data anda telah dihapuskan.');
        redirect('barang');
    }

    public function detail($id)
    {
        $data = [
            'title' => 'Barang',
            'res' => $this->barangModel->ambilDataByID($id),
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('barang/detail', $data);
        $this->load->view('layout/footer');
    }
}
