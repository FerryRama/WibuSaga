<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->model('M_user', 'user');
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
        $username = htmlspecialchars($this->get('username'));
        $password = htmlspecialchars($this->get('password'));
        $account = $this->db->get_where('userMemberDB', ['userID' => $username])->row_array();

        if ($account) {
            if (password_verify($password, $account['userPWD'])) {

                $game = [
                    'userState'     => '-1',
                ];
                $session = [
                    'connDate'      => (new \DateTime())->format('Y-m-d H:i:s')
                ];

                $verif = [
                    'verify'      => 'verify',
                ];

                $accountIDX = $account['accountIDX'];


                $where = [
                    'accountIDX'    => $account['accountIDX']
                ];
                $this->db->query("exec FIX_EXPIRED_KEY 
                @userNum = '$accountIDX'");
                $this->user->update_login($game, $where);
                //$this->user->update_sess($session, $where);
                //$this->user->update_session($where);
                $this->user->update_veriff($verif, $where);
                $this->response([
                    'status'    => true,
                    'data' => [
                        'accountidx' => $account['accountIDX'],
                        'username' => $account['userID'],
                        'connDate' => (new \DateTime())->format('Y-m-d H:i:s'),
                        'status_verify' => $account['verify'],
                    ]

                ], 200);
            } else {

                $this->response([
                    'status'    => false,
                ], 404);
            }
        } else {
            $this->response([
                'status'    => false,

            ], 403);
        }
    }



    public function server_get()
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

    public function wibukeys_get()
    {
        $query2 = $this->db->query("SELECT IDENT_CURRENT('WibuSaga_ApiKeys') as last_id")->result();
        $res = htmlspecialchars($query2[0]->last_id);

        $server =  $this->user->get_api($res);

        if ($server) {
            echo base64_encode($server->WibuApiKeys);
        } else {
            $this->response([
                'status'    => false,
            ], 403);
        }
    }
}
