/**
 * VINFAST MINH NGÂN PHÚ THỌ 3S — PREVIEW INTERACTIONS
 * Concept A: Premium Showroom Interactive Logic
 */

document.addEventListener('DOMContentLoaded', () => {
  // 1. Mobile Drawer Navigation
  const hamburgerBtn = document.getElementById('hamburgerBtn');
  const closeDrawerBtn = document.getElementById('closeDrawerBtn');
  const mobileDrawer = document.getElementById('mobileDrawer');
  const drawerOverlay = document.getElementById('drawerOverlay');

  function openDrawer() {
    mobileDrawer.classList.add('active');
    drawerOverlay.classList.add('active');
    document.body.style.overflow = 'hidden';
  }

  function closeDrawer() {
    mobileDrawer.classList.remove('active');
    drawerOverlay.classList.remove('active');
    document.body.style.overflow = '';
  }

  if (hamburgerBtn) hamburgerBtn.addEventListener('click', openDrawer);
  if (closeDrawerBtn) closeDrawerBtn.addEventListener('click', closeDrawer);
  if (drawerOverlay) drawerOverlay.addEventListener('click', closeDrawer);

  // 2. Collection Category Tabs (Xe cá nhân / Xe dịch vụ)
  const tabPersonal = document.getElementById('tabPersonal');
  const tabCommercial = document.getElementById('tabCommercial');
  const gridPersonal = document.getElementById('gridPersonal');
  const gridCommercial = document.getElementById('gridCommercial');

  if (tabPersonal && tabCommercial) {
    tabPersonal.addEventListener('click', () => {
      tabPersonal.classList.add('active');
      tabCommercial.classList.remove('active');
      gridPersonal.style.display = 'grid';
      gridCommercial.style.display = 'none';
    });

    tabCommercial.addEventListener('click', () => {
      tabCommercial.classList.add('active');
      tabPersonal.classList.remove('active');
      gridPersonal.style.display = 'none';
      gridCommercial.style.display = 'grid';
    });
  }

  // 3. Promotional Popup (Tự đóng & lưu phiên)
  const promoPopup = document.getElementById('promoPopup');
  const closePopupBtn = document.getElementById('closePopupBtn');
  const dismissPopupBtn = document.getElementById('dismissPopupBtn');

  function showPopup() {
    if (!sessionStorage.getItem('vf_promo_closed')) {
      promoPopup.classList.add('active');
    }
  }

  function hidePopup() {
    promoPopup.classList.remove('active');
    sessionStorage.setItem('vf_promo_closed', 'true');
  }

  // Tự động hiển thị sau 3 giây nếu chưa đóng
  setTimeout(showPopup, 3000);

  // Tự động đóng sau 15 giây nếu không tương tác
  const autoCloseTimer = setTimeout(() => {
    if (promoPopup && promoPopup.classList.contains('active')) {
      hidePopup();
    }
  }, 15000);

  if (closePopupBtn) {
    closePopupBtn.addEventListener('click', () => {
      clearTimeout(autoCloseTimer);
      hidePopup();
    });
  }

  if (dismissPopupBtn) {
    dismissPopupBtn.addEventListener('click', () => {
      clearTimeout(autoCloseTimer);
      hidePopup();
    });
  }

  // 4. Keyboard Navigation (ESC to close drawers/modals)
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeDrawer();
      hidePopup();
    }
  });

  // 5. Demo CTA Toast Alerts
  const demoButtons = document.querySelectorAll('[data-demo-action]');
  demoButtons.forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const actionName = btn.getAttribute('data-demo-action');
      showToast(`⚡ Chế độ Preview: Bạn vừa bấm "${actionName}". Chức năng này sẽ kết nối hoàn chỉnh ở các Slice tiếp theo.`);
    });
  });

  function showToast(message) {
    let toast = document.getElementById('previewToast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'previewToast';
      toast.style.position = 'fixed';
      toast.style.bottom = '90px';
      toast.style.left = '50%';
      toast.style.transform = 'translateX(-50%)';
      toast.style.backgroundColor = '#111827';
      toast.style.color = '#FFFFFF';
      toast.style.padding = '12px 24px';
      toast.style.borderRadius = '8px';
      toast.style.fontSize = '14px';
      toast.style.boxShadow = '0 10px 25px rgba(0,0,0,0.2)';
      toast.style.zIndex = '300';
      toast.style.maxWidth = '90vw';
      toast.style.textAlign = 'center';
      toast.style.transition = 'opacity 0.3s ease';
      document.body.appendChild(toast);
    }
    toast.textContent = message;
    toast.style.opacity = '1';
    setTimeout(() => {
      toast.style.opacity = '0';
    }, 3500);
  }
});

