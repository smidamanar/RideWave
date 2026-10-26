<button
    aria-label="Dark mode"
    class="theme-toggle {{ $className ?? '' }}"
    data-theme-toggle
    data-theme-label-light="Dark mode"
    data-theme-label-dark="Light mode"
    type="button"
>
    <span
        aria-hidden="true"
        class="material-symbols-outlined"
        data-theme-icon
        data-theme-icon-mode="text"
        data-theme-icon-light="dark_mode"
        data-theme-icon-dark="light_mode"
    >dark_mode</span>
</button>
