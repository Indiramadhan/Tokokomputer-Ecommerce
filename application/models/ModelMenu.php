<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMenu extends CI_Model
{
    public function getSubMenu()
    {
        $query = "SELECT `tb_user_sub_menu`.*, `tb_user_menu`.`menu` FROM `tb_user_sub_menu` JOIN `tb_user_menu` ON `tb_user_sub_menu`.`menu_id` = `tb_user_menu`.`id`";
        return $this->db->query($query)->result_array();
    }
}
