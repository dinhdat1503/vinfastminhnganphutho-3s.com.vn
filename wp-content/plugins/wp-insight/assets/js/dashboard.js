/**
 * WP Insight – Dashboard JavaScript
 */
(function ($) {
    'use strict';

    if (typeof wpInsightConfig === 'undefined') return;

    let currentRange = '7d';
    let currentFrom  = '';
    let currentTo    = '';
    let charts       = {};

    $(document).ready(function () {
        if ($('#wpi-dashboard').length) {
            initDashboard();
        }
    });

    function initDashboard() {
        $(document).on('click', '.wpi-range-btn', function () {
            const range = $(this).data('range');
            $('.wpi-range-btn').removeClass('active');
            $(this).addClass('active');
            if (range === 'custom') { $('.wpi-custom-range').addClass('show'); return; }
            $('.wpi-custom-range').removeClass('show');
            currentRange = range; currentFrom = ''; currentTo = '';
            loadAll();
        });

        $(document).on('click', '.wpi-btn-apply', function () {
            currentFrom = $('#wpi-from').val(); currentTo = $('#wpi-to').val();
            if (!currentFrom || !currentTo) return;
            currentRange = 'custom'; loadAll();
        });

        $(document).on('click', '#wpi-export-btn', function () {
            window.location.href = wpInsightConfig.ajaxUrl
                + '?action=wpinsight_export&nonce=' + wpInsightConfig.nonce
                + '&range=' + currentRange
                + (currentFrom ? '&from=' + currentFrom : '')
                + (currentTo   ? '&to='   + currentTo   : '');
        });

        setInterval(loadRecent, 60000);
        loadAll();
    }

    function loadAll() {
        setLoading(true);
        $.ajax({
            url: wpInsightConfig.ajaxUrl, method: 'POST',
            data: { action: 'wpinsight_get_data', nonce: wpInsightConfig.nonce, range: currentRange, from: currentFrom, to: currentTo, section: 'all' },
            success: function (res) {
                if (!res.success) return;
                const d = res.data;
                renderKPI(d.kpi); renderDailyChart(d.daily); renderTopPages(d.pages);
                renderDeviceChart(d.device); renderReferrers(d.referrers);
                renderCountries(d.countries); renderBrowserChart(d.browsers); renderRecentTable(d.recent);
                setLoading(false);
            },
            error: function () { setLoading(false); }
        });
    }

    function loadRecent() {
        $.ajax({
            url: wpInsightConfig.ajaxUrl, method: 'POST',
            data: { action: 'wpinsight_get_data', nonce: wpInsightConfig.nonce, range: currentRange, section: 'recent' },
            success: function (res) { if (res.success) renderRecentTable(res.data.recent); }
        });
    }

    function setLoading(on) {
        if (on) $('#wpi-dashboard').addClass('wpi-loading');
        else $('#wpi-dashboard').removeClass('wpi-loading');
    }

    function renderKPI(kpi) {
        if (!kpi) return;
        animateNumber('#wpi-kpi-pageviews', kpi.pageviews);
        animateNumber('#wpi-kpi-visitors',  kpi.unique_visitors);
        animateNumber('#wpi-kpi-bounce',    kpi.bounce_rate, '%');
        animateNumber('#wpi-kpi-pps',       kpi.pages_per_session);
        animateNumber('#wpi-kpi-realtime',  kpi.realtime);
        if (kpi.top_country) {
            $('#wpi-kpi-country').html(flag(kpi.top_country.country) + ' ' + esc(kpi.top_country.country_name || kpi.top_country.country));
        } else { $('#wpi-kpi-country').text('—'); }
    }

    function animateNumber(selector, target, suffix) {
        suffix = suffix || '';
        const el = $(selector); if (!el.length) return;
        const duration = 600; const startTime = performance.now();
        const isFloat = String(target).includes('.');
        function update(now) {
            const progress = Math.min((now - startTime) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const current = target * eased;
            el.text((isFloat ? current.toFixed(1) : Math.round(current).toLocaleString()) + suffix);
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    function renderDailyChart(daily) {
        if (!daily) return;
        const ctx = document.getElementById('wpi-chart-daily'); if (!ctx) return;
        if (charts.daily) charts.daily.destroy();
        const labels = daily.labels.map(function(d) { return new Date(d).toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' }); });
        charts.daily = new Chart(ctx, {
            type: 'line',
            data: { labels: labels, datasets: [
                { label: 'Pageviews', data: daily.views, borderColor: '#6366f1', backgroundColor: 'rgba(99,102,241,0.08)', fill: true, tension: 0.4, pointBackgroundColor: '#6366f1', pointRadius: 4, pointHoverRadius: 6, borderWidth: 2 },
                { label: 'Visitors',  data: daily.uniques, borderColor: '#10b981', backgroundColor: 'rgba(16,185,129,0.06)', fill: true, tension: 0.4, pointBackgroundColor: '#10b981', pointRadius: 4, pointHoverRadius: 6, borderWidth: 2 }
            ]},
            options: chartDefaults({ plugins: { legend: { display: true, position: 'top', align: 'end' }, tooltip: { mode: 'index', intersect: false } },
                scales: { x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } }, y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, color: '#94a3b8' } } } })
        });
    }

    function renderTopPages(pages) {
        if (!pages) return;
        const el = $('#wpi-top-pages'); if (!el.length) return;
        if (!pages.length) { el.html('<div class="wpi-empty"><div class="wpi-empty-icon">📄</div>Chưa có dữ liệu</div>'); return; }
        const max = Math.max(...pages.map(p => +p.pageviews));
        let html = '';
        pages.slice(0, 10).forEach(function (p) {
            const pct = max > 0 ? Math.round((p.pageviews / max) * 100) : 0;
            html += `<div class="wpi-bar-row"><a href="${esc(p.url)}" target="_blank" class="wpi-bar-label" title="${esc(p.page_title)}">${esc(p.page_title || p.url)}</a><div class="wpi-bar-track"><div class="wpi-bar-fill" style="width:${pct}%"></div></div><span class="wpi-bar-count">${Number(p.pageviews).toLocaleString()}</span></div>`;
        });
        el.html(html);
    }

    function renderDeviceChart(device) {
        if (!device) return;
        const ctx = document.getElementById('wpi-chart-device'); if (!ctx) return;
        if (charts.device) charts.device.destroy();
        charts.device = new Chart(ctx, { type: 'doughnut',
            data: { labels: device.labels, datasets: [{ data: device.data, backgroundColor: ['#6366f1','#10b981','#f59e0b','#ef4444'], hoverOffset: 6, borderWidth: 2, borderColor: '#fff' }] },
            options: chartDefaults({ cutout: '65%', plugins: { legend: { position: 'bottom', labels: { padding: 12, font: { size: 12 } } } } })
        });
    }

    function renderBrowserChart(browsers) {
        if (!browsers) return;
        const ctx = document.getElementById('wpi-chart-browser'); if (!ctx) return;
        if (charts.browser) charts.browser.destroy();
        charts.browser = new Chart(ctx, { type: 'doughnut',
            data: { labels: browsers.labels, datasets: [{ data: browsers.data, backgroundColor: ['#3b82f6','#f97316','#8b5cf6','#06b6d4','#ec4899','#84cc16','#64748b','#f59e0b'], hoverOffset: 6, borderWidth: 2, borderColor: '#fff' }] },
            options: chartDefaults({ cutout: '65%', plugins: { legend: { position: 'bottom', labels: { padding: 10, font: { size: 11 } } } } })
        });
    }

    function renderReferrers(referrers) {
        if (!referrers) return;
        const el = $('#wpi-top-referrers'); if (!el.length) return;
        if (!referrers.length) { el.html('<div class="wpi-empty"><div class="wpi-empty-icon">🔗</div>Chưa có dữ liệu</div>'); return; }
        const max = Math.max(...referrers.map(r => +r.cnt));
        let html = '';
        referrers.forEach(function (r) {
            const pct = max > 0 ? Math.round((r.cnt / max) * 100) : 0;
            html += `<div class="wpi-bar-row"><span class="wpi-bar-label">${refIcon(r.ref_source)} ${esc(r.ref_source)}</span><div class="wpi-bar-track"><div class="wpi-bar-fill" style="width:${pct}%;background:linear-gradient(90deg,#10b981,#34d399)"></div></div><span class="wpi-bar-count">${Number(r.cnt).toLocaleString()}</span></div>`;
        });
        el.html(html);
    }

    function renderCountries(countries) {
        if (!countries) return;
        const el = $('#wpi-top-countries'); if (!el.length) return;
        if (!countries.length) { el.html('<div class="wpi-empty"><div class="wpi-empty-icon">🌍</div>Chưa có dữ liệu</div>'); return; }
        const max = Math.max(...countries.map(c => +c.cnt));
        let html = '';
        countries.forEach(function (c) {
            const pct = max > 0 ? Math.round((c.cnt / max) * 100) : 0;
            html += `<div class="wpi-bar-row"><span class="wpi-bar-label">${flag(c.country)} ${esc(c.country_name || c.country)}</span><div class="wpi-bar-track"><div class="wpi-bar-fill" style="width:${pct}%;background:linear-gradient(90deg,#f59e0b,#fbbf24)"></div></div><span class="wpi-bar-count">${Number(c.cnt).toLocaleString()}</span></div>`;
        });
        el.html(html);
    }

    function renderRecentTable(recent) {
        if (!recent) return;
        const el = $('#wpi-recent-body'); if (!el.length) return;
        if (!recent.length) { el.html('<tr><td colspan="6" class="wpi-empty"><div class="wpi-empty-icon">⚡</div>Chưa có lượt truy cập nào</td></tr>'); return; }
        let html = '';
        recent.forEach(function (r) {
            const deviceBadge = `<span class="wpi-badge wpi-badge-${r.device}">${esc(r.device)}</span>`;
            html += `<tr><td><a href="${esc(r.url)}" target="_blank" class="wpi-page-title" title="${esc(r.page_title)}">${esc(r.page_title || r.url)}</a></td><td>${deviceBadge}</td><td>${esc(r.browser)}</td><td>${r.country !== '??' ? flag(r.country) + ' ' + esc(r.country_name || r.country) : '—'}</td><td>${esc(r.ref_source)}</td><td style="color:#94a3b8;font-size:12px;">${formatTime(r.hit_time)}</td></tr>`;
        });
        el.html(html);
    }

    function chartDefaults(override) {
        return Object.assign({ responsive: true, maintainAspectRatio: false, animation: { duration: 500 }, plugins: { legend: { display: false } } }, override);
    }
    function flag(code) {
        if (!code || code === '??' || code === 'LO') return '🌐';
        return code.toUpperCase().replace(/./g, ch => String.fromCodePoint(0x1F1E6 - 65 + ch.charCodeAt(0)));
    }
    function refIcon(source) {
        const icons = { 'Google':'🔍','Bing':'🔍','DuckDuckGo':'🔍','Yahoo':'🔍','CocCoc':'🔍','Facebook':'📘','Instagram':'📷','TikTok':'🎵','YouTube':'▶️','Twitter':'🐦','LinkedIn':'💼','Pinterest':'📌','Reddit':'🤖','Zalo':'💬','Direct':'🎯' };
        return icons[source] || '🔗';
    }
    function esc(str) {
        if (!str) return '';
        return String(str).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
    function formatTime(datetime) {
        const d = new Date(datetime + ' UTC'); const now = new Date(); const diff = Math.floor((now - d) / 1000);
        if (diff < 60) return diff + 'g trước';
        if (diff < 3600) return Math.floor(diff / 60) + 'p trước';
        if (diff < 86400) return Math.floor(diff / 3600) + 'h trước';
        return d.toLocaleDateString('vi-VN');
    }

})(jQuery);
