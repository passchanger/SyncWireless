<?php
class VariantCategory_model extends CI_Model
{

    public function getVariationCat()
    {
        $query = $this->db->get('variation_cat');
        if ($query) {
            return $query->result();
        }
    }
    public function insert_VariationCat($data)
    {
        $query = $this->db->insert('variation_cat', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleVariationCat($id)
    {

        $this->db->where('id', $id);
        $query =  $this->db->get('variation_cat');
        if ($query) {
            return $query->row();
        }
    }
    public function update_VariationCat($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('variation_cat', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('variation_cat');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
