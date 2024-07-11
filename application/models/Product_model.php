<?php
class Product_model extends CI_Model
{
    public function getProducts(){
        $this->db->select('products.*, brands.name as brand_name, models.name as model_name');
        $this->db->from('products');
        $this->db->join('brands', 'products.brand_id = brands.id', 'left');
        $this->db->join('models', 'products.model_id = models.id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getProductsByModelId($id){
        $this->db->select('products.id, products.image, products.name, products.price, brands.name as brand_name, models.name as model_name');
        $this->db->from('products');
        $this->db->join('brands', 'products.brand_id = brands.id', 'left');
        $this->db->join('models', 'products.model_id = models.id', 'left');
        $this->db->where('products.model_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getActiveProductWithVariations($id){
        $query = $this->db->select('products.*, brands.name as brand_name, models.name as model_name, product_variations.*')
            ->from('products')
            ->join('brands', 'products.brand_id = brands.id', 'left')
            ->join('models', 'products.model_id = models.id', 'left')
            ->join('product_variations', 'products.id = product_variations.product_id', 'left')
            ->where('products.id', $id)
            ->where('products.status', 'active')
            ->where('product_variations.status', 'active')
            ->get();

        return $query->result();
    }

    public function insert_product($data){
        $query = $this->db->insert('products', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function insert_pv($params){
        $query = $this->db->insert('product_variations', $params);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleProduct($id){
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        return $query->row();
    }

    public function update_product($data, $id){
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function delete_product($id){
        $this->db->where('id', $id);
        return $this->db->delete('products');
    }

    public function delete_pv($id){
        $this->db->where('product_id', $id);
        return $this->db->delete('product_variations');
    }

    public function getModelsByBrand($brand_id)
    {
        $this->db->select('id, name');
        $this->db->where('brand_id', $brand_id);
        $query = $this->db->get('models');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return [];
        }
    }
}
