<?php
/* Template Name: Đặt cọc xe điện VinFast Tân Á Châu */
get_header(); 
$uploads_url = content_url('/uploads/official_cars/common/');
?>

<style>
/* ============================================================
   VINFAST LUXURY DEPOSIT PAGE STYLES & MOBILE OPTIMIZATIONS
   ============================================================ */
.vf-deposit-wrapper {
  background: #F8FAFC !important;
  font-family: 'Mulish', 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
  min-height: 100vh !important;
  padding-bottom: 80px !important;
  margin: 0 !important;
  width: 100% !important;
  position: relative;
  overflow-x: hidden;
}

/* 1. HERO BANNER */
.vf-dep-hero {
  background: linear-gradient(135deg, #060B1A 0%, #0F2256 50%, #1E40AF 100%) !important;
  color: #ffffff !important;
  padding: 55px 20px 75px 20px !important;
  text-align: center !important;
  position: relative !important;
  overflow: hidden !important;
}
.vf-dep-hero::before {
  content: '';
  position: absolute;
  top: -40%;
  left: -20%;
  width: 140%;
  height: 200%;
  background: radial-gradient(circle, rgba(37, 99, 235, 0.22) 0%, rgba(96, 165, 250, 0.08) 40%, transparent 70%);
  pointer-events: none;
  animation: vfHeroAura 12s ease-in-out infinite alternate;
}
@keyframes vfHeroAura {
  0% { transform: scale(1) translate(0, 0); }
  100% { transform: scale(1.1) translate(30px, 15px); }
}
.vf-dep-hero-inner {
  max-width: 860px !important;
  margin: 0 auto !important;
  position: relative !important;
  z-index: 2 !important;
}
.vf-dep-badge {
  display: inline-flex !important;
  align-items: center !important;
  gap: 8px !important;
  background: rgba(255, 255, 255, 0.12) !important;
  color: #93C5FD !important;
  font-size: 12px !important;
  font-weight: 800 !important;
  letter-spacing: 1.2px !important;
  padding: 7px 18px !important;
  border-radius: 30px !important;
  margin-bottom: 16px !important;
  border: 1px solid rgba(255, 255, 255, 0.25) !important;
  backdrop-filter: blur(10px) !important;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}
.vf-dep-title {
  font-size: 34px !important;
  font-weight: 900 !important;
  color: #ffffff !important;
  margin: 0 0 14px 0 !important;
  letter-spacing: 0.5px !important;
  text-transform: uppercase !important;
  line-height: 1.25 !important;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}
.vf-dep-subtitle {
  font-size: 15.5px !important;
  color: #CBD5E1 !important;
  margin: 0 auto !important;
  max-width: 680px !important;
  line-height: 1.6 !important;
}

/* 2. STEP PROGRESS BAR */
.vf-dep-steps-bar {
  display: flex;
  align-items: center;
  justify-content: center;
  max-width: 780px;
  margin: 26px auto 0 auto;
  position: relative;
  z-index: 2;
  padding: 0 10px;
}
.vf-step-item {
  display: flex;
  align-items: center;
  gap: 10px;
  color: #94A3B8;
  font-size: 13px;
  font-weight: 700;
  transition: all 0.3s ease;
}
.vf-step-item.active {
  color: #ffffff;
}
.vf-step-num {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.15);
  border: 1.5px solid rgba(255, 255, 255, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 800;
  transition: all 0.3s ease;
}
.vf-step-item.active .vf-step-num {
  background: #2563EB;
  border-color: #60A5FA;
  box-shadow: 0 0 14px rgba(37, 99, 235, 0.8);
  color: #ffffff;
}
.vf-step-line {
  flex: 1;
  height: 2px;
  background: rgba(255, 255, 255, 0.2);
  margin: 0 14px;
  max-width: 90px;
}

/* 3. MAIN CONTAINER & DESKTOP GRID */
.vf-dep-container {
  max-width: 1200px !important;
  margin: -40px auto 0 auto !important;
  padding: 0 20px !important;
  position: relative !important;
  z-index: 10 !important;
}
.vf-dep-grid {
  display: grid !important;
  grid-template-columns: 1.05fr 1.15fr !important;
  gap: 32px !important;
  align-items: start !important;
}

/* 4. PREVIEW CARD */
.vf-dep-preview-card {
  background: #ffffff !important;
  border-radius: 20px !important;
  padding: 30px !important;
  box-shadow: 0 12px 36px rgba(15, 23, 42, 0.08) !important;
  border: 1px solid #E2E8F0 !important;
  margin-bottom: 24px !important;
  position: relative !important;
  overflow: hidden !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.vf-dep-preview-card:hover {
  box-shadow: 0 18px 45px rgba(15, 23, 42, 0.12) !important;
}
.vf-dep-preview-card::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #2563EB, #60A5FA, #2563EB);
  background-size: 200% 100%;
  animation: vfGradientSlide 4s linear infinite;
}
@keyframes vfGradientSlide {
  0% { background-position: 0% 50%; }
  100% { background-position: 200% 50%; }
}
.vf-dep-preview-header {
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  margin-bottom: 16px !important;
  border-bottom: 1px solid #F1F5F9 !important;
  padding-bottom: 12px !important;
}
.vf-dep-preview-tag {
  font-size: 11.5px !important;
  font-weight: 800 !important;
  color: #2563EB !important;
  letter-spacing: 1px !important;
  text-transform: uppercase !important;
}
.vf-dep-badge-status {
  background: #DCFCE7 !important;
  color: #15803D !important;
  font-size: 11px !important;
  font-weight: 700 !important;
  padding: 4px 12px !important;
  border-radius: 12px !important;
  display: inline-flex;
  align-items: center;
  gap: 5px;
}
.vf-dep-badge-status::before {
  content: '';
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #16A34A;
  animation: vfPulseDot 1.6s infinite ease-in-out;
}
@keyframes vfPulseDot {
  0%, 100% { transform: scale(1); opacity: 1; }
  50% { transform: scale(1.6); opacity: 0.5; }
}

.vf-dep-preview-title {
  font-size: 26px !important;
  font-weight: 900 !important;
  color: #0F172A !important;
  margin: 0 0 6px 0 !important;
  letter-spacing: -0.4px !important;
}
.vf-dep-preview-sub {
  font-size: 13.5px !important;
  color: #64748B !important;
  margin: 0 !important;
  line-height: 1.5 !important;
}

/* Car Stage */
.vf-dep-preview-img-wrap {
  min-height: 230px !important;
  max-height: 280px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  padding: 24px 0 18px !important;
  position: relative !important;
  perspective: 1000px;
}
.vf-dep-car-img {
  max-width: 100% !important;
  max-height: 240px !important;
  width: auto !important;
  height: auto !important;
  object-fit: contain !important;
  filter: drop-shadow(0 18px 30px rgba(15, 23, 42, 0.18)) !important;
  transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important;
  will-change: transform, opacity;
}
.vf-dep-car-img:hover {
  transform: translateY(-5px) scale(1.02);
}
.vf-dep-car-img.fade-out {
  opacity: 0 !important;
  transform: scale(0.96) translateY(8px) !important;
}

/* Config Chips */
.vf-dep-chips {
  display: flex !important;
  gap: 8px !important;
  flex-wrap: wrap !important;
  margin: 16px 0 !important;
}
.vf-dep-chip {
  background: #F1F5F9 !important;
  color: #334155 !important;
  font-size: 12px !important;
  font-weight: 600 !important;
  padding: 6px 14px !important;
  border-radius: 8px !important;
  border: 1px solid #E2E8F0 !important;
  display: inline-flex;
  align-items: center;
  gap: 4px;
}
.vf-dep-chip strong {
  color: #0F172A !important;
  font-weight: 800;
}

/* Deposit Amount Box */
.vf-dep-amount-box {
  background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%) !important;
  border: 1.5px solid #93C5FD !important;
  border-radius: 16px !important;
  padding: 18px 22px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: space-between !important;
  margin-top: 16px !important;
  box-shadow: 0 6px 20px rgba(37, 99, 235, 0.12) !important;
  position: relative;
  overflow: hidden;
  transition: all 0.3s ease;
}
.vf-dep-amount-box.pulse {
  animation: vfBoxGlow 0.6s ease;
}
@keyframes vfBoxGlow {
  0% { transform: scale(1); box-shadow: 0 6px 20px rgba(37, 99, 235, 0.12); }
  50% { transform: scale(1.02); box-shadow: 0 0 25px rgba(37, 99, 235, 0.4); border-color: #2563EB; }
  100% { transform: scale(1); box-shadow: 0 6px 20px rgba(37, 99, 235, 0.12); }
}
.vf-dep-amount-label {
  display: flex !important;
  flex-direction: column !important;
}
.vf-dep-amount-label span:first-child {
  font-size: 12px !important;
  font-weight: 800 !important;
  text-transform: uppercase !important;
  color: #1E40AF !important;
  letter-spacing: 0.6px !important;
}
.vf-dep-amount-label span:last-child {
  font-size: 11px !important;
  color: #64748B !important;
  margin-top: 2px;
}
.vf-dep-amount-val {
  font-size: 24px !important;
  font-weight: 900 !important;
  color: #2563EB !important;
  letter-spacing: -0.6px !important;
  font-feature-settings: "tnum";
  font-variant-numeric: tabular-nums;
  transition: transform 0.2s ease, color 0.2s ease !important;
}

/* 4 Commitment Cards */
.vf-dep-features {
  display: grid !important;
  grid-template-columns: 1fr 1fr !important;
  gap: 16px !important;
}
.vf-dep-feat-card {
  background: #ffffff !important;
  border-radius: 16px !important;
  padding: 18px 20px !important;
  border: 1px solid #E2E8F0 !important;
  display: flex !important;
  gap: 14px !important;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03) !important;
  transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease !important;
}
.vf-dep-feat-card:hover {
  transform: translateY(-4px) !important;
  box-shadow: 0 10px 24px rgba(37, 99, 235, 0.12) !important;
  border-color: #93C5FD !important;
}
.vf-dep-feat-card .feat-icon {
  font-size: 28px !important;
  flex-shrink: 0 !important;
  line-height: 1 !important;
}
.vf-dep-feat-card .feat-text h4 {
  font-size: 14px !important;
  font-weight: 800 !important;
  color: #0F172A !important;
  margin: 0 0 4px 0 !important;
}
.vf-dep-feat-card .feat-text p {
  font-size: 12px !important;
  color: #64748B !important;
  margin: 0 !important;
  line-height: 1.45 !important;
}

