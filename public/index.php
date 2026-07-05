<?php
// بدء الجلسة
session_start();

// تحميل الإعدادات الأساسية
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/helpers/functions.php';
require_once __DIR__ . '/../app/helpers/seo.php';

use Core\Database;

$db = Database::getInstance();

// جلب البيانات من قاعدة البيانات
$services = $db->fetchAll("SELECT * FROM services WHERE is_active = 1 ORDER BY sort_order LIMIT 6");
$projects = $db->fetchAll("SELECT * FROM projects WHERE is_active = 1 ORDER BY sort_order DESC LIMIT 8");
$testimonials = $db->fetchAll("SELECT * FROM testimonials WHERE is_active = 1 ORDER BY sort_order LIMIT 6");
$faqs = $db->fetchAll("SELECT * FROM faqs WHERE is_active = 1 ORDER BY sort_order LIMIT 8");
$settings = $db->fetch("SELECT * FROM settings LIMIT 1");

// متغيرات SEO
$page_title = $settings['meta_title'] ?? 'الشاقي للزجاج السكريت - رواد تركيب الزجاج في الرياض';
$page_description = $settings['meta_description'] ?? 'أفضل شركة زجاج سكريت في الرياض - تركيب واجهات، درابزين، شورات، قصور وفيلات - خبرة ١٠ سنوات وأكثر من ١٥٠ مشروعاً منفذاً';
$page_keywords = $settings['meta_keywords'] ?? 'زجاج سكريت الرياض، تركيب زجاج، واجهات زجاجية، درابزين زجاج، شورات زجاجية، قصور، فلل، الرياض';
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    
    <!-- SEO -->
    <title><?php echo htmlspecialchars($page_title); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords); ?>">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://al-shaqi.com">
    <meta property="og:image" content="https://al-shaqi.com/assets/images/og-image.jpg">
    <meta property="og:site_name" content="الشاقي للزجاج السكريت">
    
    <!-- Schema.org (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "الشاقي للزجاج السكريت",
        "description": "شركة متخصصة في تركيب الزجاج السكريت في الرياض",
        "image": "https://al-shaqi.com/assets/images/logo.png",
        "telephone": "<?php echo htmlspecialchars($settings['phone'] ?? '+966500000000'); ?>",
        "email": "<?php echo htmlspecialchars($settings['email'] ?? 'info@al-shaqi.com'); ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "الرياض",
            "addressCountry": "SA"
        },
        "geo": {
            "@type": "GeoCoordinates",
            "latitude": "24.7136",
            "longitude": "46.6753"
        },
        "openingHours": "Sa-Th 08:00-20:00",
        "priceRange": "$$"
    }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&family=Noto+Sans+Arabic:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    
    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    
    <!-- Lightbox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css">
    
    <!-- التصميم الرئيسي -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico">
</head>
<body>

<!-- ============================================ -->
<!-- 1. شريط التنقل العلوي (Sticky Navbar)        -->
<!-- ============================================ -->
<nav class="navbar" id="navbar">
    <div class="container">
        <div class="nav-brand">
            <a href="#home">
                <img src="assets/images/logo.png" alt="الشاقي للزجاج السكريت" class="logo" onerror="this.src='assets/images/logo-placeholder.png'">
            </a>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#home">الرئيسية</a></li>
                <li><a href="#services">خدماتنا</a></li>
                <li><a href="#projects">مشاريعنا</a></li>
                <li><a href="#testimonials">آراء العملاء</a></li>
                <li><a href="#faq">الأسئلة الشائعة</a></li>
                <li><a href="#contact">اتصل بنا</a></li>
            </ul>
        </div>
        <div class="nav-actions">
            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '966500000000'); ?>" 
               class="btn-whatsapp" target="_blank">
                <i class="fab fa-whatsapp"></i>
            </a>
            <a href="tel:<?php echo htmlspecialchars($settings['phone'] ?? '+966500000000'); ?>" 
               class="btn-phone">
                <i class="fas fa-phone"></i>
            </a>
            <button class="nav-toggle" id="navToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</nav>

