<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->load->model('Home_model', 'allpostingan');
        $data['title'] = 'Wibu Home';
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


    public function contact()
    {


        $this->load->library('form_validation');

        //Set form validation
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[6]|max_length[60]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[12]|max_length[200]');

        //Run form validation
        if ($this->form_validation->run() === FALSE) {
            $data['title'] = 'Contact WibuSaga';
            $data['home'] = '';
            $data['download'] = '';
            $data['rank'] = '';
            $data['donation'] = '';
            $this->load->view('home/template/home_header', $data);
            $this->load->view('home/contact');
            $this->load->view('home/template/home_footer');
        } else {

            //Get the form data
            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            //Web master email
            $to_email = 'wibusaga2021@gmail.com'; //Webmaster email, who receive mails

            //Mail settings
            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.gmail.com',
                'smtp_user' => 'wibusaga2021@gmail.com',
                'smtp_pass' => '180918fnfn',
                'smtp_port' => 465,
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'isHTML' => true,
                'newline' => "\r\n"
            ];
            $this->load->library('email', $config);
            $this->email->initialize($config);

            //Send mail with data
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('msg', '<div class="alert alert-success">Mail sent!</div>');

                redirect('home/contact');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger">Problem in sending</div>');
                $this->load->view('home/contact');
            }
        }
    }
}
