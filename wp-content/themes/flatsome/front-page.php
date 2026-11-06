<?php
/**
 * Trang chủ VinFast VFG Vĩnh Phúc
 * Mỗi section nằm ở template-parts/home/section-*.php
 * Muốn sửa section nào → mở đúng file đó
 */

get_header();

get_template_part('template-parts/home/section', 'hero');     // Block 1: Banner chính
get_template_part('template-parts/home/section', 'cars');     // Block 2: Danh sách xe
get_template_part('template-parts/home/section', 'products'); // Block 3: Grid xe chi tiết 4 cột
get_template_part('template-parts/home/section', 'services'); // Block 4: Dịch vụ vòng tròn
get_template_part('template-parts/home/section', 'news');     // Block 5: Tin tức & Sự kiện

get_footer();
