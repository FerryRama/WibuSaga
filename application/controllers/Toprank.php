<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toprank extends CI_Controller
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

    public function tentoprank()
    {
        $this->load->model('Toprank_model', 'toprank');
        $data = [
            'title' => 'Top Rank 10 User',
            'getexp' => $this->toprank->TopRank(),
            'user' => $this->db->get('userMemberDB')->result_array()


        ];
        $data['home'] = '';
        $data['download'] = '';
        $data['rank'] = 'active';
        $data['donation'] = '';

        $this->load->view('home/template/home_header', $data);
        $this->load->view('home/toprank10user', $data);
        $this->load->view('home/template/home_footer');
    }

    public function tentopguild()
    {
        $this->load->model('Toprank_model', 'toprankguild');
        $data = [
            'title' => 'Top Rank 10',
            'getexp' => $this->toprankguild->TopRankGuild(),
            'user' => $this->db->get('userMemberDB')->result_array()


        ];
        $data['home'] = '';
        $data['download'] = '';
        $data['rank'] = 'active';
        $data['donation'] = '';

        $this->load->view('home/template/home_header', $data);
        $this->load->view('home/toprank10guild', $data);
        $this->load->view('home/template/home_footer');
    }
}
