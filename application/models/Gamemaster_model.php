<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gamemaster_model extends CI_Model
//postingan model
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
        $data = $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Postingan')->num_rows();
    }

    public function GetPostingan($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('WibuSaga_Postingan', $limit, $start)->result_array();
    }

    //history redeem
    public function RedeemHistory($limit, $start)
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Code', ['accountIDX' => $data['accountIDX']], $limit, $start)->result_array();
    }

    public function TotalRedeemHistory()
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Code', ['accountIDX' => $data['accountIDX']])->num_rows();
    }

    public function Redeem($limit, $start)
    {

        return $this->db->get('WibuSaga_Code', $limit, $start)->result_array();
    }
    //end of history redeem

    //history giftitem
    public function AllHistoryItem()
    {
        $query = "SELECT WibuSaga_Gift_Item_History.*
FROM WibuSaga_Gift_Item_History
ORDER by date";
        return $this->db->query($query)->result_array();
    }


    public function TotalHistoryItem()
    {
        $data = $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Gift_Item_History')->num_rows();
    }

    public function GetHistoryItem($limit, $start)
    {
        $this->db->order_by('date', 'desc');
        return $this->db->get('WibuSaga_Gift_Item_History', $limit, $start)->result_array();
    }

    //end of giftitem


    //history gift cash
    public function GiftCashHistory($limit, $start)
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        $this->db->order_by('id', 'desc');
        return $this->db->get_where('WibuSaga_Gift_Cash_History', ['accountIDX' => $data['accountIDX']], $limit, $start)->result_array();
    }

    public function TotalGiftCashHistory()
    {
        $data =  $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Gift_Cash_History', ['accountIDX' => $data['accountIDX']])->num_rows();
    }

    public function GiftCash($limit, $start)
    {

        return $this->db->get('WibuSaga_Gift_Cash_History', $limit, $start)->result_array();
    }
    //end of history gift cash

    public function totalBonusCash()
    {
        return $this->db->query("SELECT SUM(bonusCash) as total FROM userMoneyDB");
    }

    public function totalRealCash()
    {
        return $this->db->query("SELECT SUM(realCash) as totalrealcash FROM userMoneyDB");
    }
    // end cash

    //start link download
    public function alllinkdownload()
    {
        $query = "SELECT WibuSaga_Download.*
FROM WibuSaga_Download
ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }


    public function totallinkdownload()
    {
        $data = $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Download')->num_rows();
    }

    public function getlinkdownload($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('WibuSaga_Download', $limit, $start)->result_array();
    }
    //end link download

    //start link donation
    public function alllinkdonation()
    {
        $query = "SELECT WibuSaga_Donate.*
FROM WibuSaga_Donate
ORDER by id DESC";
        return $this->db->query($query)->result_array();
    }


    public function totallinkdonation()
    {
        $data = $this->db->get_where('userMemberDB', ['userID' =>
        $this->session->userdata('userID')])
            ->row_array();
        return $this->db->get_where('WibuSaga_Donate')->num_rows();
    }

    public function getlinkdonation($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get('WibuSaga_Donate', $limit, $start)->result_array();
    }
    //end link donation
}
