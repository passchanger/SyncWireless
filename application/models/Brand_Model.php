<?php
class Brand_Model extends CI_Model
{
    public function getALLProducts()
    {
        $query = $this->db->get('brands');
        if ($query) {
            return $query->result();
        }
    }
    public function insert_Brand($data)
    {
        $query = $this->db->insert('brands', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleBrand($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('brands');
        if ($query) {
            return $query->row();
        }
    }
    public function update_Brand($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('brands', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('brands');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
