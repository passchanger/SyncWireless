<?php
class Storage_model extends CI_Model
{

    public function getStorage()
    {
        $query = $this->db->get('storages');
        if ($query) {
            return $query->result();
        }
    }
    public function insert_storage($data)
    {
        $query = $this->db->insert('storages', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleStorage($id)
    {

        $this->db->where('id', $id);
        $query =  $this->db->get('storages');
        if ($query) {
            return $query->row();
        }
    }
    public function update_Storage($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('storages', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('storages');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
