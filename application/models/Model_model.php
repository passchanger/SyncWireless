<?php
class Model_model extends CI_Model
{
    public function getALLModels()
    {
        $this->db->select('models.*, brands.name AS brand_name');
        $this->db->from('models');
        $this->db->join('brands', 'models.brand_id = brands.id');
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        }
    }

    public function getActiveModels($id)
    {
        $this->db->select('models.id, models.name, models.date_added');
        $this->db->from('models');
        $this->db->where('models.brand_id', $id);
        $this->db->join('brands', 'models.brand_id = brands.id', 'left');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function getModelsByBrand($brand_id)
    {
        $this->db->where('brand_id', $brand_id);
        $query = $this->db->get('models');
        return $query->result_array();
    }


    public function insert_Model($data)
    {
        $query = $this->db->insert('models', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleModel($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('models');
        if ($query) {
            return $query->row();
        }
    }
    public function update_Model($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('models', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->load->model('Model_model');
        $this->db->where('id', $id);
        $query = $this->db->delete('models');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
