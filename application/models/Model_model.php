<?php
class Model_model extends CI_Model
{
    public function getALLModels()
    {
        $query = $this->db->get('model');
        if ($query) {
            return $query->result();
        }
    }
    public function insert_Model($data)
    {
        $query = $this->db->insert('model', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleModel($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('model');
        if ($query) {
            return $query->row();
        }
    }
    public function update_Model($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('model', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->load->model('Model_model');
        $this->db->where('id', $id);
        $query = $this->db->delete('model');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
