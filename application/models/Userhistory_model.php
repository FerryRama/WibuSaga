<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Userhistory_model extends CI_Model
{
    public function TopRank()
    {
        $query = "SELECT TOP 10 userGameDB.*, userMemberDB.*
        FROM userGameDB JOIN userMemberDB
        ON userGameDB.accountIDX = userMemberDB.accountIDX
        Order by userEXP DESC";
        return $this->db->query($query)->result_array();
    }

    //history cash
    public function CashHistory($limit, $start)
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_cash_History', ['accountIDX' => $data['accountIDX']], $limit, $start)->result_array();
    }

    public function totalcash()
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_cash_History', ['accountIDX' => $data['accountIDX']])->num_rows();
    }

    public function Cash($limit, $start)
    {

        return $this->db->get('WibuSaga_cash_History', $limit, $start)->result_array();
    }
    //end of history cash

    //history redeem
    public function RedeemHistory($limit, $start)
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Redeem_History', ['accountIDX' => $data['accountIDX']], $limit, $start)->result_array();
    }

    public function TotalRedeem()
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Redeem_History', ['accountIDX' => $data['accountIDX']])->num_rows();
    }

    public function Redeem($limit, $start)
    {

        return $this->db->get('WibuSaga_Redeem_History', $limit, $start)->result_array();
    }
    //end of history
}
