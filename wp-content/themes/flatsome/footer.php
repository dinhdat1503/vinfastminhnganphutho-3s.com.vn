<?php
/**
 * The template for displaying the footer.
 */

global $flatsome_opt;
?>

</main>

<footer id="footer" class="footer-wrapper">
    <style>
        /* Base Reset for Footer */
        .footer-widgets, .absolute-footer, .footer-payment-icons, .payment-icons {
            display: none !important;
        }

        /* --- 1. Top Section (Hotline Detailed) --- */
        /* Moved to section-hotline.php */

        /* --- 2. Middle Section (Main Widgets) --- */
        .vf-ft-middle {
            background-color: #444444;
            color: #ffffff;
            padding: 50px 0;
        }
        .vf-ft-middle-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1.2fr;
            gap: 40px;
            max-width: 1230px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .vf-ft-widget-title {
            color: #ffffff;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 25px;
            display: block;
        }
        .vf-ft-widget-title::after {
            content: "";
            display: block;
            width: 40px;
            height: 2px;
            background: #666;
            margin-top: 10px;
        }
        .vf-ft-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .vf-ft-menu li {
            margin-bottom: 12px;
            border-bottom: 1px dashed #555;
            padding-bottom: 8px;
        }
        .vf-ft-menu li:last-child {
            border-bottom: none;
        }
        .vf-ft-menu a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
        }
        .vf-ft-menu a:hover {
            color: #ffffff;
            padding-left: 5px;
        }
        .vf-ft-map-title {
            color: #c8102e;
            text-align: center;
            font-weight: 800;
            margin-bottom: 15px;
            font-size: 16px;
        }
        .vf-ft-map-box {
            border: 1px solid #555;
            padding: 2px;
            background: #fff;
        }

        /* --- 3. Bottom Section (Copyright & Info) --- */
        .vf-ft-bottom {
            background-color: #222222;
            color: #999;
            padding: 40px 0;
            font-size: 13px;
        }
        .vf-ft-bottom-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 50px;
            max-width: 1230px;
            margin: 0 auto;
            padding: 0 15px;
        }
        .vf-ft-info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .vf-ft-info li {
            margin-bottom: 8px;
            line-height: 1.6;
        }
        .vf-ft-info b {
            color: #c8102e;
            font-weight: 700;
        }
        .vf-ft-reg-title {
            color: #fff;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
            display: block;
        }
        .vf-ft-reg-form {
            display: flex;
            gap: 10px;
        }
        .wpcf7-form.init .vf-ft-reg-form p {
            display: none !important; /* Hide automatic paragraphs */
        }
        .vf-ft-reg .wpcf7 form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .vf-ft-reg .wpcf7 form p {
            margin: 0;
            display: flex;
            gap: 10px;
            width: 100%;
        }
        .vf-ft-reg .wpcf7-form-control-wrap {
            flex-grow: 1;
        }
        .vf-ft-input {
            width: 100%;
            background: transparent !important;
            border: 1px solid #444 !important;
            color: #fff !important;
            height: 42px !important;
            padding: 0 15px !important;
            font-size: 13px !important;
        }
        .vf-ft-submit {
            background: #444 !important;
            color: #fff !important;
            border: none !important;
            height: 42px !important;
            padding: 0 25px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            cursor: pointer !important;
            white-space: nowrap;
        }
        .vf-ft-submit:hover {
            background: #c8102e !important;
        }
        .vf-ft-dev-credit {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .vf-ft-dev-credit a {
            color: #888;
            font-weight: 700;
            text-decoration: none;
        }
        .vf-ft-dev-credit a:hover {
            color: #fff;
        }
        .vf-ft-legal {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #333;
            color: #666;
            font-style: italic;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .vf-ft-middle-grid, .vf-ft-bottom-grid {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            .vf-ft-top-inner {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
        }
        @media (max-width: 768px) {
            .vf-ft-bottom {
                padding-bottom: 150px; /* Thêm khoảng đệm lớn để nút nổi Zalo/Hotline không đè lên chữ */
            }
            .vf-ft-reg .wpcf7 form p {
                flex-direction: column; /* Chuyển form thành 2 hàng ngang trên mobile */
            }
            .vf-ft-submit {
                width: 100%; /* Nút bấm trải rộng 100% trên mobile */
            }
        }
        /* Bottom Left Floating Buttons */
        .vf-left-buttons {
            position: fixed;
            bottom: 25px;
            left: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column; /* Quay lại 2 hàng */
            gap: 10px;
            align-items: flex-start;
        }
        .vf-ft-logo-small {
            width: 50px;
            margin-bottom: 5px;
            filter: drop-shadow(0 0 5px rgba(255,255,255,0.3));
        }
        .vf-btn-item {
            display: flex;
            align-items: center;
            padding: 10px 20px;
            border-radius: 50px;
            color: #fff !important;
            text-decoration: none !important;
            font-size: 14px;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            white-space: nowrap; /* Đảm bảo chữ trên 1 hàng */
            width: 280px; /* Cố định chiều rộng để 2 nút bằng chằn chặn */
        }
        .vf-btn-zalo { background: #0068ff; }
        .vf-btn-hotline { background: #d0021b; }
        .vf-btn-item .vf-icon-wrap {
            width: 30px;
            height: 30px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }
        .vf-btn-zalo .vf-icon-wrap img,
        .vf-btn-hotline .vf-icon-wrap img {
            width: 18px;
            height: 18px;
            object-fit: contain;
        }
        .vf-btn-item:hover { 
            transform: translateX(10px);
            filter: brightness(1.1);
        }
        @media (max-width: 768px) {
            .vf-left-buttons { bottom: 85px; left: 10px; }
            .vf-btn-item { width: 220px; padding: 8px 15px; font-size: 11px; }
            .vf-ft-logo-small { width: 40px; }
        }
    </style>

    <!-- Top: Hotline Detailed -->
    <?php get_template_part('template-parts/home/section', 'hotline'); ?>

    <!-- Middle: Main Content -->
    <div class="vf-ft-middle">
        <div class="vf-ft-middle-grid">
            <!-- Col 1: Tools -->
            <div class="vf-ft-widget">
                <span class="vf-ft-widget-title">Công cụ hỗ trợ</span>
                <ul class="vf-ft-menu">
                    <li><a href="<?php echo home_url('/dang-ky-lai-thu/'); ?>">Đăng ký lái thử</a></li>
                    <li><a href="<?php echo home_url('/dat-hen-dich-vu/'); ?>">Đặt hẹn dịch vụ</a></li>
                    <li><a href="<?php echo home_url('/yeu-cau-bao-gia/'); ?>">Yêu cầu báo giá</a></li>
                    <li><a href="<?php echo home_url('/mua-xe-tra-gop/'); ?>">Mua xe trả góp</a></li>
                    <li><a href="<?php echo home_url('/du-toan-chi-phi/'); ?>">Dự toán chi phí</a></li>
                </ul>
            </div>

            <!-- Col 2: News -->
            <div class="vf-ft-widget">
                <span class="vf-ft-widget-title">Tin tức sự kiện</span>
                <ul class="vf-ft-menu">
                    <li><a href="<?php echo home_url('/tin-tuc/'); ?>">Tin về VinFast</a></li>
                    <li><a href="<?php echo home_url('/tin-tuc/'); ?>">Người đẹp và xe</a></li>
                    <li><a href="<?php echo home_url('/tin-tuc/'); ?>">Xe và phong thủy</a></li>
                    <li><a href="<?php echo home_url('/tin-tuc/'); ?>">Tin tổng hợp</a></li>
                    <li><a href="<?php echo home_url('/tin-tuc/'); ?>">Tin khuyến mãi</a></li>
                </ul>
            </div>

            <!-- Col 3: Map -->
            <div class="vf-ft-widget">
                <div class="vf-ft-map-title">--- VINFAST VFG VĨNH PHÚC #1 CHÍNH HÃNG ---</div>
                <div class="vf-ft-map-box">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3711.2383820468087!2d105.37890781125211!3d21.34102608030113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31349195b0c950a7%3A0x6a2b85e00508a8e1!2zS20zIMSQxrDhu51uZyDEkGluaCBUacOqbiBIb8OgbmcsIERvbiBI4bqtdSwIFZp4buHdCBUcsOsLCBQaMO6IFRo4buNLCBWaWV0bmFt!5e0!3m2!1svi!2s!4v1715871234567!5m2!1svi!2s" width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom: Copyright & Info -->
    <div class="vf-ft-bottom">
        <div class="vf-ft-bottom-grid">
            <div class="vf-ft-info">
                <ul>
                    <li>Copyright © 2026 <b>ĐẠI LÝ VINFAST CHÍNH HÃNG - VINFAST VFG VĨNH PHÚC</b></li>
                    <li>Chịu trách nhiệm kinh doanh: <b><?php echo "Nguyễn Thế Toàn"; ?></b></li>
                    <li>[ĐỊA CHỈ]: Đường Đinh Tiên Hoàng, Đôn Hậu, Phường Vĩnh Phúc, Tỉnh Phú Thọ.</li>
                    <li>[Hotline]: <b>0971.569.093</b></li>
                    <li>[Email]: <a href="mailto:Thetoan19.tn@gmail.com" style="color: inherit; text-decoration: none;">Thetoan19.tn@gmail.com</a></li>
                </ul>
            </div>
            <div class="vf-ft-reg">
                <span class="vf-ft-reg-title">Đăng ký tư vấn dịch vụ web</span>
                <?php echo do_shortcode('[contact-form-7 id="125" title="Footer Registration"]'); ?>
                <div class="vf-ft-dev-credit">
                    Thiết kế bởi <a href="https://zalo.me/0971692675" target="_blank">CATCHIE</a>
                </div>
        <div class="vf-ft-legal">
            * Website được vận hành bởi đại lý ủy quyền của VinFast Việt Nam. Hình ảnh và thông số chỉ mang tính chất tham khảo.
        </div>
    </div>

    <!-- Bottom Left Floating Buttons -->
    <div class="vf-left-buttons">
        <a href="https://zalo.me/0971569093" class="vf-btn-item vf-btn-zalo" target="_blank">
            <div class="vf-icon-wrap">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/91/Icon_of_Zalo.svg" alt="Zalo">
            </div>
            Zalo tư vấn: 0971.569.093
        </a>
        <a href="tel:0971569093" class="vf-btn-item vf-btn-hotline">
            <div class="vf-icon-wrap">
                <img src="https://cdn-icons-png.flaticon.com/512/126/126509.png" alt="Hotline">
            </div>
            Hotline 24/7: 0971.569.093
        </a>
    </div>

    <?php do_action('flatsome_footer'); ?>
</footer>

</div> <!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>
