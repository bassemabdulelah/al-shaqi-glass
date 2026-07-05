<?php
namespace App\Models;

use Core\Database;

class Setting {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function get($key = null) {
        if ($key) {
            $result = $this->db->fetch("SELECT * FROM settings WHERE id = 1");
            return $result[$key] ?? null;
        }
        return $this->db->fetch("SELECT * FROM settings LIMIT 1");
    }
    
    public function getAll() {
        return $this->db->fetch("SELECT * FROM settings LIMIT 1");
    }
    
    public function update($data) {
        return $this->db->update('settings', $data, ['id' => 1]);
    }
    
    public function getSiteName() {
        return $this->get('site_name') ?? 'الشاقي للزجاج السكريت';
    }
    
    public function getPhone() {
        return $this->get('phone') ?? '+966 50 000 0000';
    }
    
    public function getWhatsapp() {
        return $this->get('whatsapp') ?? '+966 50 000 0000';
    }
    
    public function getEmail() {
        return $this->get('email') ?? 'info@al-shaqi.com';
    }
}
?>