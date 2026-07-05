<?php
namespace App\Models;

use Core\Database;

class Service {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll($limit = null) {
        $sql = "SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        return $this->db->fetchAll($sql);
    }
    
    public function getById($id) {
        return $this->db->fetch("SELECT * FROM services WHERE id = ? AND is_active = 1", [$id]);
    }
    
    public function getBySlug($slug) {
        return $this->db->fetch("SELECT * FROM services WHERE slug = ? AND is_active = 1", [$slug]);
    }
    
    public function create($data) {
        return $this->db->insert('services', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('services', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('services', ['id' => $id]);
    }
}
?>