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
        $this->db->where('token', $token);
        $query = $this->db->get('customers');
        return $query->row();
    }

    public function insertOrder($data)
    {
        return $this->db->insert('cust_riorders', $data); // Adjust table name as needed
    }


    public function updateOrder($order_id, $data)
    {
        // Ensure order_id and data are provided
        if (empty($order_id) || empty($data)) {
            return false;
        }

        // Update the order record
        $this->db->where('id', $order_id);
        return $this->db->update('cust_riorders', $data); // Adjust table name as needed
    }

    public function deleteCartItem($customer_id, $cart_id)
    {
        // Check if parameters are provided
        if (empty($customer_id) || empty($cart_id)) {
            return false;
        }

        // Perform deletion
        $this->db->where('customer_id', $customer_id);
        $this->db->where('id', $cart_id);
        return $this->db->delete('cust_ricart'); // Adjust the table name as needed
    }
    public function deleteCartItemsByCustomerID($customer_id)
    {
        // Check if parameter is provided
        if (empty($customer_id)) {
            return false;
        }

        // Perform deletion
        $this->db->where('customer_id', $customer_id);
        return $this->db->delete('cust_ricart'); // Adjust the table name as needed
    }
}
