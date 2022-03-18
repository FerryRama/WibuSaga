<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gamemaster extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        user_security();
    }
    public function index()
    {

        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Admin Panel',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array(),


        ];
        $this->load->model('Gamemaster_model', 'totalBonusCash', 'totalRealCash');
        $data['totalbonuscash'] = $this->totalBonusCash->totalBonusCash()->row();
        $data['totalrealcash'] = $this->totalBonusCash->totalRealCash()->row();

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/index', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    //start postingan
    public function addnewpostingan()
    {
        $query = $this->db->query("SELECT IDENT_CURRENT('WibuSaga_Postingan') as last_id");
        $res = $query->result();

        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        $data = [
            //postingan//
            'postinganshow' => 'mm-active',
            'postingan1' => 'mm-active',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'New Postingan',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();
        $this->form_validation->set_rules('authors', 'Authors', 'required|trim');
        $this->form_validation->set_rules('judul', 'Judul / Title', 'required|trim');
        $this->form_validation->set_rules('img', 'Link Images Banner Home (230 x 325)', 'required|trim');
        $this->form_validation->set_rules('banner', ' Link Images Banner Home (1170 x 600)', 'required|trim');
        $this->form_validation->set_rules('tags', ' Tagline Post', 'required|trim');
        $this->form_validation->set_rules('detail', ' Detail Post', 'required|trim');



        if ($this->form_validation->run() == false) {
            $this->load->view('gamemaster/template/header', $data);
            $this->load->view('gamemaster/template/topbar', $data);
            $this->load->view('gamemaster/template/sidebar', $data);
            $this->load->view('gamemaster/menu/postingan/addpost', $data);
            $this->load->view('gamemaster/template/footer', $data);
        } else {
            $data = [
                $authors = $this->input->post('authors'),
                $judul = $this->input->post('judul'),
                $img = $this->input->post('img'),
                $banner = $this->input->post('banner'),
                $tags = $this->input->post('tags'),
                $detail = $this->input->post('detail'),
                $Date = date('Y-m-d')
            ];
            $postingan = [
                'judul' => $_POST['judul'],
                'date' => date('Y-m-d'),
                'banner' => $_POST['banner'],
                'tags' => $_POST['tags'],
                'authors' => $_POST['authors'],
                'img' => $_POST['img'],
                'detail' => $_POST['detail'],

            ];

            $this->db->insert('WibuSaga_Postingan', $postingan);
            $ras = $this->db->insert_id();
            $this->_sendBotDiscord($ras, 'postinfo');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Add New Post Success!</div>');
            redirect('gamemaster/allpost');
        }
    }

    //discord Bots
    public function _sendBotDiscord($ras, $type)
    {
        if ($type == 'postinfo') {
            if ($this->input->post('tags') == 1) {
                //News Info Discord
                date_default_timezone_set('Asia/Jakarta');
                $regDates = (new \DateTime())->format('Y-m-d H:i:s');
                $url = "https://discord.com/api/webhooks/950034572790345748/svSIWOm3Ld3oS9eOrhqwkHVCMFpyTwLhEqoztDOrgK7a5hFQghrrPn-3fPAgSrvsGgmp";
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
                        "username" => "News Info Post!",
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
                                "title" => strtoupper($_POST['judul']),

                                // The type of your embed, will ALWAYS be "rich"
                                "type" => "rich",

                                // A description for your embed
                                "description" => "News By : " . strtoupper($_POST['authors']),

                                // The URL of where your title will be a link to
                                "url" => base_url('news/idx/') . $ras,

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
                                    // Field 3
                                    [
                                        "name" => "Post Date",
                                        "value" => $regDates,
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
                //end news info discord
            } else if ($this->input->post('tags') == 2) {
                //Update Info Discord
                //bot news//
                date_default_timezone_set('Asia/Jakarta');
                $regDates = (new \DateTime())->format('Y-m-d H:i:s');
                $url = "https://discord.com/api/webhooks/950029211911995432/S-DyYuS1vbZdiFoqLwtcTh8S7ca6P3_U9t0T--HHExECqWZQtOVRP4GUMj9xPbi1fu1U";
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
                        "username" => "UPDATE INFO PATCH",
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
                                "title" => $this->input->post('judul'),

                                // The type of your embed, will ALWAYS be "rich"
                                "type" => "rich",

                                // A description for your embed
                                "description" => "UPDATE Info by : " . $this->input->post('authors'),

                                // The URL of where your title will be a link to
                                "url" => base_url('news/idx/') . $ras,

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
                                    // Field 3
                                    [
                                        "name" => "Posted Date",
                                        "value" => $regDates,
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
                //end update info discord
            } else if ($this->input->post('tags') == 3) {
                //Event Info Discord
                //bot news//
                date_default_timezone_set('Asia/Jakarta');
                $regDates = (new \DateTime())->format('Y-m-d H:i:s');
                $url = "https://discord.com/api/webhooks/950025855659302942/KVTRj8cz05cH8fMMpwox4GgUz5cmWIakdiQ2bPsxjktNDIwOQ4B4p0pD5uvhWQBUDNkv";
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
                        "username" => "New Event WibuSaga",
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
                                "title" => strtoupper($_POST['judul']),

                                // The type of your embed, will ALWAYS be "rich"
                                "type" => "rich",

                                // A description for your embed
                                "description" => "Event By : " . strtoupper($_POST['authors']),

                                // The URL of where your title will be a link to
                                "url" => base_url('news/idx/') . $ras,

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
                                    // Field 3
                                    [
                                        "name" => "Post Date",
                                        "value" => $regDates,
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
                //end event info discord
            } else if ($this->input->post('tags') == 4) {
                //Notice Info Discord
                //bot news//
                date_default_timezone_set('Asia/Jakarta');
                $regDates = (new \DateTime())->format('Y-m-d H:i:s');
                $url = "https://discord.com/api/webhooks/950033776438804510/k9lEb7y1cof2MJHHLWqW7Esf5dc1dzt7kDFSWK6uvtx3IbQ_UybCUcpwwF4QPgEpe261";
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
                        "username" => "Notice Information",
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
                                "title" => strtoupper($_POST['judul']),

                                // The type of your embed, will ALWAYS be "rich"
                                "type" => "rich",

                                // A description for your embed
                                "description" => "Notice By : " . strtoupper($_POST['authors']),

                                // The URL of where your title will be a link to
                                "url" => base_url('news/idx/') . $ras,

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
                                    // Field 3
                                    [
                                        "name" => "Post Date",
                                        "value" => $regDates,
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
                //end notice info discord
            }
        } else if ($this->input->post('tags') == 4) {
            //Notice Info Discord
            //bot news//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/950033776438804510/k9lEb7y1cof2MJHHLWqW7Esf5dc1dzt7kDFSWK6uvtx3IbQ_UybCUcpwwF4QPgEpe261";
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
                    "username" => "Notice Information",
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
                            "title" => strtoupper($_POST['judul']),

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "Notice By : " . strtoupper($_POST['authors']),

                            // The URL of where your title will be a link to
                            "url" => base_url('news/idx/') . $ras,

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
                                // Field 3
                                [
                                    "name" => "Post Date",
                                    "value" => $regDates,
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
    } //end Discord Bots


    public function allpost()
    {
        $this->load->model('Gamemaster_model', 'allpostingan');
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('gamemaster/allpost');

        $config['total_rows'] = $this->allpostingan->TotalPostingan();

        $config['per_page'] = 9;
        $config['num_links'] = 5;


        $config['full_tag_open'] = '<nav><ul class="pagination pagination-gutter  justify-content-center">';
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


        $data = [
            //postingan//
            'postinganshow' => 'mm-active',
            'postingan1' => '',
            'postingan2' => 'mm-active',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'History Post',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $data['start'] = $this->uri->segment(3);
        $data['getallpost'] = $this->allpostingan->GetPostingan($config['per_page'], $data['start']);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/postingan/allpost', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    public function editpost($id)
    {
        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Edit Post',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];
        $data['editpost'] = $this->db->get_where('WibuSaga_Postingan', ['id' => $id])->row_array();
        //$this->db->where('id !=', 1);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/postingan/editpost', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }

    public function editspost()
    {
        $query = $this->db->query("SELECT IDENT_CURRENT('WibuSaga_Postingan') as last_id");
        $res = $query->result();

        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        $data = [
            //postingan//
            'postinganshow' => 'mm-active',
            'postingan1' => 'mm-active',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'New Postingan',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();
        $this->form_validation->set_rules('authors', 'Judul / Title', 'required|trim');
        $this->form_validation->set_rules('judul', 'Judul / Title', 'required|trim');
        $this->form_validation->set_rules('img', 'Link Images Banner Home (230 x 325)', 'required|trim');
        $this->form_validation->set_rules('banner', ' Link Images Banner Home (1170 x 600)', 'required|trim');
        $this->form_validation->set_rules('tags', ' Tagline Post', 'required|trim');
        $this->form_validation->set_rules('detail', ' Detail Post', 'required|trim');
        $data = [
            $id = $this->input->post('idx'),
            $authors = $this->input->post('authors'),
            $judul = $this->input->post('judul'),
            $img = $this->input->post('img'),
            $banner = $this->input->post('banner'),
            $tags = $this->input->post('tags'),
            $detail = $this->input->post('detail'),
            $Date = date('Y-m-d')
        ];



        if (empty($judul)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Title / Judul Required!</div>');
            redirect('gamemaster/allpost');
        } else if (empty($img)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Link Images Banner Home (230 x 325) Required!</div>');
            redirect('gamemaster/allpost');
        } else if (empty($banner)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Link Images Banner Home (1170 x 600) Required!</div>');
            redirect('gamemaster/allpost');
        } else if (empty($tags)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Tagsline Required!</div>');
            redirect('gamemaster/allpost');
        } else if (empty($detail)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Detail Post Required!</div>');
            redirect('gamemaster/allpost');
        } else {
            $postingan = [
                'judul' => $_POST['judul'],
                'date' => date('Y-m-d'),
                'banner' => $_POST['banner'],
                'tags' => $_POST['tags'],
                'authors' => $_POST['authors'],
                'img' => $_POST['img'],
                'detail' => $_POST['detail'],

            ];
            $this->db->set('judul', $this->input->post('judul'));
            $this->db->set('img', $this->input->post('img'));
            $this->db->set('banner', $this->input->post('banner'));
            $this->db->set('tags', $this->input->post('tags'));
            $this->db->set('detail', $this->input->post('detail'));
            $this->db->where('id', $id);
            $this->db->update('WibuSaga_Postingan');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Edit Post Success!</div>');
            redirect('gamemaster/allpost');
        }
    }
    public function deletepost($id)
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        if (empty($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed!</div>');
            redirect('gamemaster/allpost');
        } else {
            $this->db->delete('WibuSaga_Postingan', array('id' => $id));
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Success!</div>');
            redirect('gamemaster/allpost');
        }
    }
    //end of postingan


    //start redeemcode
    public function addredeemcode()
    {
        $query = $this->db->query("SELECT IDENT_CURRENT('WibuSaga_Postingan') as last_id");
        $res = $query->result();

        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => 'mm-active',
            'redem1' => 'mm-active',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'New RedeemCode',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();

        $this->form_validation->set_rules('nickName', 'NickName Crators', 'required|trim');
        $this->form_validation->set_rules('item_name', 'Item Name', 'required|trim');
        $this->form_validation->set_rules(
            'redeem_code',
            'Redeem Code',
            'required|trim|is_unique[WibuSaga_Code.code]',
            array(
                'required'      => 'Your %s is empty.',
                'is_unique'     => 'This %s already exists.',
                'alpha_numeric' => 'Your %s Error, Dont Use Special Character'
            )
        );
        $this->form_validation->set_rules('accountIDX', 'Present Type', 'required|trim');
        $this->form_validation->set_rules('present_type', 'Present Type', 'required|trim');
        $this->form_validation->set_rules('item_code', ' Item Code Value 1', 'required|trim');
        $this->form_validation->set_rules('item_amount', ' Item Code Value 2', 'required|trim');
        $this->form_validation->set_rules('expired', ' Expired Date', 'required|trim');
        $this->form_validation->set_rules('discordshare', ' Discord Share?', 'required|trim');
        $Regdates = date("Y-m-d");
        if ($this->form_validation->run() == false) {
            $this->load->view('gamemaster/template/header', $data);
            $this->load->view('gamemaster/template/topbar', $data);
            $this->load->view('gamemaster/template/sidebar', $data);
            $this->load->view('gamemaster/menu/redeemcode/add-redeemcode', $data);
            $this->load->view('gamemaster/template/footer', $data);
        } else {
            $data = [
                $accountIDX = $this->input->post('accountIDX'),
                $nickName = $this->input->post('nickName'),
                $item_name = $this->input->post('item_name'),
                $redeem_code = $this->input->post('redeem_code'),
                $present_type = $this->input->post('present_type'),
                $item_code = $this->input->post('item_code'),
                $item_amount = $this->input->post('item_amount'),
                $expired = $this->input->post('expired'),
                $discord_share = $this->input->post('discordshare')

            ];
            $code_redeem = [
                'accountIDX' => $_POST['accountIDX'],
                'item_code' => $_POST['item_code'],
                'item_name' => $_POST['item_name'],
                'expired' => $_POST['expired'],
                'code' => $_POST['redeem_code'],
                'present_type' => $_POST['present_type'],
                'item_amount' => $_POST['item_amount'],
                'nickname' => $_POST['nickName'],

            ];
            if ($discord_share == 'yesshare') {
                $ras = $this->input->post('redeem_code');
                $this->db->insert('WibuSaga_Code', $code_redeem);
                $this->_sendBotDiscordRedeemCode($redeem_code, 'redeemcode');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Add redeem code success add and auto share in discord!</div>');
                redirect('gamemaster/historyredeemcode');
            } else if ($discord_share == 'noshare') {
                $this->db->insert('WibuSaga_Code', $code_redeem);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Add redeem code success add and auto share off!</div>');
                redirect('gamemaster/historyredeemcode');
            }
        }
    }
    public function _sendBotDiscordRedeemCode($redeem_code, $type)
    {
        if ($type == 'redeemcode') {
            //bot discord//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/950751882484260884/zWOkgxt0j_ZfC7yJ8EybME3U_oABVMMLnppF3uUdxBA7s09FJ2nQHSAI2-247CS_5k8g";
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
                    "username" => "Redeem Code WibuSaga",
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
                            "title" => "WibuSaga",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "Redeem Code By : " . strtoupper($this->input->post('nickName')),

                            // The URL of where your title will be a link to
                            "url" => base_url('user/redeemcode'),

                            /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
                            "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec("5865F2"),

                            // Footer object
                            "footer" => [
                                "text" => "WIBUSAGA",
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
                                    "name" => "Redeem Code",
                                    "value" => $redeem_code,
                                    "inline" => true
                                ],
                                // Field 2
                                [
                                    "name" => "Expired Date",
                                    "value" => strtoupper($this->input->post('expired')),
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
    public function historyredeemcode()
    {
        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => 'mm-active',
            'redem1' => '',
            'redem2' => 'mm-active',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'History Redeem Code',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array()
        ];

        $this->load->model('Gamemaster_model', 'historyredeemcode');
        //pagination
        $this->load->library('pagination');

        // keyword
        //config       
        $config['base_url'] = base_url('gamemaster/historyredeemcode');

        $config['total_rows'] = $this->historyredeemcode->TotalRedeemHistory();

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
        $data['gethistory'] = $this->historyredeemcode->RedeemHistory($config['per_page'], $data['start']);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/redeemcode/history_redeem', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    public function deleteredeemcode($code)
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        if (empty($code)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed!</div>');
            redirect('gamemaster/historyredeemcode');
        } else {
            $this->db->delete('WibuSaga_Code', array('code' => $code));
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Success!</div>');
            redirect('gamemaster/historyredeemcode');
        }
    }
    public function editredeemcode()
    {
        $query = $this->db->query("SELECT IDENT_CURRENT('WibuSaga_Postingan') as last_id");
        $res = $query->result();

        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        $data = [
            //postingan//
            'postinganshow' => 'mm-active',
            'postingan1' => 'mm-active',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'New Postingan',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array(),
            'codee' => $this->db->get_where('WibuSaga_Code', ['code' => $this->input->post('redeem_code')])
                ->row_array()
        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();

        $data = [
            $id = $this->input->post('id'),
            $redeem_code = $_POST['redeem_code'],
            $item_code = $_POST['item_code'],
            $expired = $_POST['expired'],
            $expired = $_POST['expired'],
            $present_type = $_POST['present_type'],
            $item_amount = $_POST['item_amount'],
            $item_name = $_POST['item_name'],
        ];


        if (empty($item_code)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Redeem Code Required!</div>');
            redirect('gamemaster/historyredeemcode');
        } else if (empty($expired)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Expired Required!</div>');
            redirect('gamemaster/historyredeemcode');
        } else if (empty($redeem_code)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Redeem Code Required!</div>');
            redirect('gamemaster/historyredeemcode');
        } else if (empty($present_type)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Present Type!</div>');
            redirect('gamemaster/historyredeemcode');
        } else if (empty($item_name)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Item Name Required!</div>');
            redirect('gamemaster/historyredeemcode');
        }
        if ($redeem_code == !$this->db->get_where('WibuSaga_Code', ['code' => $this->input->post('redeem_code')])
            ->row_array()) {
            $this->db->set('code', $this->input->post('redeem_code'));
            $this->db->set('item_name', $this->input->post('item_name'));
            $this->db->set('present_type', $this->input->post('present_type'));
            $this->db->set('item_code', $this->input->post('item_code'));
            $this->db->set('item_amount', $this->input->post('item_amount'));
            $this->db->set('expired', $this->input->post('expired'));
            $this->db->where('id', $id);
            $this->db->update('WibuSaga_Code');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Edit Redeem Code Success!</div>');
            redirect('gamemaster/historyredeemcode');
        } elseif ($redeem_code == $redeem_code) {
            $this->db->set('item_name', $this->input->post('item_name'));
            $this->db->set('present_type', $this->input->post('present_type'));
            $this->db->set('item_code', $this->input->post('item_code'));
            $this->db->set('item_amount', $this->input->post('item_amount'));
            $this->db->set('expired', $this->input->post('expired'));
            $this->db->where('id', $id);
            $this->db->update('WibuSaga_Code');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Edit Redeem Code Success!</div>');
            redirect('gamemaster/historyredeemcode');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Edit Redeem Code No Success!</div>');
            redirect('gamemaster/historyredeemcode');
        }
    }   //end redeemcode

    //start gift item

    public function historygiftitem()
    {
        $this->load->model('Gamemaster_model', 'allhistoryitem');
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('gamemaster/historygiftitem');

        $config['total_rows'] = $this->allhistoryitem->TotalHistoryItem();

        $config['per_page'] = 9;
        $config['num_links'] = 5;


        $config['full_tag_open'] = '<nav><ul class="pagination pagination-gutter  justify-content-center">';
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


        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => 'mm-active',
            'giftitem1' => '',
            'giftitem2' => 'mm-active',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'History Gift Item',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $data['start'] = $this->uri->segment(3);
        $data['gethistoryitem'] = $this->allhistoryitem->GetHistoryItem($config['per_page'], $data['start']);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/giftitem/history_giftitem', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    public function addgiftitem()
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Add Gift Item',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array(),
        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();

        $data = [
            $accountIDX = $this->input->post('accountIDX'),
            $sender = $this->input->post('sendnick'),
            $received = $this->input->post('nickname'),
            $namaitem = $_POST['namaitem'],
            $present_type = $_POST['present_type'],
            $value1 = $_POST['item_code'],
            $value2 = $_POST['item_amount'],
            $expiredclaim = $_POST['expired'],
        ];

        if (empty($received)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            nickName Received Required!</div>');
            redirect('gamemaster/historygiftitem');
        } else if (empty($namaitem)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Nama Item Required!</div>');
            redirect('gamemaster/historygiftitem');
        } else if (empty($present_type)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Present Type Required!</div>');
            redirect('gamemaster/historygiftitem');
        } else if (empty($value1)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Item Value (1) Required!</div>');
            redirect('gamemaster/historygiftitem');
        } else if (empty($expiredclaim)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Expired Date Claim Required!</div>');
            redirect('gamemaster/historygiftitem');
        } else {
            $senditem = [
                'accountIDX' => $_POST['accountIDX'],
                'nick' => $_POST['sendnick'],
                'nickname' => $_POST['nickname'],
                'itemcode' => $_POST['value1'],
                'date' => date('Y-m-d'),
                'namaitem' => $_POST['namaitem']

            ];
            $this->db->query("exec game_present_add 
            @sendNick = '$sender', 
            @receiveNick = '$received', 
            @persentType = '$present_type', 
            @value1 = '$value1', 
            @value2 = '$value2', 
            @value3 = '0', 
            @value4 = '0',
            @msgType = '1040', 
            @limitDate = '$expiredclaim',
            @flag ='0'");
            $this->db->insert('WibuSaga_Gift_Item_History', $senditem);
            $this->_sendBotDiscordSendItem($received, 'senditem');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Send Item To ' . $received . ' Success!</div>');
            redirect('gamemaster/historygiftitem');
        }
    }
    public function deletegiftitem($id)
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            if (empty($id)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed ID History Required!</div>');
                redirect('gamemaster/historygiftitem');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed You Dont Have Access!</div>');
                redirect('gamemaster/historygiftitem');
            }
        } else if ($user['role_id'] == 1) {
            if (empty($id)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed ID History Required!</div>');
                redirect('gamemaster/historygiftitem');
            } else {
                $this->db->delete('WibuSaga_Gift_Item_History', array('id' => $id));
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Success!</div>');
                redirect('gamemaster/historygiftitem');
            }
        } else {
            redirect('auth/blocked');
        }
    }
    public function _sendBotDiscordSendItem($received, $type)
    {
        if ($type == 'senditem') {
            //bot discord//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/951842187891593256/7ziLptiiOBNZmWDthzerSW4x5AtoZ6jzu5j8XI32c-bzwCtV23UNClm94YNs9qwOrWYI";
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
                    "username" => "WibuSaga",
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
                            "title" => "WibuSaga Send Item Log",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "Send By : " . strtoupper($this->input->post('sendnick')),

                            // The URL of where your title will be a link to
                            "url" => base_url(''),

                            /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
                            "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec("5865F2"),

                            // Footer object
                            "footer" => [
                                "text" => "WIBUSAGA",
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
                                    "name" => "Received",
                                    "value" => $received,
                                    "inline" => true
                                ],
                                // Field 2
                                [
                                    "name" => "Expired Claim",
                                    "value" => strtoupper($this->input->post('expired')),
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
    } //end gift item

    //start send cash
    public function historysendcash()
    {
        $this->load->model('Gamemaster_model', 'allhistorygiftcash');
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('gamemaster/historysendcash');

        $config['total_rows'] = $this->allhistorygiftcash->TotalGiftCashHistory();

        $config['per_page'] = 9;
        $config['num_links'] = 5;


        $config['full_tag_open'] = '<nav><ul class="pagination pagination-gutter  justify-content-center">';
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


        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => 'mm-active',
            'giftcash1' => '',
            'giftcash2' => 'mm-active',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'History Send Cash',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $data['start'] = $this->uri->segment(3);
        $data['gethistorycash'] = $this->allhistorygiftcash->GiftCashHistory($config['per_page'], $data['start']);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/sendcash/history_sendcash', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    public function addsendcash()
    {
        $this->load->model('Gamemaster_model', 'allhistorygiftcash');
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('gamemaster/historysendcash');

        $config['total_rows'] = $this->allhistorygiftcash->TotalGiftCashHistory();

        $config['per_page'] = 9;
        $config['num_links'] = 5;


        $config['full_tag_open'] = '<nav><ul class="pagination pagination-gutter  justify-content-center">';
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

        $username = $this->input->post('userID');
        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => 'mm-active',
            'giftcash1' => 'mm-active',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Send Cash',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array(),

        ];
        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $this->form_validation->set_rules('userID', 'User ID', 'required|trim');
        $this->form_validation->set_rules('cash', 'Total Send Cash', 'required|trim');
        $data['start'] = $this->uri->segment(3);
        $data['gethistorycash'] = $this->allhistorygiftcash->GiftCashHistory($config['per_page'], $data['start']);


        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/sendcash/history_sendcash', $data);
        $this->load->view('gamemaster/template/footer', $data);

        $data = [
            $accountIDX = $this->input->post('accountIDX'),
            $sender = $this->input->post('sendnick'),
            $userID = $this->input->post('userID'),
            $cash = $this->input->post('cash'),

        ];
        $data['usercek'] = $this->db->get_where('userMemberDB', ['userID' => $this->input->post('userID')])->row_array();
        if (empty($userID)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                userID Required!</div>');
            redirect('gamemaster/historysendcash');
        } else if (empty($cash)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Cash Required!</div>');
            redirect('gamemaster/historysendcash');
        } else if ($data['usercek'] == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                UserID No EXIST!</div>');
            redirect('gamemaster/historysendcash');
        } else {
            $this->session->set_userdata('send_to', $userID);
            $this->session->set_userdata('total_cash', $cash);
            redirect('gamemaster/sendcashconfirm');
        }
    }
    public function sendcashconfirm()
    {
        if (!$this->session->userdata('send_to')) {
            redirect('gamemaster/addsendcash');
        }
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        $userID = $this->input->post('userID');
        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => 'mm-active',
            'giftcash1' => 'mm-active',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Send Cash',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array(),
            'cekusers' => $this->db->get_where('userMemberDB', ['userID' => $userID])
                ->row_array(),
            'cekcash' => $this->db->select('*')->from('userMemberDB')->where('userID', $this->session->userdata('send_to'))
                ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')->get()->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/sendcash/cek_sendcash', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    public function sendcashsuccess()
    {
        $cash = $this->input->post('cash');
        if ($cash <= '10000') {
            $Date = date('Y-m-d');
            $data = [
                $accountIDX = $this->input->post('accountIDX'),
                $sender = $this->input->post('sendnick'),
                $accountIDXTo = $this->input->post('accountIDXSend'),
                $nicknameto = $this->input->post('nicknameto'),
                $userID = $this->input->post('userID'),
                $total = $this->input->post('bonusCash'),
                $cash = $this->input->post('cash'),

            ];
            $history = [
                'accountIDX' => $accountIDX,
                'nick' => $sender,
                'nickname' => $nicknameto,
                'date' => $Date,
                'cash' => $cash
            ];
            $cashto = array(
                'bonusCash' =>  $total + $cash
            );
            $this->db->set('bonusCash', 'bonusCash');
            $this->db->where('accountIDX', $accountIDXTo);
            $this->db->update('userMoneyDB', $cashto);
            $this->db->insert('WibuSaga_Gift_Cash_History', $history);
            $this->_sendBotDiscordSendCashGM($nicknameto, 'sendcashgm');
            $this->session->unset_userdata('send_to');
            $this->session->unset_userdata('total_cash');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Send ' . $cash . ' Cash To ' . $userID . ' Success!</div>');
            redirect('gamemaster/historysendcash');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Maximal 10.000 Cash!</div>');
            redirect('gamemaster/historysendcash');
        }
    }
    public function _sendBotDiscordSendCashGM($nicknameto, $type)
    {
        if ($type == 'sendcashgm') {
            //bot discord//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/952238455897858120/s9zrhP_n3ywCuMQhI2AEbb7GEO5X5aLJEIBb_hDYzO4fD-dTcy45PqhTm0ewzPUstVm4";
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
                    "username" => "WibuSaga",
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
                            "title" => "WibuSaga Send Cash Log",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "Send By : " . strtoupper($this->input->post('sendnick')),

                            // The URL of where your title will be a link to
                            "url" => base_url(''),

                            /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
                            "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec("5865F2"),

                            // Footer object
                            "footer" => [
                                "text" => "WIBUSAGA",
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
                                    "name" => "Received",
                                    "value" => $nicknameto,
                                    "inline" => true
                                ],
                                [
                                    "name" => "Total Cash",
                                    "value" => strtoupper($this->input->post('cash')),
                                    "inline" => true
                                ],
                                // Field 2
                                [
                                    "name" => "Send Date",
                                    "value" => $regDates,
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
    public function deletehistorycash($id)
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            if (empty($id)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed ID History Required!</div>');
                redirect('gamemaster/historysendcash');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed You Dont Have Access!</div>');
                redirect('gamemaster/historysendcash');
            }
        } else if ($user['role_id'] == 1) {
            if (empty($id)) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed ID History Required!</div>');
                redirect('gamemaster/historysendcash');
            } else {
                $this->db->delete('WibuSaga_Gift_Cash_History', array('id' => $id));
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Success!</div>');
                redirect('gamemaster/historysendcash');
            }
        } else {
            redirect('auth/blocked');
        }
    } //end cash send

    //start link download
    public function historydownloadlink()
    {
        $this->load->model('Gamemaster_model', 'downloadlink');
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('gamemaster/historydownloadlink');

        $config['total_rows'] = $this->downloadlink->totallinkdownload();

        $config['per_page'] = 9;
        $config['num_links'] = 5;


        $config['full_tag_open'] = '<nav><ul class="pagination pagination-gutter  justify-content-center">';
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


        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => 'mm-active',
            'linkupdate' => 'mm-active',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'History Link Download',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $data['start'] = $this->uri->segment(3);
        $data['linkdownload'] = $this->downloadlink->getlinkdownload($config['per_page'], $data['start']);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/linkdownload/history_linkdownload', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }

    public function addlinkdownload()
    {
        $data = [
            $nama = $this->input->post('name'),
            $desc = $this->input->post('desc'),
            $link = $this->input->post('link')
        ];

        if (empty($nama)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Name Required!</div>');
            redirect('gamemaster/historydownloadlink');
        } else if (empty($desc)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Description Required!</div>');
            redirect('gamemaster/historydownloadlink');
        } else if (empty($link)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Link Download Required!</div>');
            redirect('gamemaster/historydownloadlink');
        } else {
            $addlinkdownload = [
                'nama' => $_POST['name'],
                'description' => $_POST['desc'],
                'link' => $_POST['link']
            ];
            $this->db->insert('WibuSaga_Download', $addlinkdownload);
            $this->_sendBotDiscordDownload($nama, 'download');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Add New Link Download ' . $nama . ' Success!</div>');
            redirect('gamemaster/historydownloadlink');
        }
    }
    public function editlinkdownload()
    {
        $data = [
            $id = $this->input->post('id'),
            $nama = $this->input->post('name'),
            $desc = $this->input->post('desc'),
            $link = $this->input->post('link')
        ];

        if (empty($nama)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Name Required!</div>');
            redirect('gamemaster/historydownloadlink');
        } else if (empty($desc)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Description Required!</div>');
            redirect('gamemaster/historydownloadlink');
        } else if (empty($link)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Link Download Required!</div>');
            redirect('gamemaster/historydownloadlink');
        } else {
            $this->db->set('nama', $this->input->post('name'));
            $this->db->set('description', $this->input->post('desc'));
            $this->db->set('link', $this->input->post('link'));
            $this->db->where('id', $id);
            $this->db->update('WibuSaga_Download');
            $this->_sendBotDiscordDownload($nama, 'download');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Edit ' . $nama . ' Success!</div>');
            redirect('gamemaster/historydownloadlink');
        }
    }
    public function _sendBotDiscordDownload($nama, $type)
    {
        if ($type == 'download') {
            //bot discord//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/952985406306123786/6Y4ZF1cZwBn1UuXqsoeY-nOxlsQfb2a2hBQwSMgl6j_SjDXWiTwryCzfcxCH23Vq-Yom";
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
                    "username" => "WibuSaga Download Link",
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
                            "title" => "Wibu Saga Download Link",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "" . strtoupper($this->input->post('desc')),

                            // The URL of where your title will be a link to
                            "url" => base_url('downloaddonation/download'),

                            /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
                            "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec("5865F2"),

                            // Footer object
                            "footer" => [
                                "text" => "WIBUSAGA",
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
                                    "name" => "Link Download",
                                    "value" => $this->input->post('link'),
                                    "inline" => true
                                ],
                                // Field 2
                                [
                                    "name" => "Link update",
                                    "value" => $regDates,
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
    public function deletelinkdownload($id)
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        if (empty($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed!</div>');
            redirect('gamemaster/historydownloadlink');
        } else {
            $this->db->delete('WibuSaga_Download', array('id' => $id));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Delete Success!</div>');
            redirect('gamemaster/historydownloadlink');
        }
    }
    //end off link download

    //start link donation
    public function historylinkdonation()
    {
        $this->load->model('Gamemaster_model', 'linkdonation');
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }

        //pagination
        $this->load->library('pagination');
        //config       
        $config['base_url'] = base_url('gamemaster/historylinkdonation');

        $config['total_rows'] = $this->linkdonation->totallinkdonation();

        $config['per_page'] = 9;
        $config['num_links'] = 5;


        $config['full_tag_open'] = '<nav><ul class="pagination pagination-gutter  justify-content-center">';
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


        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => 'mm-active',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => 'mm-active',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'History Link Download',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();


        $data['start'] = $this->uri->segment(3);
        $data['linkdonation'] = $this->linkdonation->getlinkdonation($config['per_page'], $data['start']);

        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/linkdonation/history_linkdonation', $data);
        $this->load->view('gamemaster/template/footer', $data);
    }
    public function addlinkdonation()
    {
        $data = [

            $nama = $this->input->post('name'),
            $price = $this->input->post('price'),
            $link = $this->input->post('link'),
            $nickgm = $this->input->post('nickname')
        ];

        if (empty($nama)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Name Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else if (empty($price)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Price Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else if (empty($link)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Link Donation Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else if (empty($nickgm)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            NickName Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else {
            $addlinkdonation = [
                'nama' => $_POST['name'],
                'price' => $_POST['price'],
                'link' => $_POST['link'],
                'nickname' => $_POST['nickname'],
            ];
            $this->db->insert('WibuSaga_Donate', $addlinkdonation);
            $this->_sendBotDiscordDonation($nama, 'donation');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Add New Link Donation ' . $nama . ' Success!</div>');
            redirect('gamemaster/historylinkdonation');
        }
    }
    public function editlinkdonation()
    {
        $data = [
            $id = $this->input->post('id'),
            $nama = $this->input->post('name'),
            $price = $this->input->post('price'),
            $link = $this->input->post('link'),
            $nickgm = $this->input->post('nickname')
        ];

        if (empty($nama)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Name Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else if (empty($price)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Price Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else if (empty($link)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Link Donation Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else if (empty($nickgm)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            NickName Required!</div>');
            redirect('gamemaster/historylinkdonation');
        } else {
            $this->db->set('nama', $this->input->post('name'));
            $this->db->set('price', $this->input->post('price'));
            $this->db->set('link', $this->input->post('link'));
            $this->db->set('nickname', $this->input->post('nickname'));
            $this->db->where('id', $id);
            $this->db->update('WibuSaga_Donate');
            $this->_sendBotDiscordDonation($nama, 'donation');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Edit ' . $nama . ' Success!</div>');
            redirect('gamemaster/historylinkdonation');
        }
    }
    public function _sendBotDiscordDonation($nama, $type)
    {
        if ($type == 'donation') {
            //bot discord//
            date_default_timezone_set('Asia/Jakarta');
            $regDates = (new \DateTime())->format('Y-m-d H:i:s');
            $url = "https://discord.com/api/webhooks/953579550082732084/Y7kritaO1m5_FhLaV-oHmSX4-p1Ynr0wrS6SzKdwL7nCgVA6tssQSIefCsXzDDCFhXqH";
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
                    "username" => "WibuSaga Donation Link",
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
                            "title" => "Wibu Saga Donation Link",

                            // The type of your embed, will ALWAYS be "rich"
                            "type" => "rich",

                            // A description for your embed
                            "description" => "" . strtoupper($this->input->post('name')),

                            // The URL of where your title will be a link to
                            "url" => base_url('downloaddonation/donation'),

                            /* A timestamp to be displayed below the embed, IE for when an an article was posted
            * This must be formatted as ISO8601
            */
                            "timestamp" => date(DATE_ISO8601, strtotime($regDates)),

                            // The integer color to be used on the left side of the embed
                            "color" => hexdec("5865F2"),

                            // Footer object
                            "footer" => [
                                "text" => "WIBUSAGA",
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
                                    "name" => "Link Download",
                                    "value" => $this->input->post('link'),
                                    "inline" => true
                                ],
                                // Field 2
                                [
                                    "name" => "Donation Dates Reg",
                                    "value" => $regDates,
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
    public function deletelinkdonation($id)
    {
        $user = $this->db->get_where('userMemberDB', ['userID' => $this->session->userdata('userID')])->row_array();
        if ($user['role_id'] == 2) {
            base_url('gamemaster');
        } else {
            redirect('auth/blocked');
        }
        if (empty($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Delete Failed!</div>');
            redirect('gamemaster/historylinkdonation');
        } else {
            $this->db->delete('WibuSaga_Donate', array('id' => $id));
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Delete Success!</div>');
            redirect('gamemaster/historylinkdonation');
        }
    }
    //end off link download

    //launcher configuration
    public function statuslauncher()
    {

        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Change Status Launcher',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();




        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/launcher/change_status', $data);
        $this->load->view('gamemaster/template/footer', $data);
        $data = [
            $idx = $this->input->post('idx'),
            $status = $this->input->post('status'),
            $price = $this->input->post('price'),
            $link = $this->input->post('link'),
            $nickgm = $this->input->post('nickname')
        ];

        if (empty($idx)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                idx Required!</div>');
            base_url('gamemaster/statuslauncher');
        } else {
            $this->db->set('status', $this->input->post('status'));
            $this->db->where('idx', $idx);
            $this->db->update('define_game_server');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Edit Status Launcher Success!</div>');
            redirect('gamemaster/statuslauncher');
        }
    }
    public function bannerlauncher()
    {

        $data = [
            //postingan//
            'postinganshow' => '',
            'postingan1' => '',
            'postingan2' => '',
            //End Postingan//

            //Launcher//
            'launchershow' => '',
            'launcher1' => '',
            'launcher2' => '',
            'launcher3' => '',
            //End Launcher//

            //Redeem Code//
            'redeemshow' => '',
            'redem1' => '',
            'redem2' => '',
            //End redeem code//

            //gift item//
            'giftitemshow' => '',
            'giftitem1' => '',
            'giftitem2' => '',
            //gift item//

            //gift cash//
            'giftcashshow' => '',
            'giftcash1' => '',
            'giftcash2' => '',
            //end gift cash//

            //link update//
            'linkupdateshow' => '',
            'linkupdate' => '',
            'linkupdate2' => '',
            //End link update//

            //donate//
            'donateshow' => '',
            'donate1' => '',
            'donate2' => '',
            //End donate//

            //additional//
            'aditionalshow' => '',
            'aditional1' => '',
            'aditional2' => '',
            //End additonal//
            'title' => 'Change Banner Launcher',
            'user' => $this->db->get_where('userMemberDB', ['userID' =>
            $this->session->userdata('userID')])
                ->row_array(),
            'total_users' => $this->db->get_where('userMemberDB')->num_rows(),
            'total_online' => $this->db->get_where('define_game_server', ['serverName' => 'WibuSaga'])->row_array(),
            'banner_launcher' => $this->db->get_where('WibuSaga_BannerLauncher', ['id' => '1'])->row_array()

        ];

        $data['user1'] = $this->db->select('*')
            ->from('userMemberDB')
            ->where('userID', $this->session->userdata('userID'))
            ->join('userMoneyDB', 'userMoneyDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->join('userGameDB', 'userGameDB.accountIDX = userMemberDB.accountIDX', 'left')
            ->get()
            ->row_array();




        $this->load->view('gamemaster/template/header', $data);
        $this->load->view('gamemaster/template/topbar', $data);
        $this->load->view('gamemaster/template/sidebar', $data);
        $this->load->view('gamemaster/menu/launcher/banner_launcher', $data);
        $this->load->view('gamemaster/template/footer', $data);
        $data = [
            $idx = $this->input->post('idx'),
            $banner = $this->input->post('banner')
        ];

        if (empty($banner)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Banner Link Required!</div>');
            base_url('gamemaster/bannerlauncher');
        } else {
            $this->db->set('bannerlauncher', $this->input->post('banner'));
            $this->db->where('id', $idx);
            $this->db->update('WibuSaga_BannerLauncher');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Edit Banner Launcher Success!</div>');
            redirect('gamemaster/bannerlauncher');
        }
    }
}
