<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Toprank_model extends CI_Model
{
    public function TopRank()
    {
        $query = "SELECT TOP 10 userGameDB.*, userMemberDB.*
        FROM userGameDB JOIN userMemberDB
        ON userGameDB.accountIDX = userMemberDB.accountIDX
        Order by userEXP DESC";
        return $this->db->query($query)->result_array();
    }

    public function TopRankGuild()
    {
        $query = "SELECT TOP 10 userGuildDB.*
        FROM userGuildDB
        ORDER by ranking";
        return $this->db->query($query)->result_array();
    }
}
