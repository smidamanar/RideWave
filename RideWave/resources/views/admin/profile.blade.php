@extends('admin.layouts.ridewave')

@section('title', 'Manage Admin Profile | RideWave')

@section('content')
@php
    $admin = auth()->user();
    $initial = $admin->profileInitial();
    $memberSince = optional($admin->created_at)->format('Y') ?? now()->format('Y');
    $profilePhotoStatus = $admin->profile_photo_path ? 'Current photo saved' : 'No file chosen';
@endphp
<style>
    .surface-card {
        border: 1px solid #e2e8f0;
        background: #ffffff;
        border-radius: 1.5rem;
        box-shadow: 0 24px 50px -30px rgba(15, 23, 42, 0.2);
    }
    .surface-muted {
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 1rem;
    }
    .profile-input {
        border: 1px solid #d7dee7;
        background: #ffffff;
        border-radius: 0.95rem;
        padding: 0.85rem 1rem;
        transition: all 0.2s ease;
    }
    .profile-input:focus-within {
        border-color: rgba(248, 46, 110, 0.35);
        box-shadow: 0 0 0 4px rgba(248, 46, 110, 0.08);
    }
</style>

<section class="mb-8">
    <span class="inline-flex rounded-full bg-rose-50 px-4 py-1.5 text-[10px] font-bold uppercase tracking-[0.2em] text-rose-600">Manage Profile</span>
    <h1 class="mt-4 text-4xl font-black tracking-tight text-slate-900 sm:text-5xl">Your profile, account details, and security.</h1>
    <p class="mt-3 max-w-3xl text-base text-slate-500">This page is dedicated to account management only. Update your identity, contact information, photo, and password from one clean workflow.</p>
</section>

<div class="grid grid-cols-1 gap-7 xl:grid-cols-12">
    <aside class="xl:col-span-4">
        <div class="surface-card p-6">
            <div class="flex items-center gap-4">
                @if ($admin->profile_photo_path)
                    <img alt="{{ $admin->name }} profile photo" class="h-20 w-20 rounded-2xl border-4 border-white object-cover shadow-lg" src="{{ route('admin.profile.photo') }}">
                @else
                    <div class="gradient-brand flex h-20 w-20 items-center justify-center rounded-2xl border-4 border-white text-2xl font-black text-white shadow-lg">
                        {{ $initial }}
                    </div>
                @endif
                <div>
                    <h2 class="text-2xl font-extrabold text-slate-900">{{ $admin->name }}</h2>
                    <p class="text-sm font-medium text-slate-500">Member since {{ $memberSince }}</p>
                </div>
            </div>

            <div class="mt-5 space-y-3 text-sm text-slate-600">
                <div class="surface-muted flex items-center gap-3 px-4 py-3">
                    <span class="material-symbols-outlined text-rose-500">mail</span>
                    <span class="truncate">{{ $admin->email }}</span>
                </div>
                <div class="surface-muted flex items-center gap-3 px-4 py-3">
                    <span class="material-symbols-outlined text-rose-500">shield</span>
                    <span>Administrator account</span>
                </div>
                <div class="surface-muted flex items-center gap-3 px-4 py-3">
                    <span class="material-symbols-outlined text-rose-500">calendar_month</span>
                    <span>Member since {{ $memberSince }}</span>
                </div>
            </div>
        </div>
    </aside>

    <section class="xl:col-span-8">
        <form action="{{ route('admin.profile.update') }}" class="space-y-5" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="surface-card p-6">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Profile Photo</h3>
                        <p class="mt-1 text-sm text-slate-500">Use a clear photo so your team can identify you quickly.</p>
                    </div>
                    <div class="flex items-center gap-2 sm:justify-end">
                        <span class="material-symbols-outlined text-slate-400">photo_camera</span>
                        <input accept="image/jpeg,image/png,image/jpg,image/webp" class="sr-only" id="profile_photo" name="profile_photo" type="file">
                        <label class="inline-flex cursor-pointer items-center rounded-2xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white" for="profile_photo">Upload photo</label>
                    </div>
                </div>

                <p class="mt-2 text-sm font-medium text-slate-500" id="profile-photo-status">{{ $profilePhotoStatus }}</p>

                @if ($admin->profile_photo_path)
                    <label class="mt-3 inline-flex cursor-pointer items-center gap-2 text-xs font-semibold text-slate-500" for="remove_profile_photo">
                        <input @checked(old('remove_profile_photo')) class="rounded border-slate-300 text-rose-500 focus:ring-rose-400" id="remove_profile_photo" name="remove_profile_photo" type="checkbox" value="1">
                        Remove current photo
                        </label>
                @endif

                <div class="mt-4 hidden items-center gap-2 rounded-xl border border-slate-200 bg-white px-2 py-1.5" id="profile-photo-preview-wrap">
                    <img alt="Selected profile photo preview" class="h-10 w-10 rounded-lg border border-slate-200 object-cover" id="profile-photo-preview-image" src="">
                    <p class="max-w-[200px] truncate text-xs font-semibold text-slate-600" id="profile-photo-preview-name"></p>
                </div>
            </div>

            <div class="surface-card p-6">
                <h3 class="text-2xl font-extrabold text-slate-900">Personal Information</h3>
                <p class="mt-1 text-sm text-slate-500">Keep your details current for smoother account administration.</p>
                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-400" for="name"><span class="text-rose-500">*</span> Full Name</label>
                        <div class="profile-input flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">person</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="name" name="name" required type="text" value="{{ old('name', $admin->name) }}">
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-400" for="telephone">Phone Number</label>
                        <div class="profile-input flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">call</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="telephone" name="telephone" placeholder="+216 XX XXX XXX" type="text" value="{{ old('telephone', $admin->telephone) }}">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <label class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-400" for="email"><span class="text-rose-500">*</span> Email Address</label>
                    <div class="profile-input flex items-center gap-2.5">
                        <span class="material-symbols-outlined text-[18px] text-slate-400">mail</span>
                        <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="email" name="email" required type="email" value="{{ old('email', $admin->email) }}">
                    </div>
                </div>
            </div>

            <div class="surface-card p-6">
                <h3 class="text-2xl font-extrabold text-slate-900">Security</h3>
                <p class="mt-1 text-sm text-slate-500">Set a new password when needed. Leave fields empty to keep your current password.</p>
                <div class="mt-5 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-400" for="password">New Password</label>
                        <div class="profile-input flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">lock</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="password" name="password" placeholder="At least 8 characters" type="password">
                        </div>
                    </div>
                    <div>
                        <label class="mb-2 block text-xs font-bold uppercase tracking-[0.18em] text-slate-400" for="password_confirmation">Confirm Password</label>
                        <div class="profile-input flex items-center gap-2.5">
                            <span class="material-symbols-outlined text-[18px] text-slate-400">verified_user</span>
                            <input class="w-full border-0 bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-300 focus:ring-0" id="password_confirmation" name="password_confirmation" placeholder="Re-enter new password" type="password">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button class="gradient-brand inline-flex items-center justify-center gap-2 rounded-2xl px-6 py-3 text-sm font-black text-white shadow-lg shadow-rose-500/20 transition hover:scale-[1.01] active:scale-[0.99]" type="submit">
                    <span class="material-symbols-outlined text-base text-white">save</span>
                    Save Profile
                </button>
            </div>
        </form>
    </section>
