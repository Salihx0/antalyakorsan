# ============================================
# ANTALYA KORSAN TAKSİ - .HTACCESS
# Tarih: 18 Kasım 2025
# Versiyon: 1.0
# ============================================

# ============================================
# REWRITE ENGINE
# ============================================
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    
    # HTTPS Yönlendirme
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    
    # WWW Yönlendirme (İsteğe bağlı)
    # RewriteCond %{HTTP_HOST} !^www\. [NC]
    # RewriteRule ^(.*)$ https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
    
    # Admin paneli koruması
    RewriteCond %{REQUEST_URI} ^/admin
    RewriteCond %{REMOTE_ADDR} !^127\.0\.0\.1$
    # RewriteRule ^(.*)$ - [F,L]
    
    # Dosya ve klasör varsa direkt göster
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    
    # SEO-Friendly URL Rewriting
    
    # Ana sayfa
    RewriteRule ^$ index.php [L]
    
    # Hakkımızda
    RewriteRule ^hakkimizda/?$ hakkimizda.php [L,QSA]
    
    # Hizmetler
    RewriteRule ^hizmetler/?$ hizmetler.php [L,QSA]
    
    # Fiyatlar
    RewriteRule ^fiyatlar/?$ fiyatlar.php [L,QSA]
    
    # İletişim
    RewriteRule ^iletisim/?$ iletisim.php [L,QSA]
    
    # Galeri
    RewriteRule ^galeri/?$ galeri.php [L,QSA]
    
    # Blog ana sayfa
    RewriteRule ^blog/?$ blog.php [L,QSA]
    
    # Blog kategori
    RewriteRule ^blog/kategori/([a-zA-Z0-9-]+)/?$ blog.php?kategori=$1 [L,QSA]
    
    # Blog arama
    RewriteRule ^blog/ara/?$ blog.php?ara=1 [L,QSA]
    
    # Blog detay
    RewriteRule ^blog/([a-zA-Z0-9-]+)/?$ blog-detay.php?slug=$1 [L,QSA]
    
    # Sitemap
    RewriteRule ^sitemap\.xml$ sitemap.php [L]
    
    # Robots.txt
    RewriteRule ^robots\.txt$ robots.txt [L]
    
    # LLMs.txt
    RewriteRule ^llms\.txt$ llms.txt [L]
</IfModule>

# ============================================
# GÜVENLİK AYARLARI
# ============================================

# Dizin listelemeyi kapat
Options -Indexes

# Server signature gizle
ServerSignature Off

# PHP bilgilerini gizle
<IfModule mod_php.c>
    php_flag display_errors Off
    php_flag expose_php Off
</IfModule>

# Hassas dosyalara erişimi engelle
<FilesMatch "^(config\.php|\.htaccess|\.htpasswd|\.env|composer\.json|composer\.lock|package\.json|package-lock\.json)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# SQL ve veritabanı dosyalarını koru
<FilesMatch "\.(sql|db|sqlite)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Log dosyalarını koru
<FilesMatch "\.(log|txt)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Backup dosyalarını koru
<FilesMatch "\.(bak|backup|old|orig|save|swp|tmp)$">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# Git dosyalarını koru
<FilesMatch "^\.git">
    Order Allow,Deny
    Deny from all
</FilesMatch>

# ============================================
# HOTLINK KORUMASI
# ============================================
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{HTTP_REFERER} !^$
    RewriteCond %{HTTP_REFERER} !^https?://(www\.)?antalyakorsan\.com\.tr [NC]
    RewriteCond %{HTTP_REFERER} !^https?://(www\.)?localhost [NC]
    RewriteRule \.(jpg|jpeg|png|gif|webp|svg|ico)$ - [F,NC,L]
</IfModule>

