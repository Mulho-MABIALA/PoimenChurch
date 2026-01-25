<x-app-layout>
    <x-slot name="title">{{ __('app.profile.title') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.profile.title'))

    <style>
        .profile-card {
            transition: all 0.2s ease;
        }
        .info-item {
            transition: background-color 0.15s ease;
            padding: 0.75rem;
            margin: -0.75rem;
            border-radius: 0.75rem;
        }
        .info-item:hover {
            background-color: #f8fafc;
        }
        .section-title {
            position: relative;
            padding-bottom: 0.75rem;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 3rem;
            height: 3px;
            background: linear-gradient(90deg, var(--color-primary-500), var(--color-primary-300));
            border-radius: 2px;
        }
    </style>

    <div class="max-w-4xl mx-auto">
        <!-- Profile Header Card -->
        <div class="profile-card bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mb-6">
            <div class="bg-gradient-to-r from-primary-600 to-primary-700 px-6 py-8 sm:px-8">
                <div class="flex flex-col sm:flex-row sm:items-center gap-5">
                    @if(auth()->user()->photo)
                        <img src="{{ Storage::url(auth()->user()->photo) }}" alt=""
                             class="w-20 h-20 rounded-2xl object-cover ring-4 ring-white/30 shadow-lg">
                    @else
                        <div class="w-20 h-20 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center text-white text-2xl font-bold ring-4 ring-white/30 shadow-lg">
                            {{ substr(auth()->user()->first_name, 0, 1) }}{{ substr(auth()->user()->last_name, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-white">{{ auth()->user()->full_name }}</h2>
                        <p class="text-white/80 mt-1">{{ auth()->user()->email }}</p>
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach(auth()->user()->roles as $role)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 text-white backdrop-blur-sm">
                                    {{ __('app.roles.' . $role->name) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    <a href="{{ route('profile.edit') }}"
                       class="inline-flex items-center px-4 py-2.5 bg-white text-primary-700 font-semibold rounded-xl hover:bg-gray-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-primary-600 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        {{ __('app.edit') }}
                    </a>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Personal Info -->
            <div class="profile-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-primary-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('app.profile.personal_info') }}</h3>
                </div>
                <dl class="space-y-4">
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.members.phone') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->phone ?? '-' }}</dd>
                        </div>
                    </div>
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.members.address') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->address ?? '-' }}</dd>
                        </div>
                    </div>
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.members.date_of_birth') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->date_of_birth?->format('d/m/Y') ?? '-' }}</dd>
                        </div>
                    </div>
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.members.gender') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->gender ? __('app.members.' . auth()->user()->gender) : '-' }}</dd>
                        </div>
                    </div>
                </dl>
            </div>

            <!-- Church Info -->
            <div class="profile-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('app.profile.church_info') }}</h3>
                </div>
                <dl class="space-y-4">
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.members.member_since') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->member_since?->format('d/m/Y') ?? '-' }}</dd>
                        </div>
                    </div>
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.members.baptism_date') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->baptism_date?->format('d/m/Y') ?? '-' }}</dd>
                        </div>
                    </div>
                    @if(auth()->user()->bacenta)
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.nav.bacentas') }}</dt>
                            <dd class="font-medium text-gray-900 mt-0.5">{{ auth()->user()->bacenta->name }}</dd>
                        </div>
                    </div>
                    @endif
                    @if(auth()->user()->departments->count() > 0)
                    <div class="info-item flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-400 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                        <div>
                            <dt class="text-sm text-gray-500">{{ __('app.nav.departments') }}</dt>
                            <dd class="mt-1.5 flex flex-wrap gap-1.5">
                                @foreach(auth()->user()->departments as $dept)
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-gray-100 text-gray-700">{{ $dept->name }}</span>
                                @endforeach
                            </dd>
                        </div>
                    </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Actions Card -->
        <div class="profile-card bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mt-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h4 class="font-semibold text-gray-900">{{ __('app.profile.change_password') }}</h4>
                    <p class="text-sm text-gray-500 mt-1">Modifiez votre mot de passe pour sécuriser votre compte</p>
                </div>
                <a href="{{ route('profile.password') }}"
                   class="inline-flex items-center justify-center px-4 py-2.5 text-primary-600 font-semibold rounded-xl border-2 border-primary-200 hover:bg-primary-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 transition-colors group">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                    Changer le mot de passe
                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
