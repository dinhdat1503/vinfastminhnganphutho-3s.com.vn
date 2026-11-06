<?php
/**
 * Template Name: Dự toán chi phí lăn bánh
 */
defined('ABSPATH') || exit;
get_header();
?>

<style>
/* ============================================================
   DỰ TOÁN CHI PHÍ LĂN BÁNH & TRẢ GÓP VINFAST (VINFAST VĨNH PHÚC)
   ============================================================ */
#vf-print-container {
  display: none;
}

@media print {
  /* Ẩn toàn bộ giao diện Web, sticky bar, mobile bar khi in PDF */
  #header, #footer, header, footer, .vf-calc-page, .vf-quick-action-bar, .vf-quick-bar, .vf-sticky-bar-mobile, .vf-mobile-bar, .vf-sticky-bar, .vf-sticky-item, .vf-footer-bottom, #modal-laythu, .floating-sidebar, .scroll-to-top, .vf-back-to-top, .vf-btn, div[class*="vf-mobile"], div[class*="sticky"] {
    display: none !important;
    opacity: 0 !important;
    visibility: hidden !important;
    height: 0 !important;
    width: 0 !important;
    position: absolute !important;
    overflow: hidden !important;
    top: -9999px !important;
  }

  body {
    background: #ffffff !important;
    margin: 0 !important;
    padding: 0 !important;
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif !important;
    color: #1e293b !important;
    -webkit-print-color-adjust: exact !important;
    print-color-adjust: exact !important;
  }

  #vf-print-container {
    display: block !important;
    width: 100% !important;
    padding: 0 !important;
    margin: 0 !important;
  }

  .vf-print-header {
    text-align: center;
    border-bottom: 3px double #2563eb;
    padding-bottom: 12px;
    margin-bottom: 16px;
  }

  .vf-print-logo-title {
    font-size: 18px;
    font-weight: 800;
    color: #2563eb;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 4px;
  }

  .vf-print-doc-title {
    font-size: 15px;
    font-weight: 700;
    color: #0f172a;
    text-transform: uppercase;
    margin-bottom: 6px;
  }

  .vf-print-meta {
    font-size: 11px;
    color: #475569;
  }

  .vf-print-section-title {
    font-size: 12px;
    font-weight: 800;
    color: #0f172a;
    text-transform: uppercase;
    background: #f1f5f9;
    padding: 6px 10px;
    border-left: 4px solid #2563eb;
    margin: 14px 0 8px 0;
    page-break-after: avoid;
  }

  .vf-print-grid-2 {
    display: flex !important;
    gap: 20px;
    align-items: center;
    margin-bottom: 12px;
  }

  .vf-print-car-info {
    flex: 1;
  }

  .vf-print-car-img-box {
    width: 180px;
    text-align: center;
  }

  .vf-print-car-img-box img {
    max-width: 100%;
    max-height: 110px;
    object-fit: contain;
  }

  .vf-print-table-info {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
    margin-bottom: 8px;
  }

  .vf-print-table-info td {
    padding: 4px 8px;
    border-bottom: 1px solid #e2e8f0;
  }

  .vf-print-table-info td.label {
    font-weight: 700;
    color: #475569;
    width: 42%;
  }

  .vf-print-table-info td.val {
    font-weight: 700;
    color: #0f172a;
  }

  .vf-print-table-fees {
    width: 100%;
    border-collapse: collapse;
    font-size: 11px;
    margin-bottom: 12px;
  }

  .vf-print-table-fees th, .vf-print-table-fees td {
    padding: 5px 8px;
    border: 1px solid #cbd5e1;
  }

  .vf-print-table-fees th {
    background: #f8fafc !important;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 10px;
    color: #334155;
  }

  .vf-print-table-fees tr.total-row td {
    background: #eff6ff !important;
    font-weight: 800;
    color: #2563eb;
    font-size: 12px;
  }

  .vf-print-loan-summary {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 12px;
    page-break-inside: avoid;
  }

  .vf-print-loan-box {
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    padding: 8px 10px;
    background: #f8fafc !important;
    text-align: center;
  }

  .vf-print-loan-lbl {
    font-size: 10px;
    font-weight: 700;
    color: #64748b;
    text-transform: uppercase;
  }

  .vf-print-loan-val {
    font-size: 12px;
    font-weight: 800;
    color: #2563eb;
    margin-top: 2px;
  }

  .vf-print-schedule-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 10px;
    margin-bottom: 12px;
  }

  .vf-print-schedule-table th, .vf-print-schedule-table td {
    padding: 4px 6px;
    border: 1px solid #cbd5e1;
    text-align: left;
  }

  .vf-print-schedule-table th {
    background: #f1f5f9 !important;
    font-weight: 700;
  }

  .vf-print-signatures {
    display: flex !important;
    justify-content: space-between;
    margin-top: 24px;
    page-break-inside: avoid;
  }

  .vf-print-sig-box {
    text-align: center;
    width: 45%;
  }

  .vf-print-sig-title {
    font-weight: 800;
    font-size: 11px;
    color: #0f172a;
    text-transform: uppercase;
  }

  .vf-print-sig-sub {
    font-size: 9px;
    color: #64748b;
    font-style: italic;
    margin-top: 2px;
  }

  .vf-print-sig-space {
    height: 50px;
  }

  .vf-print-sec4-wrap {
    page-break-before: always !important;
    break-before: page !important;
    page-break-inside: avoid !important;
    break-inside: avoid-page !important;
  }

  .vf-print-note {
    font-size: 9px;
    color: #64748b;
    font-style: italic;
    margin-top: 12px;
    border-top: 1px dashed #cbd5e1;
    padding-top: 6px;
    page-break-inside: avoid;
  }

  @page {
    size: A4 portrait;
    margin: 8mm 10mm;
  }
}

.vf-calc-page {
  font-family: var(--vf-font, 'Plus Jakarta Sans', 'Inter', sans-serif) !important;
  background-color: #F8FAFC !important;
  padding: 40px 0 80px !important;
  color: #1E293B !important;
}

.vf-calc-page * {
  box-sizing: border-box;
  font-family: inherit;
}

/* Header Section */
.vf-calc-header {
  text-align: center;
  max-width: 800px;
  margin: 0 auto 40px;
  padding: 0 20px;
}

.vf-calc-badge {
  display: inline-block;
  background: #EFF6FF;
  color: #2563EB;
  font-size: 13px;
  font-weight: 700;
  padding: 6px 16px;
  border-radius: 30px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 12px;
}

.vf-calc-title {
  font-size: 2.4rem;
  font-weight: 800;
  color: #0F172A;
  margin: 0 0 16px;
  line-height: 1.25;
  letter-spacing: -0.5px;
}

.vf-calc-subtitle {
  font-size: 1rem;
  color: #64748B;
  line-height: 1.6;
  margin: 0;
}

