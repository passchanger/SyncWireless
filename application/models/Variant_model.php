<?php
class Variant_model extends CI_Model
{

    public function getVariation()
    {
        $this->db->select('variation.*, variation_cat.name AS Category_name');
        $this->db->from('variation');
        $this->db->join('variation_cat', 'variation.cat_id = variation_cat.id', 'left');
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        }
    }

    public function insert_variation($data)
    {
        $query = $this->db->insert('variation', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function update_variation($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('variation', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('variation');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
