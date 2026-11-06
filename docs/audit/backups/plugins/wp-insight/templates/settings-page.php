<?php
/**
 * Settings page template
 */
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! current_user_can( 'manage_options' ) ) wp_die( 'Unauthorized' );

$saved          = isset( $_GET['saved'] ) && $_GET['saved'] === '1';
$exclude_ips    = get_option( 'wpinsight_exclude_ips', '' );
$enable_geo     = get_option( 'wpinsight_enable_geo', '1' );
$enable_bot     = get_option( 'wpinsight_enable_bot_filter', '1' );
$data_retention = (int) get_option( 'wpinsight_data_retention', 365 );
$sampling       = (int) get_option( 'wpinsight_sampling', 100 );
$exclude_roles  = (array) get_option( 'wpinsight_exclude_roles', [ 'administrator' ] );
$all_roles      = wp_roles()->get_names();

global $wpdb;
$hits_count = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}wpinsight_hits" );
$db_size    = $wpdb->get_var( $wpdb->prepare(
    "SELECT ROUND(SUM(data_length + index_length) / 1024, 1) FROM information_schema.tables WHERE table_schema = %s AND table_name IN (%s, %s)",
    DB_NAME, $wpdb->prefix . 'wpinsight_hits', $wpdb->prefix . 'wpinsight_sessions'
) );
?>