</div>

<script>
    (() => {
        const profilePhotoInput = document.getElementById('profile_photo');
        const profilePhotoStatus = document.getElementById('profile-photo-status');
        const profilePhotoPreviewWrap = document.getElementById('profile-photo-preview-wrap');
        const profilePhotoPreviewImage = document.getElementById('profile-photo-preview-image');
        const profilePhotoPreviewName = document.getElementById('profile-photo-preview-name');
        const removeProfilePhoto = document.getElementById('remove_profile_photo');
        let profilePhotoObjectUrl = null;

        if (!profilePhotoInput || !profilePhotoStatus || !profilePhotoPreviewWrap || !profilePhotoPreviewImage || !profilePhotoPreviewName) {
            return;
        }

        const updateProfilePhotoPreview = () => {
            if (profilePhotoObjectUrl) {
                URL.revokeObjectURL(profilePhotoObjectUrl);
                profilePhotoObjectUrl = null;
            }

            const selectedFile = profilePhotoInput.files && profilePhotoInput.files.length > 0 ? profilePhotoInput.files[0] : null;

            if (!selectedFile) {
                profilePhotoPreviewWrap.classList.add('hidden');
                profilePhotoPreviewWrap.classList.remove('flex');
                profilePhotoPreviewImage.removeAttribute('src');
                profilePhotoPreviewName.textContent = '';
                profilePhotoStatus.textContent = '{{ $profilePhotoStatus }}';
                return;
            }

            profilePhotoObjectUrl = URL.createObjectURL(selectedFile);
            profilePhotoPreviewImage.src = profilePhotoObjectUrl;
            profilePhotoPreviewName.textContent = selectedFile.name;
            profilePhotoStatus.textContent = selectedFile.name;
            profilePhotoPreviewWrap.classList.remove('hidden');
            profilePhotoPreviewWrap.classList.add('flex');

            if (removeProfilePhoto) {
                removeProfilePhoto.checked = false;
            }
        };

        profilePhotoInput.addEventListener('change', updateProfilePhotoPreview);

        window.addEventListener('beforeunload', () => {
            if (profilePhotoObjectUrl) {
                URL.revokeObjectURL(profilePhotoObjectUrl);
            }
        });
    })();
</script>
@endsection
