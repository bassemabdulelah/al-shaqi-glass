<?php
// توليد عنوان الصفحة المحسن
function generatePageTitle($title, $siteName = 'الشاقي للزجاج السكريت') {
    return $title . ' | ' . $siteName;
}

// توليد الوصف الميتا
function generateMetaDescription($description, $maxLength = 160) {
    if (strlen($description) > $maxLength) {
        $description = substr($description, 0, $maxLength - 3) . '...';
    }
    return $description;
}

// توليد كلمات مفتاحية
function generateKeywords($keywords = []) {
    return implode(', ', $keywords);
}

// توليد رابط الكنسي
function canonicalUrl($url = null) {
    if ($url === null) {
        $url = (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }
    return $url;
}
?>