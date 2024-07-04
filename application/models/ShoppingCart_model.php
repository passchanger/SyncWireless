<?php
class ShoppingCart_model extends CI_Model
{
    public function getCartDetails()
    {
        $this->db->select('sc.id, c.name as customer_name, p.name as product_name, v.name as variation_name, sc.disc_price, sc.status, sc.date_added')
            ->from('shopping_cart sc')
            ->join('customers c', 'sc.customer_id = c.id', 'left')
            ->join('products p', 'sc.product_id = p.id', 'left')
            ->join('variation v', 'sc.variation_id = v.id', 'left')
            ->where('sc.status', 'active');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function deleteItem($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('shopping_cart');
    }
}
