<x-app-layout>
    <x-slot name="title">{{ __('app.attendance.submit_report') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.attendance.submit_report'))

    <style>
        .report-type-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .report-type-card:hover {
            transform: translateY(-2px);
        }
        .report-type-card.selected {
            border-color: #1F4D2B;
            background: linear-gradient(135deg, rgba(31, 77, 43, 0.05), rgba(31, 77, 43, 0.1));
            box-shadow: 0 4px 20px -4px rgba(31, 77, 43, 0.25);
        }
        .report-type-card.selected .type-icon {
            background: linear-gradient(135deg, #1F4D2B, #2d6a3e);
            color: white;
        }
        .input-modern {
            transition: all 0.2s ease;
            border: 2px solid #e5e7eb;
        }
        .input-modern:focus {
            border-color: #1F4D2B;
            box-shadow: 0 0 0 4px rgba(31, 77, 43, 0.1);
        }
        .number-input-wrapper {
            position: relative;
        }
        .number-input-wrapper input::-webkit-outer-spin-button,
        .number-input-wrapper input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .increment-btn {
            transition: all 0.15s ease;
        }
        .increment-btn:hover {
            background-color: #1F4D2B;
            color: white;
        }
        .increment-btn:active {
            transform: scale(0.95);
        }
    </style>

    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-br from-primary-700 via-primary-600 to-primary-800 p-8 shadow-xl">
            <div class="absolute inset-0 overflow-hidden">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-gold-500/20 rounded-full blur-3xl"></div>
            </div>
            <div class="relative z-10">
                <a href="{{ route('reports.index') }}" class="inline-flex items-center text-white/80 hover:text-white mb-4 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Retour aux rapports
                </a>
                <h1 class="text-3xl font-bold text-white mb-2">Soumettre un rapport</h1>
                <p class="text-primary-100">Enregistrez les présences et offrandes de votre réunion</p>
            </div>
        </div>

        <form method="POST" action="{{ route('reports.store') }}" class="space-y-6">
            @csrf

            <!-- Step 1: Select Bacenta -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-3">1</span>
                        <div>
                            <h3 class="font-semibold text-gray-900">Sélectionner le Bacenta</h3>
                            <p class="text-sm text-gray-500">Choisissez le bacenta concerné par ce rapport</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <select id="bacenta_id" name="bacenta_id" required
                        class="w-full px-4 py-3 rounded-xl input-modern bg-white text-gray-900 font-medium @error('bacenta_id') border-red-500 @enderror">
                        <option value="">-- Sélectionner un bacenta --</option>
                        @foreach($bacentas as $bacenta)
                            <option value="{{ $bacenta->id }}" {{ old('bacenta_id') == $bacenta->id ? 'selected' : '' }}>
                                {{ $bacenta->name }} — {{ $bacenta->zone?->name ?? 'Sans zone' }}
                            </option>
                        @endforeach
                    </select>
                    @error('bacenta_id')
                        <p class="mt-2 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <!-- Step 2: Report Type -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-3">2</span>
                        <div>
                            <h3 class="font-semibold text-gray-900">Type de réunion</h3>
                            <p class="text-sm text-gray-500">Sélectionnez le type de service</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Bacenta Meeting -->
                        <label class="report-type-card cursor-pointer block p-5 rounded-xl border-2 border-gray-200 hover:border-primary-300" id="type-bacenta">
                            <input type="radio" name="report_type" value="bacenta_meeting" class="hidden" {{ old('report_type', 'bacenta_meeting') === 'bacenta_meeting' ? 'checked' : '' }}>
                            <div class="flex items-start">
                                <div class="type-icon shrink-0 w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ __('app.attendance.bacenta_meeting') }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Réunion de cellule en semaine</p>
                                </div>
                            </div>
                        </label>

                        <!-- Sunday Service -->
                        <label class="report-type-card cursor-pointer block p-5 rounded-xl border-2 border-gray-200 hover:border-primary-300" id="type-sunday">
                            <input type="radio" name="report_type" value="sunday_service" class="hidden" {{ old('report_type') === 'sunday_service' ? 'checked' : '' }}>
                            <div class="flex items-start">
                                <div class="type-icon shrink-0 w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">{{ __('app.attendance.sunday_service') }}</p>
                                    <p class="text-sm text-gray-500 mt-1">Culte dominical à l'église</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('report_type')
                        <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Step 3: Date & Numbers -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white text-sm font-bold mr-3">3</span>
                        <div>
                            <h3 class="font-semibold text-gray-900">Détails du rapport</h3>
                            <p class="text-sm text-gray-500">Date, présences et offrandes</p>
                        </div>
                    </div>
                </div>
                <div class="p-6 space-y-6">
                    <!-- Date -->
                    <div>
                        <label for="report_date" class="block text-sm font-semibold text-gray-700 mb-2">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                Date de la réunion
                            </span>
                        </label>
                        <input type="date" id="report_date" name="report_date"
                            value="{{ old('report_date', now()->format('Y-m-d')) }}"
                            required max="{{ now()->format('Y-m-d') }}"
                            class="w-full md:w-auto px-4 py-3 rounded-xl input-modern @error('report_date') border-red-500 @enderror">
                        @error('report_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Attendance & Offering -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Attendance Count -->
                        <div class="bg-gradient-to-br from-primary-50 to-white p-5 rounded-xl border border-primary-100">
                            <label class="block text-sm font-semibold text-primary-800 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Nombre de présents
                                </span>
                            </label>
                            <div class="number-input-wrapper flex items-center">
                                <button type="button" onclick="decrementValue('attendance_count')"
                                    class="increment-btn w-12 h-12 rounded-l-xl bg-primary-100 text-primary-700 font-bold text-xl flex items-center justify-center border-2 border-r-0 border-primary-200">
                                    −
                                </button>
                                <input type="number" id="attendance_count" name="attendance_count"
                                    value="{{ old('attendance_count', 0) }}" required min="0"
                                    class="w-full h-12 text-center text-2xl font-bold text-primary-700 border-2 border-primary-200 focus:border-primary-500 focus:ring-0 @error('attendance_count') border-red-500 @enderror">
                                <button type="button" onclick="incrementValue('attendance_count')"
                                    class="increment-btn w-12 h-12 rounded-r-xl bg-primary-100 text-primary-700 font-bold text-xl flex items-center justify-center border-2 border-l-0 border-primary-200">
                                    +
                                </button>
                            </div>
                            <p class="mt-2 text-xs text-primary-600 text-center">personnes présentes</p>
                            @error('attendance_count')
                                <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Offering Amount -->
                        <div class="bg-gradient-to-br from-gold-50 to-white p-5 rounded-xl border border-gold-100">
                            <label class="block text-sm font-semibold text-gold-800 mb-3">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Montant des offrandes
                                </span>
                            </label>
                            <div class="relative">
                                <input type="number" id="offering_amount" name="offering_amount"
                                    value="{{ old('offering_amount', 0) }}" min="0" step="100"
                                    class="w-full h-12 pl-4 pr-16 text-2xl font-bold text-gold-700 rounded-xl border-2 border-gold-200 focus:border-gold-500 focus:ring-0 @error('offering_amount') border-red-500 @enderror">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gold-600 font-semibold">XOF</span>
                            </div>
                            <p class="mt-2 text-xs text-gold-600 text-center">collectées pendant la réunion</p>
                            @error('offering_amount')
                                <p class="mt-2 text-sm text-red-600 text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Notes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                    <div class="flex items-center">
                        <span class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-400 text-white text-sm font-bold mr-3">4</span>
                        <div>
                            <h3 class="font-semibold text-gray-900">Notes <span class="text-gray-400 font-normal">(optionnel)</span></h3>
                            <p class="text-sm text-gray-500">Observations, nouveaux venus, points de prière...</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <textarea id="notes" name="notes" rows="4"
                        class="w-full px-4 py-3 rounded-xl input-modern resize-none @error('notes') border-red-500 @enderror"
                        placeholder="Ajoutez vos observations ici... (nouveaux visiteurs, témoignages, besoins de prière, etc.)">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit"
                    class="flex-1 inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl shadow-lg shadow-primary-500/30 hover:shadow-xl hover:shadow-primary-500/40 hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Soumettre le rapport
                </button>
                <a href="{{ route('reports.index') }}"
                    class="inline-flex items-center justify-center px-8 py-4 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-200 hover:bg-gray-50 hover:border-gray-300 transition-all duration-200">
                    Annuler
                </a>
            </div>

            <!-- Info Banner -->
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-5 border border-blue-100">
                <div class="flex items-start">
                    <div class="shrink-0 w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center mr-4">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-blue-900">Rappel important</p>
                        <p class="text-sm text-blue-700 mt-1">
                            Chaque bacenta doit soumettre <strong>2 rapports par semaine</strong> :
                            un pour la réunion de bacenta (en semaine) et un pour le culte du dimanche.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Report type selection
        document.querySelectorAll('input[name="report_type"]').forEach(radio => {
            radio.addEventListener('change', updateReportTypeUI);
        });

        function updateReportTypeUI() {
            document.querySelectorAll('.report-type-card').forEach(card => {
                card.classList.remove('selected');
            });

            const checked = document.querySelector('input[name="report_type"]:checked');
            if (checked) {
                checked.closest('.report-type-card').classList.add('selected');
            }
        }

        // Initialize on page load
        updateReportTypeUI();

        // Number increment/decrement functions
        function incrementValue(id) {
            const input = document.getElementById(id);
            const step = id === 'offering_amount' ? 1000 : 1;
            input.value = parseInt(input.value || 0) + step;
            input.dispatchEvent(new Event('change'));
        }

        function decrementValue(id) {
            const input = document.getElementById(id);
            const step = id === 'offering_amount' ? 1000 : 1;
            const newValue = parseInt(input.value || 0) - step;
            input.value = newValue >= 0 ? newValue : 0;
            input.dispatchEvent(new Event('change'));
        }
    </script>
    @endpush
</x-app-layout>
