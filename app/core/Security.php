<?php
namespace Core;

class Security {
    // منع هجمات XSS
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }
        return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
    }
    
    // منع هجمات SQL Injection (يتم عبر PDO بالفعل)
    public static function validateInput($data, $type = 'string') {
        switch ($type) {
            case 'email':
                return filter_var($data, FILTER_VALIDATE_EMAIL);
            case 'int':
                return filter_var($data, FILTER_VALIDATE_INT);
            case 'float':
                return filter_var($data, FILTER_VALIDATE_FLOAT);
            case 'url':
                return filter_var($data, FILTER_VALIDATE_URL);
            case 'phone':
                return preg_match('/^(05|5)[0-9]{8}$/', preg_replace('/[^0-9]/', '', $data));
            default:
                return self::sanitizeInput($data);
        }
    }
    
    // توليد رمز CSRF
    public static function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    // التحقق من CSRF
    public static function validateCsrfToken($token) {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    // توليد رمز عشوائي
    public static function generateToken($length = 32) {
        return bin2hex(random_bytes($length));
    }
    
    // تشفير كلمة المرور
    public static function hashPassword($password) {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
    
    // التحقق من كلمة المرور
    public static function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }
    
    // توليد مفتاح فريد
    public static function generateUniqueKey($length = 16) {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
    
    // التحقق من البريد الإلكتروني
    public static function isValidEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    // التحقق من رقم الجوال السعودي
    public static function isValidSaudiPhone($phone) {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        return preg_match('/^(05|5)[0-9]{8}$/', $phone);
    }
    
    // منع هجمات Rate Limiting
    public static function checkRateLimit($key, $limit = 60, $timeWindow = 60) {
        $sessionKey = 'rate_limit_' . $key;
        $timestampKey = 'rate_limit_time_' . $key;
        
        if (!isset($_SESSION[$sessionKey])) {
            $_SESSION[$sessionKey] = 1;
            $_SESSION[$timestampKey] = time();
            return true;
        }
        
        if (time() - $_SESSION[$timestampKey] > $timeWindow) {
            $_SESSION[$sessionKey] = 1;
            $_SESSION[$timestampKey] = time();
            return true;
        }
        
        if ($_SESSION[$sessionKey] >= $limit) {
            return false;
        }
        
        $_SESSION[$sessionKey]++;
        return true;
    }
    
    // الحصول على عنوان IP الحقيقي
    public static function getClientIP() {
        $ip = $_SERVER['REMOTE_ADDR'];
        if (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : '0.0.0.0';
    }
}
?>