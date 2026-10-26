<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="#ffffff" name="theme-color"/>
    <title>Login | RideWave</title>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "tertiary-fixed": "#e1e0ff",
                        "surface-container-highest": "#e6e0e9",
                        "on-tertiary-fixed": "#07006c",
                        "secondary": "#5c5e63",
                        "inverse-surface": "#322f35",
                        "secondary-fixed-dim": "#c5c6cc",
                        "primary": "#4f378a",
                        "secondary-fixed": "#e1e2e8",
                        "error": "#ba1a1a",
                        "surface-container-lowest": "#ffffff",
                        "surface-dim": "#ded8e0",
                        "surface-container-low": "#f8f2fa",
                        "tertiary-container": "#494bd6",
                        "error-container": "#ffdad6",
                        "on-error": "#ffffff",
                        "surface-container": "#f2ecf4",
                        "on-tertiary-container": "#d6d5ff",
                        "tertiary-fixed-dim": "#c0c1ff",
                        "on-tertiary-fixed-variant": "#2f2ebe",
                        "outline-variant": "#cbc4d2",
                        "tertiary": "#2f2ebe",
                        "surface-bright": "#fdf7ff",
                        "surface-container-high": "#ece6ee",
                        "on-secondary-fixed-variant": "#44474b",
                        "on-primary-fixed-variant": "#4f378a",
                        "on-primary-fixed": "#22005d",
                        "inverse-on-surface": "#f5eff7",
                        "surface-tint": "#6750a4",
                        "primary-container": "#6750a4",
                        "background": "#ffffff",
                        "on-tertiary": "#ffffff",
                        "on-surface-variant": "#494551",
                        "secondary-container": "#e1e2e8",
                        "on-background": "#1d1b20",
                        "inverse-primary": "#cfbcff",
                        "surface": "#ffffff",
                        "outline": "#7a7582",
                        "on-primary-container": "#e0d2ff",
                        "on-secondary-container": "#626469",
                        "on-surface": "#1d1b20",
                        "on-secondary-fixed": "#191c20",
                        "on-secondary": "#ffffff",
                        "surface-variant": "#e6e0e9",
                        "primary-fixed-dim": "#cfbcff",
                        "primary-fixed": "#e9ddff",
                        "on-primary": "#ffffff",
                        "on-error-container": "#93000a"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "gutter": "16px",
                        "md": "24px",
                        "sm": "12px",
                        "lg": "40px",
                        "xl": "64px",
                        "margin": "20px",
                        "base": "8px",
                        "xs": "4px"
                    },
                    "fontFamily": {
                        "headline-sm": ["Plus Jakarta Sans"],
                        "body-lg": ["Plus Jakarta Sans"],
                        "label-md": ["Plus Jakarta Sans"],
                        "display-lg": ["Plus Jakarta Sans"],
                        "headline-md": ["Plus Jakarta Sans"],
                        "body-md": ["Plus Jakarta Sans"]
                    },
                    "fontSize": {
                        "headline-sm": ["20px", {"lineHeight": "1.3", "fontWeight": "700"}],
                        "body-lg": ["16px", {"lineHeight": "1.55", "fontWeight": "400"}],
                        "label-md": ["13px", {"lineHeight": "1.35", "letterSpacing": "0.04em", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                        "headline-md": ["28px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                        "body-md": ["15px", {"lineHeight": "1.55", "fontWeight": "400"}]
                    }
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #ffffff; }
        .brand-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); }
        .brand-text-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .soft-glow { box-shadow: 0 10px 34px -14px rgba(248, 46, 110, 0.12); }
        .sunset-gradient { background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%); }
        .wheel-icon { width: 1.25rem; height: 1.25rem; display: block; }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="bg-white antialiased overflow-x-hidden">
<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <nav class="flex justify-between items-center h-16 px-5 md:px-10 max-w-7xl mx-auto w-full">
        <a class="text-[1.35rem] font-black bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] bg-clip-text text-transparent" href="{{ route('home') }}">RideWave</a>
        <div class="flex items-center gap-4">
            @include('partials.theme-toggle-button')
            <a class="px-5 py-2 rounded-full text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 transition-all active:scale-95" href="{{ route('login') }}">Log In</a>
            <a class="px-5 py-2 rounded-full text-sm font-semibold transition-all active:scale-95 bg-transparent border border-[#F82E6E] text-[#F82E6E] hover:bg-[#F82E6E]/5" href="{{ route('register') }}">Sign Up</a>
        </div>
    </nav>