# ============================================
# CACHE AYARLARI
# ============================================
<IfModule mod_expires.c>
    ExpiresActive On
    
    # Varsayılan
    ExpiresDefault "access plus 1 month"
    
    # HTML
    ExpiresByType text/html "access plus 0 seconds"
    
    # CSS
    ExpiresByType text/css "access plus 1 year"
    
    # JavaScript
    ExpiresByType application/javascript "access plus 1 year"
    ExpiresByType text/javascript "access plus 1 year"
    
    # Görseller
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    ExpiresByType image/x-icon "access plus 1 year"
    
    # Fontlar
    ExpiresByType font/ttf "access plus 1 year"
    ExpiresByType font/otf "access plus 1 year"
    ExpiresByType font/woff "access plus 1 year"
    ExpiresByType font/woff2 "access plus 1 year"
    ExpiresByType application/font-woff "access plus 1 year"
    
    # Video
    ExpiresByType video/mp4 "access plus 1 year"
    ExpiresByType video/webm "access plus 1 year"
    
    # PDF
    ExpiresByType application/pdf "access plus 1 month"
</IfModule>

# Cache-Control Headers
<IfModule mod_headers.c>
    # HTML - No cache
    <FilesMatch "\.(html|htm|php)$">
        Header set Cache-Control "no-cache, no-store, must-revalidate"
        Header set Pragma "no-cache"
        Header set Expires 0
    </FilesMatch>
    
    # CSS ve JS - 1 yıl
    <FilesMatch "\.(css|js)$">
        Header set Cache-Control "public, max-age=31536000, immutable"
    </FilesMatch>
    
    # Görseller - 1 yıl
    <FilesMatch "\.(jpg|jpeg|png|gif|webp|svg|ico)$">
        Header set Cache-Control "public, max-age=31536000, immutable"
    </FilesMatch>
    
    # Fontlar - 1 yıl
    <FilesMatch "\.(ttf|otf|woff|woff2|eot)$">
        Header set Cache-Control "public, max-age=31536000, immutable"
    </FilesMatch>
</IfModule>

# ============================================
# COMPRESSION (GZIP)
# ============================================
<IfModule mod_deflate.c>
    # HTML, CSS, JavaScript, Text, XML
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/x-javascript
    AddOutputFilterByType DEFLATE text/xml
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE application/xhtml+xml
    AddOutputFilterByType DEFLATE application/rss+xml
    AddOutputFilterByType DEFLATE application/atom+xml
    AddOutputFilterByType DEFLATE text/plain
    AddOutputFilterByType DEFLATE application/json
    AddOutputFilterByType DEFLATE application/ld+json
    
    # SVG
    AddOutputFilterByType DEFLATE image/svg+xml
    
    # Fontlar
    AddOutputFilterByType DEFLATE font/ttf
    AddOutputFilterByType DEFLATE font/otf
    AddOutputFilterByType DEFLATE font/woff
    AddOutputFilterByType DEFLATE font/woff2
    AddOutputFilterByType DEFLATE application/font-woff
    AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
    
    # Eski tarayıcılar için
    BrowserMatch ^Mozilla/4 gzip-only-text/html
    BrowserMatch ^Mozilla/4\.0[678] no-gzip
    BrowserMatch \bMSIE !no-gzip !gzip-only-text/html
    
    # Proxy'ler için
    Header append Vary User-Agent
</IfModule>

# ============================================
# MIME TYPES
# ============================================
<IfModule mod_mime.c>
    # CSS - Kritik: text/css olarak zorla
    AddType text/css css
    
    # JavaScript
    AddType application/javascript js
    AddType text/javascript js
    
    # JSON
    AddType application/json json
    AddType application/ld+json jsonld
    
    # Görseller
    AddType image/jpeg jpg jpeg
    AddType image/png png
    AddType image/gif gif
    AddType image/webp webp
    AddType image/svg+xml svg svgz
    AddType image/x-icon ico
    
    # Fontlar
    AddType font/ttf ttf
    AddType font/otf otf
    AddType font/woff woff
    AddType font/woff2 woff2
    AddType application/font-woff woff
    AddType application/vnd.ms-fontobject eot
    
    # Video
    AddType video/mp4 mp4
    AddType video/webm webm
    
    # Audio
    AddType audio/mpeg mp3
    AddType audio/ogg ogg
    
    # Diğer
    AddType application/pdf pdf
    AddType text/xml xml
    AddType text/plain txt