<!-- ============================================ -->
<!-- 2. Hero Section (المقدمة البصرية)            -->
<!-- ============================================ -->
<section class="hero" id="home">
    <div class="hero-overlay"></div>
    <div class="hero-bg">
        <video autoplay loop muted playsinline poster="assets/images/hero-poster.jpg">
            <source src="assets/videos/hero-bg.mp4" type="video/mp4">
            <source src="assets/videos/hero-bg.webm" type="video/webm">
        </video>
    </div>
    <div class="container hero-content" data-aos="fade-up">
        <div class="hero-badge">
            <i class="fas fa-crown"></i>
            خبرة أكثر من ١٠ سنوات
        </div>
        <h1>لمسات من الزجاج...<br>تحوّل مبناك إلى <span>تحفة معمارية</span></h1>
        <p>نحن في <strong>الشاقي للزجاج السكريت</strong> نصنع الجمال والثقة، نركب أفخم أنواع الزجاج السكريت للقصور والفلل والمباني الحديثة في الرياض</p>
        <div class="hero-buttons">
            <a href="#contact" class="btn-primary">
                <i class="fas fa-paper-plane"></i>
                اطلب استشارة مجانية
            </a>
            <a href="#projects" class="btn-secondary">
                <i class="fas fa-images"></i>
                شاهد أعمالنا
            </a>
        </div>
        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-number" data-count="150">0</span>
                <span class="stat-label">مشروعاً منفذاً</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-count="50">0</span>
                <span class="stat-label">عميلاً من الشركات</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-count="10">0</span>
                <span class="stat-label">سنوات من الخبرة</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-count="15">0</span>
                <span class="stat-label">حي في الرياض</span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 3. شريط الثقة (Trust Bar)                   -->
<!-- ============================================ -->
<section class="trust-bar" data-aos="fade-up">
    <div class="container">
        <div class="trust-slider">
            <div class="trust-item">
                <i class="fas fa-building"></i>
                <span>شركة الفاخرية</span>
            </div>
            <div class="trust-item">
                <i class="fas fa-crown"></i>
                <span>قصر اليمامة</span>
            </div>
            <div class="trust-item">
                <i class="fas fa-hotel"></i>
                <span>مجمع النخيل</span>
            </div>
            <div class="trust-item">
                <i class="fas fa-store"></i>
                <span>محلات العقيق</span>
            </div>
            <div class="trust-item">
                <i class="fas fa-school"></i>
                <span>مدارس الرواد</span>
            </div>
            <div class="trust-item">
                <i class="fas fa-hospital"></i>
                <span>مستشفى الشفاء</span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 4. مقدمة عن الشركة                          -->
<!-- ============================================ -->
<section class="about-intro" data-aos="fade-up">
    <div class="container">
        <div class="about-grid">
            <div class="about-text">
                <span class="section-tag">من نحن</span>
                <h2>الشاقي للزجاج السكريت<br>رواد <span>الجودة والثقة</span></h2>
                <p>نحن شركة سعودية متخصصة في تركيب الزجاج السكريت بجميع أنواعه في الرياض. نمتلك خبرة تمتد لأكثر من عقد من الزمن في تنفيذ المشاريع الضخمة للقصور والفلل والمباني التجارية.</p>
                <p>نتميز بتقديم حلول زجاجية مبتكرة تجمع بين الأناقة والمتانة، مع التزامنا بأعلى معايير الجودة والسلامة.</p>
                <ul class="about-features">
                    <li><i class="fas fa-check-circle"></i> خبرة ١٠ سنوات في السوق السعودي</li>
                    <li><i class="fas fa-check-circle"></i> أكثر من ١٥٠ مشروعاً منفذاً</li>
                    <li><i class="fas fa-check-circle"></i> ضمان على جميع الأعمال</li>
                    <li><i class="fas fa-check-circle"></i> فريق فني مدرب و محترف</li>
                </ul>
            </div>
            <div class="about-image" data-aos="fade-left">
                <img src="assets/images/about.jpg" alt="عن الشاقي للزجاج السكريت" onerror="this.src='assets/images/placeholder.jpg'">
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 5. الخدمات الرئيسية                         -->
<!-- ============================================ -->
<section class="services" id="services" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">خدماتنا</span>
            <h2>ما نقدمه من <span>خدمات زجاجية فاخرة</span></h2>
            <p>نقدم مجموعة متكاملة من خدمات الزجاج السكريت لتلبية احتياجاتكم</p>
        </div>
        <div class="services-grid">
            <?php foreach ($services as $service): ?>
            <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                <div class="service-icon">
                    <i class="fas <?php echo htmlspecialchars($service['icon'] ?? 'fa-glass'); ?>"></i>
                </div>
                <h3><?php echo htmlspecialchars($service['title']); ?></h3>
                <p><?php echo htmlspecialchars($service['description']); ?></p>
                <a href="#contact" class="service-link">اطلب الخدمة <i class="fas fa-arrow-left"></i></a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 6. Before/After (سحب المؤشر)                -->
