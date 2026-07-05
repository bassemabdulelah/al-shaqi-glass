<?php
namespace App\Models;

use Core\Database;

class Project {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function getAll($limit = null) {
        $sql = "SELECT p.*, s.title as service_title 
                FROM projects p 
                LEFT JOIN services s ON p.service_id = s.id 
                WHERE p.is_active = 1 
                ORDER BY p.sort_order DESC";
        if ($limit) {
            $sql .= " LIMIT " . intval($limit);
        }
        return $this->db->fetchAll($sql);
    }
    
    public function getFeatured($limit = 4) {
        return $this->db->fetchAll(
            "SELECT * FROM projects WHERE is_active = 1 AND is_featured = 1 ORDER BY sort_order LIMIT ?",
            [$limit]
        );
    }
    
    public function getById($id) {
        return $this->db->fetch(
            "SELECT p.*, s.title as service_title 
             FROM projects p 
             LEFT JOIN services s ON p.service_id = s.id 
             WHERE p.id = ? AND p.is_active = 1",
            [$id]
        );
    }
    
    public function getBySlug($slug) {
        return $this->db->fetch(
            "SELECT p.*, s.title as service_title 
             FROM projects p 
             LEFT JOIN services s ON p.service_id = s.id 
             WHERE p.slug = ? AND p.is_active = 1",
            [$slug]
        );
    }
    
    public function getImages($projectId) {
        return $this->db->fetchAll(
            "SELECT * FROM project_images WHERE project_id = ? ORDER BY sort_order",
            [$projectId]
        );
    }
    
    public function getByLocation($location) {
        return $this->db->fetchAll(
            "SELECT * FROM projects WHERE location LIKE ? AND is_active = 1 ORDER BY sort_order",
            ['%' . $location . '%']
        );
    }
    
    public function create($data) {
        return $this->db->insert('projects', $data);
    }
    
    public function update($id, $data) {
        return $this->db->update('projects', $data, ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('projects', ['id' => $id]);
    }
    
    public function addImage($data) {
        return $this->db->insert('project_images', $data);
    }
    
    public function deleteImage($id) {
        return $this->db->delete('project_images', ['id' => $id]);
    }
}
?>