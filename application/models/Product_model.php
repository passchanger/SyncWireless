<?php
class Product_model extends CI_Model
{
    public function getProducts()
    {
        $this->db->select('products.*, brands.name as brand_name, models.name as model_name');
        $this->db->from('products');
        $this->db->join('brands', 'products.brand_id = brands.id', 'left');
        $this->db->join('models', 'products.model_id = models.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_product($data)
    {
        $query = $this->db->insert('products', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function insert_pv($params)
    {
        $query = $this->db->insert('product_variations', $params);
        if ($query) {
            return true;
        } else {
            return false;
        }
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

    public function delete_pv($id)
    {
        $this->db->where('product_id', $id);
        return $this->db->delete('product_variations');
    }
}
