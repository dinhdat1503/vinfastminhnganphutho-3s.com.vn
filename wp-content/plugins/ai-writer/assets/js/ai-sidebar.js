( function ( wp ) {
    const { registerPlugin }    = wp.plugins;
    const { PluginSidebarMoreMenuItem, PluginSidebar } = wp.editPost;
    const { PanelBody, Button, TextareaControl, TextControl, SelectControl, Spinner, Notice, TabPanel } = wp.components;
    const { useState, useEffect } = wp.element;
    const { useSelect }          = wp.data;
    const apiFetch               = wp.apiFetch;
    const { __ }                 = wp.i18n;

    const config = window.aiWriterConfig || {};

    // ─── Helper: POST to REST ─────────────────────────────────────────────────
    async function callAI( endpoint, body ) {
        return apiFetch( {
            url: config.restUrl + endpoint,
            method: 'POST',
            headers: { 'X-WP-Nonce': config.nonce },
            data: body,
        } );
    }

    // ─── Tab: Tiêu đề SEO ─────────────────────────────────────────────────────
    function TitlesTab() {
        const [ topic,   setTopic   ] = useState( '' );
        const [ results, setResults ] = useState( [] );
        const [ loading, setLoading ] = useState( false );
        const [ error,   setError   ] = useState( '' );

        async function handleGenerate() {
            if ( ! topic.trim() ) return;
            setLoading( true ); setError( '' ); setResults( [] );
            try {
                const res = await callAI( 'titles', { topic } );
                if ( res.success ) {
                    const lines = res.data.split( '\n' ).filter( l => l.trim() );
                    setResults( lines );
                } else { setError( res.message ); }
            } catch ( e ) { setError( e.message || 'Lỗi kết nối' ); }
            setLoading( false );
        }

        function copyTitle( t ) {
            const cleanT = t.replace( /^\d+\.\s*[-–]?\s*/, '' ).trim();
            navigator.clipboard.writeText( cleanT );
            wp.data.dispatch( 'core/notices' ).createSuccessNotice( 
                `📋 Đã copy: "${cleanT}"`, 
                { type: 'snackbar', id: 'aiw-copy-notice' } 
            );
        }

        function applyTitle( t ) {
            const cleanT = t.replace( /^\d+\.\s*[-–]?\s*/, '' ).trim();
            wp.data.dispatch( 'core/editor' ).editPost( { title: cleanT } );
            wp.data.dispatch( 'core/notices' ).createSuccessNotice( 
                `✍️ Đã cập nhật tiêu đề bài viết thành: "${cleanT}"`, 
                { type: 'snackbar', id: 'aiw-title-notice' } 
            );
        }

        return wp.element.createElement( 'div', { className: 'aiw-tab-content' },
            wp.element.createElement( TextControl, {
                label: '📌 Chủ đề bài viết',
                placeholder: 'VD: Lợi ích của xe điện VinFast',
                value: topic,
                onChange: setTopic,
            } ),
            wp.element.createElement( Button, {
                isPrimary: true,
                onClick: handleGenerate,
                disabled: loading || ! topic.trim(),
                className: 'aiw-btn-primary',
            }, loading ? wp.element.createElement( Spinner ) : '✨ Gợi ý tiêu đề SEO' ),
            error && wp.element.createElement( Notice, { status: 'error', isDismissible: false }, error ),
            results.length > 0 && wp.element.createElement( 'div', { className: 'aiw-results' },
                wp.element.createElement( 'p', { className: 'aiw-results-label' }, '💡 Chọn tiêu đề phù hợp:' ),
                results.map( ( t, i ) => {
                    const cleanText = t.replace( /^\d+\.\s*[-–]?\s*/, '' ).trim();
                    return wp.element.createElement( 'div', { key: i, className: 'aiw-result-item', style: { display: 'flex', flexDirection: 'column', gap: '8px', padding: '10px', marginBottom: '8px' } },
                        wp.element.createElement( 'span', { style: { fontWeight: '500', color: '#1e293b', lineHeight: '1.4' } }, cleanText ),
                        wp.element.createElement( 'div', { style: { display: 'flex', gap: '8px' } },
                            wp.element.createElement( Button, {
                                isPrimary: true,
                                isSmall: true,
                                onClick: () => applyTitle( t ),
                                style: { fontSize: '11px', height: '24px', padding: '0 10px' }
                            }, '✍️ Sử dụng' ),
                            wp.element.createElement( Button, {
                                isSecondary: true,
                                isSmall: true,
                                onClick: () => copyTitle( t ),
                                style: { fontSize: '11px', height: '24px', padding: '0 10px' }
                            }, '📋 Copy' )
                        )
                    );
                } )
            )
        );
    }

    // ─── Tab: Meta Description ────────────────────────────────────────────────
    function MetaTab() {
        const postContent = useSelect( select => select( 'core/editor' ).getEditedPostContent() );
        const [ result,  setResult  ] = useState( '' );
        const [ loading, setLoading ] = useState( false );
        const [ error,   setError   ] = useState( '' );

        async function handleGenerate() {
            if ( ! postContent ) { setError( 'Bài viết đang trống!'); return; }
            setLoading( true ); setError( '' );
            try {
                const res = await callAI( 'meta', { content: postContent } );
                if ( res.success ) setResult( res.data );
                else setError( res.message );
            } catch ( e ) { setError( e.message || 'Lỗi kết nối' ); }
            setLoading( false );
        }

        return wp.element.createElement( 'div', { className: 'aiw-tab-content' },
            wp.element.createElement( 'p', { className: 'aiw-hint' }, 'AI sẽ đọc nội dung bài hiện tại và tạo meta description tối ưu SEO (150-160 ký tự).' ),
            wp.element.createElement( Button, {
                isPrimary: true,
                onClick: handleGenerate,
                disabled: loading,
                className: 'aiw-btn-primary',
            }, loading ? wp.element.createElement( Spinner ) : '📝 Tạo Meta Description' ),
            error && wp.element.createElement( Notice, { status: 'error', isDismissible: false }, error ),
            result && wp.element.createElement( 'div', { className: 'aiw-result-box' },
                wp.element.createElement( 'p', { className: 'aiw-result-text' }, result ),
                wp.element.createElement( 'div', { className: 'aiw-char-count', style: { color: result.length > 160 ? '#e74c3c' : '#27ae60' } },
                    result.length + '/160 ký tự'
                ),
                wp.element.createElement( Button, {
                    isSecondary: true,
                    onClick: () => navigator.clipboard.writeText( result ),
                    className: 'aiw-copy-btn',
                }, '📋 Copy Meta' )
            )
        );
    }

    // ─── Tab: Từ khóa SEO ────────────────────────────────────────────────────
    function KeywordsTab() {
        const postContent = useSelect( select => select( 'core/editor' ).getEditedPostContent() );
        const [ seedKeyword, setSeedKeyword ] = useState( '' );
        const [ results, setResults ] = useState( [] );
        const [ loading, setLoading ] = useState( false );
        const [ error,   setError   ] = useState( '' );

        async function handleGenerate() {
            const isTopic = !! seedKeyword.trim();
            const payload = isTopic 
                ? { content: seedKeyword, is_topic: true }
                : { content: postContent };

            if ( ! isTopic && ! postContent ) { 
                setError( 'Bài viết đang trống! Hãy nhập một từ khóa gốc hoặc viết nội dung trước.' ); 
                return; 
            }
            
            setLoading( true ); setError( '' );
            try {
                const res = await callAI( 'keywords', payload );
                if ( res.success ) {
                    setResults( res.data.split( '\n' ).filter( l => l.trim() ) );
                } else setError( res.message );
            } catch ( e ) { setError( e.message || 'Lỗi kết nối' ); }
            setLoading( false );
        }

        async function handleKeywordClick( k ) {
            const keyword = k.replace(/^\d+\.\s*[-–]?\s*/, '').trim();
            
            // 1. Copy to clipboard
            navigator.clipboard.writeText( keyword );
            
            // 2. Show copy notification
            wp.data.dispatch( 'core/notices' ).createSuccessNotice( 
                `📋 Đã copy: "${keyword}"`, 
                { type: 'snackbar', id: 'aiw-copy-notice' } 
            );

            // 3. Automatically add to post tags in WordPress
            try {
                let tagId;
                try {
                    const res = await apiFetch( {
                        path: '/wp/v2/tags',
                        method: 'POST',
                        data: { name: keyword }
                    } );
                    tagId = res.id;
                } catch ( err ) {
                    if ( err.code === 'term_exists' ) {
                        tagId = err.data.term_id;
                    } else {
                        throw err;
                    }
                }

                if ( tagId ) {
                    const currentTags = wp.data.select( 'core/editor' ).getEditedPostAttribute( 'tags' ) || [];
                    if ( ! currentTags.includes( tagId ) ) {
                        const updatedTags = [ ...currentTags, tagId ];
                        wp.data.dispatch( 'core/editor' ).editPost( { tags: updatedTags } );
                        wp.data.dispatch( 'core/notices' ).createSuccessNotice( 
                            `🏷️ Đã thêm "${keyword}" vào danh sách Thẻ (Tags) bài viết!`, 
                            { type: 'snackbar', id: 'aiw-tag-notice' } 
                        );
                    } else {
                        wp.data.dispatch( 'core/notices' ).createInfoNotice( 
                            `ℹ️ Từ khóa "${keyword}" đã có sẵn trong danh sách Thẻ bài viết.`, 
                            { type: 'snackbar', id: 'aiw-tag-notice' } 
                        );
                    }
                }
            } catch ( e ) {
                console.error( 'Lỗi tự động thêm thẻ:', e );
            }
        }

        return wp.element.createElement( 'div', { className: 'aiw-tab-content' },
            wp.element.createElement( TextControl, {
                label: '🔑 Từ khóa gốc hoặc Chủ đề (Tùy chọn)',
                placeholder: 'Để trống để tự động phân tích bài viết...',
                value: seedKeyword,
                onChange: setSeedKeyword,
            } ),
            wp.element.createElement( 'p', { className: 'aiw-hint' }, 
                seedKeyword.trim() 
                    ? 'AI sẽ gợi ý các từ khóa liên quan dựa trên từ khóa gốc của bạn.'
                    : 'Nhập từ khóa hạt giống để mở rộng, hoặc để trống để phân tích nội dung bài hiện tại.'
            ),
            wp.element.createElement( Button, {
                isPrimary: true,
                onClick: handleGenerate,
                disabled: loading || ( ! seedKeyword.trim() && ! postContent ),
                className: 'aiw-btn-primary',
            }, loading ? wp.element.createElement( Spinner ) : '🔑 Gợi ý từ khóa' ),
            error && wp.element.createElement( Notice, { status: 'error', isDismissible: false }, error ),
            results.length > 0 && wp.element.createElement( 'div', { className: 'aiw-keyword-cloud' },
                results.map( ( k, i ) =>
                    wp.element.createElement( 'span', {
                        key: i,
                        className: 'aiw-keyword-tag',
                        onClick: () => handleKeywordClick( k ),
                        title: 'Click để copy và tự động thêm vào Thẻ (Tags) bài viết',
                    }, k )
                )
            )
        );
    }

    // ─── Tab: Cải thiện văn ──────────────────────────────────────────────────
    function ImproveTab() {
        const [ text,    setText    ] = useState( '' );
        const [ style,   setStyle   ] = useState( 'professional' );
        const [ result,  setResult  ] = useState( '' );
        const [ loading, setLoading ] = useState( false );
        const [ error,   setError   ] = useState( '' );

        async function handleImprove() {
            if ( ! text.trim() ) return;
            setLoading( true ); setError( '' );
            try {
                const res = await callAI( 'improve', { text, style } );
                if ( res.success ) setResult( res.data );
                else setError( res.message );
            } catch ( e ) { setError( e.message || 'Lỗi kết nối' ); }
            setLoading( false );
        }

        return wp.element.createElement( 'div', { className: 'aiw-tab-content' },
            wp.element.createElement( TextareaControl, {
                label: '✍️ Đoạn văn cần cải thiện',
                placeholder: 'Dán đoạn văn vào đây...',
                value: text,
                onChange: setText,
                rows: 5,
            } ),
            wp.element.createElement( SelectControl, {
                label: '🎨 Phong cách viết',
                value: style,
                options: [
                    { label: '💼 Chuyên nghiệp', value: 'professional' },
                    { label: '😊 Thân thiện',    value: 'friendly'     },
                    { label: '✂️ Ngắn gọn',      value: 'concise'      },
                    { label: '🔥 Hấp dẫn',       value: 'engaging'     },
                ],
                onChange: setStyle,
            } ),
            wp.element.createElement( Button, {
                isPrimary: true,
                onClick: handleImprove,
                disabled: loading || ! text.trim(),
                className: 'aiw-btn-primary',
            }, loading ? wp.element.createElement( Spinner ) : '✨ Cải thiện đoạn văn' ),
            error && wp.element.createElement( Notice, { status: 'error', isDismissible: false }, error ),
            result && wp.element.createElement( 'div', { className: 'aiw-result-box' },
                wp.element.createElement( 'p', { className: 'aiw-result-label' }, '📄 Kết quả:' ),
                wp.element.createElement( 'p', { className: 'aiw-result-text' }, result ),
                wp.element.createElement( Button, {
                    isSecondary: true,
                    onClick: () => navigator.clipboard.writeText( result ),
                    className: 'aiw-copy-btn',
                }, '📋 Copy kết quả' )
            )
        );
    }

    // ─── Main Sidebar ─────────────────────────────────────────────────────────
    function AIWriterSidebar() {
        if ( ! config.hasApiKey ) {
            return wp.element.createElement( PluginSidebar, {
                name: 'ai-writer-sidebar',
                title: '✨ AI Writer',
                icon: 'edit',
            },
                wp.element.createElement( 'div', { className: 'aiw-no-key' },
                    wp.element.createElement( 'p', {}, '⚠️ Chưa cấu hình Gemini API Key.' ),
                    wp.element.createElement( 'a', { href: config.settingsUrl, target: '_blank', className: 'aiw-settings-link' }, '⚙️ Vào Settings để cấu hình' )
                )
            );
        }

        return wp.element.createElement( wp.element.Fragment, null,
            wp.element.createElement( PluginSidebarMoreMenuItem, { target: 'ai-writer-sidebar' }, '✨ AI Writer' ),
            wp.element.createElement( PluginSidebar, {
                name: 'ai-writer-sidebar',
                title: '✨ AI Writer',
                icon: 'edit',
            },
                wp.element.createElement( TabPanel, {
                    className: 'aiw-tabs',
                    activeClass: 'is-active',
                    tabs: [
                        { name: 'titles',   title: '📌 Tiêu đề', className: 'aiw-tab' },
                        { name: 'meta',     title: '📝 Meta',     className: 'aiw-tab' },
                        { name: 'keywords', title: '🔑 Từ khóa',  className: 'aiw-tab' },
                        { name: 'improve',  title: '✨ Cải thiện', className: 'aiw-tab' },
                    ],
                }, function ( tab ) {
                    if ( tab.name === 'titles'   ) return wp.element.createElement( TitlesTab   );
                    if ( tab.name === 'meta'     ) return wp.element.createElement( MetaTab     );
                    if ( tab.name === 'keywords' ) return wp.element.createElement( KeywordsTab );
                    if ( tab.name === 'improve'  ) return wp.element.createElement( ImproveTab  );
                } )
            )
        );
    }

    registerPlugin( 'ai-writer', { render: AIWriterSidebar } );

} )( window.wp );