<div class="wpi-wrap wpi-settings-wrap">

    <div class="wpi-header">
        <div class="wpi-header-left">
            <div class="wpi-logo">⚙️</div>
            <div><h1>Cài đặt WP Insight</h1><p>Tuỳ chỉnh cách thu thập và lưu trữ dữ liệu thống kê</p></div>
        </div>
        <a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-insight' ) ); ?>" class="wpi-btn wpi-btn-outline">← Về Dashboard</a>
    </div>

    <?php if ( $saved ) : ?>
        <div class="wpi-notice-success">✅ Cài đặt đã được lưu thành công!</div>
    <?php endif; ?>

    <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'wpinsight_save_settings' ); ?>
        <input type="hidden" name="action" value="wpinsight_save_settings" />

        <div class="wpi-settings-section">
            <h2>🎯 Theo dõi & lọc</h2>
            <div class="wpi-field">
                <label>Loại trừ theo Role</label>
                <div class="wpi-checkbox-group">
                    <?php foreach ( $all_roles as $role_slug => $role_name ) : ?>
                        <label>
                            <input type="checkbox" name="wpinsight_exclude_roles[]" value="<?php echo esc_attr( $role_slug ); ?>" <?php checked( in_array( $role_slug, $exclude_roles, true ) ); ?> />
                            <?php echo esc_html( $role_name ); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
                <p class="wpi-hint">Các role được chọn sẽ không bị theo dõi khi đăng nhập.</p>
            </div>

            <div class="wpi-field">
                <label for="wpinsight_exclude_ips">Loại trừ IP (mỗi IP 1 dòng)</label>
                <textarea id="wpinsight_exclude_ips" name="wpinsight_exclude_ips" placeholder="192.168.1.1&#10;1.2.3.4"><?php echo esc_textarea( $exclude_ips ); ?></textarea>
                <p class="wpi-hint">Nhập địa chỉ IP cần loại trừ (ví dụ: IP văn phòng, IP của bạn).</p>
            </div>

            <div class="wpi-field">
                <label class="wpi-toggle">
                    <input type="checkbox" name="wpinsight_enable_bot_filter" value="1" <?php checked( $enable_bot, '1' ); ?> />
                    Bật lọc bot & crawler tự động
                </label>
                <p class="wpi-hint">Tự động phát hiện và bỏ qua Googlebot, Bingbot và các crawler phổ biến.</p>
            </div>

            <div class="wpi-field">
                <label for="wpinsight_sampling">Sampling Rate (%)</label>
                <input type="number" id="wpinsight_sampling" name="wpinsight_sampling" value="<?php echo esc_attr( $sampling ); ?>" min="1" max="100" step="1" style="max-width:120px;" />
                <p class="wpi-hint">100% = theo dõi tất cả. Giảm xuống nếu site có lượng traffic rất lớn.</p>
            </div>
        </div>

        <div class="wpi-settings-section">
            <h2>🌍 Geolocation</h2>
            <div class="wpi-field">
                <label class="wpi-toggle">
                    <input type="checkbox" name="wpinsight_enable_geo" value="1" <?php checked( $enable_geo, '1' ); ?> />
                    Bật phát hiện quốc gia (ip-api.com)
                </label>
                <p class="wpi-hint">Sử dụng <a href="https://ip-api.com" target="_blank">ip-api.com</a> (miễn phí). Kết quả được cache 24h. IP thô <strong>không bao giờ được lưu</strong>.</p>
            </div>
        </div>

        <div class="wpi-settings-section">
            <h2>🗄️ Lưu trữ dữ liệu</h2>
            <div class="wpi-field">
                <label for="wpinsight_data_retention">Tự động xóa data cũ hơn (ngày)</label>
                <input type="number" id="wpinsight_data_retention" name="wpinsight_data_retention" value="<?php echo esc_attr( $data_retention ); ?>" min="30" max="3650" step="1" style="max-width:140px;" />
                <p class="wpi-hint">Dữ liệu cũ hơn số ngày này sẽ bị xóa tự động mỗi ngày. Mặc định: 365 ngày.</p>
            </div>
            <div style="background:var(--wpi-bg);border-radius:8px;padding:14px 16px;margin-top:10px;">
                <div style="font-size:13px;font-weight:600;margin-bottom:8px;">📊 Thống kê Database</div>
                <div style="display:flex;gap:30px;font-size:13px;color:var(--wpi-muted);">
                    <span>Tổng hits: <strong style="color:var(--wpi-text);"><?php echo number_format( $hits_count ); ?></strong></span>
                    <span>Dung lượng: <strong style="color:var(--wpi-text);"><?php echo esc_html( $db_size ?? '—' ); ?> KB</strong></span>
                </div>
            </div>
        </div>

        <div class="wpi-btn-row">
            <?php submit_button( '💾 Lưu cài đặt', 'primary wpi-btn wpi-btn-primary', 'submit', false ); ?>
        </div>
    </form>

    <div class="wpi-settings-section" style="margin-top:30px;border-color:#fca5a5;">
        <h2>🗑️ Vùng nguy hiểm</h2>
        <p style="font-size:13px;color:var(--wpi-muted);margin-bottom:16px;">Xóa toàn bộ dữ liệu thống kê. Thao tác này <strong>không thể hoàn tác</strong>.</p>
        <button class="wpi-btn wpi-btn-danger" id="wpi-purge-btn">🗑️ Xóa toàn bộ dữ liệu</button>
        <span id="wpi-purge-result" style="display:none;margin-left:12px;font-size:13px;"></span>
    </div>
</div>

<script>
document.getElementById('wpi-purge-btn').addEventListener('click', function () {
    if (!confirm('⚠️ Xóa toàn bộ dữ liệu thống kê? Thao tác này không thể hoàn tác!')) return;
    const btn = this; const result = document.getElementById('wpi-purge-result');
    btn.disabled = true; btn.textContent = '⏳ Đang xóa...';
    fetch(ajaxurl, { method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: 'action=wpinsight_purge&nonce=<?php echo esc_js( wp_create_nonce( 'wpinsight_nonce' ) ); ?>' })
    .then(r => r.json())
    .then(data => {
        result.style.display = 'inline';
        result.style.color = data.success ? '#059669' : '#dc2626';
        result.textContent = (data.success ? '✅ ' : '❌ ') + (data.data || 'Không xác định');
        btn.disabled = false; btn.textContent = '🗑️ Xóa toàn bộ dữ liệu';
    });
});
</script>