/* Main Layout Grid */
.vf-calc-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 32px;
  align-items: start;
}

@media (max-width: 991px) {
  .vf-calc-grid {
    grid-template-columns: 1fr;
  }
}

/* Form Card */
.vf-calc-card {
  background: #FFFFFF;
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
  border: 1px solid #E2E8F0;
}

.vf-calc-step-title {
  font-size: 1.15rem;
  font-weight: 800;
  color: #0F172A;
  margin: 0 0 20px;
  display: flex;
  align-items: center;
  gap: 10px;
  padding-bottom: 12px;
  border-bottom: 2px solid #F1F5F9;
}

.vf-calc-step-num {
  background: #2563EB;
  color: #FFFFFF;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 800;
}

/* Form Controls */
.vf-calc-form-group {
  margin-bottom: 24px;
}

.vf-calc-label {
  display: block;
  font-size: 14px;
  font-weight: 700;
  color: #334155;
  margin-bottom: 8px;
}

.vf-calc-select,
.vf-calc-input {
  width: 100%;
  height: 48px;
  padding: 0 16px;
  font-size: 15px;
  font-weight: 600;
  color: #0F172A;
  background-color: #F8FAFC;
  border: 1.5px solid #CBD5E1;
  border-radius: 8px;
  outline: none;
  transition: all 0.2s ease;
}

.vf-calc-select:focus,
.vf-calc-input:focus {
  border-color: #2563EB;
  background-color: #FFFFFF;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
}

/* Radio Toggle Pills */
.vf-calc-pill-group {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 10px;
}

.vf-calc-pill-3 {
  grid-template-columns: repeat(3, 1fr);
}

.vf-calc-pill-5 {
  grid-template-columns: repeat(5, 1fr);
}

.vf-calc-pill {
  position: relative;
}

.vf-calc-pill input[type="radio"] {
  position: absolute;
  opacity: 0;
  width: 0;
  height: 0;
}

.vf-calc-pill label {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 44px;
  background-color: #F1F5F9;
  color: #475569;
  border: 1.5px solid #E2E8F0;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.2s ease;
  text-align: center;
  padding: 0 8px;
}

.vf-calc-pill input[type="radio"]:checked + label {
  background-color: #EFF6FF;
  color: #2563EB;
  border-color: #2563EB;
  box-shadow: 0 4px 12px rgba(37, 99, 235, 0.12);
}

/* Car Preview Box */
.vf-calc-car-preview {
  text-align: center;
  padding: 20px;
  background: #F8FAFC;
  border-radius: 12px;
  margin-bottom: 24px;
  border: 1px dashed #CBD5E1;
}

.vf-calc-car-img {
  max-height: 180px;
  width: auto;
  object-fit: contain;
  margin: 0 auto 12px;
  filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));
  transition: transform 0.3s ease;
}

.vf-calc-car-img:hover {
  transform: scale(1.03);
}

.vf-calc-car-name {
  font-size: 1.25rem;
  font-weight: 800;
  color: #0F172A;
  margin: 0 0 4px;
}

.vf-calc-car-price-tag {
  font-size: 1.35rem;
  font-weight: 800;
  color: #2563EB;
}

/* Result Box Sticky Right */
.vf-calc-result-card {
  position: sticky;
  top: 100px;
  background: #FFFFFF;
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 12px 36px rgba(15, 23, 42, 0.08);
  border: 2px solid #2563EB;
}

.vf-calc-total-banner {
  background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
  border-radius: 12px;
  padding: 24px;
  color: #FFFFFF;
  text-align: center;
  margin-bottom: 24px;
  box-shadow: 0 8px 24px rgba(37, 99, 235, 0.3);
}

.vf-calc-total-label {
  font-size: 13px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  opacity: 0.9;
  margin-bottom: 4px;
}

.vf-calc-total-val {
  font-size: 2.2rem;
  font-weight: 800;
  letter-spacing: -0.5px;
}

/* Summary Grid Breakdown */
.vf-calc-summary-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-bottom: 24px;
}

.vf-calc-sum-box {
  background: #F8FAFC;
  padding: 14px 16px;
  border-radius: 10px;
  border: 1px solid #E2E8F0;
}

.vf-calc-sum-lbl {
  font-size: 12px;
  font-weight: 700;
  color: #64748B;
  text-transform: uppercase;
  margin-bottom: 4px;
}

.vf-calc-sum-num {
  font-size: 1.1rem;
  font-weight: 800;
  color: #0F172A;
}

.vf-calc-sum-num.highlight {
  color: #2563EB;
}

/* Fee Breakdown List */
.vf-calc-fee-list {
  list-style: none;
  padding: 0;
  margin: 0 0 28px;
}

.vf-calc-fee-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 0;
  border-bottom: 1px dashed #E2E8F0;
  font-size: 14px;
}

.vf-calc-fee-item:last-child {
  border-bottom: none;
}

.vf-calc-fee-name {
  color: #475569;
  font-weight: 600;
}

.vf-calc-fee-val {
  font-weight: 700;
  color: #0F172A;
}

.vf-calc-fee-val.free {
  color: #16A34A;
  background: #DCFCE7;
  padding: 2px 8px;
  border-radius: 4px;
  font-size: 12px;
}

/* CTA Buttons */
.vf-calc-actions {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.vf-calc-actions .vf-btn {
  width: 100% !important;
}

/* Schedule Table Section */
.vf-calc-table-wrap {
  margin-top: 40px;
  background: #FFFFFF;
  border-radius: 16px;
  padding: 32px;
  box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
  border: 1px solid #E2E8F0;
}

.vf-calc-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  font-size: 14px;
}

.vf-calc-table th {
  background-color: #F8FAFC;
  color: #475569;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 12px;
  letter-spacing: 0.5px;
  padding: 14px;
  text-align: left;
  border-bottom: 2px solid #E2E8F0;
}

.vf-calc-table td {
  padding: 14px;
  border-bottom: 1px solid #F1F5F9;
  color: #1E293B;
  font-weight: 600;
}

.vf-calc-table tr:hover td {
  background-color: #F8FAFC;
}

/* Mobile Responsive */
@media (max-width: 768px) {
  .vf-calc-title {
    font-size: 1.75rem;
  }
  .vf-calc-card,
  .vf-calc-result-card,
  .vf-calc-table-wrap {
    padding: 20px;
    border-radius: 12px;
  }
  .vf-calc-pill-3 {
    grid-template-columns: 1fr;
  }
  .vf-calc-summary-grid {
    grid-template-columns: 1fr;
  }
  .vf-calc-table-scroll {
    overflow-x: auto;
  }
  .vf-calc-table {
    min-width: 600px;
  }
}
</style>

