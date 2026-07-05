<?php
namespace App\Models;

use Core\Database;

class Testimonial {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll($limit = null) {
        $sql = "SELECT * FROM testimonials WHERE is_active = 1 ORDER BY sort_order";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        return $this->db->fetchAll($sql);
    }
    
    public function getById($id) {
        return $this->db->fetch("SELECT * FROM testimonials WHERE id = ? AND is_active = 1", [$id]);
    }
    
    public function getRandom($limit = 3) {
        return $this->db->fetchAll(
            "SELECT * FROM testimonials WHERE is_active = 1 ORDER BY RAND() LIMIT ?",
            [$limit]
        );
    }
    
    public function create($data) {
        return $this->db->insert('testimonials', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('testimonials', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('testimonials', ['id' => $id]);
    }
}
?>