</IfModule>

# CSS dosyaları için özel MIME type zorlaması
<FilesMatch "\.css$">
    ForceType text/css
    Header set Content-Type "text/css; charset=utf-8"
</FilesMatch>

# ============================================
# CHARSET
# ============================================
AddDefaultCharset UTF-8
<IfModule mod_mime.c>
    AddCharset UTF-8 .html .css .js .xml .json .rss .atom
</IfModule>

# ============================================
# ETAGs
# ============================================
<IfModule mod_headers.c>
    Header unset ETag
</IfModule>
FileETag None

# ============================================
# CORS (Cross-Origin Resource Sharing)
# ============================================
<IfModule mod_headers.c>
    # Fontlar için CORS
    <FilesMatch "\.(ttf|otf|woff|woff2|eot)$">
        Header set Access-Control-Allow-Origin "*"
    </FilesMatch>
    
    # API için CORS (gerekirse)
    # <FilesMatch "\.(json)$">
    #     Header set Access-Control-Allow-Origin "*"
    #     Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"
    #     Header set Access-Control-Allow-Headers "Content-Type, Authorization"
    # </FilesMatch>
</IfModule>

# ============================================
# GÜVENLİK HEADERS
# ============================================
<IfModule mod_headers.c>
    # XSS Protection
    Header set X-XSS-Protection "1; mode=block"
    
    # Clickjacking Protection
    Header set X-Frame-Options "SAMEORIGIN"
    
    # MIME Type Sniffing Protection
    Header set X-Content-Type-Options "nosniff"
    
    # Referrer Policy
    Header set Referrer-Policy "strict-origin-when-cross-origin"
    
    # Content Security Policy (Geliştirme için gevşek)
    # Header set Content-Security-Policy "default-src 'self' 'unsafe-inline' 'unsafe-eval' https: data:;"
    
    # Strict Transport Security (HTTPS için)
    # Header set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"
    
    # Permissions Policy
    Header set Permissions-Policy "geolocation=(), microphone=(), camera=()"
</IfModule>

# ============================================
# ERROR PAGES
# ============================================
ErrorDocument 400 /error.php?code=400
ErrorDocument 401 /error.php?code=401
ErrorDocument 403 /error.php?code=403
ErrorDocument 404 /error.php?code=404
ErrorDocument 500 /error.php?code=500
ErrorDocument 503 /error.php?code=503

# ============================================
# PHP AYARLARI
# ============================================
<IfModule mod_php.c>
    # Upload limitleri
    php_value upload_max_filesize 10M
    php_value post_max_size 10M
    php_value max_execution_time 300
    php_value max_input_time 300
    php_value memory_limit 256M
    
    # Session ayarları
    php_value session.cookie_httponly 1
    php_value session.cookie_secure 0
    php_value session.use_only_cookies 1
    
    # Hata raporlama (Production'da kapatılmalı)
    php_flag display_errors Off
    php_flag display_startup_errors Off
    php_value error_reporting 0
    
    # Timezone
    php_value date.timezone "Europe/Istanbul"
</IfModule>

# ============================================
# PERFORMANS OPTİMİZASYONU
# ============================================

# Keep-Alive
<IfModule mod_headers.c>
    Header set Connection keep-alive
</IfModule>

# Prefetch DNS
<IfModule mod_headers.c>
    <FilesMatch "\.(html|php)$">
        Header add Link "<https://fonts.googleapis.com>; rel=dns-prefetch"
        Header add Link "<https://www.google-analytics.com>; rel=dns-prefetch"
    </FilesMatch>
</IfModule>

# ============================================
# REDIRECT RULES (Örnekler)
# ============================================
# Redirect 301 /old-page.html /new-page
# Redirect 301 /old-directory/ /new-directory/

# ============================================
# .HTACCESS SONU
# ============================================

# php -- BEGIN cPanel-generated handler, do not edit
# “ea-php81” paketini varsayılan “PHP” programlama dili olarak ayarlayın.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php81 .php .php8 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit
