<?php
class Setting_Model extends CI_Model
{
    public function getALLSettings()
    {
        $query = $this->db->get('settings');
        if ($query) {
            return $query->result();
        }
    }
    public function insert_Setting($data)
    {
        $query = $this->db->insert('settings', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSinglSetting($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('settings');
        if ($query) {
            return $query->row();
        }
    }
    public function update_Setting($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('settings', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('settings');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
