<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Downloaddonation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        redirect('');
    }

    public function download()
    {
        $this->load->model('Downdon_model', 'download');
        $data = [
            'title' => 'Download',
            'getexp' => $this->download->download(),
            'user' => $this->db->get('userMemberDB')->result_array()


        ];
        $data['home'] = '';
        $data['download'] = 'active';
        $data['rank'] = '';
        $data['donation'] = '';

        $this->load->view('home/template/home_header', $data);
        $this->load->view('home/download', $data);
        $this->load->view('home/template/home_footer');
    }

    public function downloads()
    {
        $this->load->model('Downdon_model', 'download');
        $data = [
            'title' => 'Download',
            'getexp' => $this->download->download(),
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()


        ];
        $data['homepage'] = '';
        $data['download'] = 'active';
        $data['setting'] = '';
        $data['donation'] = '';
        $data['cash'] = '';
        $data['redeem'] = '';

        $this->load->view('user/header', $data);
        $this->load->view('home/download', $data);
        $this->load->view('user/footer');
    }

    public function donate()
    {
        $this->load->model('Downdon_model', 'donation');
        $data = [
            'title' => 'WibuSaga Donation',
            'donate' => $this->donation->donation(),
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()


        ];
        $data['homepage'] = '';
        $data['download'] = 'active';
        $data['setting'] = '';
        $data['donation'] = '';
        $data['cash'] = '';
        $data['redeem'] = '';

        $this->load->view('user/header', $data);
        $this->load->view('home/donation', $data);
        $this->load->view('user/footer');
    }

    public function donation()
    {
        $this->load->model('Downdon_model', 'donation');
        $data = [
            'title' => 'WibuSaga Donation',
            'donate' => $this->donation->donation(),
            'user' => $this->db->get('userMemberDB')->result_array()


        ];
        $data['home'] = '';
        $data['download'] = '';
        $data['rank'] = '';
        $data['donation'] = 'active';

        $this->load->view('home/template/home_header', $data);
        $this->load->view('home/donation', $data);
        $this->load->view('home/template/home_footer');
    }
}
