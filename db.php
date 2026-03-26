<?php
/**
 * HEADER - SITE BAŞLIĞI
 * 
 * @package AntalyaKorsanTaksi
 * @version 1.0
 * @date 18 Kasım 2025
 */

if (!defined('SITE_URL')) {
    require_once __DIR__ . '/../config.php';
}

// Sayfa bilgilerini al
$page_title = $page_title ?? DEFAULT_META_TITLE;
$page_description = $page_description ?? DEFAULT_META_DESCRIPTION;
$page_keywords = $page_keywords ?? DEFAULT_META_KEYWORDS;
$page_image = $page_image ?? DEFAULT_OG_IMAGE;
$page_url = $page_url ?? get_current_url();
$body_class = $body_class ?? '';
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Tema
$current_theme = $_COOKIE['theme'] ?? DEFAULT_THEME;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <?php echo generate_meta_tags([
        'title' => $page_title,
        'description' => $page_description,
        'keywords' => $page_keywords,
        'image' => $page_image,
        'url' => $page_url
    ]); ?>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo assets_url('images/logo/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo assets_url('images/logo/favicon-16x16.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo assets_url('images/logo/apple-touch-icon.png'); ?>">
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="<?php echo assets_url('css/main.css'); ?>" as="style">
    <link rel="preload" href="<?php echo assets_url('js/main.js'); ?>" as="script">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo assets_url('css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/themes/' . $current_theme . '.css'); ?>" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo assets_url('css/preloader.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/cursor.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/scrollbar.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/animations.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?php echo assets_url('css/mobile-redesign.css'); ?>">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    
    <!-- Mobile Menu Script -->
    <script src="<?php echo assets_url('js/mobile-menu.js'); ?>" defer></script>
    
    <!-- Schema Markup -->
    <?php echo generate_local_business_schema(); ?>
    <?php echo generate_organization_schema(); ?>
    
    <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
        <?php echo generate_breadcrumb_schema($breadcrumbs); ?>
    <?php endif; ?>
    
    <!-- Google Analytics -->
    <?php if (GOOGLE_ANALYTICS_ID): ?>
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_ANALYTICS_ID; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo GOOGLE_ANALYTICS_ID; ?>');
    </script>
    <?php endif; ?>
    
    <style>
        /* Mobil uyumluluk iyileştirmeleri */
        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        img,
        video,
        iframe {
            max-width: 100%;
            height: auto;
        }

        .floating-contact-buttons {
            position: fixed;
            left: 0;
            right: 0;
            bottom: 24px;
            z-index: 9999;
            pointer-events: none;
        }

        .floating-contact-button {
            pointer-events: auto;
            position: fixed;
            bottom: 24px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 52px;
            padding: 0 18px;
            border-radius: 999px;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .floating-contact-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 26px rgba(0, 0, 0, 0.25);
        }

        .floating-contact-button.whatsapp {
            right: 24px;
            background: #25d366;
        }

        .floating-contact-button.phone {
            left: 24px;
            background: #1f4cff;
        }

        @media (max-width: 768px) {
            .floating-contact-button {
                bottom: 20px;
            }

            .floating-contact-button.phone {
                left: 50%;
                transform: translateX(-50%);
                bottom: 84px;
            }

            .floating-contact-button.phone:hover {
                transform: translateX(-50%) translateY(-2px);
            }

            .floating-contact-button.whatsapp {
                right: auto;
                left: 50%;
                transform: translateX(-50%);
            }

            .floating-contact-button.whatsapp:hover {
                transform: translateX(-50%) translateY(-2px);
            }
        }
    </style>
</head>
<body class="<?php echo $body_class; ?> theme-<?php echo $current_theme; ?>" data-theme="<?php echo $current_theme; ?>">
    
    <?php if (PRELOADER_ENABLED): ?>
    <!-- Preloader -->
    <div id="preloader" class="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <img src="<?php echo assets_url('images/logo/logo.png'); ?>" alt="<?php echo SITE_NAME; ?>">
            </div>
            <div class="preloader-animation">
                <div class="taxi-animation">
                    <i class="fas fa-taxi"></i>
                </div>
            </div>
            <div class="preloader-text">Yükleniyor...</div>
        </div>
    </div>
    <?php endif; ?>
    
    <?php if (CUSTOM_CURSOR_ENABLED): ?>
    <!-- Custom Cursor -->
    <div class="custom-cursor">
        <div class="cursor-dot"></div>
        <div class="cursor-outline"></div>
    </div>
    <?php endif; ?>
    
    <!-- Header -->
    <header class="site-header" id="site-header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <div class="site-logo">
                    <a href="<?php echo site_url(); ?>" class="logo-link">
                        <img src="<?php echo assets_url('images/logo/logo.png'); ?>" alt="<?php echo SITE_NAME; ?>" class="logo-img" onerror="this.style.display='none'">
                        <span class="logo-text">Antalya Korsan Taksi</span>
                    </a>
                </div>
                
                <!-- Navigation -->
                <nav class="main-navigation" id="main-navigation">
                    <ul class="nav-menu">
                        <li class="nav-item <?php echo ($current_page == 'index') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url(); ?>" class="nav-link">
                                <i class="fas fa-home"></i>
                                <span>Ana Sayfa</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'hakkimizda') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('hakkimizda'); ?>" class="nav-link">
                                <i class="fas fa-info-circle"></i>
                                <span>Hakkımızda</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'hizmetler') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('hizmetler'); ?>" class="nav-link">
                                <i class="fas fa-taxi"></i>
                                <span>Hizmetler</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'fiyatlar') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('fiyatlar'); ?>" class="nav-link">
                                <i class="fas fa-tags"></i>
                                <span>Fiyatlar</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'blog') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('blog'); ?>" class="nav-link">
                                <i class="fas fa-blog"></i>
                                <span>Blog</span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo ($current_page == 'iletisim') ? 'active' : ''; ?>">
                            <a href="<?php echo site_url('iletisim'); ?>" class="nav-link">
                                <i class="fas fa-envelope"></i>
                                <span>İletişim</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
                <!-- Header Actions -->
                <div class="header-actions">
                    <!-- Theme Switcher -->
                    <div class="theme-switcher">
                        <button type="button" class="theme-toggle" id="theme-toggle" aria-label="Tema Değiştir" title="Tema Değiştir">
                            <i class="fas fa-palette"></i>
                        </button>
                        <div class="theme-dropdown" id="theme-dropdown">
                            <button type="button" class="theme-option" data-theme="corporate">
                                <i class="fas fa-building"></i>
                                <span>Kurumsal</span>
                            </button>
                            <button type="button" class="theme-option" data-theme="dark">
                                <i class="fas fa-moon"></i>
                                <span>Koyu</span>
                            </button>
                            <button type="button" class="theme-option" data-theme="light">
                                <i class="fas fa-sun"></i>
                                <span>Açık</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Call Button -->
                    <a href="tel:+905070073210" class="btn btn-primary btn-call">
                        <i class="fas fa-phone"></i>
                        <span>Hemen Ara</span>
                    </a>
                    
                    <!-- Mobile Menu Toggle -->
                    <button type="button" class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Menü" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        
        
        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Mobil menü" aria-hidden="true">
            <div class="mobile-menu-content">
                <ul class="mobile-nav-menu">
                    <li class="mobile-nav-item <?php echo ($current_page == 'index') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url(); ?>" class="mobile-nav-link">
                            <i class="fas fa-home"></i>
                            <span>Ana Sayfa</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item <?php echo ($current_page == 'hakkimizda') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url('hakkimizda'); ?>" class="mobile-nav-link">
                            <i class="fas fa-info-circle"></i>
                            <span>Hakkımızda</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item <?php echo ($current_page == 'hizmetler') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url('hizmetler'); ?>" class="mobile-nav-link">
                            <i class="fas fa-taxi"></i>
                            <span>Hizmetler</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item <?php echo ($current_page == 'fiyatlar') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url('fiyatlar'); ?>" class="mobile-nav-link">
                            <i class="fas fa-tags"></i>
                            <span>Fiyatlar</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item <?php echo ($current_page == 'blog') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url('blog'); ?>" class="mobile-nav-link">
                            <i class="fas fa-blog"></i>
                            <span>Blog</span>
                        </a>
                    </li>
                    <li class="mobile-nav-item <?php echo ($current_page == 'iletisim') ? 'active' : ''; ?>">
                        <a href="<?php echo site_url('iletisim'); ?>" class="mobile-nav-link">
                            <i class="fas fa-envelope"></i>
                            <span>İletişim</span>
                        </a>
                    </li>
                </ul>
                
                <div class="mobile-menu-footer">
                    <a href="tel:+905070073210" class="btn btn-primary w-100 mb-3">
                        <i class="fas fa-phone"></i>
                        <span>+90 507 007 3210</span>
                    </a>
                    <a href="mailto:iletisim@antalyakorsan.com.tr" class="btn btn-outline w-100">
                        <i class="fas fa-envelope"></i>
                        <span>E-posta Gönder</span>
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <?php if (WHATSAPP_WIDGET_ENABLED): ?>
    <div class="floating-contact-buttons" id="contact-buttons">
        <a href="tel:+905070073210"
           class="floating-contact-button phone"
           aria-label="Telefon ile ara">
            <i class="fas fa-phone"></i>
            <span>HEMEN ARA</span>
        </a>

        <a href="https://wa.me/905070073210?text=<?php echo urlencode('araç çağırmak istiyorum.'); ?>"
           class="floating-contact-button whatsapp"
           target="_blank"
           rel="noopener"
           aria-label="WhatsApp ile araç çağır">
            <i class="fab fa-whatsapp"></i>
            <span>ARAÇ ÇAĞIR</span>
        </a>
    </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main class="site-main" id="site-main">
        <?php if (isset($breadcrumbs) && !empty($breadcrumbs)): ?>
            <?php echo generate_breadcrumb($breadcrumbs); ?>
        <?php endif; ?>
        
        <?php echo display_messages(); ?>
