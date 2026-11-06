/**
 * VINFAST MINH NGÂN PHÚ THỌ 3S — PREVIEW INTERACTIONS
 * Concept A: Premium Showroom Interactive Logic
 */

document.addEventListener('DOMContentLoaded', () => {
  // 0. CINEMATIC MOTION HERO & DYNAMIC CAR SLIDER CONTROLLER
  function initCinematicHeroSlider() {
    const heroSection = document.getElementById('hero');
    if (!heroSection) return;

    const slides = Array.from(heroSection.querySelectorAll('.hero-slide'));
    const indPills = Array.from(heroSection.querySelectorAll('.ind-pill'));
    const btnPrev = document.getElementById('btnPrev');
    const btnNext = document.getElementById('btnNext');
    const btnPause = document.getElementById('btnPause');

    if (slides.length <= 1) return;

    let currentIndex = 0;
    let slideDuration = 8000; // 8.0s per slide
    let isUserPaused = false;
    let isHovered = false;
    let isFocused = false;
    let startTime = 0;
    let elapsedBeforePause = 0;
    let rafId = null;

    function updateProgress(timestamp) {
      if (!startTime) startTime = timestamp;
      const totalElapsed = elapsedBeforePause + (timestamp - startTime);
      const progressPercent = Math.min((totalElapsed / slideDuration) * 100, 100);

      const activePill = indPills[currentIndex];
      if (activePill) {
        const progressBar = activePill.querySelector('.ind-progress');
        if (progressBar) progressBar.style.width = progressPercent + '%';
      }

      if (totalElapsed >= slideDuration) {
        nextSlide();
      } else if (!isUserPaused && !isHovered && !isFocused) {
        rafId = requestAnimationFrame(updateProgress);
      }
    }

    function startTimer() {
      stopTimer();
      startTime = performance.now();
      rafId = requestAnimationFrame(updateProgress);
    }

    function stopTimer() {
      if (rafId) {
        cancelAnimationFrame(rafId);
        rafId = null;
      }
    }

    function pauseTimer() {
      if (rafId) {
        elapsedBeforePause += performance.now() - startTime;
        cancelAnimationFrame(rafId);
        rafId = null;
      }
    }

    function resumeTimer() {
      if (isUserPaused || isHovered || isFocused) return;
      startTime = performance.now();
      rafId = requestAnimationFrame(updateProgress);
    }

    function goToSlide(targetIndex, direction = 'next') {
      if (targetIndex === currentIndex) return;

      // Reset indicators
      indPills.forEach(pill => {
        const bar = pill.querySelector('.ind-progress');
        if (bar) bar.style.width = '0%';
        pill.classList.remove('active');
        pill.removeAttribute('aria-current');
      });

      // Slide cũ rời đi
      const prevSlide = slides[currentIndex];
      prevSlide.classList.remove('active');
      prevSlide.style.transform = direction === 'next' ? 'translate3d(-40px, 0, 0)' : 'translate3d(40px, 0, 0)';
      prevSlide.style.opacity = '0';

      // Slide mới xuất hiện
      currentIndex = (targetIndex + slides.length) % slides.length;
      const nextSlideEl = slides[currentIndex];
      void nextSlideEl.offsetWidth; // Force Reflow

      nextSlideEl.classList.add('active');
      nextSlideEl.style.transform = 'translate3d(0, 0, 0)';
      nextSlideEl.style.opacity = '1';

      // Cập nhật Indicator tương ứng
      const newActivePill = indPills[currentIndex];
      if (newActivePill) {
        newActivePill.classList.add('active');
        newActivePill.setAttribute('aria-current', 'true');
      }

      // Reset timer
      elapsedBeforePause = 0;
      startTime = 0;
      if (!isUserPaused && !isHovered && !isFocused) {
        startTimer();
      }
    }

    function nextSlide() {
      goToSlide(currentIndex + 1, 'next');
    }

    function prevSlide() {
      goToSlide(currentIndex - 1, 'prev');
    }

    if (btnNext) btnNext.addEventListener('click', nextSlide);
    if (btnPrev) btnPrev.addEventListener('click', prevSlide);

    if (btnPause) {
      btnPause.addEventListener('click', () => {
        isUserPaused = !isUserPaused;
        btnPause.classList.toggle('is-paused', isUserPaused);
        btnPause.setAttribute('aria-label', isUserPaused ? 'Tiếp tục trình chiếu' : 'Tạm dừng trình chiếu');
        if (isUserPaused) pauseTimer();
        else resumeTimer();
      });
    }

    indPills.forEach((pill, idx) => {
      pill.addEventListener('click', () => {
        goToSlide(idx, idx > currentIndex ? 'next' : 'prev');
      });
    });

    heroSection.addEventListener('mouseenter', () => {
      isHovered = true;
      if (!isUserPaused) pauseTimer();
    });

    heroSection.addEventListener('mouseleave', () => {
      isHovered = false;
      if (!isUserPaused && !isFocused) resumeTimer();
    });

    heroSection.addEventListener('focusin', () => {
      isFocused = true;
      if (!isUserPaused) pauseTimer();
    });

    heroSection.addEventListener('focusout', () => {
      isFocused = false;
      if (!isUserPaused && !isHovered) resumeTimer();
    });

    document.addEventListener('keydown', (e) => {
      if (['INPUT', 'SELECT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;
      if (e.key === 'ArrowRight') nextSlide();
      else if (e.key === 'ArrowLeft') prevSlide();
      else if (e.key === ' ' || e.code === 'Space') {
        if (document.activeElement === btnPause || heroSection.contains(document.activeElement)) {
          e.preventDefault();
          if (btnPause) btnPause.click();
        }
      }
    });

    // Touch Swipe Detection
    let touchStartX = 0;
    let touchStartY = 0;

    heroSection.addEventListener('touchstart', (e) => {
      if (e.touches.length === 1) {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
      }
    }, { passive: true });

    heroSection.addEventListener('touchend', (e) => {
      if (e.changedTouches.length === 1) {
        const deltaX = e.changedTouches[0].clientX - touchStartX;
        const deltaY = e.changedTouches[0].clientY - touchStartY;
        if (Math.abs(deltaX) > 45 && Math.abs(deltaX) > Math.abs(deltaY)) {
          if (deltaX < 0) nextSlide();
          else prevSlide();
        }
      }
    }, { passive: true });

    startTimer();
  }

  initCinematicHeroSlider();

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