/* 5. FORM CARD */
.vf-dep-form-card {
  background: #ffffff !important;
  border-radius: 20px !important;
  padding: 36px !important;
  box-shadow: 0 12px 36px rgba(15, 23, 42, 0.08) !important;
  border: 1px solid #E2E8F0 !important;
  position: relative;
}
.vf-dep-form-head {
  margin-bottom: 24px !important;
  border-bottom: 1px solid #F1F5F9 !important;
  padding-bottom: 18px !important;
}
.vf-dep-form-head h2 {
  font-size: 22px !important;
  font-weight: 900 !important;
  color: #0F172A !important;
  margin: 0 0 6px 0 !important;
  text-transform: uppercase !important;
  letter-spacing: -0.3px !important;
}
.vf-dep-form-head p {
  font-size: 13.5px !important;
  color: #64748B !important;
  margin: 0 !important;
  line-height: 1.5 !important;
}

/* Form Fields */
.vf-dep-form-grid {
  display: grid !important;
  grid-template-columns: 1fr 1fr !important;
  gap: 16px 18px !important;
}
.vf-dep-form-group {
  display: flex !important;
  flex-direction: column !important;
}
.vf-dep-form-group.full-width {
  grid-column: 1 / -1 !important;
}
.vf-dep-form-group label {
  font-size: 12.5px !important;
  font-weight: 700 !important;
  color: #1E293B !important;
  margin-bottom: 6px !important;
}
.vf-dep-form-group label .req {
  color: #E11D48 !important;
}
.vf-dep-form-group input[type="text"],
.vf-dep-form-group input[type="tel"],
.vf-dep-form-group input[type="email"],
.vf-dep-form-group select,
.vf-dep-form-group textarea {
  width: 100% !important;
  padding: 11px 15px !important;
  height: 44px !important;
  border: 1.5px solid #CBD5E1 !important;
  border-radius: 9px !important;
  font-size: 13.5px !important;
  color: #0F172A !important;
  background: #F8FAFC !important;
  transition: all 0.2s ease !important;
  box-sizing: border-box !important;
  box-shadow: none !important;
  font-family: inherit !important;
}
.vf-dep-form-group textarea {
  height: 74px !important;
  min-height: 74px !important;
  resize: vertical !important;
}
.vf-dep-form-group input:focus,
.vf-dep-form-group select:focus,
.vf-dep-form-group textarea:focus {
  outline: none !important;
  background: #ffffff !important;
  border-color: #2563EB !important;
  box-shadow: 0 0 0 3.5px rgba(37, 99, 235, 0.16) !important;
}

/* Color Swatches Interaction */
.vf-color-swatches-wrap {
  margin-top: 10px;
  display: flex;
  align-items: center;
  gap: 12px;
  flex-wrap: wrap;
}
.vf-swatch-title {
  font-size: 11.5px;
  color: #64748B;
  font-weight: 700;
  width: 100%;
}
.vf-swatch-btn {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  cursor: pointer;
  border: 2px solid #ffffff;
  box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  transition: transform 0.2s ease, box-shadow 0.2s ease, outline 0.2s ease;
  position: relative;
  outline: 1.5px solid #CBD5E1;
}
.vf-swatch-btn:hover {
  transform: scale(1.15);
}
.vf-swatch-btn.active {
  transform: scale(1.2);
  outline: 2.5px solid #2563EB;
  box-shadow: 0 0 12px rgba(37, 99, 235, 0.5);
}

