<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        user_security();
    }
    public function index()
    {
        $data = [
            'homepage' => 'active',
            'download' => '',
            'donation' => '',
            'cash' => '',
            'redeem' => '',
            'setting' => '',
            'title' => 'Profile',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()
        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();



        $this->load->view('user/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('user/footer');
    }

    public function changepassword()
    {
        $data = [
            'homepage' => '',
            'download' => '',
            'donation' => '',
            'cash' => '',
            'redeem' => '',
            'setting' => 'active',
            'title' => 'Change Password',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()
        ];

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Repeat Password', 'required|trim|min_length[6]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/menu/change-password', $data);
            $this->load->view('user/footer');
        } else {
            $password = $_POST['new_password1'];
            $current_password = $_POST['current_password'];
            if (password_verify($current_password, $data['userPWD'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong Current Password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New password cannot be the same as current password!</div>');
                    redirect('user/changepassword');
                } else {
                    //password ok
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    $this->db->set('userPWD', $password_hash);
                    $this->db->where('userID', $this->session->userdata('userID'));
                    $this->db->update('userMemberDB');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Change Password Success!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function edit()
    {

        $data = [
            'homepage' => '',
            'download' => '',
            'donation' => '',
            'cash' => '',
            'redeem' => '',
            'setting' => 'active',
            'title' => 'Edit Profile',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()
        ];
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('username', 'username', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/menu/edit-profile', $data);
            $this->load->view('user/footer');
        } else {
            $userID = $this->input->post('username');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '20048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('email', $email);
            $this->db->where('userID', $userID);
            $this->db->update('userMemberDB');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Profile has been updated!</div>');
            redirect('user');
        }
    }
    public function dailycash()
    {

        $data = [
            'homepage' => '',
            'download' => '',
            'donation' => '',
            'cash' => 'active',
            'redeem' => '',
            'setting' => '',
            'title' => 'Daily Cash',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();

        $this->form_validation->set_rules('accountIDX', 'AccountIDX', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('bonusCash', 'BonusCash', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/menu/dailycash', $data);
            $this->load->view('user/footer');
        } else {
            $accountIDX = $this->input->post('accountIDX');
            $userID = $this->input->post('username');
            $bonusCash = $this->input->post('bonusCash');
            $randomCash = rand(50, 500);
            $Date = date('Y-m-d');
            $cekdata = $this->db->get_where('WibuSaga_Cash_History', ['accountIDX' => $accountIDX, 'date' => $Date])->num_rows();
            if ($cekdata != 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                You ID : ' . $userID . ' already claim the daily cash today. Please comeback tomorrow!</div>');
                redirect('user/historycash');
            } else {
                $data = array(
                    'bonusCash' => $bonusCash + $randomCash
                );

                $data1 = array(
                    'accountIDX' => $accountIDX,
                    'cash' => $randomCash,
                    'date' => $Date
                );

                $this->db->set('bonusCash', 'bonusCash');
                $this->db->where('accountIDX', $accountIDX);
                $this->db->update('userMoneyDB', $data);
                $this->db->insert('WibuSaga_Cash_History', $data1);
                $this->_sendBotDiscord($randomCash, 'DailyCash');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Congratulations! You got ' . $randomCash . ' Cash!!</div>');
                redirect('user/historycash');
            }
        }
    }
    public function historycash()
    {
        $data = [
            'homepage' => '',
            'download' => '',
            'donation' => '',
            'cash' => '',
            'redeem' => '',
            'setting' => 'active',
            'title' => 'History Daily Cash',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()
        ];

        $this->load->model('Userhistory_model', 'historycash');
        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('user/historycash');

        $config['total_rows'] = $this->historycash->totalcash();

        $config['per_page'] = 10;



        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
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
        $data['gethistory'] = $this->historycash->CashHistory($config['per_page'], $data['start']);

        $this->load->view('user/header', $data);
        $this->load->view('user/menu/history-cash', $data);
        $this->load->view('user/footer');
    }

    public function historyredeem()
    { {
            $data = [
                'homepage' => '',
                'download' => '',
                'donation' => '',
                'cash' => '',
                'redeem' => '',
                'setting' => 'active',
                'title' => 'History Redeem',
                'user' => $this->db->get_where('userMemberDB', ['userID' =>
                $this->session->userdata('userID')])
                    ->row_array()
            ];

            $this->load->model('Userhistory_model', 'historyredeem');
            //pagination
            $this->load->library('pagination');
            //config       
            $config['base_url'] = base_url('user/historyredeem');

            $config['total_rows'] = $this->historyredeem->TotalRedeem();

            $config['per_page'] = 10;



            $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
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
            $data['gethistory'] = $this->historyredeem->RedeemHistory($config['per_page'], $data['start']);

            $this->load->view('user/header', $data);
            $this->load->view('user/menu/history-redeem', $data);
            $this->load->view('user/footer');
        }
    }
    public function redeemcode()
    {
        $code = $this->input->post('code');
        $data = [
            'homepage' => '',
            'download' => '',
            'donation' => '',
            'cash' => '',
            'redeem' => 'active',
            'setting' => '',
            'title' => 'Redeem Code',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'codee' => $this->db->get_where('WibuSaga_Code', ['code' => $code])
                ->row_array()
        ];
        $this->form_validation->set_rules('code', 'Code Redeem', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/menu/redeem-code', $data);
            $this->load->view('user/footer');
        } else {
            if ($data['codee'] == "") {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                This Voucher Not Exist!</div>');
                redirect('user/redeemcode');
            } else {
                $this->session->set_userdata('saved_code', $code);
                redirect('user/cekredeemcode');
            }
        }
    }
    public function cekredeemcode()
    {
        if (!$this->session->userdata('saved_code')) {
            redirect('user/redeemcode');
        }

        $this->form_validation->set_rules('accountIDX', 'Nickname Sender', 'required|trim');
        $this->form_validation->set_rules('item_code', 'Item Code', 'required|trim');
        $this->form_validation->set_rules('item_name', 'Item Code', 'required|trim');
        $this->form_validation->set_rules('expired', 'Expired', 'required|trim');
        $this->form_validation->set_rules('code', 'Code Redeem', 'required|trim');
        $this->form_validation->set_rules('present_type', 'Present Type', 'required|trim');
        $this->form_validation->set_rules('item_amount', 'Item Amount', 'required|trim');
        $this->form_validation->set_rules('nickname_sender', 'Nickname Sender', 'required|trim');
        $this->form_validation->set_rules('nickname_received', 'Received Sender', 'required|trim');

        $accountIDX = $this->input->post('accountIDX');
        $item_code = $this->input->post('item_code');
        $item_name = $this->input->post('item_name');
        $expired = $this->input->post('expired');
        $code = $this->input->post('code');
        $present_type = $this->input->post('present_type');
        $item_amount = $this->input->post('item_amount');
        $sender = $this->input->post('nickname_sender');
        $received = $this->input->post('nickname_received');

        $data = [
            'homepage' => '',
            'download' => '',
            'donation' => '',
            'cash' => '',
            'redeem' => 'active',
            'setting' => '',
            'title' => 'Redeem Code',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'codee' => $this->db->get_where('WibuSaga_Code', ['code' => $this->session->userdata('saved_code')])
                ->row_array(),
            'codeee' => $this->db->get_where('WibuSaga_Code', ['item_code' => $this->input->post('item_code')])
                ->row_array()
        ];


        if ($this->form_validation->run() == false) {
            $this->load->view('user/header', $data);
            $this->load->view('user/menu/redeem-cek', $data);
            $this->load->view('user/footer');
        } else {
            $Date = date('Y-m-d');
            $Date1 = date('Y-m-d H:i:s');
            if ($item_code == !$data['codeee']) {
                $this->session->unset_userdata('saved_code');
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Invalid Code Redeem!.</div>');
                redirect('user/historyredeem');
            } else {
                if ($expired < $Date) {
                    $this->session->unset_userdata('saved_code');
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    This Voucher is Expired!.</div>');
                    redirect('user/historyredeem');
                } else {
                    $username = $this->session->userdata('userID');
                    $total_redeem = $this->db->get_where('WibuSaga_Redeem', ['username' => $this->session->userdata('userID'), 'code' => $this->session->userdata('saved_code')])->num_rows();

                    if ($total_redeem != 0) {
                        $this->session->unset_userdata('saved_code');
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                        You already claim this item.</div>');
                        redirect('user/historyredeem');
                    } else {
                        $this->db->query("exec game_present_add 
                        @sendNick = '$sender',
                        @receiveNick = '$received',
                        @persentType = '$present_type',
                        @value1 = '$item_code',
                        @value2 = '$item_amount',
                        @value3 = '0',
                        @value4 = '0',
                        @msgType = '1040',
                        @limitDate = '$expired',
                        @flag = '0'");
                        $WibuRedeem = [
                            'username' => $username,
                            'code' => $code
                        ];

                        $this->db->insert('WibuSaga_Redeem', $WibuRedeem);
                        $WibuRedeemHistory = [
                            'username' => $username,
                            'item' => $item_name,
                            'accountIDX' => $accountIDX,
                            'date' => $Date1
                        ];

                        $this->db->insert('WibuSaga_Redeem_History', $WibuRedeemHistory);
                        $this->session->unset_userdata('saved_code');
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Success claim ' . $item_name . ' the item. Please relogin if you in game!</div>');
                        redirect('user/historyredeem');
                    }
                }
            }
        }
    }
    public function _sendBotDiscord($randomCash, $type)
    {
        if ($type == 'DailyCash') {
            //bot discord//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/932303702545559602/lqFJrjSQ6yLSqYMyHxJwpaZ9oE4FqpRurRTJl-hl4jU4NP68tyRuP3wPmAxxiZnaotkk";
            $headers = ['Content-Type: application/json; charset=utf-8'];

            $hookObject = json_encode(
                [
                    /*
    * The general "message" shown above your embeds
    */
                    "content" => "",
                    /*
    * The username shown in the message
    */
                    "username" => "WIBUSAGA - DailyCash",
                    /*
    * The image location for the senders image
    */
                    "avatar_url" => "",
                    /*
    * Whether or not to read the message in Text-to-speech
    */
                    "tts" => false,
                    /*
    * File contents to send to upload a file
    */
                    // "file" => "",
                    /*
    * An array of Embeds
    */
                    "embeds" => [
                        /*
        * Our first embed
        */
                        [
                            // Set the title for your embed
                            "title" => "WibuSaga | DAILYCASH",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "Someone has been take daily cash",

                            // The URL of where your title will be a link to
                            "url" => base_url('user/dailycash'),

                            /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
                            "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec("5865F2"),

                            // Footer object
                            "footer" => [
                                "text" => "MADE BY WIBUSAGA",
                                "icon_url" => "https://styles.redditmedia.com/t5_2tjkp/styles/communityIcon_j1vhjmngovq21.png"
                            ],

                            // Thumbnail object
                            // "thumbnail" => [
                            //     "url" => "https://styles.redditmedia.com/t5_2tjkp/styles/communityIcon_j1vhjmngovq21.png"
                            // ],

                            // Author object
                            // "author" => [
                            //     "name" => "Alphabet",
                            //     "url" => "https://www.abc.xyz"
                            // ],

                            // Field array of objects
                            "fields" => [

                                // Field 1
                                [
                                    "name" => "Username",
                                    "value" => strtoupper($this->input->post('username')),
                                    "inline" => true
                                ],
                                // Field 2
                                [
                                    "name" => "Get Cash",
                                    "value" => $randomCash . " Bonus Cash",
                                    "inline" => true
                                ]
                            ]
                        ]
                    ]

                ],
                JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $hookObject);

            $response = curl_exec($ch);

            if ($response) {
            }
        }
    }
}
