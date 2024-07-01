<?php
class Shopping_cart_model extends CI_Model
{
    public function getCartDetails()
    {
        $query = $this->db->get('shopping_cart');
        return $query->result();
    }

    public function deleteItem($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('shopping_cart');
    }
}
