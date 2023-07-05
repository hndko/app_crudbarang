<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{
    public function index()
    {
        $data = [
            'title' => 'Home'
        ];

        $this->load->view('layout/head', $data);
        $this->load->view('layout/navbar', $data);
        $this->load->view('home', $data);
        $this->load->view('layout/footer');
    }
}