<div class="vf-calc-page">
  <div class="container">
    
    <!-- Header -->
    <div class="vf-calc-header">
      <span class="vf-calc-badge">Công Cụ Độc Quyền VinFast Tân Á Châu</span>
      <h1 class="vf-calc-title">Dự Toán Chi Phí Lăn Bánh & Trả Góp Xe VinFast</h1>
      <p class="vf-calc-subtitle">
        Tính toán chi phí hoàn lăn bánh chính xác và bảng dự toán lịch trả góp ngân hàng hàng tháng cho tất cả các dòng xe ô tô điện VinFast chính hãng.
      </p>
    </div>

    <!-- Calculator Grid -->
    <div class="vf-calc-grid">
      
      <!-- Left Column: Options Form -->
      <div class="vf-calc-card">
        
        <!-- Step 1 -->
        <div class="vf-calc-step-title">
          <span class="vf-calc-step-num">1</span>
          <span>Chọn Dòng Xe & Phiên Bản VinFast</span>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label" for="vf-select-model">Dòng xe VinFast:</label>
          <select id="vf-select-model" class="vf-calc-select">
            <optgroup label="Dòng Xe Ô Tô Điện Cá Nhân">
              <option value="vf2">VinFast VF 2 (Mini Electric)</option>
              <option value="vf3">VinFast VF 3 (Xe Điện Thông Minh Mini SUV)</option>
              <option value="vf5" selected>VinFast VF 5 Plus (A-SUV Đô Thị)</option>
              <option value="vf6">VinFast VF 6 (B-SUV Đô Thị)</option>
              <option value="vf7">VinFast VF 7 (C-SUV Thể Thao)</option>
              <option value="vf8">VinFast VF 8 (D-SUV Đỉnh Cao)</option>
              <option value="vf8_allnew">VinFast VF 8 The All New</option>
              <option value="vf9">VinFast VF 9 (E-SUV Đẳng Cấp Sang Trọng)</option>
              <option value="vfwild">VinFast VF Wild (Bán Tải Điện Địa Hình REEV)</option>
              <option value="mpv7">VinFast VF MPV 7 (MPV Điện 7 Chỗ)</option>
            </optgroup>
            <optgroup label="Dòng Xe Dịch Vụ & Thương Mại">
              <option value="minio">Minio Green (Xe dịch vụ Mini)</option>
              <option value="herio">Herio Green (Xe dịch vụ Sedan)</option>
              <option value="nerio">Nerio Green (Xe dịch vụ SUV)</option>
              <option value="limo">Limo Green (Xe dịch vụ Limo 7 chỗ)</option>
              <option value="ecvan">VinFast EC Van (Xe Tải Van Điện)</option>
            </optgroup>
          </select>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label" for="vf-select-version">Phiên bản xe:</label>
          <select id="vf-select-version" class="vf-calc-select">
            <!-- Dynamically populated -->
          </select>
        </div>

        <!-- Car Live Preview -->
        <div class="vf-calc-car-preview">
          <img id="vf-preview-img" src="" alt="VinFast Car" class="vf-calc-car-img">
          <div id="vf-preview-name" class="vf-calc-car-name">VinFast VF 5 Plus</div>
          <div id="vf-preview-price" class="vf-calc-car-price-tag">468.000.000 VNĐ</div>
        </div>

        <!-- Step 2 -->
        <div class="vf-calc-step-title">
          <span class="vf-calc-step-num">2</span>
          <span>Địa Phương Đăng Ký & Chủ Xe</span>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label">Tỉnh / Thành phố đăng ký biển số:</label>
          <div class="vf-calc-pill-group">
            <div class="vf-calc-pill">
              <input type="radio" id="province-vinhphuc" name="province" value="tinh" checked>
              <label for="province-vinhphuc">Vĩnh Phúc & Các Tỉnh</label>
            </div>
            <div class="vf-calc-pill">
              <input type="radio" id="province-hanoi" name="province" value="hanoi">
              <label for="province-hanoi">Hà Nội / TP. Hồ Chí Minh</label>
            </div>
          </div>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label">Đối tượng đứng tên xe:</label>
          <div class="vf-calc-pill-group">
            <div class="vf-calc-pill">
              <input type="radio" id="owner-personal" name="owner" value="canhan" checked>
              <label for="owner-personal">Cá nhân</label>
            </div>
            <div class="vf-calc-pill">
              <input type="radio" id="owner-company" name="owner" value="doanhnghiep">
              <label for="owner-company">Doanh nghiệp / Kinh doanh</label>
            </div>
          </div>
        </div>

        <!-- Step 3 -->
        <div class="vf-calc-step-title">
          <span class="vf-calc-step-num">3</span>
          <span>Cấu Hình Vay Trả Góp Ngân Hàng</span>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label">Số tiền trả trước (% giá xe):</label>
          <div class="vf-calc-pill-group vf-calc-pill-5">
            <div class="vf-calc-pill">
              <input type="radio" id="down-15" name="downpayment" value="15">
              <label for="down-15">15%</label>
            </div>
            <div class="vf-calc-pill">
              <input type="radio" id="down-20" name="downpayment" value="20" checked>
              <label for="down-20">20%</label>
            </div>
            <div class="vf-calc-pill">
              <input type="radio" id="down-30" name="downpayment" value="30">
              <label for="down-30">30%</label>
            </div>
            <div class="vf-calc-pill">
              <input type="radio" id="down-50" name="downpayment" value="50">
              <label for="down-50">50%</label>
            </div>
            <div class="vf-calc-pill">
              <input type="radio" id="down-70" name="downpayment" value="70">
              <label for="down-70">70%</label>
            </div>
          </div>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label" for="vf-select-tenure">Thời gian vay ngân hàng:</label>
          <select id="vf-select-tenure" class="vf-calc-select">
            <option value="12">1 năm (12 tháng)</option>
            <option value="24">2 năm (24 tháng)</option>
            <option value="36">3 năm (36 tháng)</option>
            <option value="48">4 năm (48 tháng)</option>
            <option value="60" selected>5 năm (60 tháng)</option>
            <option value="72">6 năm (72 tháng)</option>
            <option value="84">7 năm (84 tháng)</option>
            <option value="96">8 năm (96 tháng)</option>
          </select>
        </div>

        <div class="vf-calc-form-group">
          <label class="vf-calc-label" for="vf-input-interest">Lãi suất ưu đãi (%/năm):</label>
          <input type="number" id="vf-input-interest" class="vf-calc-input" value="7.5" step="0.1" min="1" max="20">
        </div>

      </div>

      <!-- Right Column: Results sticky -->
      <div>
        <div class="vf-calc-result-card">

          <!-- Banner Total -->
          <div class="vf-calc-total-banner">
            <div class="vf-calc-total-label">Tổng Chi Phí Lăn Bánh Tạm Tính</div>
            <div id="vf-res-lanbanh" class="vf-calc-total-val">472.380.700 VNĐ</div>
          </div>

          <!-- Quick Summary Grid -->
          <div class="vf-calc-summary-grid">
            <div class="vf-calc-sum-box">
              <div class="vf-calc-sum-lbl">Trả trước lăn bánh</div>
              <div id="vf-res-tratruoc" class="vf-calc-sum-num highlight">101.980.700 VNĐ</div>
            </div>
            <div class="vf-calc-sum-box">
              <div class="vf-calc-sum-lbl">Vay ngân hàng</div>
              <div id="vf-res-sotienvay" class="vf-calc-sum-num">374.400.000 VNĐ</div>
            </div>
            <div class="vf-calc-sum-box" style="grid-column: span 2;">
              <div class="vf-calc-sum-lbl">Trả góp tháng đầu tiên (Gốc + Lãi)</div>
              <div id="vf-res-thangdau" class="vf-calc-sum-num highlight" style="font-size: 1.35rem; color: #2563EB;">8.580.000 VNĐ/tháng</div>
            </div>
          </div>

          <!-- Detailed Fee Table -->
          <div style="font-weight: 800; font-size: 1rem; color: #0F172A; margin-bottom: 12px;">Chi Tiết Các Khoản Phí Lăn Bánh:</div>
          <ul class="vf-calc-fee-list">
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Giá niêm yết xe:</span>
              <span id="vf-fee-giaxe" class="vf-calc-fee-val">468.000.000 VNĐ</span>
            </li>
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Lệ phí trước bạ (Ô tô điện 0%):</span>
              <span class="vf-calc-fee-val free">0 VNĐ (Miễn 100%)</span>
            </li>
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Phí cấp biển số:</span>
              <span id="vf-fee-bienso" class="vf-calc-fee-val">1.000.000 VNĐ</span>
            </li>
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Phí đăng kiểm:</span>
              <span id="vf-fee-dangkiem" class="vf-calc-fee-val">340.000 VNĐ</span>
            </li>
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Phí bảo trì đường bộ (1 năm):</span>
              <span id="vf-fee-duongbo" class="vf-calc-fee-val">1.560.000 VNĐ</span>
            </li>
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Bảo hiểm TNDS (1 năm):</span>
              <span id="vf-fee-tnds" class="vf-calc-fee-val">480.700 VNĐ</span>
            </li>
            <li class="vf-calc-fee-item">
              <span class="vf-calc-fee-name">Phí dịch vụ đăng ký (Tạm tính):</span>
              <span id="vf-fee-dichvu" class="vf-calc-fee-val">1.000.000 VNĐ</span>
            </li>
          </ul>

          <!-- Action Buttons -->
          <div class="vf-calc-actions" style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
            <button type="button" class="vf-btn vf-btn-primary" onclick="vfOpenModal('tu-van')" style="grid-column: span 2;">
              NHẬN BÁO GIÁ LĂN BÁNH CHI TIẾT
            </button>
            <button type="button" class="vf-btn vf-btn-outline" onclick="vfExportExcel()" style="background:#16a34a; color:#fff; border-color:#16a34a;">
              📊 TẢI FILE EXCEL
            </button>
            <button type="button" class="vf-btn vf-btn-outline" onclick="vfExportPDF()" style="background:#0284c7; color:#fff; border-color:#0284c7;">
              🖨️ TẢI FILE PDF
            </button>
            <button type="button" class="vf-btn vf-btn-outline" onclick="vfOpenModal('lai-thu')" style="grid-column: span 2;">
              ĐĂNG KÝ LÁI THỬ TẠI VĨNH PHÚC
            </button>
          </div>

        </div>
      </div>

    </div>

    <!-- Monthly Payment Schedule Table -->
    <div class="vf-calc-table-wrap">
      <h3 style="font-size: 1.3rem; font-weight: 800; color: #0F172A; margin: 0 0 8px;">
        Bảng Lịch Trả Góp Dự Kiến (Dư Nợ Giảm Dần)
      </h3>
      <p style="color: #64748B; font-size: 0.95rem; margin: 0 0 20px;">
        Số tiền gốc trả đều hàng tháng kết hợp tiền lãi tính theo dư nợ giảm dần thực tế.
      </p>

      <div class="vf-calc-table-scroll">
        <table class="vf-calc-table">
          <thead>
            <tr>
              <th>Kỳ vay (Tháng)</th>
              <th>Dư nợ đầu kỳ</th>
              <th>Tiền gốc hàng tháng</th>
              <th>Tiền lãi hàng tháng</th>
              <th>Tổng trả hàng tháng</th>
            </tr>
          </thead>
          <tbody id="vf-schedule-tbody">
            <!-- Dynamically generated rows -->
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- ============================================================
     BẢNG DỰ TOÁN IN PDF DÀNH CHO KHÁCH HÀNG (CHÍNH THỨC VINFAST VĨNH PHÚC)
     ============================================================ -->
