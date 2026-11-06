<?php
/* Template Name: Liên hệ VinFast */
get_header(); ?>

<style>
    .contact-page {
        padding: 60px 0;
        background: #fff;
        font-family: "Inter", sans-serif;
    }
    .contact-container {
        max-width: 1100px;
        margin: 0 auto;
    }
    .contact-title {
        text-align: center;
        font-weight: 800;
        text-transform: uppercase;
        margin-bottom: 40px;
    }
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 60px;
    }
    @media (max-width: 768px) {
        .contact-grid { grid-template-columns: 1fr; }
    }
    
    .contact-info-card {
        background: #fdfdfd;
        padding: 40px;
        border-radius: 20px;
        border-left: 5px solid #da251d;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .info-item {
        margin-bottom: 30px;
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }
    .info-item i {
        font-size: 24px;
        color: #da251d;
        width: 30px;
        text-align: center;
    }
    .info-label {
        font-weight: 700;
        display: block;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #888;
        margin-bottom: 8px;
    }
    .info-value {
        font-size: 17px;
        color: #333;
        line-height: 1.6;
        font-weight: 500;
    }
    .info-value a {
        color: #da251d;
        font-weight: 700;
        text-decoration: none;
        border-bottom: 2px solid transparent;
        transition: all 0.3s;
    }
    .info-value a:hover {
        border-bottom-color: #da251d;
    }

    .contact-form-wrapper {
        background: #fff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .contact-form-title {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 25px;
        text-transform: uppercase;
        color: #333;
    }
    /* Style for Contact Form 7 fields */
    .custom-cf7-form select {
        height: 45px !important;
        line-height: 1.2 !important;
        cursor: pointer;
    }
    .custom-cf7-form input:not([type="submit"]),
    .custom-cf7-form select,
    .custom-cf7-form textarea {
        width: 100% !important;
        padding: 12px 15px !important;
        border: 1px solid #ddd !important;
        border-radius: 5px !important;
        margin-bottom: 15px !important;
        font-size: 15px !important;
        background: #fff !important;
        transition: all 0.3s;
    }
    .custom-cf7-form input:focus,
    .custom-cf7-form select:focus,
    .custom-cf7-form textarea:focus {
        border-color: #da251d !important;
        outline: none;
        box-shadow: 0 0 5px rgba(218, 37, 29, 0.2);
    }
    .custom-cf7-form textarea {
        height: 120px !important;
    }
    .custom-cf7-form input[type="submit"] {
        background: #da251d !important;
        color: #fff !important;
        border: none !important;
        padding: 12px 40px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        border-radius: 5px !important;
        cursor: pointer !important;
        transition: background 0.3s;
    }
    .custom-cf7-form input[type="submit"]:hover {
        background: #b91d17 !important;
    }
    .custom-cf7-form input:not([type="submit"])::placeholder,
    .custom-cf7-form textarea::placeholder {
        color: #aaa;
    }
    .wpcf7-form p {
        margin-bottom: 0 !important;
    }
    .wpcf7-not-valid-tip {
        font-size: 13px;
        color: #da251d;
        margin-top: -10px;
        margin-bottom: 15px;
        display: block;
    }
    .wpcf7-response-output {
        border-radius: 5px !important;
        margin: 20px 0 0 0 !important;
        padding: 10px 15px !important;
        font-size: 14px !important;
    }
</style>

<div class="contact-page">
    <div class="contact-container">
        <h1 class="contact-title">Liên hệ - Góp ý</h1>

        <div class="contact-grid">
            <!-- Cột trái: Thông tin -->
            <div class="contact-col-left">
                <div class="contact-info-card">
                    <h2 style="font-size: 24px; margin-bottom: 30px;">TRỤ SỞ CHÍNH</h2>
                    
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <span class="info-label">Địa chỉ:</span>
                            <span class="info-value">Đường Đinh Tiên Hoàng, Đôn Hậu, Phường Vĩnh Phúc, Tỉnh Phú Thọ</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-car-side"></i>
                        <div>
                            <span class="info-label">Đại lý:</span>
                            <span class="info-value">VinFast VFG Vĩnh Phúc</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-user-tie"></i>
                        <div>
                            <span class="info-label">Đại diện bán hàng:</span>
                            <span class="info-value">Nguyễn Thế Toàn</span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <span class="info-label">Hotline Kinh doanh:</span>
                            <span class="info-value"><a href="tel:0971569093">0971.569.093</a></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <span class="info-label">Email:</span>
                            <span class="info-value"><a href="mailto:Thetoan19.tn@gmail.com">Thetoan19.tn@gmail.com</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột phải: Form & Map -->
            <div class="contact-col-right">
                <div class="contact-form-wrapper">
                    <div class="contact-form-title">GỬI TIN NHẮN CHO CHÚNG TÔI</div>
                    <div class="custom-cf7-form">
                        <?php echo do_shortcode('[contact-form-7 id="176" title="Liên hệ - Mẫu Chuẩn Đẹp"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
