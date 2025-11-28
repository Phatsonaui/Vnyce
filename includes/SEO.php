<?php

/**
 * SEO Configuration for V'nyce Clinic
 * ไฟล์นี้จัดการ Meta Tags, Schema Markup, และ SEO Settings ทั้งหมด
 */

// ข้อมูล SEO หลักของเว็บไซต์
$seo = [
    // Basic Meta Tags
    'title' => "V'nyce Clinic | คลินิกความงามระดับพรีเมียม ฉะเชิงเทรา | รักษาสิว ฉีดผิวขาว เลเซอร์ขน",
    'description' => "V'nyce Clinic คลินิกความงามระดับพรีเมียม ฉะเชิงเทรา ✨ รักษาสิว | ฉีดผิวขาว | เลเซอร์ขน | ฟื้นฟูผิว ✓ แพทย์ผู้เชี่ยวชาญ ✓ เทคโนโลยีล่าสุด ✓ ปลอดภัย FDA ✓ นัดฟรี 093-895-5999",
    'keywords' => "คลินิกความงาม, คลินิกความงามฉะเชิงเทรา, รักษาสิว, ฉีดผิวขาว, เลเซอร์ขนถาวร, ฟื้นฟูผิวหน้า, V'nyce Clinic, Vnyce, คลินิกพรีเมียม, ลดสิว, กระจ่างใส, ผิวขาว, ดูแลผิว, รักษาสิวอักเสบ, ลดรอยสิว, ลดริ้วรอย, botox, filler, ความงามฉะเชิงเทรา",
    'author' => "V'nyce Clinic",
    'canonical' => "https://www.vnyce.com/",

    // Open Graph (Facebook, LinkedIn)
    'og' => [
        'type' => 'website',
        'site_name' => "V'nyce Clinic",
        'title' => "V'nyce Clinic | คลินิกความงามระดับพรีเมียม ฉะเชิงเทรา",
        'description' => "คลินิกความงามครบวงจร ด้วยแพทย์ผู้เชี่ยวชาญและเทคโนโลยีล่าสุด รักษาสิว ฉีดผิวขาว เลเซอร์ขน FDA approved นัดหมาย 093-895-5999",
        'image' => "https://www.vnyce.com/images/og-image.jpg",
        'url' => "https://www.vnyce.com/",
        'locale' => 'th_TH',
    ],

    // Twitter Card
    'twitter' => [
        'card' => 'summary_large_image',
        'title' => "V'nyce Clinic | คลินิกความงามระดับพรีเมียม",
        'description' => "คลินิกความงามครบวงจร ฉะเชิงเทรา รักษาสิว ฉีดผิวขาว เลเซอร์ขน",
        'image' => "https://www.vnyce.com/images/og-image.jpg",
    ],

    // Business Info
    'business' => [
        'name' => "V'nyce Clinic",
        'address' => "62/3 ถนนศรีโสธรตัดใหม่ 18 ตำบลหน้าเมือง อำเภอเมือง ฉะเชิงเทรา 24000",
        'phone' => '0938955999',
        'email' => 'info@vnyce.com',
        'lat' => '13.6777321',
        'lng' => '101.0647918',
    ],
];

/**
 * Output SEO Meta Tags
 * ฟังก์ชันนี้จะแสดง Meta Tags ทั้งหมดในส่วน <head>
 */
