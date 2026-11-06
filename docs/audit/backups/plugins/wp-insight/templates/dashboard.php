<?php
/**
 * Dashboard template – Trang thống kê chính
 */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );
?>

<div class="wpi-wrap" id="wpi-dashboard">

    <div class="wpi-header">
        <div class="wpi-header-left">
            <div class="wpi-logo">📊</div>
            <div>
                <h1>WP Insight</h1>
                <p>Thống kê truy cập thời gian thực — không cần Google Analytics</p>
            </div>
        </div>

        <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;">
            <div class="wpi-range-bar">
                <button class="wpi-range-btn" data-range="today">Hôm nay</button>
                <button class="wpi-range-btn active" data-range="7d">7 ngày</button>
                <button class="wpi-range-btn" data-range="30d">30 ngày</button>
                <button class="wpi-range-btn" data-range="90d">3 tháng</button>
                <button class="wpi-range-btn" data-range="custom">📅 Tùy chỉnh</button>
                <div class="wpi-custom-range" id="wpi-custom-range">
                    <input type="date" id="wpi-from" />
                    <span style="color:#94a3b8;">→</span>
                    <input type="date" id="wpi-to" />
                    <button class="wpi-btn-apply">Áp dụng</button>
                </div>
            </div>
            <button class="wpi-btn wpi-btn-outline" id="wpi-export-btn">⬇️ Xuất CSV</button>
        </div>
    </div>

    <div class="wpi-kpi-row">
        <div class="wpi-kpi-card">
            <div class="wpi-kpi-icon purple">👁️</div>
            <div class="wpi-kpi-value" id="wpi-kpi-pageviews">—</div>
            <div class="wpi-kpi-label">Lượt xem trang</div>
        </div>
        <div class="wpi-kpi-card">
            <div class="wpi-kpi-icon green">👤</div>
            <div class="wpi-kpi-value" id="wpi-kpi-visitors">—</div>
            <div class="wpi-kpi-label">Unique Visitors</div>
        </div>
        <div class="wpi-kpi-card">
            <div class="wpi-kpi-icon red">📉</div>
            <div class="wpi-kpi-value" id="wpi-kpi-bounce">—</div>
            <div class="wpi-kpi-label">Bounce Rate</div>
        </div>
        <div class="wpi-kpi-card">
            <div class="wpi-kpi-icon blue">📄</div>
            <div class="wpi-kpi-value" id="wpi-kpi-pps">—</div>
            <div class="wpi-kpi-label">Trang / Session</div>
        </div>
        <div class="wpi-kpi-card">
            <div class="wpi-kpi-icon teal">🌍</div>
            <div class="wpi-kpi-value" id="wpi-kpi-country" style="font-size:18px;">—</div>
            <div class="wpi-kpi-label">Top Quốc gia</div>
        </div>
        <div class="wpi-kpi-card">
            <div class="wpi-kpi-icon yellow">⚡</div>
            <div class="wpi-kpi-value" id="wpi-kpi-realtime">—</div>
            <div class="wpi-kpi-label">
                <span class="wpi-realtime-badge"><span class="wpi-realtime-dot"></span>10 phút qua</span>
            </div>
        </div>
    </div>

    <div class="wpi-card" style="margin-bottom:16px;">
        <div class="wpi-card-title">📈 Pageviews & Visitors theo ngày</div>
        <div style="height:260px;position:relative;"><canvas id="wpi-chart-daily"></canvas></div>
    </div>

    <div class="wpi-grid-2">
        <div class="wpi-card">
            <div class="wpi-card-title">🔥 Top trang phổ biến</div>
            <div id="wpi-top-pages"><div class="wpi-spinner"></div></div>
        </div>
        <div class="wpi-card">
            <div class="wpi-card-title">📱 Thiết bị</div>
            <div style="height:220px;position:relative;"><canvas id="wpi-chart-device"></canvas></div>
        </div>
    </div>

    <div class="wpi-grid-3">
        <div class="wpi-card">
            <div class="wpi-card-title">🔗 Nguồn truy cập</div>
            <div id="wpi-top-referrers"><div class="wpi-spinner"></div></div>
        </div>
        <div class="wpi-card">
            <div class="wpi-card-title">🌍 Top Quốc gia</div>
            <div id="wpi-top-countries"><div class="wpi-spinner"></div></div>
        </div>
        <div class="wpi-card">
            <div class="wpi-card-title">🌐 Trình duyệt</div>
            <div style="height:220px;position:relative;"><canvas id="wpi-chart-browser"></canvas></div>
        </div>
    </div>

    <div class="wpi-card">
        <div class="wpi-card-title" style="justify-content:space-between;">
            <span>⚡ Lượt truy cập gần đây <small style="font-size:11px;color:#94a3b8;font-weight:400;">(tự động làm mới mỗi 60 giây)</small></span>
        </div>
        <div class="wpi-table-wrap">
            <table class="wpi-table">
                <thead>
                    <tr>
                        <th>Trang</th><th>Thiết bị</th><th>Trình duyệt</th>
                        <th>Quốc gia</th><th>Nguồn</th><th>Thời gian</th>
                    </tr>
                </thead>
                <tbody id="wpi-recent-body">
                    <tr><td colspan="6"><div class="wpi-spinner"></div></td></tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