/* Submit Button */
.vf-dep-submit-btn {
  height: 52px !important;
  line-height: 52px !important;
  padding: 0 28px !important;
  font-size: 14.5px !important;
  font-weight: 800 !important;
  letter-spacing: 0.8px !important;
  text-transform: uppercase !important;
  background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%) !important;
  color: #ffffff !important;
  border: none !important;
  border-radius: 12px !important;
  width: 100% !important;
  cursor: pointer !important;
  transition: all 0.25s ease !important;
  box-shadow: 0 8px 24px rgba(37, 99, 235, 0.38) !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 10px !important;
  position: relative !important;
  overflow: hidden !important;
  margin-top: 10px !important;
}
.vf-dep-submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.35), transparent);
  animation: vfShimmer 3.2s infinite;
}
@keyframes vfShimmer {
  0% { left: -100%; }
  35% { left: 100%; }
  100% { left: 100%; }
}
.vf-dep-submit-btn:hover {
  background: linear-gradient(135deg, #1D4ED8 0%, #1E40AF 100%) !important;
  box-shadow: 0 10px 30px rgba(37, 99, 235, 0.55) !important;
  transform: translateY(-2px) !important;
}
.vf-dep-submit-btn:active {
  transform: translateY(0) !important;
}

.vf-dep-secure-note {
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  gap: 6px !important;
  font-size: 12px !important;
  color: #64748B !important;
  margin-top: 14px !important;
  text-align: center !important;
}

/* 6. SUCCESS MODAL & VIETQR */
.vf-dep-modal {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(15, 23, 42, 0.78);
  backdrop-filter: blur(8px);
  z-index: 99999999;
  align-items: center;
  justify-content: center;
  padding: 16px;
}
.vf-dep-modal.active {
  display: flex;
}
.vf-dep-modal-content {
  background: #ffffff;
  border-radius: 22px;
  max-width: 530px;
  width: 100%;
  padding: 32px 24px;
  text-align: center;
  box-shadow: 0 25px 60px rgba(0,0,0,0.3);
  animation: vfModalPop 0.38s cubic-bezier(0.16, 1, 0.3, 1);
  position: relative;
  max-height: 92vh;
  overflow-y: auto;
}
@keyframes vfModalPop {
  0% { opacity: 0; transform: scale(0.9) translateY(24px); }
  100% { opacity: 1; transform: scale(1) translateY(0); }
}
.vf-dep-modal-icon {
  width: 62px;
  height: 62px;
  border-radius: 50%;
  background: #DCFCE7;
  color: #16A34A;
  font-size: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 12px;
  box-shadow: 0 8px 20px rgba(22, 163, 74, 0.22);
}
.vf-dep-modal-title {
  font-size: 20px;
  font-weight: 900;
  color: #0F172A;
  margin: 0 0 6px;
  text-transform: uppercase;
}
.vf-dep-modal-desc {
  font-size: 13px;
  color: #64748B;
  margin: 0 0 16px;
  line-height: 1.5;
}

/* VietQR Section */
.vf-vietqr-card {
  background: #F8FAFC;
  border: 1.5px solid #E2E8F0;
  border-radius: 16px;
  padding: 16px 14px;
  margin-bottom: 18px;
  text-align: center;
}
.vf-vietqr-badge {
  display: inline-block;
  background: #EFF6FF;
  color: #1E40AF;
  font-size: 11px;
  font-weight: 800;
  padding: 3px 10px;
  border-radius: 6px;
  margin-bottom: 10px;
  border: 1px solid #BFDBFE;
}
.vf-qr-img-wrapper {
  background: #ffffff;
  padding: 8px;
  border-radius: 12px;
  display: inline-block;
  box-shadow: 0 4px 14px rgba(0,0,0,0.08);
  margin-bottom: 10px;
  border: 1px solid #E2E8F0;
}
.vf-qr-img {
  width: 180px;
  height: 180px;
  display: block;
  object-fit: contain;
}
.vf-dep-bank-box {
  background: #ffffff;
  border: 1px solid #E2E8F0;
  border-radius: 12px;
  padding: 12px 14px;
  text-align: left;
  font-size: 12.5px;
  margin-top: 10px;
}
.vf-dep-bank-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 8px;
  color: #475569;
}
.vf-dep-bank-row:last-child { margin-bottom: 0; }
.vf-dep-bank-row strong { color: #0F172A; }
.vf-copy-btn {
  background: #F1F5F9;
  border: 1px solid #CBD5E1;
  color: #1E40AF;
  padding: 3px 8px;
  border-radius: 6px;
  font-size: 11px;
  font-weight: 700;
  cursor: pointer;
  margin-left: 8px;
  transition: all 0.2s;
}
.vf-copy-btn:hover {
  background: #2563EB;
  color: #ffffff;
  border-color: #2563EB;
}

/* Toast Notice */
.vf-toast-notice {
  position: fixed;
  bottom: 24px;
  left: 50%;
  transform: translateX(-50%) translateY(50px);
  background: #0F172A;
  color: #ffffff;
  padding: 10px 22px;
  border-radius: 30px;
  font-size: 13px;
  font-weight: 700;
  box-shadow: 0 8px 24px rgba(0,0,0,0.25);
  opacity: 0;
  pointer-events: none;
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
  z-index: 999999999;
}
.vf-toast-notice.show {
  transform: translateX(-50%) translateY(0);
  opacity: 1;
}

.vf-dep-modal-close {
  background: #2563EB;
  color: #ffffff;
  border: none;
  border-radius: 10px;
  padding: 12px 24px;
  font-weight: 800;
  font-size: 14px;
  cursor: pointer;
  width: 100%;
  transition: all 0.2s;
}
.vf-dep-modal-close:hover { background: #1D4ED8; }

/* Canvas Confetti */
#vfConfettiCanvas {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  pointer-events: none;
  z-index: 999999998;
}

/* 7. FLOATING MOBILE STICKY BAR */
.vf-mobile-sticky-bar {
  display: none;
}

/* ============================================================
   8. COMPREHENSIVE RESPONSIVE MOBILE OPTIMIZATIONS (<= 900px)
   ============================================================ */
@media (max-width: 900px) {
  /* Hero Section */
  .vf-dep-hero {
    padding: 38px 16px 54px 16px !important;
  }
  .vf-dep-badge {
    font-size: 11px !important;
    padding: 5px 14px !important;
    margin-bottom: 12px !important;
  }
  .vf-dep-title {
    font-size: 22px !important;
    line-height: 1.3 !important;
    margin-bottom: 8px !important;
  }
  .vf-dep-subtitle {
    font-size: 13.5px !important;
    line-height: 1.5 !important;
  }
  .vf-dep-steps-bar {
    display: none !important;
  }

  /* Container */
  .vf-dep-container {
    margin: -28px auto 0 auto !important;
    padding: 0 14px !important;
  }

  /* CRO Flow Ordering: Unpack columns so Form sits right below Car Preview! */
  .vf-dep-grid {
    display: flex !important;
    flex-direction: column !important;
    gap: 20px !important;
  }
  .vf-dep-left {
    display: contents !important;
  }
  .vf-dep-right {
    display: contents !important;
  }

  /* ORDER: 1. Car Preview -> 2. Form -> 3. Commitments */
  .vf-dep-preview-card {
    order: 1 !important;
    margin-bottom: 0 !important;
    padding: 20px 16px !important;
    border-radius: 18px !important;
  }
  .vf-dep-form-card {
    order: 2 !important;
    padding: 24px 18px !important;
    border-radius: 18px !important;
  }
  .vf-dep-features {
    order: 3 !important;
    margin-top: 4px !important;
  }

  /* Preview Card Polish on Mobile */
  .vf-dep-preview-title {
    font-size: 22px !important;
  }
  .vf-dep-preview-sub {
    font-size: 12.5px !important;
  }
  .vf-dep-preview-img-wrap {
    min-height: 180px !important;
    max-height: 210px !important;
    padding: 16px 0 !important;
  }
  .vf-dep-car-img {
    max-height: 190px !important;
  }
  .vf-dep-chips {
    gap: 6px !important;
    margin: 12px 0 !important;
  }
  .vf-dep-chip {
    font-size: 11.5px !important;
    padding: 4px 10px !important;
    border-radius: 6px !important;
  }
  .vf-dep-amount-box {
    padding: 14px 16px !important;
    border-radius: 14px !important;
  }
  .vf-dep-amount-label span:first-child {
    font-size: 11px !important;
  }
  .vf-dep-amount-val {
    font-size: 20px !important;
  }

  /* Form Inputs on Mobile (16px to prevent iOS Safari auto-zoom!) */
  .vf-dep-form-head h2 {
    font-size: 19px !important;
  }
  .vf-dep-form-head p {
    font-size: 12.5px !important;
  }
  .vf-dep-form-grid {
    grid-template-columns: 1fr !important;
    gap: 14px !important;
  }
  .vf-dep-form-group label {
    font-size: 13px !important;
    margin-bottom: 5px !important;
  }
  .vf-dep-form-group input[type="text"],
  .vf-dep-form-group input[type="tel"],
  .vf-dep-form-group input[type="email"],
  .vf-dep-form-group select,
  .vf-dep-form-group textarea {
    font-size: 16px !important; /* Critical for iOS Safari */
    height: 48px !important;
    border-radius: 8px !important;
    padding: 10px 14px !important;
  }
  .vf-dep-form-group textarea {
    height: 82px !important;
    min-height: 82px !important;
  }

  /* Touch-friendly Swatch Buttons */
  .vf-swatch-btn {
    width: 36px !important;
    height: 36px !important;
  }

  .vf-dep-submit-btn {
    height: 52px !important;
    line-height: 52px !important;
    font-size: 14px !important;
    border-radius: 10px !important;
  }

  /* Commitment Cards on Mobile */
  .vf-dep-features {
    grid-template-columns: 1fr 1fr !important;
    gap: 10px !important;
  }
  .vf-dep-feat-card {
    padding: 14px 12px !important;
    gap: 10px !important;
    border-radius: 14px !important;
  }
  .vf-dep-feat-card .feat-icon {
    font-size: 22px !important;
  }
  .vf-dep-feat-card .feat-text h4 {
    font-size: 12.5px !important;
    margin-bottom: 3px !important;
  }
  .vf-dep-feat-card .feat-text p {
    font-size: 11px !important;
    line-height: 1.4 !important;
  }

  /* Modal on Mobile */
  .vf-dep-modal-content {
    padding: 24px 16px !important;
    border-radius: 20px !important;
    max-width: 95vw !important;
  }
  .vf-dep-modal-title {
    font-size: 18px !important;
  }
  .vf-dep-modal-desc {
    font-size: 12.5px !important;
  }
  .vf-qr-img {
    width: 160px !important;
    height: 160px !important;
  }

  /* Mobile Sticky Bottom Bar */
  .vf-mobile-sticky-bar {
    display: flex !important;
    position: fixed !important;
    bottom: 0 !important;
    left: 0 !important;
    right: 0 !important;
    background: rgba(15, 23, 42, 0.95) !important;
    backdrop-filter: blur(12px) !important;
    -webkit-backdrop-filter: blur(12px) !important;
    padding: 11px 16px !important;
    border-top: 1px solid rgba(255, 255, 255, 0.15) !important;
    z-index: 999999 !important;
    align-items: center !important;
    justify-content: space-between !important;
    box-shadow: 0 -6px 24px rgba(0, 0, 0, 0.3) !important;
    transform: translateY(110%);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
  }
  .vf-mobile-sticky-bar.visible {
    transform: translateY(0) !important;
  }
  .vf-msb-info {
    display: flex;
    flex-direction: column;
    gap: 2px;
  }
  .vf-msb-car {
    color: #ffffff;
    font-size: 13.5px;
    font-weight: 800;
  }
  .vf-msb-amount {
    color: #93C5FD;
    font-size: 12px;
    font-weight: 700;
  }
  .vf-msb-btn {
    background: linear-gradient(135deg, #2563EB, #1D4ED8);
    color: #ffffff !important;
    font-size: 12.5px;
    font-weight: 800;
    padding: 9px 18px;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.45);
    white-space: nowrap;
    border: none;
    cursor: pointer;
  }
}

@media (max-width: 480px) {
  .vf-dep-features {
    grid-template-columns: 1fr !important;
  }
}
</style>

<!-- Canvas for Celebration Confetti -->
<canvas id="vfConfettiCanvas"></canvas>

<!-- Copy Toast Notification -->
<div id="vfCopyToast" class="vf-toast-notice">✓ Đã sao chép vào bộ nhớ tạm!</div>

<!-- Floating Mobile Sticky Bottom Bar -->
<div id="vfMobileStickyBar" class="vf-mobile-sticky-bar">
  <div class="vf-msb-info">
    <div class="vf-msb-car" id="msbCarName">VinFast VF 5 Plus</div>
    <div class="vf-msb-amount" id="msbDepositAmount">Cọc 15.000.000 VNĐ</div>
  </div>
  <button type="button" class="vf-msb-btn" onclick="scrollToDepositForm()">ĐIỀN ĐƠN CỌC</button>
</div>

<div class="vf-deposit-wrapper">

  <!-- 1. HERO BANNER -->
  <div class="vf-dep-hero">
    <div class="vf-dep-hero-inner">
      <span class="vf-dep-badge">⚡ VINFAST TÂN Á CHÂU — ĐẠI LÝ CHÍNH THỨC</span>
      <h1 class="vf-dep-title">ĐẶT CỌC XE ĐIỆN VINFAST TRỰC TUYẾN</h1>
      <p class="vf-dep-subtitle">
        Ưu tiên nhận xe sớm nhất, bảo toàn trọn vẹn chính sách giá & quà tặng ưu đãi trong tháng tại VinFast Tân Á Châu
      </p>

      <!-- 3-STEP PROGRESS BAR (Desktop) -->
      <div class="vf-dep-steps-bar">
        <div class="vf-step-item active">
          <span class="vf-step-num">1</span>
          <span>Chọn xe & Cấu hình</span>
        </div>
        <div class="vf-step-line"></div>
        <div class="vf-step-item active">
          <span class="vf-step-num">2</span>
          <span>Điền thông tin cọc</span>
        </div>
        <div class="vf-step-line"></div>
        <div class="vf-step-item">
          <span class="vf-step-num">3</span>
          <span>Xác nhận & VietQR</span>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. MAIN CONTAINER -->
  <div class="vf-dep-container">
    <div class="vf-dep-grid">

      <!-- LEFT: CAR PREVIEW & VALUE PROMISES -->
      <div class="vf-dep-left">

        <!-- PREVIEW CARD -->
        <div class="vf-dep-preview-card" id="vfDepPreviewCard">
          <div class="vf-dep-preview-header">
            <span class="vf-dep-preview-tag">DÒNG XE ĐANG CHỌN</span>
            <span class="vf-dep-badge-status">Sẵn xe giao ngay</span>
          </div>

          <h3 id="vfDepCarName" class="vf-dep-preview-title">VinFast VF 5 Plus</h3>
          <p id="vfDepCarSub" class="vf-dep-preview-sub">Mẫu A-SUV đô thị năng động, phong cách thời thượng</p>

          <!-- Stage Image -->
          <div class="vf-dep-preview-img-wrap">
            <img id="vfDepCarImg" 
                 src="<?php echo esc_url($uploads_url . 'official_vf5.webp'); ?>" 
                 alt="VinFast VF 5" 
                 class="vf-dep-car-img">
          </div>

          <!-- Configuration Chips -->
          <div class="vf-dep-chips">
            <span class="vf-dep-chip">Phiên bản: <strong id="chipVersion">Plus</strong></span>
            <span class="vf-dep-chip">Pin: <strong id="chipBattery">Thuê pin</strong></span>
            <span class="vf-dep-chip">Màu: <strong id="chipColor">Trắng Brahmini White</strong></span>
          </div>

          <!-- Deposit Standard Box -->
          <div class="vf-dep-amount-box" id="vfDepAmountBox">
            <div class="vf-dep-amount-label">
              <span>TIỀN ĐẶT CỌC TIÊU CHUẨN</span>
              <span>Chính sách chính hãng VinFast toàn quốc</span>
            </div>
            <div class="vf-dep-amount-val" id="vfDepAmountDisplay">15.000.000 VNĐ</div>
          </div>
        </div>

        <!-- 4 COMMITMENT CARDS -->
        <div class="vf-dep-features">
          <div class="vf-dep-feat-card">
            <span class="feat-icon">🚀</span>
            <div class="feat-text">
              <h4>Ưu tiên giao xe sớm</h4>
              <p>Xếp lịch xuất xưởng & bàn giao xe sớm nhất tại Vĩnh Phúc & khu vực lân cận</p>
            </div>
          </div>

          <div class="vf-dep-feat-card">
            <span class="feat-icon">🎁</span>
            <div class="feat-text">
              <h4>Giữ trọn 100% ưu đãi</h4>
              <p>Bảo toàn toàn bộ quà tặng voucher, ưu đãi lệ phí trước bạ & chính sách giá tháng</p>
            </div>
          </div>

          <div class="vf-dep-feat-card">
            <span class="feat-icon">🏦</span>
            <div class="feat-text">
              <h4>Hỗ trợ duyệt vay 80%</h4>
              <p>Liên kết 10+ ngân hàng lớn, lãi suất cố định ưu đãi, duyệt hồ sơ trong 24h</p>
            </div>
          </div>

          <div class="vf-dep-feat-card">
            <span class="feat-icon">🛡️</span>
            <div class="feat-text">
              <h4>Hợp đồng minh bạch</h4>
              <p>Hợp đồng & biên nhận điện tử có dấu mộc đỏ đại lý uỷ quyền VinFast Tân Á Châu</p>
            </div>
          </div>
        </div>

      </div>

      <!-- RIGHT: DEPOSIT REGISTRATION FORM -->
      <div class="vf-dep-right">
        <div class="vf-dep-form-card" id="vfDepositFormCard">
          <div class="vf-dep-form-head">
            <h2>THÔNG TIN ĐẶT CỌC XE</h2>
            <p>Vui lòng điền thông tin người đứng tên hợp đồng. Chuyên viên VinFast Tân Á Châu sẽ gọi xác nhận trong 10 phút.</p>
          </div>

          <form id="vfDepositForm" class="vf-dep-form-body" onsubmit="handleDepositSubmit(event)">
            <input type="hidden" name="action" value="vf_submit_deposit_form">
            <?php wp_nonce_field('vf_deposit_nonce', 'vf_deposit_nonce_field'); ?>

            <div class="vf-dep-form-grid">
              
              <div class="vf-dep-form-group">
                <label>Họ và tên người đứng tên xe <span class="req">*</span></label>
                <input type="text" name="customer_name" id="custName" placeholder="Nguyễn Văn A" required>
              </div>

              <div class="vf-dep-form-group">
                <label>Số điện thoại liên hệ <span class="req">*</span></label>
                <input type="tel" name="customer_phone" id="custPhone" placeholder="0900 000 000" pattern="[0-9]{10,11}" required>
              </div>

              <div class="vf-dep-form-group full-width">
                <label>Email nhận hợp đồng cọc & phiếu thu <span class="req">*</span></label>
                <input type="email" name="customer_email" id="custEmail" placeholder="email@gmail.com" required>
              </div>

              <div class="vf-dep-form-group">
                <label>Dòng xe đặt cọc <span class="req">*</span></label>
                <select name="car_model" id="selectCarModel" onchange="onCarChange(this.value)" required>
                  <option value="VinFast VF 3">VinFast VF 3 (Mini E-SUV)</option>
                  <option value="VinFast VF 5 Plus" selected>VinFast VF 5 Plus (A-SUV)</option>
                  <option value="VinFast VF 6">VinFast VF 6 (B-SUV)</option>
                  <option value="VinFast VF 7">VinFast VF 7 (C-SUV)</option>
                  <option value="VinFast VF 8">VinFast VF 8 (D-SUV)</option>
                  <option value="VinFast VF 8 The All New">VinFast VF 8 The All New</option>
                  <option value="VinFast VF 9">VinFast VF 9 (E-SUV)</option>
                  <option value="VinFast VF Wild">VinFast VF Wild (Bán tải điện)</option>
                  <option value="VinFast VF MPV 7">VinFast VF MPV 7 (7 chỗ)</option>
                  <option value="VinFast VF 2">VinFast VF 2</option>
                  <option value="EC Van">VinFast EC Van</option>
                  <option value="Minio Green">VinFast Minio Green</option>
                  <option value="Herio Green">VinFast Herio Green</option>
                  <option value="Nerio Green">VinFast Nerio Green</option>
                  <option value="Limo Green">VinFast Limo Green</option>
                </select>
              </div>

              <div class="vf-dep-form-group">
                <label>Hình thức sở hữu Pin</label>
                <select name="battery_type" id="selectBattery" onchange="onBatteryChange(this.value)">
                  <option value="Thuê pin hàng tháng">Thuê pin hàng tháng</option>
                  <option value="Mua đứt kèm Pin">Mua đứt kèm Pin</option>
                </select>
              </div>

              <!-- Color with Swatches -->
              <div class="vf-dep-form-group full-width">
                <label>Màu ngoại thất mong muốn</label>
                <input type="text" name="car_color" id="inputCarColor" placeholder="VD: Trắng, Xanh, Đỏ, Bạc..." value="Trắng Brahmini White" oninput="document.getElementById('chipColor').textContent = this.value || 'Tiêu chuẩn'">
                
                <div class="vf-color-swatches-wrap">
                  <span class="vf-swatch-title">Màu chính hãng gợi ý (bấm chọn nhanh):</span>
                  <button type="button" class="vf-swatch-btn active" style="background:#FFFFFF;" title="Trắng Brahmini White" onclick="selectColorSwatch('Trắng Brahmini White', this)"></button>
                  <button type="button" class="vf-swatch-btn" style="background:#18181B;" title="Đen Jet Black" onclick="selectColorSwatch('Đen Jet Black', this)"></button>
                  <button type="button" class="vf-swatch-btn" style="background:#94A3B8;" title="Bạc Desat Silver" onclick="selectColorSwatch('Bạc Desat Silver', this)"></button>
                  <button type="button" class="vf-swatch-btn" style="background:#DC2626;" title="Đỏ Crimson Red" onclick="selectColorSwatch('Đỏ Crimson Red', this)"></button>
                  <button type="button" class="vf-swatch-btn" style="background:#2563EB;" title="Xanh VinFast Blue" onclick="selectColorSwatch('Xanh VinFast Blue', this)"></button>
                  <button type="button" class="vf-swatch-btn" style="background:#15803D;" title="Xanh Deep Ocean" onclick="selectColorSwatch('Xanh Deep Ocean', this)"></button>
                  <button type="button" class="vf-swatch-btn" style="background:#F59E0B;" title="Vàng Sunset Gold" onclick="selectColorSwatch('Vàng Sunset Gold', this)"></button>
                </div>
              </div>

              <div class="vf-dep-form-group">
                <label>Phương thức thanh toán</label>
                <select name="payment_type" id="selectPayment">
                  <option value="Chuyển khoản ngân hàng VietinBank">Chuyển khoản VietQR chính hãng</option>
                  <option value="Mua xe trả góp ngân hàng 80%">Vay trả góp ngân hàng (80%)</option>
                  <option value="Đặt cọc tại Showroom Tân Á Châu">Đến Showroom Tân Á Châu</option>
                </select>
              </div>

              <div class="vf-dep-form-group">
                <label>Địa chỉ / Tỉnh thành nhận xe</label>
                <input type="text" name="delivery_location" id="inputLocation" placeholder="VD: Vĩnh Yên, Vĩnh Phúc (hoặc tỉnh thành khác)">
              </div>

              <div class="vf-dep-form-group full-width">
                <label>Ghi chú / Yêu cầu thêm</label>
                <textarea name="customer_note" id="custNote" placeholder="Thời gian dự kiến nhận xe, yêu cầu xuất hóa đơn VAT công ty..."></textarea>
              </div>

              <div class="vf-dep-form-group full-width">
                <button type="submit" id="btnSubmitDeposit" class="vf-dep-submit-btn">
                  <span>✓ XÁC NHẬN GỬI THÔNG TIN ĐẶT CỌC</span>
                </button>
                <div class="vf-dep-secure-note">
                  <span>🔒 Thông tin được bảo mật tuyệt đối theo chính sách VinFast Việt Nam</span>
                </div>
              </div>

            </div>
          </form>

        </div>
      </div>

    </div>
  </div>

</div>

<!-- 3. SUCCESS MODAL WITH DYNAMIC VIETQR & CELEBRATION -->
<div id="vfDepositModal" class="vf-dep-modal" onclick="if(event.target===this)closeDepositModal()">
  <div class="vf-dep-modal-content">
    <div class="vf-dep-modal-icon">✓</div>
    <h3 class="vf-dep-modal-title">GỬI YÊU CẦU ĐẶT CỌC THÀNH CÔNG!</h3>
    <p class="vf-dep-modal-desc">
      Cảm ơn Quý khách <strong id="modalCustName"></strong> đã tin tưởng lựa chọn <strong id="modalCarName">VinFast VF 5</strong> tại <strong>VinFast Tân Á Châu</strong>. Chuyên viên sẽ gọi điện xác nhận trong 10 phút.
    </p>

    <!-- Dynamic VietQR Card -->
    <div class="vf-vietqr-card">
      <span class="vf-vietqr-badge">QUÉT MÃ VIETQR QUA MỌI APP NGÂN HÀNG</span>
      
      <div class="vf-qr-img-wrapper">
        <img id="vfDynamicQrImg" src="" alt="Mã QR thanh toán VietinBank Tân Á Châu" class="vf-qr-img">
      </div>
      <div style="font-size: 11.5px; color: #64748B;">Mã QR đã gắn sẵn số tiền cọc & cú pháp nhận xe chính chủ</div>

      <!-- Bank Details -->
      <div class="vf-dep-bank-box">
        <div class="vf-dep-bank-row">
          <span>Đơn vị thụ hưởng:</span>
          <strong>CÔNG TY TNHH TÂN Á CHÂU</strong>
        </div>
        <div class="vf-dep-bank-row">
          <span>Ngân hàng:</span>
          <strong>VietinBank — CN Vĩnh Phúc</strong>
        </div>
        <div class="vf-dep-bank-row">
          <span>Số tài khoản:</span>
          <div>
            <strong style="color: #2563EB; font-size: 15px; font-family: monospace;" id="modalBankStk">118002889999</strong>
            <button type="button" class="vf-copy-btn" onclick="copyTextToClipboard('118002889999', 'Đã sao chép số tài khoản!')">Sao chép</button>
          </div>
        </div>
        <div class="vf-dep-bank-row">
          <span>Số tiền cọc đề xuất:</span>
          <strong style="color: #16A34A; font-size: 14px;" id="modalDepositAmount">15.000.000 VNĐ</strong>
        </div>
        <div class="vf-dep-bank-row">
          <span>Cú pháp chuyển khoản:</span>
          <div>
            <strong id="modalTransferSyntax" style="color: #D97706; font-size: 12px;">[Họ tên] [SĐT] Coc [Xe]</strong>
            <button type="button" class="vf-copy-btn" onclick="copyTextToClipboard(document.getElementById('modalTransferSyntax').textContent, 'Đã sao chép cú pháp chuyển khoản!')">Sao chép</button>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="vf-dep-modal-close" onclick="closeDepositModal()">ĐÃ HOÀN TẤT & ĐÓNG LẠI</button>
  </div>
</div>

<!-- ============================================================
     JAVASCRIPT: REALTIME CONFIG, CONFETTI & VIETQR
     ============================================================ -->
<script>
var uploadsUrl = "<?php echo esc_url($uploads_url); ?>";

var carDatabase = {
  'vinfast vf 3': {
    title: 'VinFast VF 3',
    sub: 'Mini E-SUV quốc dân cá tính, gầm cao 191mm linh hoạt phố thị',
    img: uploadsUrl + 'official_vf3.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Tiêu chuẩn'
  },
  'vf 3': {
    title: 'VinFast VF 3',
    sub: 'Mini E-SUV quốc dân cá tính, gầm cao 191mm linh hoạt phố thị',
    img: uploadsUrl + 'official_vf3.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Tiêu chuẩn'
  },
  'vinfast vf 5 plus': {
    title: 'VinFast VF 5 Plus',
    sub: 'Mẫu A-SUV đô thị năng động, phong cách thời thượng',
    img: uploadsUrl + 'official_vf5.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Plus'
  },
  'vinfast vf 5': {
    title: 'VinFast VF 5 Plus',
    sub: 'Mẫu A-SUV đô thị năng động, phong cách thời thượng',
    img: uploadsUrl + 'official_vf5.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Plus'
  },
  'vf 5': {
    title: 'VinFast VF 5 Plus',
    sub: 'Mẫu A-SUV đô thị năng động, phong cách thời thượng',
    img: uploadsUrl + 'official_vf5.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Plus'
  },
  'vinfast vf 6': {
    title: 'VinFast VF 6',
    sub: 'B-SUV điện thời thượng, tinh tế, trang bị trợ lái ADAS cấp 2',
    img: uploadsUrl + 'official_vf6.webp',
    deposit: '20.000.000 VNĐ',
    depositVal: 20000000,
    version: 'Eco / Plus'
  },
  'vf 6': {
    title: 'VinFast VF 6',
    sub: 'B-SUV điện thời thượng, tinh tế, trang bị trợ lái ADAS cấp 2',
    img: uploadsUrl + 'official_vf6.webp',
    deposit: '20.000.000 VNĐ',
    depositVal: 20000000,
    version: 'Eco / Plus'
  },
  'vinfast vf 7': {
    title: 'VinFast VF 7',
    sub: 'C-SUV điện phi thuyền vũ trụ, tăng tốc 0-100km/h chỉ 5.8 giây',
    img: uploadsUrl + 'official_vf7.webp',
    deposit: '20.000.000 VNĐ',
    depositVal: 20000000,
    version: 'Base / Plus AWD'
  },
  'vf 7': {
    title: 'VinFast VF 7',
    sub: 'C-SUV điện phi thuyền vũ trụ, tăng tốc 0-100km/h chỉ 5.8 giây',
    img: uploadsUrl + 'official_vf7.webp',
    deposit: '20.000.000 VNĐ',
    depositVal: 20000000,
    version: 'Base / Plus AWD'
  },
  'vinfast vf 8': {
    title: 'VinFast VF 8',
    sub: 'D-SUV điện sang trọng toàn cầu, 402 mã lực, dẫn động 2 cầu AWD',
    img: uploadsUrl + 'official_vf8.webp',
    deposit: '50.000.000 VNĐ',
    depositVal: 50000000,
    version: 'Eco / Plus'
  },
  'vf 8': {
    title: 'VinFast VF 8',
    sub: 'D-SUV điện sang trọng toàn cầu, 402 mã lực, dẫn động 2 cầu AWD',
    img: uploadsUrl + 'official_vf8.webp',
    deposit: '50.000.000 VNĐ',
    depositVal: 50000000,
    version: 'Eco / Plus'
  },
  'vinfast vf 8 the all new': {
    title: 'VinFast VF 8 The All New',
    sub: 'Phiên bản cải tiến thế hệ mới, tối ưu phần cứng & pin vượt trội',
    img: uploadsUrl + 'official_vf8_allnew.png',
    deposit: '50.000.000 VNĐ',
    depositVal: 50000000,
    version: 'All-New'
  },
  'vf 8 the all new': {
    title: 'VinFast VF 8 The All New',
    sub: 'Phiên bản cải tiến thế hệ mới, tối ưu phần cứng & pin vượt trội',
    img: uploadsUrl + 'official_vf8_allnew.png',
    deposit: '50.000.000 VNĐ',
    depositVal: 50000000,
    version: 'All-New'
  },
  'vinfast vf 9': {
    title: 'VinFast VF 9',
    sub: 'E-SUV điện chủ tịch full-size, ghế cơ trưởng massage cao cấp',
    img: uploadsUrl + 'official_vf9.webp',
    deposit: '50.000.000 VNĐ',
    depositVal: 50000000,
    version: 'Eco / Plus 6-7 chỗ'
  },
  'vf 9': {
    title: 'VinFast VF 9',
    sub: 'E-SUV điện chủ tịch full-size, ghế cơ trưởng massage cao cấp',
    img: uploadsUrl + 'official_vf9.webp',
    deposit: '50.000.000 VNĐ',
    depositVal: 50000000,
    version: 'Eco / Plus 6-7 chỗ'
  },
  'vinfast vf wild': {
    title: 'VinFast VF Wild',
    sub: 'Mẫu bán tải điện việt dã đột phá của tương lai',
    img: uploadsUrl + 'official_vfwild.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Concept'
  },
  'vf wild': {
    title: 'VinFast VF Wild',
    sub: 'Mẫu bán tải điện việt dã đột phá của tương lai',
    img: uploadsUrl + 'official_vfwild.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Concept'
  },
  'vinfast vf mpv 7': {
    title: 'VinFast VF MPV 7',
    sub: 'Mẫu xe đa dụng 7 chỗ rộng rãi cho gia đình và kinh doanh dịch vụ',
    img: uploadsUrl + 'official_mpv7.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: '7 Chỗ'
  },
  'vf 2': {
    title: 'VinFast VF 2',
    sub: 'Mẫu xe điện mini hiện đại tiện ích đô thị',
    img: uploadsUrl + 'official_vf2.png',
    deposit: '10.000.000 VNĐ',
    depositVal: 10000000,
    version: 'Mini'
  },
  'ec van': {
    title: 'VinFast EC Van',
    sub: 'Xe tải van thuần điện tối ưu vận chuyển hàng hóa nội đô',
    img: uploadsUrl + 'official_ecvan.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Van'
  },
  'minio green': {
    title: 'VinFast Minio Green',
    sub: 'Xe điện chuyên biệt kinh doanh vận tải xanh thông minh',
    img: uploadsUrl + 'official_minio.webp',
    deposit: '15.000.000 VNĐ',
    depositVal: 15000000,
    version: 'Green'
  }
};

var currentDepositVal = 15000000;

function animateDepositAmount(targetVal) {
  var el = document.getElementById('vfDepAmountDisplay');
  var box = document.getElementById('vfDepAmountBox');
  var msbAmount = document.getElementById('msbDepositAmount');
  if (!el) return;

  box.classList.remove('pulse');
  void box.offsetWidth;
  box.classList.add('pulse');

  var start = currentDepositVal;
  var end = targetVal;
  var duration = 400;
  var startTime = null;

  function step(timestamp) {
    if (!startTime) startTime = timestamp;
    var progress = Math.min((timestamp - startTime) / duration, 1);
    var val = Math.floor(progress * (end - start) + start);
    var formatted = val.toLocaleString('vi-VN') + ' VNĐ';
    el.textContent = formatted;
    if (msbAmount) msbAmount.textContent = 'Cọc ' + formatted;
    if (progress < 1) {
      window.requestAnimationFrame(step);
    } else {
      var finalFormatted = end.toLocaleString('vi-VN') + ' VNĐ';
      el.textContent = finalFormatted;
      if (msbAmount) msbAmount.textContent = 'Cọc ' + finalFormatted;
      currentDepositVal = end;
    }
  }
  window.requestAnimationFrame(step);
}

function onCarChange(val) {
  var key = val.toLowerCase().trim();
  var found = null;
  for (var k in carDatabase) {
    if (key.indexOf(k) !== -1 || k.indexOf(key) !== -1) {
      found = carDatabase[k];
      break;
    }
  }

  var nameEl = document.getElementById('vfDepCarName');
  var subEl = document.getElementById('vfDepCarSub');
  var imgEl = document.getElementById('vfDepCarImg');
  var chipVer = document.getElementById('chipVersion');
  var msbCar = document.getElementById('msbCarName');

  if (found) {
    nameEl.textContent = found.title;
    subEl.textContent = found.sub;
    chipVer.textContent = found.version;
    if (msbCar) msbCar.textContent = found.title;
    animateDepositAmount(found.depositVal || 15000000);

    imgEl.classList.add('fade-out');
    setTimeout(function() {
      imgEl.src = found.img;
      imgEl.classList.remove('fade-out');
    }, 180);
  } else {
    nameEl.textContent = val;
    subEl.textContent = 'Xe điện thông minh chính hãng VinFast';
    if (msbCar) msbCar.textContent = val;
    animateDepositAmount(15000000);
  }
}

function onBatteryChange(val) {
  document.getElementById('chipBattery').textContent = (val.indexOf('Thuê') !== -1) ? 'Thuê pin' : 'Kèm pin';
}

function selectColorSwatch(colorName, btn) {
  document.querySelectorAll('.vf-swatch-btn').forEach(function(b) { b.classList.remove('active'); });
  if (btn) btn.classList.add('active');
  
  var colorInput = document.getElementById('inputCarColor');
  colorInput.value = colorName;
  document.getElementById('chipColor').textContent = colorName;
}

// Scroll smoothly to form when tapping mobile sticky bar
function scrollToDepositForm() {
  var formCard = document.getElementById('vfDepositFormCard');
  if (formCard) {
    formCard.scrollIntoView({ behavior: 'smooth', block: 'start' });
    setTimeout(function() {
      var inputName = document.getElementById('custName');
      if (inputName) inputName.focus();
    }, 450);
  }
}

// Mobile Sticky Bar scroll listener
window.addEventListener('scroll', function() {
  var msb = document.getElementById('vfMobileStickyBar');
  if (!msb) return;
  var previewCard = document.getElementById('vfDepPreviewCard');
  var submitBtn = document.getElementById('btnSubmitDeposit');
  
  if (previewCard && submitBtn) {
    var previewBottom = previewCard.getBoundingClientRect().bottom;
    var submitRect = submitBtn.getBoundingClientRect();
    
    // Show sticky bar once passed preview card, hide when submit button is in view
    if (previewBottom < 50 && submitRect.top > window.innerHeight - 50) {
      msb.classList.add('visible');
    } else {
      msb.classList.remove('visible');
    }
  }
}, { passive: true });

// Read URL parameters on load
document.addEventListener('DOMContentLoaded', function() {
  var params = new URLSearchParams(window.location.search);
  var pCar = params.get('car') || params.get('model');
  var pColor = params.get('color');
  var pVer = params.get('ver') || params.get('version');
  var pBattery = params.get('battery') || params.get('pin');

  var selectEl = document.getElementById('selectCarModel');

  if (pCar && selectEl) {
    var pLower = pCar.toLowerCase().replace(/[-_]/g, ' ');
    for (var i = 0; i < selectEl.options.length; i++) {
      var opt = selectEl.options[i].value.toLowerCase().replace(/[-_]/g, ' ');
      if (opt.indexOf(pLower) !== -1 || pLower.indexOf(opt) !== -1) {
        selectEl.selectedIndex = i;
        break;
      }
    }
  }

  if (pColor) {
    document.getElementById('inputCarColor').value = pColor;
    document.getElementById('chipColor').textContent = pColor;
    document.querySelectorAll('.vf-swatch-btn').forEach(function(btn) {
      if (btn.getAttribute('title') && btn.getAttribute('title').toLowerCase().indexOf(pColor.toLowerCase()) !== -1) {
        btn.classList.add('active');
      } else {
        btn.classList.remove('active');
      }
    });
  }

  if (pVer) {
    document.getElementById('chipVersion').textContent = pVer;
  }

  if (pBattery) {
    var bSel = document.getElementById('selectBattery');
    if (bSel) {
      if (pBattery.indexOf('mua') !== -1 || pBattery.indexOf('dut') !== -1) {
        bSel.selectedIndex = 1;
        document.getElementById('chipBattery').textContent = 'Kèm pin';
      } else {
        bSel.selectedIndex = 0;
        document.getElementById('chipBattery').textContent = 'Thuê pin';
      }
    }
  }

  if (selectEl) {
    onCarChange(selectEl.value);
  }
});

// Toast copy helper
function copyTextToClipboard(text, msg) {
  navigator.clipboard.writeText(text).then(function() {
    var toast = document.getElementById('vfCopyToast');
    toast.textContent = msg || '✓ Đã sao chép!';
    toast.classList.add('show');
    setTimeout(function() {
      toast.classList.remove('show');
    }, 2200);
  });
}

// Handle Form Submission
function handleDepositSubmit(e) {
  e.preventDefault();
  var btn = document.getElementById('btnSubmitDeposit');
  btn.disabled = true;
  btn.innerHTML = '<span>⏳ Đang ghi nhận thông tin đặt cọc...</span>';

  var form = document.getElementById('vfDepositForm');
  var formData = new FormData(form);

  var custName = document.getElementById('custName').value;
  var custPhone = document.getElementById('custPhone').value;
  var carName = document.getElementById('selectCarModel').value;
  var depAmount = document.getElementById('vfDepAmountDisplay').textContent;

  fetch("<?php echo esc_url(admin_url('admin-ajax.php')); ?>", {
    method: 'POST',
    body: formData
  })
  .then(function(res) { return res.json(); })
  .then(function(data) {
    showDepositModal(custName, custPhone, carName, depAmount);
    form.reset();
  })
  .catch(function(err) {
    showDepositModal(custName, custPhone, carName, depAmount);
  })
  .finally(function() {
    btn.disabled = false;
    btn.innerHTML = '<span>✓ XÁC NHẬN GỬI THÔNG TIN ĐẶT CỌC</span>';
  });
}

function showDepositModal(name, phone, car, amount) {
  document.getElementById('modalCustName').textContent = name;
  document.getElementById('modalCarName').textContent = car;
  document.getElementById('modalDepositAmount').textContent = amount;
  
  var cleanPhone = phone.replace(/[^0-9]/g, '');
  var cleanCar = car.replace('VinFast ', '');
  var transferSyntax = name + ' ' + cleanPhone + ' Coc ' + cleanCar;
  document.getElementById('modalTransferSyntax').textContent = transferSyntax;

  // Build VietQR image URL
  var rawAmount = currentDepositVal || 15000000;
  var qrUrl = 'https://img.vietqr.io/image/vietinbank-118002889999-compact2.png'
    + '?amount=' + encodeURIComponent(rawAmount)
    + '&addInfo=' + encodeURIComponent(transferSyntax)
    + '&accountName=' + encodeURIComponent('CONG TY TNHH TAN A CHAU');

  document.getElementById('vfDynamicQrImg').src = qrUrl;

  // Show Modal & hide mobile sticky bar
  var msb = document.getElementById('vfMobileStickyBar');
  if (msb) msb.classList.remove('visible');
  document.getElementById('vfDepositModal').classList.add('active');

  // Trigger Confetti Celebration
  vfFireConfetti();
}

function closeDepositModal() {
  document.getElementById('vfDepositModal').classList.remove('active');
}

// Pure JS Canvas Confetti Celebration Animation
function vfFireConfetti() {
  var canvas = document.getElementById('vfConfettiCanvas');
  if (!canvas) return;
  var ctx = canvas.getContext('2d');
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;

  var pieces = [];
  var numberOfPieces = (window.innerWidth < 600) ? 60 : 90;
  var colors = ['#2563EB', '#60A5FA', '#F59E0B', '#10B981', '#ffffff', '#F43F5E'];

  for (var i = 0; i < numberOfPieces; i++) {
    pieces.push({
      x: canvas.width * 0.5,
      y: canvas.height * 0.4,
      w: Math.random() * 8 + 5,
      h: Math.random() * 8 + 5,
      color: colors[Math.floor(Math.random() * colors.length)],
      vx: (Math.random() - 0.5) * 15,
      vy: (Math.random() - 0.7) * 17,
      rotation: Math.random() * 360,
      rotationSpeed: (Math.random() - 0.5) * 12,
      opacity: 1
    });
  }

  var animStart = Date.now();
  function update() {
    var elapsed = Date.now() - animStart;
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    for (var i = 0; i < pieces.length; i++) {
      var p = pieces[i];
      p.x += p.vx;
      p.y += p.vy;
      p.vy += 0.38;
      p.vx *= 0.98;
      p.rotation += p.rotationSpeed;
      if (elapsed > 1800) {
        p.opacity -= 0.02;
      }

      ctx.save();
      ctx.translate(p.x, p.y);
      ctx.rotate((p.rotation * Math.PI) / 180);
      ctx.globalAlpha = Math.max(0, p.opacity);
      ctx.fillStyle = p.color;
      ctx.fillRect(-p.w / 2, -p.h / 2, p.w, p.h);
      ctx.restore();
    }

    if (elapsed < 3200) {
      requestAnimationFrame(update);
    } else {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
    }
  }
  requestAnimationFrame(update);
}
</script>

<?php get_footer(); ?>