<!-- ============================================ -->
<section class="before-after" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">الفرق واضح</span>
            <h2>شاهد الفرق بنفسك <span>قبل وبعد</span></h2>
        </div>
        <div class="ba-container" id="beforeAfter">
            <div class="ba-image">
                <img src="assets/images/before-after/after.jpg" alt="بعد التركيب" class="ba-after" onerror="this.src='assets/images/placeholder.jpg'">
                <img src="assets/images/before-after/before.jpg" alt="قبل التركيب" class="ba-before" onerror="this.src='assets/images/placeholder.jpg'">
                <div class="ba-slider" id="baSlider">
                    <div class="ba-handle">
                        <i class="fas fa-arrows-alt-h"></i>
                    </div>
                </div>
            </div>
            <div class="ba-labels">
                <span>قبل</span>
                <span>بعد</span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 7. أحدث المشاريع (معرض ديناميكي)            -->
<!-- ============================================ -->
<section class="projects" id="projects" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">أعمالنا</span>
            <h2>أحدث <span>مشاريعنا</span> المنفذة</h2>
            <p>نفخر بعرض نماذج من أعمالنا التي تم تنفيذها في مختلف أحياء الرياض</p>
        </div>
        <div class="projects-grid">
            <?php foreach ($projects as $project): ?>
            <div class="project-card" data-aos="fade-up" data-aos-delay="100">
                <div class="project-image">
                    <img src="uploads/projects/<?php echo htmlspecialchars($project['image']); ?>" 
                         alt="<?php echo htmlspecialchars($project['title']); ?>"
                         loading="lazy"
                         onerror="this.src='assets/images/placeholder-project.jpg'">
                    <div class="project-overlay">
                        <a href="uploads/projects/<?php echo htmlspecialchars($project['image']); ?>" 
                           data-lightbox="project" 
                           data-title="<?php echo htmlspecialchars($project['title']); ?>">
                            <i class="fas fa-search-plus"></i>
                        </a>
                        <?php if ($project['video']): ?>
                        <a href="<?php echo htmlspecialchars($project['video']); ?>" 
                           data-lightbox="project-video">
                            <i class="fas fa-play"></i>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project-info">
                    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
                    <div class="project-meta">
                        <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($project['location']); ?></span>
                        <span><i class="fas fa-ruler-combined"></i> <?php echo htmlspecialchars($project['area']); ?> م²</span>
                        <span><i class="fas fa-clock"></i> <?php echo htmlspecialchars($project['duration']); ?></span>
                    </div>
                    <div class="project-tag">
                        <?php echo htmlspecialchars($project['glass_type']); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="projects-more">
            <a href="#gallery" class="btn-outline">عرض جميع المشاريع <i class="fas fa-arrow-left"></i></a>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 8. إحصائيات وأرقام (Counters)               -->
