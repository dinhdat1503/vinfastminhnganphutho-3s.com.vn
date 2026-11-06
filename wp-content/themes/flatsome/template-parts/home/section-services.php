<?php /* SECTION 4: DỊCH VỤ — Thiết kế dạng Grid các vòng tròn (tương tự bản gốc nhưng chuẩn Responsive) */ ?>
<style>
/* ===== DỊCH VỤ ===== */
.vf-services-wrap {
    padding: 100px 0;
    background-image: url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?auto=format&fit=crop&q=80&w=1600');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    color: #333;
    position: relative;
}

/* Light overlay to make content readable on background */
.vf-svc-overlay {
    position: absolute;
    inset: 0;
    background: rgba(255, 255, 255, 0.6); /* Reduced from 0.85 to make it brighter/pop more */
    z-index: 1;
}

.vf-svc-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.vf-svc-head {
    text-align: center;
    margin-bottom: 60px;
}

.vf-svc-head h2 {
    font-size: 2.8rem;
    font-weight: 900;
    color: #1a1a2e;
    text-transform: uppercase;
    font-family: 'Arial Black', sans-serif;
    margin: 0;
    letter-spacing: 2px;
}
.vf-svc-head .vf-line {
    width: 60px; height: 4px; background: #c02428; margin: 15px auto 0; border-radius: 2px;
}

/* Flex Container cho các dịch vụ */
.vf-svc-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 40px 30px;
}

.vf-svc-item {
    width: calc(33.333% - 20px);
    max-width: 300px;
    text-align: center;
    cursor: pointer;
    text-decoration: none;
    display: block;
}

/* Vòng tròn chứa ảnh */
.vf-svc-circle {
    width: 200px;
    height: 200px;
    margin: 0 auto 24px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #eee;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: all 0.5s cubic-bezier(0.25, 0.8, 0.25, 1);
    position: relative;
    background: #2a2a3e;
}

.vf-svc-circle img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
    opacity: 1;
}

/* Hiệu ứng hover cực xịn */
.vf-svc-item:hover .vf-svc-circle {
    border-color: #c02428;
    box-shadow: 0 15px 40px rgba(192, 36, 40, 0.5);
    transform: translateY(-12px);
}

.vf-svc-item:hover .vf-svc-circle img {
    transform: scale(1.15);
    opacity: 1;
}

.vf-svc-title {
    font-size: 1.15rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #333;
    transition: color 0.3s;
    line-height: 1.4;
}

.vf-svc-item:hover .vf-svc-title {
    color: #c02428;
}

/* Đường nối (Decorative Lines) - Tùy chọn làm đẹp thêm */
.vf-svc-item { position: relative; }

/* Responsive */
@media(max-width: 992px) {
    .vf-svc-item { width: calc(50% - 15px); }
}
@media(max-width: 576px) {
    .vf-svc-item { width: 100%; }
    .vf-svc-circle { width: 160px; height: 160px; }
    .vf-svc-title { font-size: 1.05rem; }
    .vf-svc-head h2 { font-size: 2.2rem; }
}
</style>

<div class="vf-services-wrap">
  <div class="vf-svc-overlay"></div>
  
  <div class="vf-svc-content">
    <div class="vf-svc-head">
      <h2>DỊCH VỤ</h2>
      <div class="vf-line"></div>
    </div>

    <div class="vf-svc-grid">

      <!-- Dịch vụ 1 -->
      <a href="<?php echo home_url('/dich-vu/'); ?>" class="vf-svc-item">
        <div class="vf-svc-circle">
          <img src="https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&q=80&w=400" alt="Đặt hẹn dịch vụ">
        </div>
        <div class="vf-svc-title">ĐẶT HẸN DỊCH VỤ</div>
      </a>

      <!-- Dịch vụ 2 -->
      <a href="<?php echo home_url('/dich-vu/'); ?>" class="vf-svc-item">
        <div class="vf-svc-circle">
          <img src="https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&q=80&w=400" alt="Bảo dưỡng định kỳ">
        </div>
        <div class="vf-svc-title">BẢO DƯỠNG ĐỊNH KỲ</div>
      </a>

      <!-- Dịch vụ 3 -->
      <a href="<?php echo home_url('/dich-vu/'); ?>" class="vf-svc-item">
        <div class="vf-svc-circle">
          <img src="https://images.unsplash.com/photo-1597328290883-50c5787b7c7e?auto=format&fit=crop&q=80&w=400" alt="Sơn nhanh">
        </div>
        <div class="vf-svc-title">SƠN NHANH</div>
      </a>

      <!-- Dịch vụ 4 -->
      <a href="<?php echo home_url('/dich-vu/'); ?>" class="vf-svc-item">
        <div class="vf-svc-circle">
          <img src="https://images.unsplash.com/photo-1504222490345-c075b6008014?auto=format&fit=crop&q=80&w=400" alt="Bảo dưỡng nhanh">
        </div>
        <div class="vf-svc-title">BẢO DƯỠNG NHANH</div>
      </a>

      <!-- Dịch vụ 5 -->
      <a href="<?php echo home_url('/dich-vu/'); ?>" class="vf-svc-item">
        <div class="vf-svc-circle">
          <img src="https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&q=80&w=400" alt="Chăm sóc và làm đẹp xe">
        </div>
        <div class="vf-svc-title">CHĂM SÓC VÀ LÀM ĐẸP XE</div>
      </a>

      <!-- Dịch vụ 6 -->
      <a href="<?php echo home_url('/dich-vu/'); ?>" class="vf-svc-item">
        <div class="vf-svc-circle">
          <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=400" alt="Hỗ trợ cứu hộ">
        </div>
        <div class="vf-svc-title">HỖ TRỢ CỨU HỘ</div>
      </a>

    </div>
  </div>
</div>
