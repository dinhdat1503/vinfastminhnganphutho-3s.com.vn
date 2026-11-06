<?php
/**
 * Classic Editor & Meta Box Support cho AI Writer
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class AI_Writer_Metabox {

    public function __construct() {
        add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_metabox_assets' ] );
    }

    public function add_meta_box() {
        $screens = [ 'post', 'page', 'car_model' ];
        foreach ( $screens as $screen ) {
            add_meta_box(
                'ai_writer_metabox',
                '✨ AI Writer — Trợ Lý Viết Bài',
                [ $this, 'render_metabox' ],
                $screen,
                'side',
                'high'
            );
        }
    }

    public function enqueue_metabox_assets( $hook ) {
        if ( ! in_array( $hook, [ 'post.php', 'post-new.php' ], true ) ) {
            return;
        }

        wp_enqueue_style( 'ai-writer-admin', AI_WRITER_PLUGIN_URL . 'assets/css/admin.css', [], AI_WRITER_VERSION );
    }

    public function render_metabox( $post ) {
        $api_key = get_option( 'ai_writer_gemini_api_key', '' );
        if ( empty( $api_key ) ) {
            echo '<div style="padding:10px; text-align:center;">';
            echo '<p style="color:#ef4444; font-weight:600; margin-bottom:8px;">⚠️ Chưa cấu hình Gemini API Key</p>';
            echo '<a href="' . esc_url( admin_url( 'admin.php?page=ai-writer-settings' ) ) . '" class="button button-primary" style="background:#6366f1; border-color:#6366f1;">⚙️ Cấu hình API Key</a>';
            echo '</div>';
            return;
        }

        $rest_url = esc_url_raw( rest_url( 'ai-writer/v1/' ) );
        $nonce    = wp_create_nonce( 'wp_rest' );
        ?>
        <div class="aiw-metabox-wrap" style="font-size:13px;">
            <div style="display:flex; border-bottom:2px solid #e5e7eb; margin-bottom:12px;" id="aiw-mb-tabs">
                <button type="button" class="aiw-mb-tab active" data-tab="titles" style="flex:1; padding:6px 2px; border:none; background:none; font-weight:600; color:#6366f1; cursor:pointer; font-size:11px;">📌 Tiêu đề</button>
                <button type="button" class="aiw-mb-tab" data-tab="meta" style="flex:1; padding:6px 2px; border:none; background:none; font-weight:600; color:#64748b; cursor:pointer; font-size:11px;">📝 Meta</button>
                <button type="button" class="aiw-mb-tab" data-tab="keywords" style="flex:1; padding:6px 2px; border:none; background:none; font-weight:600; color:#64748b; cursor:pointer; font-size:11px;">🔑 Từ khóa</button>
                <button type="button" class="aiw-mb-tab" data-tab="improve" style="flex:1; padding:6px 2px; border:none; background:none; font-weight:600; color:#64748b; cursor:pointer; font-size:11px;">✨ Cải thiện</button>
            </div>

            <!-- Tab 1: Tiêu đề -->
            <div class="aiw-mb-content" id="aiw-mb-tab-titles">
                <p style="margin:0 0 6px; font-weight:600;">Chủ đề bài viết:</p>
                <input type="text" id="aiw-mb-topic" placeholder="Ví dụ: Ưu đãi xe điện VinFast" style="width:100%; margin-bottom:8px; padding:6px 8px; border:1px solid #cbd5e1; border-radius:4px;">
                <button type="button" id="aiw-mb-btn-titles" class="button button-primary" style="width:100%; background:#6366f1; border-color:#6366f1; font-weight:600;">✨ Gợi ý tiêu đề SEO</button>
                <div id="aiw-mb-res-titles" style="margin-top:10px;"></div>
            </div>

            <!-- Tab 2: Meta -->
            <div class="aiw-mb-content" id="aiw-mb-tab-meta" style="display:none;">
                <p style="margin:0 0 8px; color:#64748b; font-size:12px;">Tạo Meta Description (150-160 ký tự) từ nội dung bài viết.</p>
                <button type="button" id="aiw-mb-btn-meta" class="button button-primary" style="width:100%; background:#6366f1; border-color:#6366f1; font-weight:600;">📝 Tạo Meta Description</button>
                <div id="aiw-mb-res-meta" style="margin-top:10px;"></div>
            </div>

            <!-- Tab 3: Từ khóa -->
            <div class="aiw-mb-content" id="aiw-mb-tab-keywords" style="display:none;">
                <p style="margin:0 0 6px; font-weight:600;">Từ khóa gốc (tùy chọn):</p>
                <input type="text" id="aiw-mb-seed-kw" placeholder="Để trống để phân tích bài viết..." style="width:100%; margin-bottom:8px; padding:6px 8px; border:1px solid #cbd5e1; border-radius:4px;">
                <button type="button" id="aiw-mb-btn-keywords" class="button button-primary" style="width:100%; background:#6366f1; border-color:#6366f1; font-weight:600;">🔑 Gợi ý từ khóa SEO</button>
                <div id="aiw-mb-res-keywords" style="margin-top:10px; display:flex; flex-wrap:wrap; gap:4px;"></div>
            </div>

            <!-- Tab 4: Cải thiện -->
            <div class="aiw-mb-content" id="aiw-mb-tab-improve" style="display:none;">
                <p style="margin:0 0 6px; font-weight:600;">Đoạn văn cần cải thiện:</p>
                <textarea id="aiw-mb-imp-text" rows="3" style="width:100%; margin-bottom:8px; padding:6px; border:1px solid #cbd5e1; border-radius:4px;" placeholder="Dán đoạn văn..."></textarea>
                <select id="aiw-mb-imp-style" style="width:100%; margin-bottom:8px;">
                    <option value="professional">💼 Chuyên nghiệp</option>
                    <option value="friendly">😊 Thân thiện</option>
                    <option value="concise">✂️ Ngắn gọn</option>
                    <option value="engaging">🔥 Hấp dẫn</option>
                </select>
                <button type="button" id="aiw-mb-btn-improve" class="button button-primary" style="width:100%; background:#6366f1; border-color:#6366f1; font-weight:600;">✨ Cải thiện đoạn văn</button>
                <div id="aiw-mb-res-improve" style="margin-top:10px;"></div>
            </div>
        </div>

        <script>
        (function() {
            const restUrl = '<?php echo $rest_url; ?>';
            const nonce = '<?php echo $nonce; ?>';

            // Tab switching
            document.querySelectorAll('#aiw-mb-tabs .aiw-mb-tab').forEach(btn => {
                btn.addEventListener('click', function() {
                    document.querySelectorAll('#aiw-mb-tabs .aiw-mb-tab').forEach(b => {
                        b.style.color = '#64748b';
                        b.classList.remove('active');
                    });
                    this.style.color = '#6366f1';
                    this.classList.add('active');
                    const tab = this.getAttribute('data-tab');
                    document.querySelectorAll('.aiw-mb-content').forEach(c => c.style.display = 'none');
                    document.getElementById('aiw-mb-tab-' + tab).style.display = 'block';
                });
            });

            async function postAI(endpoint, body) {
                const res = await fetch(restUrl + endpoint, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-WP-Nonce': nonce },
                    body: JSON.stringify(body)
                });
                return await res.json();
            }

            // Get post content helper
            function getEditorContent() {
                if (typeof tinymce !== 'undefined' && tinymce.get('content')) {
                    return tinymce.get('content').getContent({ format: 'text' });
                }
                const textarea = document.getElementById('content');
                return textarea ? textarea.value : '';
            }

            // Set post title helper
            window.aiwApplyTitle = function(title) {
                const titleInput = document.getElementById('title');
                if (titleInput) {
                    titleInput.value = title;
                    titleInput.focus();
                }
                if (typeof wp !== 'undefined' && wp.data && wp.data.dispatch('core/editor')) {
                    wp.data.dispatch('core/editor').editPost({ title: title });
                }
                alert('✍️ Đã cập nhật tiêu đề thành: "' + title + '"');
            };

            // 1. Titles
            document.getElementById('aiw-mb-btn-titles').addEventListener('click', async function() {
                const topic = document.getElementById('aiw-mb-topic').value || document.getElementById('title')?.value || '';
                if (!topic) { alert('Vui lòng nhập chủ đề bài viết'); return; }
                const resDiv = document.getElementById('aiw-mb-res-titles');
                resDiv.innerHTML = '<p style="color:#6366f1;">⏳ Đang gợi ý tiêu đề...</p>';
                try {
                    const data = await postAI('titles', { topic: topic });
                    if (data.success) {
                        const lines = data.data.split('\n').filter(l => l.trim());
                        let html = '';
                        lines.forEach(l => {
                            const clean = l.replace(/^\d+\.\s*[-–]?\s*/, '').trim();
                            html += `<div style="background:#f8fafc; border:1px solid #e2e8f0; padding:6px 8px; border-radius:4px; margin-bottom:6px;">
                                <div style="font-weight:500; margin-bottom:4px; font-size:12px;">${clean}</div>
                                <button type="button" onclick="aiwApplyTitle('${clean.replace(/'/g, "\\'")}')" class="button button-small" style="font-size:10px;">✍️ Dùng tiêu đề này</button>
                            </div>`;
                        });
                        resDiv.innerHTML = html;
                    } else {
                        resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${data.message}</p>`;
                    }
                } catch(e) {
                    resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${e.message}</p>`;
                }
            });

            // 2. Meta
            document.getElementById('aiw-mb-btn-meta').addEventListener('click', async function() {
                const content = getEditorContent();
                if (!content) { alert('Nội dung bài viết đang trống'); return; }
                const resDiv = document.getElementById('aiw-mb-res-meta');
                resDiv.innerHTML = '<p style="color:#6366f1;">⏳ Đang tạo meta description...</p>';
                try {
                    const data = await postAI('meta', { content: content });
                    if (data.success) {
                        resDiv.innerHTML = `<div style="background:#f8fafc; border:1px solid #e2e8f0; padding:8px; border-radius:4px;">
                            <p style="margin:0 0 6px; font-size:12px;">${data.data}</p>
                            <span style="font-size:11px; font-weight:600; color:#10b981;">${data.data.length}/160 ký tự</span>
                        </div>`;
                    } else {
                        resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${data.message}</p>`;
                    }
                } catch(e) {
                    resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${e.message}</p>`;
                }
            });

            // 3. Keywords
            document.getElementById('aiw-mb-btn-keywords').addEventListener('click', async function() {
                const seed = document.getElementById('aiw-mb-seed-kw').value;
                const content = seed ? seed : getEditorContent();
                if (!content) { alert('Vui lòng nhập từ khóa hoặc nội dung bài viết'); return; }
                const resDiv = document.getElementById('aiw-mb-res-keywords');
                resDiv.innerHTML = '<p style="color:#6366f1;">⏳ Đang gợi ý từ khóa...</p>';
                try {
                    const data = await postAI('keywords', { content: content, is_topic: !!seed });
                    if (data.success) {
                        const lines = data.data.split('\n').filter(l => l.trim());
                        let html = '';
                        lines.forEach(l => {
                            const kw = l.replace(/^\d+\.\s*[-–]?\s*/, '').trim();
                            html += `<span style="background:#e0e7ff; color:#3730a3; padding:2px 6px; border-radius:12px; font-size:11px; cursor:pointer;" onclick="navigator.clipboard.writeText('${kw}'); alert('📋 Đã copy từ khóa: ${kw}');" title="Click để copy">${kw}</span>`;
                        });
                        resDiv.innerHTML = html;
                    } else {
                        resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${data.message}</p>`;
                    }
                } catch(e) {
                    resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${e.message}</p>`;
                }
            });

            // 4. Improve
            document.getElementById('aiw-mb-btn-improve').addEventListener('click', async function() {
                const text = document.getElementById('aiw-mb-imp-text').value;
                const style = document.getElementById('aiw-mb-imp-style').value;
                if (!text) { alert('Vui lòng nhập đoạn văn'); return; }
                const resDiv = document.getElementById('aiw-mb-res-improve');
                resDiv.innerHTML = '<p style="color:#6366f1;">⏳ Đang cải thiện đoạn văn...</p>';
                try {
                    const data = await postAI('improve', { text: text, style: style });
                    if (data.success) {
                        resDiv.innerHTML = `<div style="background:#f8fafc; border:1px solid #e2e8f0; padding:8px; border-radius:4px;">
                            <p style="margin:0 0 6px; font-size:12px;">${data.data}</p>
                            <button type="button" onclick="navigator.clipboard.writeText('${data.data.replace(/'/g, "\\'")}'); alert('📋 Đã copy kết quả!');" class="button button-small">📋 Copy kết quả</button>
                        </div>`;
                    } else {
                        resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${data.message}</p>`;
                    }
                } catch(e) {
                    resDiv.innerHTML = `<p style="color:#ef4444;">❌ ${e.message}</p>`;
                }
            });
        })();
        </script>
        <?php
    }
}
