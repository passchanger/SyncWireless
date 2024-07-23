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
    public function getUserByEmail($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
    public function updateToken($userId, $token)
    {
        $this->db->where('id', $userId);
        $this->db->update('users', ['token' => $token]);
    }
}
