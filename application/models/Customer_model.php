<?php
class Customer_model extends CI_Model
{

    public function getCustomer()
    {
        $query = $this->db->get('customers');
        if ($query) {
            return $query->result();
        }
    }

    public function getSingleCustomer($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('customers');
        if ($query) {
            return $query->row();
        }
    }

    public function update_customers($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('customers', $data);
        return $query ? true : false;
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('customers');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getCustomerByEmail($email)
    {
        return $this->db->get_where('customers', array('email' => $email))->row();
    }

    public function getCustomerById($customerId)
    {
        $this->db->select('customers.id, customers.name, customers.email, customers.mobile, customers.token, customers.status, customers.updated_at, cust_addresses.country, cust_addresses.state, cust_addresses.city, cust_addresses.pincode');
        $this->db->from('customers');
        $this->db->join('cust_addresses', 'customers.id = cust_addresses.customer_id', 'left');
        $this->db->where('customers.id', $customerId);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert_customer($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }
    public function getCustomerByToken($token)
    {
        $query = $this->db->get_where('customers', array('token' => $token));
        return $query->row();
    }
}
