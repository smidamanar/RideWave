<script>
    (() => {
        const storageKey = 'ridewave-theme';
        const root = document.documentElement;

        try {
            const savedTheme = window.localStorage.getItem(storageKey);
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme === 'dark' || savedTheme === 'light'
                ? savedTheme
                : (prefersDark ? 'dark' : 'light');

            root.dataset.theme = theme;
            root.classList.remove('light', 'dark');
            root.classList.add(theme);
        } catch (error) {
            root.dataset.theme = 'light';
            root.classList.remove('dark');
            root.classList.add('light');
        }
    })();
</script>
