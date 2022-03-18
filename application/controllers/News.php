<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->load->model('Home_model', 'allpostingan');
        $data['title'] = 'Wibu Notice';
        $data['home'] = 'active';
        $data['download'] = '';
        $data['rank'] = '';
        $data['donation'] = '';


        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('news/index');

        $config['total_rows'] = $this->allpostingan->TotalPostingan();

        $config['per_page'] = 9;
        $config['num_links'] = 5;



        $config['full_tag_open'] = '<nav><ul class="pagination  justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');
        //initialize
        $this->pagination->initialize($config);
        //styling

        $data['start'] = $this->uri->segment(3);
        $data['getallpost'] = $this->allpostingan->GetPostingan($config['per_page'], $data['start']);
        $data['slider'] = $this->allpostingan->SliderPostingan();
        $data['top'] = $this->allpostingan->CategoryHome();


        $this->load->view('home/template/home_header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('home/template/home_footer');
    }

    public function idx($id)
    {

        $data['title'] = 'Wibu Notice';
        $data['home'] = 'active';
        $data['download'] = '';
        $data['rank'] = '';
        $data['donation'] = '';
        $data['getpost'] = $this->db->get_where('WibuSaga_Postingan', ['id' => $id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('WibuSaga_Postingan')->result_array();

        if (empty($id)) {
            redirect('news');
        } else {

            $this->load->view('home/template/home_header', $data);
            $this->load->view('news/idx-info', $data);
            $this->load->view('home/template/home_footer');
        }
    }
}
