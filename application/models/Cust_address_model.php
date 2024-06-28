<?php
class Cust_address_model extends CI_Model
{
    public function getCustomerAdd()
    {
        $this->db->select('cust_addresses.*, customers.name AS customer_name');
        $this->db->from('cust_addresses');
        $this->db->join('customers', 'cust_addresses.customer_id = customers.id', 'left');
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        }
    }
    public function getSingleCustomerAdd($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('cust_addresses');
        if ($query) {
            return $query->row();
        }
    }

    public function update_customersadd($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('cust_addresses', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('cust_addresses');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
