<!DOCTYPE html>
<html class="light" lang="{{ str_replace("_", "-", app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="#ffffff" name="theme-color"/>
    <title>Sign Up | RideWave</title>
    @include('partials.theme-init')
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "on-surface": "#1d1b20",
                    "on-error-container": "#93000a",
                    "outline": "#7a7582",
                    "surface-variant": "#e6e0e9",
                    "surface-container-low": "#f8f2fa",
                    "on-secondary-fixed-variant": "#44474b",
                    "inverse-primary": "#cfbcff",
                    "surface-bright": "#fdf7ff",
                    "surface-container-highest": "#e6e0e9",
                    "error": "#ba1a1a",
                    "secondary-fixed-dim": "#c5c6cc",
                    "on-primary": "#ffffff",
                    "inverse-on-surface": "#f5eff7",
                    "surface-container-high": "#ece6ee",
                    "surface": "#fdf7ff",
                    "primary-container": "#6750a4",
                    "on-tertiary-container": "#d6d5ff",
                    "on-surface-variant": "#494551",
                    "tertiary": "#2f2ebe",
                    "on-secondary-fixed": "#191c20",
                    "tertiary-fixed-dim": "#c0c1ff",
                    "secondary": "#5c5e63",
                    "surface-container-lowest": "#ffffff",
                    "on-tertiary-fixed": "#07006c",
                    "on-secondary": "#ffffff",
                    "on-primary-fixed-variant": "#4f378a",
                    "on-tertiary": "#ffffff",
                    "error-container": "#ffdad6",
                    "surface-container": "#f2ecf4",
                    "background": "#fdf7ff",
                    "on-primary-container": "#e0d2ff",
                    "primary-fixed-dim": "#cfbcff",
                    "on-tertiary-fixed-variant": "#2f2ebe",
                    "on-primary-fixed": "#22005d",
                    "on-error": "#ffffff",
                    "surface-dim": "#ded8e0",
                    "tertiary-container": "#494bd6",
                    "outline-variant": "#cbc4d2",
                    "primary-fixed": "#e9ddff",
                    "on-background": "#1d1b20",
                    "tertiary-fixed": "#e1e0ff",
                    "primary": "#4f378a",
                    "on-secondary-container": "#626469",
                    "secondary-fixed": "#e1e2e8",
                    "inverse-surface": "#322f35",
                    "surface-tint": "#6750a4",
                    "secondary-container": "#e1e2e8"
            },
            "borderRadius": {
                    "DEFAULT": "0.25rem",
                    "lg": "0.5rem",
                    "xl": "0.75rem",
                    "full": "9999px"
            },
            "spacing": {
                    "xl": "64px",
                    "sm": "12px",
                    "margin": "20px",
                    "lg": "40px",
                    "gutter": "16px",
                    "md": "24px",
                    "xs": "4px",
                    "base": "8px"
            },
            "fontFamily": {
                    "headline-md": ["Plus Jakarta Sans"],
                    "display-lg": ["Plus Jakarta Sans"],
                    "body-lg": ["Plus Jakarta Sans"],
                    "body-md": ["Plus Jakarta Sans"],
                    "headline-sm": ["Plus Jakarta Sans"],
                    "label-md": ["Plus Jakarta Sans"]
            },
            "fontSize": {
                    "headline-md": ["28px", {"lineHeight": "1.2", "letterSpacing": "-0.01em", "fontWeight": "700"}],
                    "display-lg": ["48px", {"lineHeight": "1.1", "letterSpacing": "-0.02em", "fontWeight": "800"}],
                    "body-lg": ["16px", {"lineHeight": "1.55", "fontWeight": "400"}],
                    "body-md": ["15px", {"lineHeight": "1.55", "fontWeight": "400"}],
                    "headline-sm": ["20px", {"lineHeight": "1.3", "fontWeight": "700"}],
                    "label-md": ["13px", {"lineHeight": "1.35", "letterSpacing": "0.04em", "fontWeight": "600"}]
            }
          },
        },
      }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .sunset-gradient {
            background: linear-gradient(135deg, #F26D5D 0%, #F82E6E 100%);
        }
        .sunset-text-gradient {
            background: linear-gradient(to right, #F26D5D, #F82E6E);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .ambient-shadow {
            box-shadow: 0 18px 34px -18px rgba(248, 46, 110, 0.08);
        }
        .wheel-icon {
            width: 1.25rem;
            height: 1.25rem;
            display: block;
        }
    </style>
    @include('partials.ridewave-theme')
</head>
<body class="bg-surface font-body-md text-on-background min-h-screen flex flex-col">
<header class="bg-white/80 backdrop-blur-md border-b border-slate-100 sticky top-0 z-50">
    <nav class="flex justify-between items-center h-16 px-5 md:px-10 max-w-7xl mx-auto w-full">
        <a class="text-[1.35rem] font-black bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] bg-clip-text text-transparent" href="{{ route('home') }}">RideWave</a>
        <div class="flex items-center gap-4">
            @include('partials.theme-toggle-button')
            <a class="px-5 py-2 rounded-full text-sm font-bold sunset-text-gradient border border-[#F26D5D] hover:bg-slate-50 transition-all active:scale-95" href="{{ route('login') }}">Log In</a>
            <a class="px-5 py-2 rounded-full text-sm font-semibold text-white bg-slate-900 hover:bg-slate-800 transition-all active:scale-95" href="{{ route('register') }}">Sign Up</a>
        </div>
    </nav>
</header>
<main class="flex-grow flex items-center justify-center py-12 px-5 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary-container/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-secondary-container/10 rounded-full blur-3xl translate-x-1/3 translate-y-1/3"></div>
    <div class="max-w-lg w-full relative z-10">
        <div class="bg-white rounded-[22px] p-6 md:p-8 ambient-shadow border border-slate-50">
            <div class="text-center mb-8">
                <h1 class="font-display-lg text-headline-md text-on-surface mb-2">Join the journey</h1>
                <p class="text-slate-500 font-body-md">Connect with trusted commuters heading your way.</p>
            </div>
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-2xl">
                    <div class="flex gap-x-3">
                        <div class="text-red-600 mt-1">
                            <span class="material-symbols-outlined">error</span>
                        </div>
                        <div>
                            <p class="font-semibold text-red-900">Registration Error</p>
                            <ul class="mt-2 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm text-red-700">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <form class="space-y-5" method="POST" action="{{ route('register') }}">
                @csrf
                <input id="password_confirmation" name="password_confirmation" type="hidden" value="">
                <div class="grid grid-cols-2 gap-3 p-1 bg-slate-50 rounded-2xl border border-slate-100">
                    <label class="cursor-pointer">
                        <input class="hidden peer" name="role" type="radio" value="passenger" {{ old('role', 'passenger') === 'passenger' ? 'checked' : '' }}/>
                        <div class="flex items-center justify-center py-2.5 rounded-xl text-sm peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-[#F82E6E] text-slate-500 font-semibold transition-all">
                            <span class="material-symbols-outlined mr-2" data-icon="person">person</span>
                            Passenger
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input class="hidden peer" name="role" type="radio" value="driver" {{ old('role') === 'driver' ? 'checked' : '' }}/>
                        <div class="flex items-center justify-center py-2.5 rounded-xl text-sm peer-checked:bg-white peer-checked:shadow-sm peer-checked:text-[#F82E6E] text-slate-500 font-semibold transition-all">
                            <span class="material-symbols-outlined mr-2" data-icon="directions_car">directions_car</span>
                            Driver
                        </div>
                    </label>
                </div>
                <div class="space-y-3.5">
                    <div class="relative">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1 block ml-4"><span class="text-rose-500">*</span> Full Name</label>
                        <input class="w-full bg-[#F8FAFC] border-none focus:ring-2 focus:ring-[#F82E6E]/20 focus:bg-white rounded-2xl px-5 py-3.5 transition-all outline-none" name="name" placeholder="John Doe" type="text" value="{{ old('name') }}" required/>
                    </div>
                    <div class="relative">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1 block ml-4"><span class="text-rose-500">*</span> Email Address</label>
                        <input class="w-full bg-[#F8FAFC] border-none focus:ring-2 focus:ring-[#F82E6E]/20 focus:bg-white rounded-2xl px-5 py-3.5 transition-all outline-none" name="email" placeholder="john@example.com" type="email" value="{{ old('email') }}" required/>
                    </div>
                    <div class="relative">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1 block ml-4">Phone Number</label>
                        <input class="w-full bg-[#F8FAFC] border-none focus:ring-2 focus:ring-[#F82E6E]/20 focus:bg-white rounded-2xl px-5 py-3.5 transition-all outline-none" name="telephone" placeholder="+1 (555) 000-0000" type="tel" value="{{ old('telephone') }}"/>
                    </div>
                    <div class="relative">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1 block ml-4"><span class="text-rose-500">*</span> Password</label>
                        <input class="w-full bg-[#F8FAFC] border-none focus:ring-2 focus:ring-[#F82E6E]/20 focus:bg-white rounded-2xl px-6 py-4 transition-all outline-none" id="register-password" name="password" placeholder="********" type="password" required/>
                    </div>
                </div>
                <button class="w-full sunset-gradient text-white font-headline-sm py-3.5 rounded-2xl shadow-lg shadow-[#F82E6E]/20 hover:scale-[1.02] active:scale-95 transition-all" type="submit">
                    Create Account
                </button>
                <div class="flex items-center gap-4 my-6">
                    <div class="h-px flex-grow bg-slate-100"></div>
                    <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">or continue with</span>
                    <div class="h-px flex-grow bg-slate-100"></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <button class="flex items-center justify-center gap-2.5 py-2.5 border border-slate-200 rounded-2xl hover:bg-slate-50 transition-all text-sm font-semibold" type="button">
                        <img alt="Google" class="w-5 h-5" data-alt="Google logo icon with multi-color G shape on a white background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDK72ijixmR4Q4Cc9Y2zxLh1dEhG-k4BryQlbISBd-gpUP2VVERnbUz6s5SWd8sVPLhAPqw9Bi9JzVJn21WhKNJTyv9XEtJj6vWX9E1IzGruQ6fdjwt0570AQ4WJUQDFrVJCpuZ51LWu_lhX0H6NKinJNSS-tHW3KrZO09M_O00s69tuAbGgfTyfRJn7uZauZ1dc_I3yr_Z4_lk2EoWHq0NsQhYF-EyraoyQwBL8VvytmWmgXSZFuLvyphlzMtWMmV3SEgPe03UtH2m"/>
                        Google
                    </button>
                    <button class="flex items-center justify-center gap-2.5 py-2.5 border border-slate-200 rounded-2xl hover:bg-slate-50 transition-all text-sm font-semibold" type="button">
                        <span class="material-symbols-outlined text-xl" data-icon="apple" style="font-variation-settings: 'FILL' 1;">ios</span>
                        Apple
                    </button>
                </div>
            </form>
            <p class="text-center mt-8 text-slate-500 font-body-md">
                Already have an account?
                <a class="text-[#F82E6E] font-bold hover:underline" href="{{ route('login') }}">Log In</a>
            </p>
        </div>
    </div>
</main>
<section class="max-w-screen-2xl mx-auto px-6 lg:px-12 pb-24 hidden lg:block">
    <div class="grid grid-cols-3 gap-6 h-64">
        <div class="col-span-1 bg-slate-50 rounded-[24px] p-8 flex flex-col justify-center border border-slate-100">
            <div class="w-12 h-12 sunset-gradient rounded-xl flex items-center justify-center mb-4 text-white">
                <svg aria-hidden="true" class="wheel-icon" fill="none" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="7" stroke="currentColor" stroke-width="2"/>
                    <circle cx="12" cy="12" r="2" fill="currentColor"/>
                    <path d="M12 5v5M5.5 10.5l4.4 2.1M18.5 10.5l-4.4 2.1M8.8 18l1.8-4M15.2 18l-1.8-4" stroke="currentColor" stroke-linecap="round" stroke-width="2"/>
                </svg>
            </div>
            <h3 class="font-headline-sm text-lg text-on-background">Commute Smarter</h3>
            <p class="font-body-md text-sm text-secondary mt-2">Connect with thousands of urban professionals for your daily ride.</p>
        </div>
        <div class="col-span-1 relative rounded-[24px] overflow-hidden group">
            <img alt="Urban Commute" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Modern high-end luxury car interior during sunset with soft ambient lighting and city skyline background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBN1f_Dv2Ld30Y4_lZYPfsD30AdOyZvGRc-RrdwKuVelQ03ItuOx9Ss3hziC9Gd9b4sNWIDm6WZEfIEj6qfnhdNGazf39ujblYykbK0nIk5zRdRV9457V1G5HtMdWbdjTHHXupQCjxVhr_j_GJXQUtawFlbgnbALO5fnfK6YStjZJU1qD3NbX2PZVvtAEQr89rNlWWWCSE8tqzTge8AlwKySW0R74LgdPjfVCoNvB6IDRfgtP5JtNbGySpMoNjE_tXRU5x4N8WRr8Et"/>
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex flex-col justify-end p-8">
                <span class="text-white/80 font-label-md uppercase tracking-wider text-[10px]">Community</span>
                <h3 class="text-white font-headline-sm text-lg">Safe &amp; Reliable</h3>
            </div>
        </div>
        <div class="col-span-1 bg-gradient-to-br from-[#F82E6E] to-[#F26D5D] rounded-[24px] p-8 flex flex-col justify-center text-white">
            <span class="material-symbols-outlined text-4xl mb-4" data-weight="fill">energy_savings_leaf</span>
            <h3 class="font-headline-sm text-lg">Sustainable Living</h3>
            <p class="font-body-md text-sm text-white/80 mt-2">Every shared ride reduces carbon footprint and helps our environment.</p>
        </div>
    </div>
</section>
<footer class="bg-slate-50 border-t border-slate-200 py-12">
    <div class="flex flex-col md:flex-row justify-between items-center px-6 md:px-12 max-w-7xl mx-auto gap-8">
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
    const registerPassword = document.getElementById('register-password');
    const registerConfirmation = document.getElementById('password_confirmation');
    function syncRegisterConfirmation() {
        registerConfirmation.value = registerPassword.value;
    }
    registerPassword.addEventListener('input', syncRegisterConfirmation);
    syncRegisterConfirmation();
</script>
@include('partials.theme-toggle-script')
</body>
</html>

