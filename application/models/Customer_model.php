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
    public function getCustomerById($id, $fields = array('id', 'name', 'email', 'mobile', 'token', 'status', 'updated_at'))
    {
        return $this->db->select($fields)
            ->from('customers')
            ->where('id', $id)
            ->get()
            ->row();
    }

    public function insert_customer($data)
    {
        $this->db->insert('customers', $data);
        return $this->db->insert_id();
    }
}
