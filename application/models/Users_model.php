<?php
class Users_model extends CI_Model
{

    public function getUser()
    {
        $query = $this->db->get('users');
        if ($query) {
            return $query->result();
        }
    }
    public function insert_users($data)
    {
        $query = $this->db->insert('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleUser($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('users');
        if ($query) {
            return $query->row();
        }
    }

    public function update_users($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('users');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
