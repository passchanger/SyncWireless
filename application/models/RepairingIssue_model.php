<?php
class RepairingIssue_model extends CI_Model
{
    public function getRepair()
    {
        $query = $this->db->get('repairing_issues');
        if ($query) {
            return $query->result();
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
}
