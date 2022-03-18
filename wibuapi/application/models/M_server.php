<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_server extends CI_Model
{

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
}

/* End of file M_user.php */
