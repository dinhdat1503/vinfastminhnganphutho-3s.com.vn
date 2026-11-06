document.addEventListener('DOMContentLoaded', function () {

    /* ---------- 1) Đổi ảnh theo màu xe ---------- */
    var swatches = document.querySelectorAll('.vf-swatch');
    var previewImg = document.getElementById('vf-color-preview-img');
    var colorName = document.getElementById('vf-color-name');

    swatches.forEach(function (btn) {
        btn.addEventListener('click', function () {
            swatches.forEach(function (b) { b.classList.remove('is-active'); });
            btn.classList.add('is-active');
            if (previewImg && btn.dataset.img) previewImg.src = btn.dataset.img;
            if (colorName) colorName.textContent = btn.getAttribute('title') || '';
        });
    });

    /* ---------- 2) Tab thông số kỹ thuật ---------- */
    var tabBtns = document.querySelectorAll('.vf-tab-btn');
    var tabPanels = document.querySelectorAll('.vf-tab-panel');

    tabBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var idx = btn.dataset.tab;
            tabBtns.forEach(function (b) { b.classList.remove('is-active'); });
            tabPanels.forEach(function (p) { p.classList.remove('is-active'); });
            btn.classList.add('is-active');
            var panel = document.querySelector('.vf-tab-panel[data-tab-panel="' + idx + '"]');
            if (panel) panel.classList.add('is-active');
        });
    });

    /* ---------- 3) Công cụ so sánh chi phí xăng/dầu vs điện ---------- */
    var compareBtn = document.getElementById('vf-compare-btn');
    if (compareBtn) {
        compareBtn.addEventListener('click', function () {
            var formWrap = document.querySelector('.vf-compare-form');
            var evConsumption = parseFloat(formWrap.dataset.evConsumption) || 15; // kWh/100km
            var elecPrice = parseFloat(formWrap.dataset.elecPrice) || 3500;       // VNĐ/kWh

            var fuelPrice = parseFloat(document.getElementById('vf-fuel-price').value) || 0;
            var fuelConsumption = parseFloat(document.getElementById('vf-fuel-consumption').value) || 0;
            var distance = parseFloat(document.getElementById('vf-distance').value) || 0;

            var iceCost = (distance / 100) * fuelConsumption * fuelPrice;
            var evCost = (distance / 100) * evConsumption * elecPrice;
            var saving = iceCost - evCost;
            var savingYear = saving * 12;

            function formatVND(n) {
                return Math.round(n).toLocaleString('vi-VN') + ' VNĐ';
            }

            document.getElementById('vf-result-ice').textContent = formatVND(iceCost);
            document.getElementById('vf-result-ev').textContent = formatVND(evCost);
            document.getElementById('vf-result-saving').textContent = formatVND(saving);
            document.getElementById('vf-result-saving-year').textContent = formatVND(savingYear);

            document.getElementById('vf-compare-result').style.display = 'block';
        });
    }
});
