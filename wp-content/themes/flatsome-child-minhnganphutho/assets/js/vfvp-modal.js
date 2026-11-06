/**
 * VinFast Vĩnh Phúc — Auto-Load Promo Popup & Lead Form Handler
 * Shows promo popup on page load, automatically closes after 15s if untouched.
 */
(function() {
  'use strict';

  var autoCloseTimer = null;
  var userInteracted = false;

  function getModalElement(id) {
    if (id) {
      var el = document.getElementById(id);
      if (el) return el;
    }
    return document.getElementById('vfQuoteModal') || 
           document.getElementById('modal-laythu') || 
           document.querySelector('.vf-modal-overlay') || 
           document.querySelector('.vf-modal');
  }

  function updatePromoBadges() {
    var now = new Date();
    var currentMonth = now.getMonth() + 1;
    var currentYear = now.getFullYear();
    var monthYearStr = currentMonth + '/' + currentYear;

    var badges = document.querySelectorAll('.vf-modal-badge, [data-promo-badge]');
    badges.forEach(function(badge) {
      badge.textContent = '⚡ ƯU ĐÃI THÁNG ' + monthYearStr;
    });

    var modalLogos = document.querySelectorAll('.vf-modal-logo');
    modalLogos.forEach(function(logo) {
      if (logo.src.indexOf('logo-tan-a-chau-white-horizontal.png') === -1) {
        var wpContentIdx = logo.src.indexOf('/wp-content/');
        if (wpContentIdx !== -1) {
          logo.src = logo.src.substring(0, wpContentIdx) + '/wp-content/themes/flatsome-child/assets/images/logo-tan-a-chau-white-horizontal.png';
        }
      }
      logo.alt = 'VinFast Tân Á Châu';
      logo.style.setProperty('background', 'transparent', 'important');
      logo.style.setProperty('padding', '0', 'important');
      logo.style.setProperty('border', 'none', 'important');
      logo.style.setProperty('border-radius', '0', 'important');
    });
  }

  window.vfOpenModal = function(id) {
    updatePromoBadges();
    var m = getModalElement(id);
    if (m) {
      m.classList.add('open');
      m.classList.add('active');
      m.classList.add('is-open');
      m.style.setProperty('display', 'flex', 'important');
      m.style.setProperty('opacity', '1', 'important');
      m.style.setProperty('visibility', 'visible', 'important');
      document.body.style.overflow = 'hidden';
    }
  };

  window.vfCloseModal = function(id) {
    if (autoCloseTimer) {
      clearTimeout(autoCloseTimer);
      autoCloseTimer = null;
    }
    var modals = document.querySelectorAll('#vfQuoteModal, #modal-laythu, .vf-modal-overlay, .vf-modal');
    modals.forEach(function(m) {
      m.classList.remove('open');
      m.classList.remove('active');
      m.classList.remove('is-open');
      m.style.setProperty('display', 'none', 'important');
      m.style.setProperty('opacity', '0', 'important');
      m.style.setProperty('visibility', 'hidden', 'important');
    });
    document.body.style.overflow = '';
  };

  window.vfCloseQuoteModal = function() {
    window.vfCloseModal();
  };

  window.vfOpenQuoteModal = function(carName) {
    window.vfOpenModal('vfQuoteModal');
    if (carName) {
      var carImg = document.querySelector('.vf-modal-car-img');
      if (carImg) {
        var lower = carName.toLowerCase();
        var carSlug = 'vf8';
        if (lower.indexOf('vf 3') !== -1 || lower.indexOf('vf3') !== -1) carSlug = 'vf3';
        else if (lower.indexOf('wild') !== -1) carSlug = 'vfwild';
        else if (lower.indexOf('all new') !== -1 || lower.indexOf('allnew') !== -1) carSlug = 'vf8_allnew';
        else if (lower.indexOf('vf 5') !== -1 || lower.indexOf('vf5') !== -1) carSlug = 'vf5';
        else if (lower.indexOf('vf 6') !== -1 || lower.indexOf('vf6') !== -1) carSlug = 'vf6';
        else if (lower.indexOf('vf 7') !== -1 || lower.indexOf('vf7') !== -1) carSlug = 'vf7';
        else if (lower.indexOf('vf 9') !== -1 || lower.indexOf('vf9') !== -1) carSlug = 'vf9';
        else if (lower.indexOf('vf 2') !== -1 || lower.indexOf('vf2') !== -1) carSlug = 'vf2';
        else if (lower.indexOf('mpv 7') !== -1 || lower.indexOf('mpv7') !== -1) carSlug = 'mpv7';
        else if (lower.indexOf('ec van') !== -1 || lower.indexOf('ecvan') !== -1) carSlug = 'ecvan';
        else if (lower.indexOf('minio') !== -1) carSlug = 'minio';
        else if (lower.indexOf('herio') !== -1) carSlug = 'herio';
        else if (lower.indexOf('nerio') !== -1) carSlug = 'nerio';
        else if (lower.indexOf('limo') !== -1) carSlug = 'limo';
        
        var uploadBase = carImg.src.substring(0, carImg.src.lastIndexOf('/'));
        var ext = (['vf2', 'vf8_allnew', 'herio', 'limo'].indexOf(carSlug) !== -1) ? '.png' : '.webp';
        carImg.src = uploadBase + '/official_' + carSlug + ext;
      }

      var selects = document.querySelectorAll('#vfQuoteModal select, #modal-laythu select, select[name="car-model"], select[name="your-car"], .wpcf7-select');
      selects.forEach(function(select) {
        for (var i = 0; i < select.options.length; i++) {
          var val = select.options[i].value.toLowerCase();
          var txt = select.options[i].text.toLowerCase();
          var target = carName.toLowerCase();
          if (val.indexOf(target) !== -1 || txt.indexOf(target) !== -1 || target.indexOf(val) !== -1) {
            select.selectedIndex = i;
            break;
          }
        }
      });
    }
  };

  window.vfToggleSubmenu = function(btn) {
    if (!btn) return;
    var parentLi = btn.closest('li');
    if (parentLi) {
      parentLi.classList.toggle('active');
    }
  };

  // Close modal on escape key
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      window.vfCloseQuoteModal();
    }
  });

  // Auto Load Promo Popup Handler (15s auto-close if untouched)
  function initAutoPopup() {
    var m = getModalElement();
    if (!m) return;

    // Auto open popup when page loads
    window.vfOpenModal();

    function markInteracted() {
      if (!userInteracted) {
        userInteracted = true;
        if (autoCloseTimer) {
          clearTimeout(autoCloseTimer);
          autoCloseTimer = null;
        }
      }
    }

    var inputs = m.querySelectorAll('input, select, textarea, button, form');
    inputs.forEach(function(input) {
      input.addEventListener('focus', markInteracted);
      input.addEventListener('input', markInteracted);
      input.addEventListener('change', markInteracted);
      input.addEventListener('keydown', markInteracted);
      input.addEventListener('click', markInteracted);
    });

    // 15s auto close if untouched by user
    autoCloseTimer = setTimeout(function() {
      if (!userInteracted) {
        window.vfCloseModal();
      }
    }, 15000);
  }

  // Execute immediately upon script parse
  updatePromoBadges();

  if (document.readyState === 'complete' || document.readyState === 'interactive') {
    updatePromoBadges();
    setTimeout(initAutoPopup, 400);
  } else {
    document.addEventListener('DOMContentLoaded', function() {
      updatePromoBadges();
      setTimeout(initAutoPopup, 400);
    });
  }
  window.addEventListener('load', updatePromoBadges);

})();
