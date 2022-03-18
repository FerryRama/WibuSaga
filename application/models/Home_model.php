<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function AllPostingan()
    {
        $query = "SELECT WibuSaga_Postingan.*
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
        $query = "SELECT TOP 3 WibuSaga_Postingan.*
        FROM WibuSaga_Postingan
        ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }

    public function CategoryHome()
    {
        $query = "SELECT TOP 5 WibuSaga_Postingan.*
        FROM WibuSaga_Postingan WHERE tags = '3'
        ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }
}
