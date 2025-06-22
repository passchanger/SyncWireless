<?php
class Order_Model extends CI_Model
{
    protected $table = 'repairing_orders';
    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }
    public function get($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }
    public function save($data)
    {
        if (isset($data['id'])) {
            $this->db->update($this->table, $data, ['id' => $data['id']]);
        } else {
            $this->db->insert($this->table, $data);
        }
    }
    public function delete($id)
    {
        $this->db->delete($this->table, ['id' => $id]);
    }
}
