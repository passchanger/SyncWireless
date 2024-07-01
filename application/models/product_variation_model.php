<?php
class Product_variation_model extends CI_Model
{
    public function getProductVariations()
    {
        $query = $this->db->get('product_variations');
        if ($query) {
            return $query->result();
        }
    }

    public function insertProductVariation($data)
    {
        $query = $this->db->insert('product_variations', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleProductVariation($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('product_variations');
        if ($query) {
            return $query->row();
        }
    }

    public function updateProductVariation($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('product_variations', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProductVariation($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('product_variations');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
