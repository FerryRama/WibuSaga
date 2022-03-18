<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $data['title'] = 'WibuSaga x FNStoree Shop';
        $data['home'] = '';
        $data['download'] = '';
        $data['rank'] = '';
        $data['donation'] = '';

        $this->load->view('home/template/home_header', $data);
        $this->load->view('shop/index');
        $this->load->view('home/template/home_footer');
    }
}
