<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Modeluser extends CI_Model
{
    function getDetail($email, $password)
    {;
        $sql    = "SELECT * FROM tb_client where email='$email' and password='$password'";
        $query  = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
