<script>
    (() => {
        const storageKey = 'ridewave-theme';
        const root = document.documentElement;
        const themeColorMeta = document.querySelector('meta[name="theme-color"]');
        const themeColors = {
            light: '#ffffff',
            dark: '#08111f',
        };

        function updateButtons(theme) {
            document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
                const icon = button.querySelector('[data-theme-icon]');
                const label = button.querySelector('[data-theme-label]');
                const lightLabel = button.dataset.themeLabelLight || label?.dataset.themeLabelLight || 'Dark mode';
                const darkLabel = button.dataset.themeLabelDark || label?.dataset.themeLabelDark || 'Light mode';

                if (icon) {
                    const iconMode = icon.dataset.themeIconMode || 'text';
                    const lightIcon = icon.dataset.themeIconLight || 'dark_mode';
                    const darkIcon = icon.dataset.themeIconDark || 'light_mode';
                    const nextIcon = theme === 'dark' ? darkIcon : lightIcon;

                    if (iconMode === 'class') {
                        icon.className = nextIcon;
                    } else {
                        icon.textContent = nextIcon;
                    }
                }

                if (label) {
                    const nextLabel = theme === 'dark' ? darkLabel : lightLabel;
                    label.textContent = nextLabel;
                }

                button.setAttribute('aria-label', theme === 'dark' ? darkLabel : lightLabel);

                button.setAttribute('aria-pressed', theme === 'dark' ? 'true' : 'false');
            });

            if (themeColorMeta) {
                themeColorMeta.setAttribute('content', themeColors[theme] || themeColors.light);
            }

            if (typeof window.applyLocaleTranslations === 'function') {
                window.applyLocaleTranslations();
            }
        }

        function applyTheme(theme, persist = true) {
            root.dataset.theme = theme;
            root.classList.remove('light', 'dark');
            root.classList.add(theme);

            if (persist) {
                try {
                    window.localStorage.setItem(storageKey, theme);
                } catch (error) {
                    // Ignore storage issues and still apply the theme for the current page.
                }
            }

            updateButtons(theme);
        }

        window.toggleAppTheme = () => {
            const nextTheme = root.dataset.theme === 'dark' ? 'light' : 'dark';
            applyTheme(nextTheme);
        };

        document.addEventListener('DOMContentLoaded', () => {
            updateButtons(root.dataset.theme === 'dark' ? 'dark' : 'light');

            document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
                button.addEventListener('click', window.toggleAppTheme);
            });
        });
    })();
</script>
