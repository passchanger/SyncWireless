<?php
class Ram_model extends CI_Model
{

    public function getRam()
    {
        $query = $this->db->get('rams');
        if ($query) {
            return $query->result();
        }
    }

    public function insert_ram($data)
    {
        $query = $this->db->insert('rams', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleRam($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('rams');
        if ($query) {
            return $query->row();
        }
    }

    public function update_ram($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('rams', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('rams');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
