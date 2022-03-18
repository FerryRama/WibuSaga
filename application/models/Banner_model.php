<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banner_model extends CI_Model
{
    public function AllPostingan()
    {
        $query = "SELECT TOP 4 WibuSaga_Postingan.*
        FROM WibuSaga_Postingan
        ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }


    public function TotalPostingan()
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Postingan')->num_rows();
    }

    public function GetPostingan($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('WibuSaga_Postingan', $limit, $start)->result_array();
    }
    //end of history

    // 3 header

    public function SliderPostingan()
    {
        $query = "SELECT TOP 8 WibuSaga_Postingan.*
        FROM WibuSaga_Postingan
        ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }

    public function CategoryHome()
    {
        $query = "SELECT TOP 4 WibuSaga_Postingan.*
        FROM WibuSaga_Postingan WHERE tags = '3'
        ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }

    public function StatusLaunchers()
    {
        $query = "SELECT * FROM define_game_server WHERE serverName = 'WibuSaga'";
        return $this->db->query($query)->result_array();
    }
    public function bannerimage()
    {
        $query = "SELECT * FROM WibuSaga_BannerLauncher WHERE id = '1'";
        return $this->db->query($query)->result_array();
    }
}
