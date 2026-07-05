<?php
namespace App\Models;

use Core\Database;

class Contact {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function create($data) {
        $data['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return $this->db->insert('contacts', $data);
    }
    
    public function getAll($status = null) {
        $sql = "SELECT * FROM contacts";
        if ($status) {
            $sql .= " WHERE status = '" . $status . "'";
        }
        $sql .= " ORDER BY created_at DESC";
        return $this->db->fetchAll($sql);
    }
    
    public function getById($id) {
        return $this->db->fetch("SELECT * FROM contacts WHERE id = ?", [$id]);
    }
    
    public function getUnread() {
        return $this->db->fetchAll("SELECT * FROM contacts WHERE status = 'new' ORDER BY created_at DESC");
    }
    
    public function markAsRead($id) {
        return $this->db->update('contacts', ['status' => 'read'], ['id' => $id]);
    }
    
    public function markAsReplied($id) {
        return $this->db->update('contacts', ['status' => 'replied'], ['id' => $id]);
    }
    
    public function delete($id) {
        return $this->db->delete('contacts', ['id' => $id]);
    }
    
    public function countUnread() {
        $result = $this->db->fetch("SELECT COUNT(*) as count FROM contacts WHERE status = 'new'");
        return $result['count'] ?? 0;
    }
}
?>