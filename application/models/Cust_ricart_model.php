<?php
class Cust_ricart_model extends CI_Model
{

    public function getCustomerDetails()
    {
        $query = $this->db->get('cust_ricart');
        if ($query) {
            return $query->result();
        }
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('cust_ricart');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
