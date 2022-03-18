<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Downdon_model extends CI_Model
{
    public function download()
    {
        $query = "SELECT WibuSaga_Download.*
        FROM WibuSaga_Download ";
        return $this->db->query($query)->result_array();
    }

    public function donation()
    {
        $query = "SELECT WibuSaga_Donate.*
        FROM WibuSaga_Donate ";
        return $this->db->query($query)->result_array();
    }
}
