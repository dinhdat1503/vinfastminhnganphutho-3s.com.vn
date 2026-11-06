<?php
/* Template Name: Yêu cầu báo giá VinFast Vĩnh Phúc */
get_header(); 
$uploads_url = content_url('/uploads/official_cars/common/');
?>

<style>
.vf-quote-wrapper {
  background: #F8FAFC !important;
  font-family: 'Mulish', 'Plus Jakarta Sans', 'Inter', sans-serif !important;
  min-height: 100vh !important;
  padding-bottom: 60px !important;
}

.vf-quote-hero {
  background: linear-gradient(135deg, #0F172A 0%, #1E3A8A 60%, #2563EB 100%) !important;
  color: #ffffff !important;
  padding: 50px 20px 60px 20px !important;
  text-align: center !important;
}

.vf-quote-hero-inner {
  max-width: 800px !important;
  margin: 0 auto !important;
}

.vf-quote-badge {
  display: inline-block !important;
  background: rgba(255, 255, 255, 0.15) !important;
  color: #60A5FA !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  letter-spacing: 1px !important;
  padding: 6px 14px !important;
  border-radius: 20px !important;
  margin-bottom: 12px !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
}

.vf-quote-title {
  font-size: 30px !important;
  font-weight: 900 !important;
  color: #ffffff !important;
  margin: 0 0 12px 0 !important;
  text-transform: uppercase !important;
}

.vf-quote-subtitle {
  font-size: 15px !important;
  color: #94A3B8 !important;
  margin: 0 !important;
  line-height: 1.6 !important;
}

.vf-quote-main {
  max-width: 960px !important;
  margin: -40px auto 0 auto !important;
  padding: 0 20px !important;
  position: relative !important;
  z-index: 10 !important;
}

.vf-quote-card {
  background: #ffffff !important;
  border-radius: 20px !important;
  padding: 40px !important;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08) !important;
  border: 1px solid #E2E8F0 !important;
}

.vf-quote-head {
  margin-bottom: 28px !important;
  border-bottom: 1px solid #F1F5F9 !important;
  padding-bottom: 20px !important;
}

.vf-quote-head h2 {
  font-size: 22px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 0 0 6px 0 !important;
  text-transform: uppercase !important;
}

.vf-quote-head p {
  font-size: 14px !important;
  color: #64748B !important;
  margin: 0 !important;
}

@media (max-width: 768px) {
  .vf-quote-card {
    padding: 24px 18px !important;
  }
  .vf-quote-title {
    font-size: 22px !important;
  }
}
</style>

<div class="vf-quote-wrapper">
  <!-- HERO HEADER -->
  <div class="vf-quote-hero">
    <div class="vf-quote-hero-inner">
      <span class="vf-quote-badge">⚡ BẢO HÀNH CHÍNH HÃNG 10-12 NĂM</span>
      <h1 class="vf-quote-title">YÊU CẦU BÁO GIÁ XE VINFAST VĨNH PHÚC</h1>
      <p class="vf-quote-subtitle">
        Nhận bảng tính chi phí lăn bánh chi tiết, chương trình ưu đãi mới nhất và chính sách trả góp ngân hàng từ Đại lý VinFast Vĩnh Phúc.
      </p>
    </div>
  </div>

  <!-- MAIN FORM CONTAINER -->
  <div class="vf-quote-main">
    <div class="vf-quote-card">
      <div class="vf-quote-head">
        <h2>ĐIỀN THÔNG TIN NHẬN BÁO GIÁ LĂN BÁNH</h2>
        <p>Chuyên viên VinFast Vĩnh Phúc sẽ gửi bảng giá và liên hệ tư vấn trực tiếp trong 5-10 phút.</p>
      </div>

      <?php echo vfvp_render_lead_form(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>
