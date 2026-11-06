/**
 * VINFAST MINH NGÂN PHÚ THỌ 3S — CINEMATIC MOTION HERO CONTROLLER
 * Task: HOME-02.2 | Concept: Premium Showroom
 */

(function () {
  'use strict';

  // DOM Elements
  const heroSection = document.getElementById('cinematicHero');
  const slides = Array.from(document.querySelectorAll('.hero-slide'));
  const indPills = Array.from(document.querySelectorAll('.ind-pill'));
  const btnPrev = document.getElementById('btnPrev');
  const btnNext = document.getElementById('btnNext');
  const btnPause = document.getElementById('btnPause');

  // Simulator Elements
  const viewportSelect = document.getElementById('viewportSelect');
  const speedSelect = document.getElementById('speedSelect');
  const btnReplayEntrance = document.getElementById('btnReplayEntrance');
  const btnToggleMotion = document.getElementById('btnToggleMotion');
  const lblMotionState = document.getElementById('lblMotionState');
  const btnToggleVideo = document.getElementById('btnToggleVideo');
  const lblVideoState = document.getElementById('lblVideoState');
  const viewportCanvas = document.getElementById('viewportCanvas');
  const heroVideoWrap = document.getElementById('heroVideoWrap');
  const heroBgVideo = document.getElementById('heroBgVideo');

  if (!heroSection || slides.length === 0) return;

  // State Management
  let currentIndex = 0;
  let slideDuration = 8000; // 8 seconds per slide
  let isUserPaused = false;
  let isHovered = false;
  let isFocused = false;
  let startTime = 0;
  let elapsedBeforePause = 0;
  let rafId = null;

  /**
   * Cập nhật thanh tiến trình (Progress Bar) mượt mà 60fps qua requestAnimationFrame
   */
  function updateProgress(timestamp) {
    if (!startTime) startTime = timestamp;

    const totalElapsed = elapsedBeforePause + (timestamp - startTime);
    const progressPercent = Math.min((totalElapsed / slideDuration) * 100, 100);

    // Cập nhật thanh tiến trình của slide hiện tại
    const activePill = indPills[currentIndex];
    if (activePill) {
      const progressBar = activePill.querySelector('.ind-progress');
      if (progressBar) {
        progressBar.style.width = progressPercent + '%';
      }
    }

    if (totalElapsed >= slideDuration) {
      // Hết thời gian chuyển slide tiếp theo
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

  /**
   * Chuyển đến slide chỉ định
   */
  function goToSlide(targetIndex, direction = 'next') {
    if (targetIndex === currentIndex) return;

    // Reset progress bars của tất cả pills
    indPills.forEach((pill) => {
      const bar = pill.querySelector('.ind-progress');
      if (bar) bar.style.width = '0%';
      pill.classList.remove('active');
      pill.removeAttribute('aria-current');
    });

    // Reset slide cũ
    const prevSlide = slides[currentIndex];
    prevSlide.classList.remove('active');
    prevSlide.style.transform = direction === 'next' ? 'translate3d(-40px, 0, 0)' : 'translate3d(40px, 0, 0)';
    prevSlide.style.opacity = '0';

    // Kích hoạt slide mới
    currentIndex = (targetIndex + slides.length) % slides.length;
    const nextSlideEl = slides[currentIndex];

    // Force reflow để kích hoạt animation
    void nextSlideEl.offsetWidth;

    nextSlideEl.classList.add('active');
    nextSlideEl.style.transform = 'translate3d(0, 0, 0)';
    nextSlideEl.style.opacity = '1';

    // Cập nhật Indicator
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

  // Event Listeners cho nút Prev / Next
  if (btnNext) {
    btnNext.addEventListener('click', () => {
      nextSlide();
    });
  }

  if (btnPrev) {
    btnPrev.addEventListener('click', () => {
      prevSlide();
    });
  }

  // Nút Tạm dừng / Tiếp tục (Pause / Play)
  if (btnPause) {
    btnPause.addEventListener('click', () => {
      isUserPaused = !isUserPaused;
      btnPause.classList.toggle('is-paused', isUserPaused);
      btnPause.setAttribute('aria-label', isUserPaused ? 'Tiếp tục trình chiếu' : 'Tạm dừng trình chiếu');

      if (isUserPaused) {
        pauseTimer();
      } else {
        resumeTimer();
      }
    });
  }

  // Tương tác khi click trực tiếp vào Indicator Pills
  indPills.forEach((pill, idx) => {
    pill.addEventListener('click', () => {
      goToSlide(idx, idx > currentIndex ? 'next' : 'prev');
    });
  });

  // Tự động tạm dừng khi Hover chuột (nhưng tôn trọng nếu user đã Pause)
  heroSection.addEventListener('mouseenter', () => {
    isHovered = true;
    if (!isUserPaused) pauseTimer();
  });

  heroSection.addEventListener('mouseleave', () => {
    isHovered = false;
    if (!isUserPaused && !isFocused) resumeTimer();
  });

  // Tạm dừng khi Focus bằng bàn phím (WCAG Accessibility)
  heroSection.addEventListener('focusin', () => {
    isFocused = true;
    if (!isUserPaused) pauseTimer();
  });

  heroSection.addEventListener('focusout', () => {
    isFocused = false;
    if (!isUserPaused && !isHovered) resumeTimer();
  });

  // Điều khiển bằng phím mũi tên và phím cách
  document.addEventListener('keydown', (e) => {
    // Chỉ kích hoạt khi focus không nằm trong input hoặc textarea
    if (['INPUT', 'SELECT', 'TEXTAREA'].includes(document.activeElement.tagName)) return;

    if (e.key === 'ArrowRight') {
      nextSlide();
    } else if (e.key === 'ArrowLeft') {
      prevSlide();
    } else if (e.key === ' ' || e.code === 'Space') {
      // Toggle Pause khi bấm Space trong hero
      if (document.activeElement === btnPause || heroSection.contains(document.activeElement)) {
        e.preventDefault();
        btnPause.click();
      }
    }
  });

  // Touch Swipe Gesture Detection cho Thiết bị di động
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
      const touchEndX = e.changedTouches[0].clientX;
      const touchEndY = e.changedTouches[0].clientY;
      const deltaX = touchEndX - touchStartX;
      const deltaY = touchEndY - touchStartY;

      // Vuốt ngang nhiều hơn vuốt dọc (tránh xung đột với cuộn trang)
      if (Math.abs(deltaX) > 45 && Math.abs(deltaX) > Math.abs(deltaY)) {
        if (deltaX < 0) {
          nextSlide(); // Vuốt sang trái -> Slide tiếp theo
        } else {
          prevSlide(); // Vuốt sang phải -> Slide trước đó
        }
      }
    }
  }, { passive: true });

  // ==========================================================================
  // SIMULATOR TOOLBAR LOGIC (Dành riêng cho kiểm thử và duyệt thiết kế)
  // ==========================================================================

  // Viewport Switcher
  if (viewportSelect && viewportCanvas) {
    viewportSelect.addEventListener('change', (e) => {
      const val = e.target.value;
      if (val === '100%') {
        viewportCanvas.style.maxWidth = '100%';
        viewportCanvas.style.borderLeft = 'none';
        viewportCanvas.style.borderRight = 'none';
      } else {
        viewportCanvas.style.maxWidth = val;
        viewportCanvas.style.borderLeft = '1px dashed rgba(255, 255, 255, 0.15)';
        viewportCanvas.style.borderRight = '1px dashed rgba(255, 255, 255, 0.15)';
      }
    });
  }

  // Slide Speed Switcher
  if (speedSelect) {
    speedSelect.addEventListener('change', (e) => {
      slideDuration = parseInt(e.target.value, 10);
      elapsedBeforePause = 0;
      startTime = performance.now();
    });
  }

  // Replay Entrance Animation
  if (btnReplayEntrance) {
    btnReplayEntrance.addEventListener('click', () => {
      // Re-trigger CSS animation cho slide hiện tại
      const currentSlideEl = slides[currentIndex];
      currentSlideEl.classList.remove('active');
      void currentSlideEl.offsetWidth; // Force Reflow
      currentSlideEl.classList.add('active');

      // Reset timer
      elapsedBeforePause = 0;
      startTime = 0;
      if (!isUserPaused) startTimer();
    });
  }

  // Toggle Reduced Motion Simulator
  if (btnToggleMotion && lblMotionState) {
    btnToggleMotion.addEventListener('click', () => {
      const isReduced = document.body.classList.toggle('sim-reduced-motion');
      lblMotionState.textContent = isReduced ? 'ON' : 'OFF';
      lblMotionState.style.color = isReduced ? '#34D399' : '#F87171';
    });
  }

  // Toggle Optional Video Mode
  if (btnToggleVideo && lblVideoState && heroVideoWrap) {
    btnToggleVideo.addEventListener('click', () => {
      const isVideoActive = heroVideoWrap.classList.toggle('active');
      lblVideoState.textContent = isVideoActive ? 'ON' : 'OFF';
      lblVideoState.style.color = isVideoActive ? '#34D399' : '#94A3B8';

      if (isVideoActive && heroBgVideo) {
        // Tải video demo mẫu hoặc phát video nếu có src
        heroBgVideo.play().catch(() => {});
      } else if (heroBgVideo) {
        heroBgVideo.pause();
      }
    });
  }

  // Khởi động Entrance ban đầu
  startTimer();

})();