function output_seo_meta_tags($seo)
{
?>
    <!-- Primary Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo htmlspecialchars($seo['title']); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($seo['description']); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($seo['keywords']); ?>">
    <meta name="author" content="<?php echo htmlspecialchars($seo['author']); ?>">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo htmlspecialchars($seo['canonical']); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="<?php echo htmlspecialchars($seo['og']['type']); ?>">
    <meta property="og:site_name" content="<?php echo htmlspecialchars($seo['og']['site_name']); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($seo['og']['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($seo['og']['description']); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($seo['og']['image']); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:url" content="<?php echo htmlspecialchars($seo['og']['url']); ?>">
    <meta property="og:locale" content="<?php echo htmlspecialchars($seo['og']['locale']); ?>">

    <!-- Twitter -->
    <meta name="twitter:card" content="<?php echo htmlspecialchars($seo['twitter']['card']); ?>">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($seo['twitter']['title']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($seo['twitter']['description']); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($seo['twitter']['image']); ?>">

    <!-- Additional SEO Tags -->
    <meta name="theme-color" content="#BA9A8B">
    <meta name="msapplication-TileColor" content="#BA9A8B">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <!-- Geo Tags -->
    <meta name="geo.region" content="TH-24">
    <meta name="geo.placename" content="ฉะเชิงเทรา">
    <meta name="geo.position" content="<?php echo $seo['business']['lat'] . ';' . $seo['business']['lng']; ?>">
    <meta name="ICBM" content="<?php echo $seo['business']['lat'] . ', ' . $seo['business']['lng']; ?>">

    <!-- Language -->
    <meta http-equiv="content-language" content="th">
    <link rel="alternate" hreflang="th" href="<?php echo htmlspecialchars($seo['canonical']); ?>">

    <!-- Favicon -->
    <link rel="icon" href="/img/V'NYCE.jpg" type="image/jpeg">
    <link rel="apple-touch-icon" href="/img/V'NYCE.jpg">
<?php
}

/**
 * Output Schema Markup (JSON-LD)
 * Schema Markup ช่วยให้ Google เข้าใจข้อมูลธุรกิจได้ดีขึ้น
 */
function output_schema_markup($seo)
{
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "BeautySalon",
        "name" => $seo['business']['name'],
        "image" => $seo['og']['image'],
        "@id" => $seo['canonical'],
        "url" => $seo['canonical'],
        "telephone" => $seo['business']['phone'],
        "email" => $seo['business']['email'],
        "priceRange" => "฿฿",

        // ที่อยู่
        "address" => [
            "@type" => "PostalAddress",
            "streetAddress" => "62/3 ถนนศรีโสธรตัดใหม่ 18",
            "addressLocality" => "เมืองฉะเชิงเทรา",
            "addressRegion" => "ฉะเชิงเทรา",
            "postalCode" => "24000",
            "addressCountry" => "TH"
        ],

        // เวลาทำการ
        "openingHoursSpecification" => [
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
                "opens" => "16:30",
                "closes" => "21:00"
            ],
            [
                "@type" => "OpeningHoursSpecification",
                "dayOfWeek" => ["Saturday", "Sunday"],
                "opens" => "10:00",
                "closes" => "21:00"
            ]
        ],

        // พิกัด
        "geo" => [
            "@type" => "GeoCoordinates",
            "latitude" => $seo['business']['lat'],
            "longitude" => $seo['business']['lng']
        ],

        // โซเชียลมีเดีย
        "sameAs" => [
            "https://www.facebook.com/vnyceclinic",
            "https://www.instagram.com/vnyce_clinic/",
            "https://lin.ee/pT4KQLk",
            "https://www.youtube.com/@VnyceClinic"
        ],

        // บริการที่ให้
        "hasOfferCatalog" => [
            "@type" => "OfferCatalog",
            "name" => "บริการความงาม",
            "itemListElement" => [
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "รักษาสิวและรอยสิว",
                        "description" => "เทคโนโลยีรักษาสิวอักเสบ ควบคุมความมัน และลดรอยแดง"
                    ]
                ],
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "ฉีดผิวขาว",
                        "description" => "วิตามินเข้มข้นสำหรับผิวขาวกระจ่างใสอย่างปลอดภัย"
                    ]
                ],
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "เลเซอร์กำจัดขน",
                        "description" => "เทคโนโลยีล่าสุดสำหรับกำจัดขนถาวร"
                    ]
                ],
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => "ดูแลผิวพรรณ",
                        "description" => "ทรีตเมนต์ฟื้นฟูผิวให้กระจ่างใส"
                    ]
                ]
            ]
        ],

        // รีวิว (ตัวอย่าง - ควรเปลี่ยนเป็นข้อมูลจริง)
        "aggregateRating" => [
            "@type" => "AggregateRating",
            "ratingValue" => "4.9",
            "reviewCount" => "156",
            "bestRating" => "5",
            "worstRating" => "1"
        ]
    ];

    echo '<script type="application/ld+json">' . "\n";
    echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    echo "\n</script>\n";
}

// เรียกใช้ฟังก์ชันเมื่อ include ไฟล์นี้
output_seo_meta_tags($seo);
output_schema_markup($seo);
?>

<!-- Preconnect to external resources for faster loading -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preconnect" href="https://cdnjs.cloudflare.com">

<!-- Google Fonts - Optimized Loading -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">