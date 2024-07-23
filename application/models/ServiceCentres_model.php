<?php
class ServiceCentres_model extends CI_Model
{
    public function getALLService()
    {
        $query = $this->db->get('service_centres');
        if ($query) {
            return $query->result();
        }
    }
    public function getServiceById($id)
    {
        $query = $this->db->get_where('service_centers', array('id' => $id));
        return $query->row();
    }

    public function insert_Service($data)
    {
        $query = $this->db->insert('service_centres', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleService($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('service_centres');
        if ($query) {
            return $query->row();
        }
    }
    public function update_Service($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('service_centres', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteitems($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->delete('service_centres');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function getServiceCentresByExactLocation($latitude, $longitude)
    {
        $this->db->select('*');
        $this->db->from('service_centres');
        $this->db->where('latitude', $latitude);
        $this->db->where('longitude', $longitude);

        $query = $this->db->get();
        return $query->result();
    }
}