<div id="vf-print-container">
  <!-- Header Banner -->
  <div class="vf-print-header">
    <div class="vf-print-logo-title">ĐẠI LÝ VINFAST TÂN Á CHÂU</div>
    <div class="vf-print-doc-title">BẢNG DỰ TOÁN CHI PHÍ LĂN BÁNH & VAY TRẢ GÓP KHÁCH HÀNG</div>
    <div class="vf-print-meta">
      Hotline: <strong>056 225 6256</strong> | Địa chỉ: 191 Đường Hùng Vương, Phường Vĩnh Yên, Tỉnh Phú Thọ , Vinh Yen, Vietnam | Ngày lập: <span id="vf-print-date"></span>
    </div>
  </div>

  <!-- Section 1: Thông tin xe & Cấu hình -->
  <div class="vf-print-section-title">1. THÔNG TIN XE & CẤU HÌNH DỰ TOÁN</div>
  <div class="vf-print-grid-2">
    <div class="vf-print-car-info">
      <table class="vf-print-table-info">
        <tr>
          <td class="label">Dòng xe chọn:</td>
          <td class="val" id="vf-print-car-name">VinFast VF 5 Plus</td>
        </tr>
        <tr>
          <td class="label">Phiên bản xe:</td>
          <td class="val" id="vf-print-version-name">VF 5 Plus (Thuê Pin)</td>
        </tr>
        <tr>
          <td class="label">Giá niêm yết:</td>
          <td class="val" id="vf-print-car-price" style="color:#2563eb;">468.000.000 VNĐ</td>
        </tr>
        <tr>
          <td class="label">Khu vực đăng ký:</td>
          <td class="val" id="vf-print-province">Vĩnh Phúc & Các Tỉnh</td>
        </tr>
        <tr>
          <td class="label">Chủ xe đứng tên:</td>
          <td class="val" id="vf-print-owner">Cá nhân</td>
        </tr>
        <tr>
          <td class="label">Tỷ lệ trả trước xe:</td>
          <td class="val" id="vf-print-downpayment-pct">20% (Tiền xe)</td>
        </tr>
        <tr>
          <td class="label">Thời hạn vay:</td>
          <td class="val" id="vf-print-tenure">5 năm (60 tháng)</td>
        </tr>
        <tr>
          <td class="label">Lãi suất ưu đãi:</td>
          <td class="val" id="vf-print-interest">7.5%/năm</td>
        </tr>
      </table>
    </div>
    <div class="vf-print-car-img-box">
      <img id="vf-print-car-img" src="" alt="VinFast Car">
      <div style="font-weight:700; font-size:10px; color:#334155; margin-top:4px;" id="vf-print-car-badge">VinFast VF 5 Plus</div>
    </div>
  </div>

  <!-- Section 2: Chi tiết phí lăn bánh -->
  <div class="vf-print-section-title">2. CHI TIẾT CÁC KHOẢN PHÍ LĂN BÁNH TẠM TÍNH</div>
  <table class="vf-print-table-fees">
    <thead>
      <tr>
        <th style="width: 60%;">Khoản Phí / Chi Phí</th>
        <th style="width: 40%; text-align: right;">Số Tiền (VNĐ)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1. Giá niêm yết xe</td>
        <td style="text-align: right; font-weight: 700;" id="vf-print-fee-giaxe">468.000.000 VNĐ</td>
      </tr>
      <tr>
        <td>2. Lệ phí trước bạ (Ô tô điện 0%)</td>
        <td style="text-align: right; color: #16a34a; font-weight: 700;">0 VNĐ (Miễn 100%)</td>
      </tr>
      <tr>
        <td>3. Phí cấp biển số</td>
        <td style="text-align: right; font-weight: 700;" id="vf-print-fee-bienso">1.000.000 VNĐ</td>
      </tr>
      <tr>
        <td>4. Phí kiểm định xe</td>
        <td style="text-align: right; font-weight: 700;" id="vf-print-fee-dangkiem">340.000 VNĐ</td>
      </tr>
      <tr>
        <td>5. Phí bảo trì đường bộ (1 năm)</td>
        <td style="text-align: right; font-weight: 700;" id="vf-print-fee-duongbo">1.560.000 VNĐ</td>
      </tr>
      <tr>
        <td>6. Bảo hiểm TNDS bắt buộc (1 năm)</td>
        <td style="text-align: right; font-weight: 700;" id="vf-print-fee-tnds">480.700 VNĐ</td>
      </tr>
      <tr>
        <td>7. Phí dịch vụ đăng ký xe (tạm tính)</td>
        <td style="text-align: right; font-weight: 700;" id="vf-print-fee-dichvu">1.000.000 VNĐ</td>
      </tr>
      <tr class="total-row">
        <td>TỔNG CHI PHÍ LĂN BÁNH TẠM TÍNH:</td>
        <td style="text-align: right; font-size: 13px;" id="vf-print-total-lanbanh">472.380.700 VNĐ</td>
      </tr>
    </tbody>
  </table>

  <!-- Section 3: Phương án tài chính trả góp -->
  <div class="vf-print-section-title">3. PHƯƠNG ÁN TÀI CHÍNH & VAY NGÂN HÀNG</div>
  <div class="vf-print-loan-summary">
    <div class="vf-print-loan-box">
      <div class="vf-print-loan-lbl">Tổng trả trước nhận xe</div>
      <div class="vf-print-loan-val" id="vf-print-tratruoc">101.980.700 VNĐ</div>
      <div style="font-size:9px; color:#64748b; margin-top:2px;">(Trả trước xe + Phí lăn bánh)</div>
    </div>
    <div class="vf-print-loan-box">
      <div class="vf-print-loan-lbl">Số tiền vay ngân hàng</div>
      <div class="vf-print-loan-val" style="color:#0f172a;" id="vf-print-sotienvay">374.400.000 VNĐ</div>
      <div style="font-size:9px; color:#64748b; margin-top:2px;" id="vf-print-vay-pct-sub">(80% giá trị xe)</div>
    </div>
    <div class="vf-print-loan-box">
      <div class="vf-print-loan-lbl">Trả góp tháng 1 (Gốc + Lãi)</div>
      <div class="vf-print-loan-val" style="color:#16a34a;" id="vf-print-thangdau">8.580.000 VNĐ/tháng</div>
      <div style="font-size:9px; color:#64748b; margin-top:2px;">(Dư nợ giảm dần)</div>
    </div>
  </div>

  <!-- Section 4: Lịch trả góp dự kiến (Tự động chuyển trọn vẹn sang trang 2) -->
  <div class="vf-print-sec4-wrap">
    <div class="vf-print-section-title">4. LỊCH TRẢ GÓP DỰ KIẾN (DƯ NỢ GIẢM DẦN)</div>
    <table class="vf-print-schedule-table">
      <thead>
        <tr>
          <th style="width:15%;">Kỳ vay</th>
          <th style="width:22%;">Dư nợ đầu kỳ</th>
          <th style="width:21%;">Tiền gốc / tháng</th>
          <th style="width:21%;">Tiền lãi / tháng</th>
          <th style="width:21%;">Tổng trả hàng tháng</th>
        </tr>
      </thead>
      <tbody id="vf-print-schedule-tbody">
        <!-- Dynamically generated -->
      </tbody>
    </table>

    <!-- Signatures & Note -->
    <div class="vf-print-signatures">
      <div class="vf-print-sig-box">
        <div class="vf-print-sig-title">KHÁCH HÀNG</div>
        <div class="vf-print-sig-sub">(Ký & ghi rõ họ tên)</div>
        <div class="vf-print-sig-space"></div>
      </div>
      <div class="vf-print-sig-box">
        <div class="vf-print-sig-title">ĐẠI LÝ VINFAST TÂN Á CHÂU</div>
        <div class="vf-print-sig-sub">(Tư vấn bán hàng Ký & xác nhận)</div>
        <div class="vf-print-sig-space"></div>
      </div>
    </div>

    <div class="vf-print-note">
      * Ghi chú: Giá xe và các khoản phí mang tính chất tạm tính tại thời điểm lập dự toán. Các chương trình khuyến mãi, quà tặng phụ kiện và ưu đãi lãi suất vay sẽ được áp dụng theo chính sách mới nhất của VinFast Tân Á Châu tại thời điểm ký hợp đồng mua xe.
    </div>
  </div>
