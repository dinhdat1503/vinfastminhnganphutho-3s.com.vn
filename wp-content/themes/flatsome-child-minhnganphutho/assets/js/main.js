/**
 * VinFast Vĩnh Phúc — Main JS
 * Swiper hero, floating sidebar, misc interactions
 */

(function($) {
  'use strict';

  // =============================================
  // 1. HOMEPAGE HERO SWIPER
  // =============================================
  function initHeroSwiper() {
    if (document.querySelector('.vf-hero .swiper')) {
      new Swiper('.vf-hero .swiper', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        speed: 800,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        pagination: {
          el: '.vf-hero .swiper-pagination',
          clickable: true,
        },
        navigation: {
          prevEl: '.vf-hero .swiper-button-prev',
          nextEl: '.vf-hero .swiper-button-next',
        },
      });
    }
  }

  // =============================================
  // 1B. OFFICIAL CAR SHOWCASE SWIPER
  // =============================================
  function initShowcaseSwiper() {
    if (document.querySelector('.vf-showcase-slider')) {
      new Swiper('.vf-showcase-slider', {
        slidesPerView: 1,
        spaceBetween: 40,
        loop: true,
        speed: 600,
        autoplay: {
          delay: 6000,
          disableOnInteraction: false,
        },
        pagination: {
          el: '.vf-sc-pagination',
          clickable: true,
        },
        navigation: {
          prevEl: '.vf-sc-button-prev',
          nextEl: '.vf-sc-button-next',
        },
      });
    }
  }

  // =============================================
  // 2. FLOATING SIDEBAR TOOLTIP
  // =============================================
  function initFloatSidebar() {
    const sidebar = document.getElementById('vf-float-sidebar');
    if (!sidebar) return;
    // Already CSS-driven, no extra JS needed
  }

  // =============================================
  // 3. SMOOTH SCROLL for any #hash links
  // =============================================
  function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]:not(.vf-car-subnav-tab)').forEach(a => {
      a.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    });
  }

  // =============================================
  // 4. HEADER SCROLL EFFECT
  // =============================================
  function initHeaderScroll() {
    const header = document.querySelector('.header-main, #header');
    if (!header) return;
    let lastScroll = 0;
    window.addEventListener('scroll', function() {
      const scrollY = window.scrollY;
      if (scrollY > 80) {
        header.classList.add('scrolled');
      } else {
        header.classList.remove('scrolled');
      }
      lastScroll = scrollY;
    }, { passive: true });
  }

  // =============================================
  // 5. LAZY LOAD IMAGES (IntersectionObserver)
  // =============================================
  function initLazyLoad() {
    if (!('IntersectionObserver' in window)) return;
    const lazyImgs = document.querySelectorAll('img[loading="lazy"]');
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('loaded');
          obs.unobserve(e.target);
        }
      });
    }, { rootMargin: '200px' });
    lazyImgs.forEach(img => obs.observe(img));
  }

  // =============================================
  // 6. CAR CARD HOVER ANIMATION
  // =============================================
  function initCardAnimations() {
    const cards = document.querySelectorAll('.vf-car-card');
    if (!('IntersectionObserver' in window)) return;

    cards.forEach((card, i) => {
      card.style.opacity = '0';
      card.style.transform = 'translateY(24px)';
      card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
      card.style.transitionDelay = (i * 0.08) + 's';
    });

    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.style.opacity = '1';
          e.target.style.transform = 'translateY(0)';
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.1 });

    cards.forEach(c => obs.observe(c));
  }

  // =============================================
  // 7. SECTION REVEAL ANIMATION
  // =============================================
  function initSectionReveal() {
    const sections = document.querySelectorAll('.vf-section, .vf-section-alt');
    if (!('IntersectionObserver' in window)) return;

    const obs = new IntersectionObserver((entries) => {
      entries.forEach(e => {
        if (e.isIntersecting) {
          e.target.classList.add('vf-visible');
          obs.unobserve(e.target);
        }
      });
    }, { threshold: 0.05 });

    sections.forEach(s => {
      s.style.opacity = '0';
      s.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
      s.style.transform = 'translateY(16px)';
      obs.observe(s);
    });

    // CSS class to trigger
    const style = document.createElement('style');
    style.textContent = '.vf-visible { opacity: 1 !important; transform: translateY(0) !important; }';
    document.head.appendChild(style);
  }

  // =============================================
  // 8. SINGLE PRODUCT SUBNAV & HEADER HIDE TOGGLE
  // =============================================
  function initProductSubnavToggle() {
    var subnavs = document.querySelectorAll('.vf-subnav, .vf-car-subnav, #carStickySubnav, [id$="StickySubnav"]');
    if (!subnavs.length) return;

    var header = document.getElementById('header');
    var headerWrapper = document.querySelector('.header-wrapper');
    var headerMain = document.querySelector('.header-main');

    // Tháo bỏ các class sticky của Flatsome trên trang sản phẩm
    if (header) {
      header.classList.remove('has-sticky', 'sticky-jump', 'header-sticky');
    }

    function handleScroll() {
      if (window.scrollY > 100) {
        document.body.classList.add('vf-hide-main-header');
        if (header) {
          header.classList.add('vf-header-hidden');
          header.style.setProperty('display', 'none', 'important');
        }
        if (headerWrapper) {
          headerWrapper.classList.add('vf-header-hidden');
          headerWrapper.style.setProperty('display', 'none', 'important');
        }
        if (headerMain) {
          headerMain.classList.add('vf-header-hidden');
          headerMain.style.setProperty('display', 'none', 'important');
        }
        subnavs.forEach(function(s) {
          s.classList.add('active');
          s.classList.add('subnav-visible');
        });
      } else {
        document.body.classList.remove('vf-hide-main-header');
        if (header) {
          header.classList.remove('vf-header-hidden');
          header.style.removeProperty('display');
        }
        if (headerWrapper) {
          headerWrapper.classList.remove('vf-header-hidden');
          headerWrapper.style.removeProperty('display');
        }
        if (headerMain) {
          headerMain.classList.remove('vf-header-hidden');
          headerMain.style.removeProperty('display');
        }
        subnavs.forEach(function(s) {
          s.classList.remove('active');
          s.classList.remove('subnav-visible');
        });
      }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });
    handleScroll();
  }

  // =============================================
  // INIT ALL
  // =============================================
  document.addEventListener('DOMContentLoaded', function() {
    initHeroSwiper();
    initShowcaseSwiper();
    initFloatSidebar();
    initSmoothScroll();
    initHeaderScroll();
    initLazyLoad();
    initCardAnimations();
    initSectionReveal();
    initProductSubnavToggle();
  });

})(jQuery);
