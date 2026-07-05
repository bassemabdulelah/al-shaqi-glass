<?php
// توليد رمز CSRF
function generateCsrfToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// التحقق من CSRF
function validateCsrfToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

// تنقية المدخلات
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}

// التحقق من البريد الإلكتروني
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// التحقق من رقم الجوال (سعودي)
function validatePhone($phone) {
    $phone = preg_replace('/[^0-9]/', '', $phone);
    return preg_match('/^(05|5)[0-9]{8}$/', $phone);
}

// إرسال إشعار إلى التليجرام (اختياري)
function sendTelegramNotification($message) {
    // يمكن إضافة توكن التليجرام هنا
    return true;
}

// تسجيل الأخطاء
function logError($message, $file = 'errors.log') {
    $log = date('Y-m-d H:i:s') . ' - ' . $message . PHP_EOL;
    file_put_contents(__DIR__ . '/../../logs/' . $file, $log, FILE_APPEND);
}
?>