<!-- ============================================ -->
<section class="stats" data-aos="fade-up">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-box" data-aos="zoom-in">
                <div class="stat-icon"><i class="fas fa-building"></i></div>
                <div class="stat-number" data-count="150">0</div>
                <div class="stat-label">مشروعاً منفذاً</div>
            </div>
            <div class="stat-box" data-aos="zoom-in" data-aos-delay="100">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number" data-count="50">0</div>
                <div class="stat-label">عميلاً من الشركات</div>
            </div>
            <div class="stat-box" data-aos="zoom-in" data-aos-delay="200">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-number" data-count="10">0</div>
                <div class="stat-label">سنوات من الخبرة</div>
            </div>
            <div class="stat-box" data-aos="zoom-in" data-aos-delay="300">
                <div class="stat-icon"><i class="fas fa-map-marked-alt"></i></div>
                <div class="stat-number" data-count="15">0</div>
                <div class="stat-label">حي في الرياض</div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 9. آراء العملاء (Testimonials)              -->
<!-- ============================================ -->
<section class="testimonials" id="testimonials" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">آراء العملاء</span>
            <h2>ماذا يقولون عنا <span>عملاؤنا الكرام</span></h2>
        </div>
        <div class="testimonials-slider swiper" id="testimonialsSlider">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?php echo $i <= $testimonial['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="testimonial-text">"<?php echo htmlspecialchars($testimonial['content']); ?>"</p>
                        <div class="testimonial-author">
                            <img src="uploads/testimonials/<?php echo htmlspecialchars($testimonial['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($testimonial['client_name']); ?>"
                                 onerror="this.src='assets/images/avatar.png'">
                            <div class="author-info">
                                <h4><?php echo htmlspecialchars($testimonial['client_name']); ?></h4>
                                <span><?php echo htmlspecialchars($testimonial['client_position']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 10. الأحياء التي نغطيها في الرياض           -->
<!-- ============================================ -->
<section class="areas" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">أين نتواجد</span>
            <h2>نغطي جميع <span>أحياء الرياض</span></h2>
        </div>
        <div class="areas-grid">
            <div class="area-item" data-aos="flip-up">
                <i class="fas fa-map-pin"></i>
                <span>حي العليا</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="50">
                <i class="fas fa-map-pin"></i>
                <span>حي النرجس</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="100">
                <i class="fas fa-map-pin"></i>
                <span>حي الياسمين</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="150">
                <i class="fas fa-map-pin"></i>
                <span>حي الملقا</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="200">
                <i class="fas fa-map-pin"></i>
                <span>حي الصحافة</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="250">
                <i class="fas fa-map-pin"></i>
                <span>حي الرمال</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="300">
                <i class="fas fa-map-pin"></i>
                <span>حي قرطبة</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="350">
                <i class="fas fa-map-pin"></i>
                <span>حي لبن</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="400">
                <i class="fas fa-map-pin"></i>
                <span>حي العارض</span>
            </div>
            <div class="area-item" data-aos="flip-up" data-aos-delay="450">
                <i class="fas fa-map-pin"></i>
                <span>والمزيد...</span>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 11. أنواع الزجاج السكريت                    -->
<!-- ============================================ -->
<section class="glass-types" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">أنواع الزجاج</span>
            <h2>نقدم جميع <span>أنواع الزجاج السكريت</span></h2>
        </div>
        <div class="types-grid">
            <div class="type-card" data-aos="flip-left">
                <img src="assets/images/types/clear.jpg" alt="زجاج شفاف" onerror="this.src='assets/images/placeholder-type.jpg'">
                <h4>زجاج شفاف</h4>
                <p>للإضاءة الطبيعية والوضوح الكامل</p>
            </div>
            <div class="type-card" data-aos="flip-left" data-aos-delay="100">
                <img src="assets/images/types/frosted.jpg" alt="زجاج سكريت" onerror="this.src='assets/images/placeholder-type.jpg'">
                <h4>زجاج سكريت</h4>
                <p>للخصوصية مع نفاذية الضوء</p>
            </div>
            <div class="type-card" data-aos="flip-left" data-aos-delay="200">
                <img src="assets/images/types/tinted.jpg" alt="زجاج ملون" onerror="this.src='assets/images/placeholder-type.jpg'">
                <h4>زجاج ملون</h4>
                <p>للمناظر الجمالية وعزل الحرارة</p>
            </div>
            <div class="type-card" data-aos="flip-left" data-aos-delay="300">
                <img src="assets/images/types/reflective.jpg" alt="زجاج عاكس" onerror="this.src='assets/images/placeholder-type.jpg'">
                <h4>زجاج عاكس</h4>
                <p>لعكس أشعة الشمس والحرارة</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 12. خطوات العمل                            -->
<!-- ============================================ -->
<section class="steps" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">آلية العمل</span>
            <h2>خطوات <span>تنفيذ مشروعك</span> معنا</h2>
        </div>
        <div class="steps-timeline">
            <div class="step-item" data-aos="fade-right">
                <div class="step-number">01</div>
                <div class="step-content">
                    <h4>استشارة مجانية</h4>
                    <p>نتواصل معك لفهم احتياجاتك ومتطلبات مشروعك</p>
                </div>
            </div>
            <div class="step-item" data-aos="fade-left">
                <div class="step-number">02</div>
                <div class="step-content">
                    <h4>تصميم وقياس</h4>
                    <p>نقوم بزيارة الموقع وأخذ القياسات بدقة</p>
                </div>
            </div>
            <div class="step-item" data-aos="fade-right">
                <div class="step-number">03</div>
                <div class="step-content">
                    <h4>عرض السعر</h4>
                    <p>نقدم لك عرض سعر تفصيلي وشفاف</p>
                </div>
            </div>
            <div class="step-item" data-aos="fade-left">
                <div class="step-number">04</div>
                <div class="step-content">
                    <h4>تركيب احترافي</h4>
                    <p>ننفذ المشروع بأعلى معايير الجودة والدقة</p>
                </div>
            </div>
            <div class="step-item" data-aos="fade-right">
                <div class="step-number">05</div>
                <div class="step-content">
                    <h4>تسليم وضمان</h4>
                    <p>نسلم المشروع ونقدم لك ضماناً على جميع الأعمال</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 13. معرض الصور والفيديوهات                  -->
<!-- ============================================ -->
<section class="gallery" id="gallery" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">معرض الأعمال</span>
            <h2>معرض <span>الصور والفيديوهات</span></h2>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item" data-aos="zoom-in">
                <img src="assets/images/gallery/1.jpg" alt="مشروع زجاج سكريت 1" loading="lazy" onerror="this.src='assets/images/placeholder.jpg'">
                <div class="gallery-overlay">
                    <a href="assets/images/gallery/1.jpg" data-lightbox="gallery">
                        <i class="fas fa-search-plus"></i>
                    </a>
                </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                <img src="assets/images/gallery/2.jpg" alt="مشروع زجاج سكريت 2" loading="lazy" onerror="this.src='assets/images/placeholder.jpg'">
                <div class="gallery-overlay">
                    <a href="assets/images/gallery/2.jpg" data-lightbox="gallery">
                        <i class="fas fa-search-plus"></i>
                    </a>
                </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="200">
                <img src="assets/images/gallery/3.jpg" alt="مشروع زجاج سكريت 3" loading="lazy" onerror="this.src='assets/images/placeholder.jpg'">
                <div class="gallery-overlay">
                    <a href="assets/images/gallery/3.jpg" data-lightbox="gallery">
                        <i class="fas fa-search-plus"></i>
                    </a>
                </div>
            </div>
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="300">
                <img src="assets/images/gallery/4.jpg" alt="مشروع زجاج سكريت 4" loading="lazy" onerror="this.src='assets/images/placeholder.jpg'">
                <div class="gallery-overlay">
                    <a href="assets/images/gallery/4.jpg" data-lightbox="gallery">
                        <i class="fas fa-search-plus"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 14. الأسئلة الشائعة (FAQ)                   -->
<!-- ============================================ -->
<section class="faq" id="faq" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">الأسئلة الشائعة</span>
            <h2>أجوبة على <span>استفساراتكم</span></h2>
        </div>
        <div class="faq-grid">
            <?php foreach ($faqs as $faq): ?>
            <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
                <div class="faq-question">
                    <h4><?php echo htmlspecialchars($faq['question']); ?></h4>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p><?php echo htmlspecialchars($faq['answer']); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 15. حاسبة تقديرية للمشروع                   -->
<!-- ============================================ -->
<section class="calculator" data-aos="fade-up">
    <div class="container">
        <div class="calculator-wrapper">
            <div class="calculator-content">
                <h2>احصل على <span>تقدير سريع</span> لمشروعك</h2>
                <p>املأ البيانات وسنقدم لك عرض سعر مبدئي خلال ٢٤ ساعة</p>
                <form id="calculatorForm" class="calculator-form">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="الاسم الكامل" required>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="رقم الجوال" required>
                    </div>
                    <div class="form-group">
                        <select name="service_type" required>
                            <option value="">نوع الخدمة</option>
                            <option value="واجهات زجاجية">واجهات زجاجية</option>
                            <option value="درابزين زجاجي">درابزين زجاجي</option>
                            <option value="شورات زجاجية">شورات زجاجية</option>
                            <option value="قصور وفيلات">قصور وفيلات</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="number" name="area" placeholder="المساحة بالمتر المربع" required>
                    </div>
                    <div class="form-group honeypot">
                        <input type="text" name="email_confirm" placeholder="لا تملأ هذا الحقل" autocomplete="off">
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-calculator"></i>
                        احصل على تقدير
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 16. خريطة جوجل التفاعلية                   -->
<!-- ============================================ -->
<section class="map" data-aos="fade-up">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">موقعنا</span>
            <h2>أين <span>تجدنا</span> في الرياض</h2>
        </div>
        <div class="map-container" id="mapContainer">
            <div id="googleMap" style="width:100%;height:450px;"></div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 17. معلومات الاتصال                         -->
<!-- ============================================ -->
<section class="contact" id="contact" data-aos="fade-up">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-info">
                <h2>تواصل <span>معنا</span></h2>
                <p>نحن هنا لخدمتك، تواصل معنا لأي استفسار أو طلب</p>
                <ul class="contact-details">
                    <li>
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>الهاتف</strong>
                            <a href="tel:<?php echo htmlspecialchars($settings['phone'] ?? '+966500000000'); ?>">
                                <?php echo htmlspecialchars($settings['phone'] ?? '+966 50 000 0000'); ?>
                            </a>
                        </div>
                    </li>
                    <li>
                        <i class="fab fa-whatsapp"></i>
                        <div>
                            <strong>واتساب</strong>
                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '966500000000'); ?>" target="_blank">
                                <?php echo htmlspecialchars($settings['whatsapp'] ?? '+966 50 000 0000'); ?>
                            </a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>البريد الإلكتروني</strong>
                            <a href="mailto:<?php echo htmlspecialchars($settings['email'] ?? 'info@al-shaqi.com'); ?>">
                                <?php echo htmlspecialchars($settings['email'] ?? 'info@al-shaqi.com'); ?>
                            </a>
                        </div>
                    </li>
                    <li>
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>ساعات العمل</strong>
                            <span><?php echo htmlspecialchars($settings['working_hours'] ?? 'السبت - الخميس 8ص - 8م'); ?></span>
                        </div>
                    </li>
                </ul>
                <div class="social-links">
                    <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="contact-form">
                <form id="contactForm" action="?action=contact" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>">
                    <div class="form-row">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="الاسم الكامل" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="البريد الإلكتروني" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="tel" name="phone" placeholder="رقم الجوال" required>
                    </div>
                    <div class="form-group">
                        <select name="service_type">
                            <option value="">نوع الخدمة المطلوبة</option>
                            <option value="واجهات زجاجية">واجهات زجاجية</option>
                            <option value="درابزين زجاجي">درابزين زجاجي</option>
                            <option value="شورات زجاجية">شورات زجاجية</option>
                            <option value="قصور وفيلات">قصور وفيلات</option>
                            <option value="أخرى">أخرى</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="message" rows="5" placeholder="تفاصيل طلبك..." required></textarea>
                    </div>
                    <div class="form-group honeypot">
                        <input type="text" name="email_confirm" placeholder="لا تملأ هذا الحقل" autocomplete="off">
                    </div>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane"></i>
                        إرسال الطلب
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ============================================ -->
<!-- 18. شريط التنقل السفلي (Footer)             -->
<!-- ============================================ -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-about">
                <img src="assets/images/logo-white.png" alt="الشاقي للزجاج السكريت" class="footer-logo" onerror="this.src='assets/images/logo-placeholder-white.png'">
                <p>نحن في الشاقي للزجاج السكريت نقدم حلولاً زجاجية فاخرة تجمع بين الأناقة والمتانة لجميع المشاريع في الرياض.</p>
            </div>
            <div class="footer-links">
                <h4>روابط سريعة</h4>
                <ul>
                    <li><a href="#home">الرئيسية</a></li>
                    <li><a href="#services">خدماتنا</a></li>
                    <li><a href="#projects">مشاريعنا</a></li>
                    <li><a href="#contact">اتصل بنا</a></li>
                </ul>
            </div>
            <div class="footer-services">
                <h4>خدماتنا</h4>
                <ul>
                    <li><a href="#services">واجهات زجاجية</a></li>
                    <li><a href="#services">درابزين زجاجي</a></li>
                    <li><a href="#services">شورات زجاجية</a></li>
                    <li><a href="#services">زجاج القصور</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h4>معلومات الاتصال</h4>
                <ul>
                    <li><i class="fas fa-phone"></i> <?php echo htmlspecialchars($settings['phone'] ?? '+966 50 000 0000'); ?></li>
                    <li><i class="fab fa-whatsapp"></i> <?php echo htmlspecialchars($settings['whatsapp'] ?? '+966 50 000 0000'); ?></li>
                    <li><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($settings['email'] ?? 'info@al-shaqi.com'); ?></li>
                    <li><i class="fas fa-map-marker-alt"></i> الرياض، المملكة العربية السعودية</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> الشاقي للزجاج السكريت - جميع الحقوق محفوظة</p>
            <p>تصميم وتطوير <a href="#" target="_blank">فريق الشاقي الرقمي</a></p>
        </div>
    </div>
</footer>

<!-- ============================================ -->
<!-- الأزرار الثابتة (Floating Buttons)          -->
<!-- ============================================ -->
<div class="floating-buttons">
    <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $settings['whatsapp'] ?? '966500000000'); ?>" 
       class="float-btn whatsapp" target="_blank">
        <i class="fab fa-whatsapp"></i>
        <span>واتساب</span>
    </a>
    <a href="tel:<?php echo htmlspecialchars($settings['phone'] ?? '+966500000000'); ?>" 
       class="float-btn phone">
        <i class="fas fa-phone"></i>
        <span>اتصال</span>
    </a>
    <a href="#contact" class="float-btn quote">
        <i class="fas fa-file-invoice"></i>
        <span>عرض سعر</span>
    </a>
    <button class="float-btn back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </button>
</div>

<!-- ============================================ -->
<!-- المكتبات والجافا سكريبت                     -->
<!-- ============================================ -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<!-- جافا سكريبت الرئيسية -->
<script src="assets/js/main.js"></script>

<!-- Google Maps (سيتم تحميله عند ظهور الخريطة) -->
<script>
    function loadGoogleMaps() {
        const script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&language=ar&callback=initMap';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    }

    // مراقبة ظهور الخريطة
    const mapObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && typeof google === 'undefined') {
                loadGoogleMaps();
                mapObserver.disconnect();
            }
        });
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        const mapContainer = document.getElementById('mapContainer');
        if (mapContainer) {
            mapObserver.observe(mapContainer);
        }
    });
</script>

</body>
</html>