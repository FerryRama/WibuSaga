<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

    public function update_login($game, $where)
    {
        $this->db->where($where);
        $this->db->update('userGameDB', $game);
    }

    public function update_sess($session, $where)
    {
        $this->db->where($where);
        $this->db->update('userLoginDB', $session);
    }


    public function update_veriff($verif, $where)
    {
        $this->db->where($where);
        $this->db->update('userMemberDB', $verif);
    }

    public function get_id($res)
    {
        $query = $this->db->select('*')
            ->from('define_game_server')
            ->where('idx', $res)
            ->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }

    public function get_api($res)
    {
        $query = $this->db->select('*')
            ->from('WibuSaga_ApiKeys')
            ->where('idx', $res)
            ->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }
    }
}

/* End of file M_user.php */
