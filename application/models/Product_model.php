<?php
class Product_model extends CI_Model
{
    public function getProducts()
    {
        $query = $this->db->get('products');
        return $query->result();
    }

    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }

    public function getSingleProduct($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row();
    }

    public function update_product($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }
}
