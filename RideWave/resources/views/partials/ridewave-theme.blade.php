<style>
    body {
        transition: background-color 0.25s ease, color 0.25s ease;
    }

    .theme-toggle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.9rem;
        height: 2.9rem;
        padding: 0;
        border-radius: 999px;
        border: 1px solid rgba(148, 163, 184, 0.18);
        background: rgba(255, 255, 255, 0.82);
        color: #0f172a;
        line-height: 1;
        cursor: pointer;
        transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        backdrop-filter: blur(12px);
        flex-shrink: 0;
    }

    .theme-toggle:hover {
        transform: translateY(-1px);
        box-shadow: 0 16px 40px -24px rgba(15, 23, 42, 0.35);
    }

    .theme-toggle .material-symbols-outlined {
        font-size: 19px;
    }

    .theme-toggle-label {
        display: none;
    }

    .hero-visual {
        position: relative;
        isolation: isolate;
        border-radius: 2rem;
        overflow: hidden;
        background:
            radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0) 32%),
            linear-gradient(135deg, rgba(255, 244, 246, 0.95), rgba(253, 247, 255, 0.72) 46%, rgba(244, 242, 250, 0.92));
    }

    .hero-visual::before,
    .hero-visual::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 2rem;
        pointer-events: none;
        transition: opacity 0.25s ease, background 0.25s ease, box-shadow 0.25s ease;
    }

    .hero-visual::before {
        z-index: 1;
        background:
            radial-gradient(circle at 18% 16%, rgba(255, 255, 255, 0.96), transparent 28%),
            radial-gradient(circle at 82% 20%, rgba(255, 236, 240, 0.82), transparent 26%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.14), rgba(253, 247, 255, 0.44) 38%, rgba(253, 247, 255, 0.86) 82%, rgba(253, 247, 255, 0.98));
        mix-blend-mode: screen;
    }

    .hero-visual::after {
        z-index: 2;
        box-shadow:
            inset 0 0 0 1px rgba(248, 46, 110, 0.08),
            inset 0 18px 32px rgba(255, 255, 255, 0.32),
            inset 0 -88px 110px rgba(253, 247, 255, 0.95),
            inset 48px 0 64px rgba(253, 247, 255, 0.56),
            inset -48px 0 64px rgba(253, 247, 255, 0.56);
    }

    .hero-visual-image {
        display: block;
        opacity: 0.92;
        filter: saturate(0.9) contrast(0.95) brightness(1.03);
        mask-image: radial-gradient(circle at center, #000 56%, rgba(0, 0, 0, 0.92) 68%, transparent 100%);
        -webkit-mask-image: radial-gradient(circle at center, #000 56%, rgba(0, 0, 0, 0.92) 68%, transparent 100%);
        transition: filter 0.25s ease, opacity 0.25s ease;
    }

    html.dark body {
        background-color: #08111f;
        color: #e2e8f0;
    }

    html.dark .theme-toggle {
        background: rgba(15, 23, 42, 0.88);
        border-color: rgba(148, 163, 184, 0.24);
        color: #f8fafc;
        box-shadow: 0 16px 40px -28px rgba(2, 6, 23, 0.85);
    }

    html.dark .bg-white {
        background-color: #111827 !important;
    }

    html.dark .bg-white\/95 {
        background-color: rgba(17, 24, 39, 0.95) !important;
    }

    html.dark .bg-white\/90 {
        background-color: rgba(17, 24, 39, 0.9) !important;
    }

    html.dark .bg-white\/85 {
        background-color: rgba(17, 24, 39, 0.85) !important;
    }

    html.dark .bg-white\/80 {
        background-color: rgba(17, 24, 39, 0.82) !important;
    }

    html.dark .bg-white\/70 {
        background-color: rgba(17, 24, 39, 0.74) !important;
    }

    html.dark .bg-white\/60 {
        background-color: rgba(17, 24, 39, 0.88) !important;
    }

    html.dark .bg-white\/50 {
        background-color: rgba(17, 24, 39, 0.8) !important;
    }

    html.dark .bg-slate-50,
    html.dark .bg-surface,
    html.dark .bg-surface-container,
    html.dark .bg-surface-container-high,
    html.dark .bg-surface-container-highest,
    html.dark .bg-surface-container-low,
    html.dark .bg-surface-container-lowest,
    html.dark .bg-surface-container-low\/50 {
        background-color: #0b1220 !important;
    }

    html.dark .bg-slate-900 {
        background-color: #020617 !important;
    }

    html.dark .bg-rose-50,
    html.dark .bg-rose-50\/80 {
        background-color: rgba(244, 63, 94, 0.12) !important;
    }

    html.dark .bg-slate-50\/60,
    html.dark .bg-slate-50\/70,
    html.dark .bg-slate-50\/80,
    html.dark .bg-slate-50\/90,
    html.dark .bg-slate-50\/95 {
        background-color: rgba(15, 23, 42, 0.78) !important;
    }

    html.dark .bg-rose-50\/60,
    html.dark .bg-rose-50\/70,
    html.dark .bg-rose-50\/90 {
        background-color: rgba(244, 63, 94, 0.14) !important;
    }

    html.dark .bg-sky-50,
    html.dark .bg-sky-50\/80 {
        background-color: rgba(30, 41, 59, 0.88) !important;
    }

    html.dark .bg-amber-50 {
        background-color: rgba(120, 53, 15, 0.28) !important;
    }

    html.dark .text-on-background,
    html.dark .text-on-surface,
    html.dark .text-slate-900,
    html.dark .text-slate-800,
    html.dark .text-slate-950 {
        color: #f8fafc !important;
    }

    html.dark .text-on-surface-variant,
    html.dark .text-secondary,
    html.dark .text-slate-700,
    html.dark .text-slate-600 {
        color: #cbd5e1 !important;
    }

    html.dark .text-slate-500,
    html.dark .text-slate-400 {
        color: #b6c2d4 !important;
    }

    html.dark .text-slate-300 {
        color: #cbd5e1 !important;
    }

    html.dark .nav-link {
        color: #cbd5e1 !important;
    }

    html.dark .nav-link:hover,
    html.dark .nav-active {
        color: #fb7185 !important;
    }

    html.dark .border-slate-50,
    html.dark .border-slate-100,
    html.dark .border-slate-200,
    html.dark .border-gray-50\/50,
    html.dark .border-rose-100,
    html.dark .border-rose-100\/50,
    html.dark .border-white\/60,
    html.dark .border-white\/70,
    html.dark .border-white\/80,
    html.dark .border-white\/30 {
        border-color: rgba(148, 163, 184, 0.18) !important;
    }

    html.dark input,
    html.dark select,
    html.dark textarea {
        background-color: #020617 !important;
        color: #f8fafc !important;
        border-color: rgba(148, 163, 184, 0.24) !important;
    }

    html.dark .city-menu {
        background: rgba(2, 6, 23, 0.98) !important;
        border-color: rgba(148, 163, 184, 0.2) !important;
        box-shadow: 0 24px 60px rgba(2, 6, 23, 0.6) !important;
    }

    html.dark .city-option {
        color: #f8fafc !important;
    }

    html.dark .city-option:hover,
    html.dark .city-option.is-active {
        background: rgba(244, 63, 94, 0.16) !important;
        color: #fecdd3 !important;
    }

    html.dark .city-empty {
        color: #94a3b8 !important;
    }

    html.dark input::placeholder,
    html.dark textarea::placeholder {
        color: #64748b !important;
    }

    html.dark .soft-glow,
    html.dark .ambient-shadow {
        box-shadow: 0 24px 64px -32px rgba(2, 6, 23, 0.9);
    }

    html.dark .hero-visual::before {
        background:
            radial-gradient(circle at 20% 18%, rgba(15, 23, 42, 0.08), transparent 28%),
            radial-gradient(circle at 80% 18%, rgba(244, 63, 94, 0.1), transparent 24%),
            linear-gradient(180deg, rgba(8, 17, 31, 0.06), rgba(8, 17, 31, 0.3) 42%, rgba(8, 17, 31, 0.86));
        mix-blend-mode: normal;
    }

    html.dark .hero-visual::after {
        box-shadow:
            inset 0 0 0 1px rgba(148, 163, 184, 0.12),
            inset 0 18px 36px rgba(15, 23, 42, 0.22),
            inset 0 -94px 118px rgba(8, 17, 31, 0.96),
            inset 52px 0 76px rgba(8, 17, 31, 0.7),
            inset -52px 0 76px rgba(8, 17, 31, 0.7);
    }

    html.dark .hero-visual-image {
        opacity: 0.84;
        filter: saturate(0.78) brightness(0.8) contrast(1);
    }

    html.dark footer {
        border-color: rgba(148, 163, 184, 0.18) !important;
    }

    @media (max-width: 640px) {
        .theme-toggle {
            width: 2.75rem;
            height: 2.75rem;
        }
    }
</style>