</header>
<main class="min-h-screen flex items-center justify-center pt-16 pb-10 px-5">
    <div class="fixed inset-0 pointer-events-none overflow-hidden">
        <div class="absolute -top-[10%] -left-[5%] w-96 h-96 brand-gradient opacity-[0.03] blur-[120px] rounded-full"></div>
        <div class="absolute -bottom-[10%] -right-[5%] w-[500px] h-[500px] brand-gradient opacity-[0.05] blur-[150px] rounded-full"></div>
    </div>
    <div class="w-full max-w-[26rem] z-10">
        <div class="bg-white rounded-[22px] p-6 md:p-8 soft-glow border border-gray-50/50">
            <div class="text-center mb-8">
                <h1 class="font-headline-md text-on-background mb-2">Welcome Back</h1>
                <p class="font-body-md text-secondary">Join the journey and find your next ride</p>
            </div>
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <div class="flex gap-x-3">
                        <div class="text-red-600 mt-1">
                            <span class="material-symbols-outlined">error</span>
                        </div>
                        <div>
                            <p class="font-semibold text-red-900">Login Error</p>
                            <ul class="mt-2 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm text-red-700">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-2">
                    <label class="font-label-md text-on-surface-variant block ml-1" for="email"><span class="text-rose-500">*</span> Email Address</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">mail</span>
                        <input class="w-full bg-[#F8FAFC] border-none rounded-xl py-3.5 pl-11 pr-4 focus:ring-2 focus:ring-[#F82E6E]/20 focus:bg-white transition-all duration-300 outline-none text-on-background font-body-md" id="email" name="email" placeholder="name@example.com" type="email" value="{{ old('email') }}" required/>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="font-label-md text-on-surface-variant" for="password"><span class="text-rose-500">*</span> Password</label>
                        <a class="text-[#F82E6E] font-label-md hover:underline" href="#">Forgot Password?</a>
                    </div>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">lock</span>
                        <input class="w-full bg-[#F8FAFC] border-none rounded-xl py-4 pl-12 pr-12 focus:ring-2 focus:ring-[#F82E6E]/20 focus:bg-white transition-all duration-300 outline-none text-on-background font-body-md" id="password" name="password" placeholder="********" type="password" required/>
                        <button class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600" id="toggle-password" type="button">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>
                <button class="w-full brand-gradient text-white py-3.5 rounded-xl font-headline-sm text-sm tracking-wide shadow-lg shadow-[#F82E6E]/20 hover:shadow-xl hover:shadow-[#F82E6E]/30 active:scale-[0.98] transition-all duration-300 mt-1" type="submit">
                    Login
                </button>
            </form>
            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-100"></div>
                </div>
                <div class="relative flex justify-center text-xs uppercase tracking-widest font-bold text-slate-300 bg-white px-4">
                    Or continue with
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <button class="flex items-center justify-center gap-2.5 py-3 px-4 bg-white border border-slate-100 rounded-xl hover:bg-slate-50 active:scale-[0.98] transition-all duration-200" type="button">
                    <img alt="Google" class="w-5 h-5" data-alt="Google logo icon colorful minimalism" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBkd8CAg4-PoRFuAIjG0vvsjJbVptwfdffKWB8AxwparDlsiCqVmoSmc6pl2vrkyskQfYUlvVU0lKe7ZrtDjil5yABTObe6PX6iyBdhq_CfkrRaOY2fcSdQGm0b0QCGH9Moa7O_zKkCf-4FjoZVNXS40Z-VH0foY0k-S2epYq3P2_vrJkIMb4ZRVCGjXSBwoR1kyIxCcXXnh8GYtKrbkOFYt8LUxq5BSq1AlclwwoWyp_XoHBEiMWFazFrOo0wAuPBfpVFsViz_p3CK"/>
                    <span class="font-label-md text-slate-700">Google</span>
                </button>
                <button class="flex items-center justify-center gap-2.5 py-3 px-4 bg-white border border-slate-100 rounded-xl hover:bg-slate-50 active:scale-[0.98] transition-all duration-200" type="button">
                    <span class="material-symbols-outlined text-[20px]" data-weight="fill">ios</span>
                    <span class="font-label-md text-slate-700">Apple</span>
                </button>
            </div>
            <p class="text-center mt-8 font-body-md text-secondary">
                Don't have an account?
                <a class="text-[#F82E6E] font-bold hover:underline" href="{{ route('register') }}">Join RideWave</a>
            </p>
        </div>
        <div class="mt-6 flex items-center justify-center gap-3 text-slate-400 text-[13px]">
            <span class="font-label-md flex items-center gap-1">
                <span class="material-symbols-outlined text-sm">verified_user</span>
                Secure Login
            </span>
            <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
            <span class="font-label-md">Privacy Policy</span>
        </div>
    </div>
