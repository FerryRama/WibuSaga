<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class server extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('M_server', 'user');
    }

    public function index()
    {
        $this->load->view('welcome_message');
    }

    // public function member_get()
    // {
    //     $user = $this->get('userID');

    //     if ($user === null) {

    //         $member = $this->user->getUser();
    //     } else {
    //         $member = $this->user->getUser($user);
    //     }

    //     if ($member) {
    //         $this->response([
    //             'status'    => true,

    //         ], 200);
    //     } else {
    //         $this->response([
    //             'status'    => false,
    //         ], 404);
    //     }
    // }

    public function index_get()
    {
        $query2 = $this->db->query("SELECT IDENT_CURRENT('define_game_server') as last_id")->result();
        $res = htmlspecialchars($query2[0]->last_id);

        $servergame =  $this->user->get_id($res);

        if ($servergame) {
            $this->response([
                'status'    => true,
                'data'      => base64_encode($servergame->serverID)

            ], 200);
        } else {
            $this->response([
                'status'    => false,
            ], 403);
        }
    }
}
