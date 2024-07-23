<?php
class RepairingIssue_model extends CI_Model
{
    public function getRepair()
    {
        $this->db->select('repairing_issues.*, brands.name AS brand_name,models.name as model_name');
        $this->db->from('repairing_issues');
        $this->db->join('brands', 'repairing_issues.brand_id = brands.id');
        $this->db->join('models', 'repairing_issues.model_id = models.id');
        $query = $this->db->get();
        if ($query) {
            return $query->result();
        }
    }

    public function getActiveRepairingIssues()
    {
        $query = $this->db->select('repairing_issues.id, repairing_issues.issue_name, repairing_issues.issue_price')
            ->where('repairing_issues.status', 'active')
            ->join('models', 'repairing_issues.model_id = models.id', 'left')
            ->get('repairing_issues');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getAllRepairingIssues()
    {
        $query = $this->db->get('repairing_issues');
        if ($query) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function insert_issue($data)
    {
        $query = $this->db->insert('repairing_issues', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleRepair($id)
    {
        $this->db->where('id', $id);
        $query =  $this->db->get('repairing_issues');
        if ($query) {
            return $query->row();
        }
    }
    public function update_issue($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('repairing_issues', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('repairing_issues');
        if ($query) {
            return true;
        } else {
            return false;
        }
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