</main>
<section class="max-w-screen-2xl mx-auto px-6 lg:px-12 pb-16 hidden lg:block">
    <div class="grid grid-cols-3 gap-5 h-56">
        <div class="col-span-1 bg-slate-50 rounded-[22px] p-6 flex flex-col justify-center border border-slate-100">
            <div class="w-10 h-10 brand-gradient rounded-xl flex items-center justify-center mb-3 text-white">
                <svg aria-hidden="true" class="wheel-icon" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="7" stroke="currentColor" stroke-width="2"/>
                    <circle cx="12" cy="12" r="2" fill="currentColor"/>
                    <path d="M12 5v5M5.5 10.5l4.4 2.1M18.5 10.5l-4.4 2.1M8.8 18l1.8-4M15.2 18l-1.8-4" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                </svg>
            </div>
            <h3 class="font-headline-sm text-[18px] text-on-background">Commute Smarter</h3>
            <p class="font-body-md text-sm text-secondary mt-2">Connect with thousands of urban professionals for your daily ride.</p>
        </div>
        <div class="col-span-1 relative rounded-[22px] overflow-hidden group">
            <img alt="Urban Commute" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Modern high-end luxury car interior during sunset with soft ambient lighting and city skyline background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBN1f_Dv2Ld30Y4_lZYPfsD30AdOyZvGRc-RrdwKuVelQ03ItuOx9Ss3hziC9Gd9b4sNWIDm6WZEfIEj6qfnhdNGazf39ujblYykbK0nIk5zRdRV9457V1G5HtMdWbdjTHHXupQCjxVhr_j_GJXQUtawFlbgnbALO5fnfK6YStjZJU1qD3NbX2PZVvtAEQr89rNlWWWCSE8tqzTge8AlwKySW0R74LgdPjfVCoNvB6IDRfgtP5JtNbGySpMoNjE_tXRU5x4N8WRr8Et"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-6">
                <span class="text-white/80 font-label-md uppercase tracking-wider text-[10px]">Community</span>
                <h3 class="text-white font-headline-sm text-[18px]">Safe &amp; Reliable</h3>
            </div>
        </div>
        <div class="col-span-1 brand-gradient rounded-[22px] p-6 flex flex-col justify-center text-white">
            <span class="material-symbols-outlined text-3xl mb-3" data-weight="fill">energy_savings_leaf</span>
            <h3 class="font-headline-sm text-[18px]">Sustainable Living</h3>
            <p class="font-body-md text-sm text-white/80 mt-2">Every shared ride reduces carbon footprint and helps our environment.</p>
        </div>
    </div>
</section>
<footer class="bg-slate-50 border-t border-slate-200 py-10">
    <div class="flex flex-col md:flex-row justify-between items-center px-6 md:px-12 max-w-7xl mx-auto gap-6">
        <div class="flex flex-col items-center md:items-start gap-4">
            <span class="text-xl font-bold text-slate-900">RideWave</span>
            <p class="text-slate-600 text-sm tracking-tight">&copy; 2024 RideWave. Moving forward, together.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-x-8 gap-y-4">
            <a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Privacy Policy</a>
            <a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Terms of Service</a>
            <a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Safety Guidelines</a>
            <a class="text-slate-600 text-sm hover:text-slate-900 transition-colors" href="#">Support</a>
        </div>
        <div class="flex gap-4">
            <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#F82E6E] cursor-pointer transition-all">
                <span class="material-symbols-outlined text-lg" data-icon="share">share</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-[#F82E6E] cursor-pointer transition-all">
                <span class="material-symbols-outlined text-lg" data-icon="public">public</span>
            </div>
        </div>
    </div>
</footer>
<script>
    const loginPassword = document.getElementById('password');
    const loginToggle = document.getElementById('toggle-password');
    loginToggle.addEventListener('click', () => {
        const nextType = loginPassword.type === 'password' ? 'text' : 'password';
        loginPassword.type = nextType;
        loginToggle.querySelector('.material-symbols-outlined').textContent = nextType === 'password' ? 'visibility' : 'visibility_off';
    });
</script>
@include('partials.theme-toggle-script')
</body>
</html>