</div>

<script>
(function() {
  // CAR DATABASE
  const carsData = {
    'vf3': {
      name: 'VinFast VF 3',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf3.webp'); ?>',
      versions: [
        { id: 'vf3-thue', name: 'VF 3 (Thuê Pin)', price: 240000000 },
        { id: 'vf3-mua', name: 'VF 3 (Mua Đứt Pin)', price: 322000000 }
      ]
    },
    'vf5': {
      name: 'VinFast VF 5 Plus',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf5.webp'); ?>',
      versions: [
        { id: 'vf5-thue', name: 'VF 5 Plus (Thuê Pin)', price: 468000000 },
        { id: 'vf5-mua', name: 'VF 5 Plus (Mua Đứt Pin)', price: 548000000 }
      ]
    },
    'vf6': {
      name: 'VinFast VF 6',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf6.webp'); ?>',
      versions: [
        { id: 'vf6s-thue', name: 'VF 6S Base (Thuê Pin)', price: 675000000 },
        { id: 'vf6s-mua', name: 'VF 6S Base (Mua Đứt Pin)', price: 765000000 },
        { id: 'vf6p-thue', name: 'VF 6 Plus (Thuê Pin)', price: 765000000 },
        { id: 'vf6p-mua', name: 'VF 6 Plus (Mua Đứt Pin)', price: 855000000 }
      ]
    },
    'vf7': {
      name: 'VinFast VF 7',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf7.webp'); ?>',
      versions: [
        { id: 'vf7s-thue', name: 'VF 7S Base (Thuê Pin)', price: 850000000 },
        { id: 'vf7s-mua', name: 'VF 7S Base (Mua Đứt Pin)', price: 999000000 },
        { id: 'vf7p-thue', name: 'VF 7 Plus (Thuê Pin)', price: 999000000 },
        { id: 'vf7p-mua', name: 'VF 7 Plus (Mua Đứt Pin)', price: 1199000000 }
      ]
    },
    'vf8': {
      name: 'VinFast VF 8',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf8.webp'); ?>',
      versions: [
        { id: 'vf8e-thue', name: 'VF 8 Eco (Thuê Pin)', price: 1090000000 },
        { id: 'vf8e-mua', name: 'VF 8 Eco (Mua Đứt Pin)', price: 1290000000 },
        { id: 'vf8p-thue', name: 'VF 8 Plus (Thuê Pin)', price: 1270000000 },
        { id: 'vf8p-mua', name: 'VF 8 Plus (Mua Đứt Pin)', price: 1470000000 }
      ]
    },
    'vf8_allnew': {
      name: 'VinFast VF 8 The All New',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf8_allnew.png'); ?>',
      versions: [
        { id: 'vf8an-eco', name: 'VF 8 The All New Eco', price: 1110000000 },
        { id: 'vf8an-plus', name: 'VF 8 The All New Plus', price: 1290000000 }
      ]
    },
    'vf9': {
      name: 'VinFast VF 9',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf9.webp'); ?>',
      versions: [
        { id: 'vf9e-thue', name: 'VF 9 Eco (Thuê Pin)', price: 1499000000 },
        { id: 'vf9e-mua', name: 'VF 9 Eco (Mua Đứt Pin)', price: 1984000000 },
        { id: 'vf9p-thue', name: 'VF 9 Plus (Thuê Pin)', price: 1699000000 },
        { id: 'vf9p-mua', name: 'VF 9 Plus (Mua Đứt Pin)', price: 2169000000 }
      ]
    },
    'minio': {
      name: 'Minio Green',
      image: '<?php echo content_url('/uploads/official_cars/common/official_minio.png'); ?>',
      versions: [
        { id: 'minio-std', name: 'Minio Green Tiêu Chuẩn', price: 240000000 }
      ]
    },
    'herio': {
      name: 'Herio Green',
      image: '<?php echo content_url('/uploads/official_cars/common/official_herio.png'); ?>',
      versions: [
        { id: 'herio-std', name: 'Herio Green Tiêu Chuẩn', price: 490000000 }
      ]
    },
    'nerio': {
      name: 'Nerio Green',
      image: '<?php echo content_url('/uploads/official_cars/common/official_nerio.png'); ?>',
      versions: [
        { id: 'nerio-std', name: 'Nerio Green Tiêu Chuẩn', price: 680000000 }
      ]
    },
    'limo': {
      name: 'Limo Green',
      image: '<?php echo content_url('/uploads/official_cars/common/official_limo.png'); ?>',
      versions: [
        { id: 'limo-std', name: 'Limo Green 7 Chỗ Tiêu Chuẩn', price: 750000000 }
      ]
    },
    'vfwild': {
      name: 'VinFast VF Wild',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vfwild.webp'); ?>',
      versions: [
        { id: 'vfwild-comfort', name: 'VF Wild Comfort (Dự kiến)', price: 850000000 },
        { id: 'vfwild-premium', name: 'VF Wild Premium 4WD (Dự kiến)', price: 1050000000 }
      ]
    },
    'vf2': {
      name: 'VinFast VF 2',
      image: '<?php echo content_url('/uploads/official_cars/common/official_vf2.png'); ?>',
      versions: [
        { id: 'vf2-thue', name: 'VF 2 (Thuê Pin Dự Kiến)', price: 199000000 },
        { id: 'vf2-mua', name: 'VF 2 (Kèm Pin Dự Kiến)', price: 259000000 }
      ]
    },
    'mpv7': {
      name: 'VinFast VF MPV 7',
      image: '<?php echo content_url('/uploads/official_cars/common/official_mpv7.webp'); ?>',
      versions: [
        { id: 'mpv7-eco', name: 'VF MPV 7 Eco', price: 750000000 },
        { id: 'mpv7-plus', name: 'VF MPV 7 Plus', price: 875000000 }
      ]
    },
    'ecvan': {
      name: 'VinFast EC Van',
      image: '<?php echo content_url('/uploads/official_cars/common/official_ecvan.webp'); ?>',
      versions: [
        { id: 'ecvan-std', name: 'EC Van Tiêu Chuẩn', price: 299000000 }
      ]
    }
  };

  // Helper Formatter
  function formatVND(amount) {
    return new Intl.NumberFormat('vi-VN').format(Math.round(amount)) + ' VNĐ';
  }

  // Populate Versions Dropdown
  function populateVersions(modelKey) {
    const selectVersion = document.getElementById('vf-select-version');
    selectVersion.innerHTML = '';
    
    const modelData = carsData[modelKey];
    if (!modelData) return;

    modelData.versions.forEach(ver => {
      const opt = document.createElement('option');
      opt.value = ver.id;
      opt.textContent = ver.name + ' - ' + formatVND(ver.price);
      opt.dataset.price = ver.price;
      selectVersion.appendChild(opt);
    });

    // Update Image & Name Preview
    document.getElementById('vf-preview-img').src = modelData.image;
    document.getElementById('vf-preview-name').textContent = modelData.name;
  }

  // Calculate Function
  function calculate() {
    const modelKey = document.getElementById('vf-select-model').value;
    const modelData = carsData[modelKey];
    const versionSelect = document.getElementById('vf-select-version');
    const selectedOpt = versionSelect.options[versionSelect.selectedIndex];
    
    if (!selectedOpt || !modelData) return;
    
    const carPrice = parseFloat(selectedOpt.dataset.price || 0);

    // Update preview price tag
    document.getElementById('vf-preview-price').textContent = formatVND(carPrice);
    document.getElementById('vf-fee-giaxe').textContent = formatVND(carPrice);

    // Options
    const isHanoi = document.querySelector('input[name="province"]:checked').value === 'hanoi';
    const isCompany = document.querySelector('input[name="owner"]:checked').value === 'doanhnghiep';
    const downPercent = parseFloat(document.querySelector('input[name="downpayment"]:checked').value);
    const tenureMonths = parseInt(document.getElementById('vf-select-tenure').value, 10);
    const annualInterestRate = parseFloat(document.getElementById('vf-input-interest').value || 7.5) / 100;

    // Fees Calculation
    const feeTruocBa = 0; // Miễn 100% cho ô tô điện
    const feeBienSo = isHanoi ? 20000000 : 1000000;
    const feeDangKiem = 340000;
    const feeDuongBo = isCompany ? 2160000 : 1560000;
    
    // TNDS: VF 9, Limo Green, MPV 7 -> 7-9 chỗ (873,400đ), Bán tải / Van (953,000đ), các xe còn lại 480,700đ
    const is7Seater = (modelKey === 'vf9' || modelKey === 'limo' || modelKey === 'mpv7');
    const isTruck = (modelKey === 'vfwild' || modelKey === 'ecvan');
    const feeTNDS = is7Seater ? 873400 : (isTruck ? 953000 : 480700);
    const feeDichVu = 1000000;

    const totalFees = feeTruocBa + feeBienSo + feeDangKiem + feeDuongBo + feeTNDS + feeDichVu;
    const totalLanBanh = carPrice + totalFees;

    // Loan Calculations
    const loanAmount = carPrice * (1 - downPercent / 100);
    const downpaymentCar = carPrice * (downPercent / 100);
    const totalDownpaymentNeeded = downpaymentCar + totalFees;

    // Monthly Payment (Month 1: Principal + Month 1 Interest)
    const monthlyPrincipal = loanAmount / tenureMonths;
    const monthlyInterestRate = annualInterestRate / 12;
    const month1Interest = loanAmount * monthlyInterestRate;
    const month1Total = monthlyPrincipal + month1Interest;

    // Update Web UI Results
    document.getElementById('vf-res-lanbanh').textContent = formatVND(totalLanBanh);
    document.getElementById('vf-res-tratruoc').textContent = formatVND(totalDownpaymentNeeded);
    document.getElementById('vf-res-sotienvay').textContent = formatVND(loanAmount);
    document.getElementById('vf-res-thangdau').textContent = formatVND(month1Total) + '/tháng';

    // Update Fee Breakdown List
    document.getElementById('vf-fee-bienso').textContent = formatVND(feeBienSo);
    document.getElementById('vf-fee-dangkiem').textContent = formatVND(feeDangKiem);
    document.getElementById('vf-fee-duongbo').textContent = formatVND(feeDuongBo);
    document.getElementById('vf-fee-tnds').textContent = formatVND(feeTNDS);

    // Update PDF Printable Template (#vf-print-container)
    const versionText = selectedOpt.textContent;
    const provinceLabel = isHanoi ? 'Hà Nội / TP. Hồ Chí Minh' : 'Vĩnh Phúc & Các Tỉnh';
    const ownerLabel = isCompany ? 'Doanh nghiệp / Kinh doanh' : 'Cá nhân';
    const tenureLabel = tenureMonths + ' tháng (' + Math.round(tenureMonths / 12) + ' năm)';
    const interestLabel = (annualInterestRate * 100).toFixed(1) + '%/năm';

    if (document.getElementById('vf-print-car-name')) {
      document.getElementById('vf-print-car-name').textContent = modelData.name;
      document.getElementById('vf-print-version-name').textContent = versionText;
      document.getElementById('vf-print-car-price').textContent = formatVND(carPrice);
      document.getElementById('vf-print-province').textContent = provinceLabel;
      document.getElementById('vf-print-owner').textContent = ownerLabel;
      document.getElementById('vf-print-downpayment-pct').textContent = downPercent + '% giá trị xe';
      document.getElementById('vf-print-tenure').textContent = tenureLabel;
      document.getElementById('vf-print-interest').textContent = interestLabel;
      document.getElementById('vf-print-car-img').src = modelData.image;
      document.getElementById('vf-print-car-badge').textContent = modelData.name;

      document.getElementById('vf-print-fee-giaxe').textContent = formatVND(carPrice);
      document.getElementById('vf-print-fee-bienso').textContent = formatVND(feeBienSo);
      document.getElementById('vf-print-fee-dangkiem').textContent = formatVND(feeDangKiem);
      document.getElementById('vf-print-fee-duongbo').textContent = formatVND(feeDuongBo);
      document.getElementById('vf-print-fee-tnds').textContent = formatVND(feeTNDS);
      document.getElementById('vf-print-fee-dichvu').textContent = formatVND(feeDichVu);
      document.getElementById('vf-print-total-lanbanh').textContent = formatVND(totalLanBanh);

      document.getElementById('vf-print-tratruoc').textContent = formatVND(totalDownpaymentNeeded);
      document.getElementById('vf-print-sotienvay').textContent = formatVND(loanAmount);
      document.getElementById('vf-print-vay-pct-sub').textContent = '(' + (100 - downPercent) + '% giá trị xe)';
      document.getElementById('vf-print-thangdau').textContent = formatVND(month1Total) + '/tháng';
    }

    // Generate Schedule Table
    generateSchedule(loanAmount, tenureMonths, monthlyInterestRate, monthlyPrincipal);
  }

  // Generate Payment Schedule Table (Both Web & PDF Print)
  function generateSchedule(loanAmount, tenureMonths, monthlyInterestRate, monthlyPrincipal) {
    const tbody = document.getElementById('vf-schedule-tbody');
    const printTbody = document.getElementById('vf-print-schedule-tbody');
    tbody.innerHTML = '';
    if (printTbody) printTbody.innerHTML = '';

    let currentBalance = loanAmount;
    const rowsToDisplay = Math.min(tenureMonths, 24); // Show first 24 months

    for (let month = 1; month <= rowsToDisplay; month++) {
      const monthInterest = currentBalance * monthlyInterestRate;
      const monthTotal = monthlyPrincipal + monthInterest;
      const endBalance = Math.max(0, currentBalance - monthlyPrincipal);

      // Web Row
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>Tháng ${month}</td>
        <td>${formatVND(currentBalance)}</td>
        <td>${formatVND(monthlyPrincipal)}</td>
        <td>${formatVND(monthInterest)}</td>
        <td style="color: #2563EB; font-weight: 800;">${formatVND(monthTotal)}</td>
      `;
      tbody.appendChild(tr);

      // PDF Print Row
      if (printTbody) {
        const ptr = document.createElement('tr');
        ptr.innerHTML = `
          <td>Tháng ${month}</td>
          <td>${formatVND(currentBalance)}</td>
          <td>${formatVND(monthlyPrincipal)}</td>
          <td>${formatVND(monthInterest)}</td>
          <td style="color: #2563EB; font-weight: 700;">${formatVND(monthTotal)}</td>
        `;
        printTbody.appendChild(ptr);
      }

      currentBalance = endBalance;
    }
  }

  // Event Listeners Initialization
  document.addEventListener('DOMContentLoaded', function() {
    const modelSelect = document.getElementById('vf-select-model');
    const versionSelect = document.getElementById('vf-select-version');
    const tenureSelect = document.getElementById('vf-select-tenure');
    const interestInput = document.getElementById('vf-input-interest');
    const radioInputs = document.querySelectorAll('input[type="radio"]');

    // Init print date
    const today = new Date();
    const dateStr = String(today.getDate()).padStart(2, '0') + '/' + String(today.getMonth() + 1).padStart(2, '0') + '/' + today.getFullYear();
    const dateElem = document.getElementById('vf-print-date');
    if (dateElem) dateElem.textContent = dateStr;

    // Check URL query parameter (e.g. ?model=vfwild or ?car=vfwild)
    const urlParams = new URLSearchParams(window.location.search);
    const paramModel = urlParams.get('model') || urlParams.get('car');
    if (paramModel) {
      const pLower = paramModel.toLowerCase();
      if (carsData[pLower]) {
        modelSelect.value = pLower;
      } else if (pLower.indexOf('wild') !== -1) {
        modelSelect.value = 'vfwild';
      }
    }

    // Init Models
    populateVersions(modelSelect.value);
    calculate();

    // Model Change
    modelSelect.addEventListener('change', function() {
      populateVersions(this.value);
      calculate();
    });

    // Version / Tenure / Interest Change
    versionSelect.addEventListener('change', calculate);
    tenureSelect.addEventListener('change', calculate);
    interestInput.addEventListener('input', calculate);

    // Radio Changes
    radioInputs.forEach(radio => {
      radio.addEventListener('change', calculate);
    });
  });

  // Export Excel / CSV Function
  window.vfExportExcel = function() {
    const modelName = document.getElementById('vf-preview-name').textContent;
    const versionSelect = document.getElementById('vf-select-version');
    const verName = versionSelect.options[versionSelect.selectedIndex]?.textContent || '';
    const totalLanBanh = document.getElementById('vf-res-lanbanh').textContent;
    const traTruoc = document.getElementById('vf-res-tratruoc').textContent;
    const soTienVay = document.getElementById('vf-res-sotienvay').textContent;
    const thangDau = document.getElementById('vf-res-thangdau').textContent;

    const isHanoi = document.querySelector('input[name="province"]:checked').value === 'hanoi';
    const isCompany = document.querySelector('input[name="owner"]:checked').value === 'doanhnghiep';
    const downPercent = document.querySelector('input[name="downpayment"]:checked').value;
    const tenureMonths = document.getElementById('vf-select-tenure').value;
    const interestRate = document.getElementById('vf-input-interest').value;

    let csvContent = "\uFEFF";
    csvContent += "ĐẠI LÝ VINFAST TÂN Á CHÂU - BẢNG DỰ TOÁN CHI PHÍ LĂN BÁNH & VAY TRẢ GÓP\n";
    csvContent += "Hotline: 056 225 6256 - Địa chỉ: 191 Đường Hùng Vương, Phường Vĩnh Yên, Tỉnh Phú Thọ , Vinh Yen, Vietnam\n\n";
    csvContent += `Dòng xe,${modelName}\n`;
    csvContent += `Phiên bản,${verName.replace(/,/g, '')}\n`;
    csvContent += `Nơi đăng ký,${isHanoi ? 'Hà Nội / TP.HCM' : 'Vĩnh Phúc & Các Tỉnh'}\n`;
    csvContent += `Đối tượng đứng tên,${isCompany ? 'Doanh nghiệp' : 'Cá nhân'}\n`;
    csvContent += `Trả trước (Tiền xe),${downPercent}%\n`;
    csvContent += `Thời hạn vay,${tenureMonths} tháng\n`;
    csvContent += `Lãi suất vay,${interestRate}%/năm\n\n`;

    csvContent += `Tổng chi phí lăn bánh tạm tính,${totalLanBanh.replace(/,/g, '')}\n`;
    csvContent += `Tổng trả trước nhận xe,${traTruoc.replace(/,/g, '')}\n`;
    csvContent += `Số tiền vay ngân hàng,${soTienVay.replace(/,/g, '')}\n`;
    csvContent += `Trả góp tháng đầu tiên,${thangDau.replace(/,/g, '')}\n\n`;

    csvContent += "CHI TIẾT PHÍ LĂN BÁNH\n";
    csvContent += `Giá niêm yết,${document.getElementById('vf-fee-giaxe').textContent.replace(/,/g, '')}\n`;
    csvContent += `Thuế trước bạ,0 VNĐ (Miễn 100% cho xe điện)\n`;
    csvContent += `Phí cấp biển số,${document.getElementById('vf-fee-bienso').textContent.replace(/,/g, '')}\n`;
    csvContent += `Phí đăng kiểm,${document.getElementById('vf-fee-dangkiem').textContent.replace(/,/g, '')}\n`;
    csvContent += `Phí bảo trì đường bộ (1 năm),${document.getElementById('vf-fee-duongbo').textContent.replace(/,/g, '')}\n`;
    csvContent += `Bảo hiểm TNDS (1 năm),${document.getElementById('vf-fee-tnds').textContent.replace(/,/g, '')}\n\n`;

    csvContent += "LỊCH TRẢ GÓP DỰ KIẾN (DƯ NỢ GIẢM DẦN)\n";
    csvContent += "Kỳ vay,Dư nợ đầu kỳ,Tiền gốc hàng tháng,Tiền lãi hàng tháng,Tổng trả hàng tháng\n";

    const rows = document.querySelectorAll('#vf-schedule-tbody tr');
    rows.forEach(row => {
      const cols = row.querySelectorAll('td');
      if (cols.length >= 5) {
        const line = Array.from(cols).map(c => `"${c.innerText.replace(/"/g, '""')}"`).join(',');
        csvContent += line + "\n";
      }
    });

    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement("a");
    const url = URL.createObjectURL(blob);
    link.setAttribute("href", url);
    link.setAttribute("download", `Du_Toan_VinFast_${modelName.replace(/\s+/g, '_')}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  };

  // Export PDF Function
  window.vfExportPDF = function() {
    window.print();
  };

})();
</script>

<?php get_footer(); ?>
