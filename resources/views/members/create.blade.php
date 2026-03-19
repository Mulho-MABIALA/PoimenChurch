<x-app-layout>
    <x-slot name="title">{{ __('app.members.add') }} - {{ config('app.name') }}</x-slot>

    @section('page-title', __('app.members.add'))

    <div class="mb-6">
        <a href="{{ route('members.index') }}" class="text-primary-600 hover:text-primary-700 flex items-center">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            {{ __('app.back') }}
        </a>
    </div>

    <form method="POST" action="{{ route('members.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Info -->
            <div class="lg:col-span-2 space-y-6">
                <div class="card">
                    <h3 class="text-lg font-semibold text-primary-700 mb-4">Informations personnelles</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="first_name" class="label">{{ __('app.members.first_name') }} *</label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required
                                class="input @error('first_name') input-error @enderror">
                            @error('first_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="last_name" class="label">{{ __('app.members.last_name') }} *</label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required
                                class="input @error('last_name') input-error @enderror">
                            @error('last_name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="label">{{ __('app.members.email') }} *</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="input @error('email') input-error @enderror">
                            @error('email')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone" class="label">{{ __('app.members.phone') }} *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                class="input @error('phone') input-error @enderror">
                            @error('phone')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date_of_birth" class="label">{{ __('app.members.date_of_birth') }}</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                class="input @error('date_of_birth') input-error @enderror">
                            @error('date_of_birth')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="gender" class="label">{{ __('app.members.gender') }}</label>
                            <select id="gender" name="gender" class="input @error('gender') input-error @enderror">
                                <option value="">--</option>
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>{{ __('app.members.male') }}</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>{{ __('app.members.female') }}</option>
                            </select>
                            @error('gender')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group md:col-span-2">
                            <label for="address" class="label">{{ __('app.members.address') }}</label>
                            <textarea id="address" name="address" rows="2" class="input @error('address') input-error @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="occupation" class="label">{{ __('app.members.occupation') }}</label>
                            <input type="text" id="occupation" name="occupation" value="{{ old('occupation') }}"
                                class="input @error('occupation') input-error @enderror">
                            @error('occupation')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="workplace" class="label">{{ __('app.members.workplace') }}</label>
                            <input type="text" id="workplace" name="workplace" value="{{ old('workplace') }}"
                                class="input @error('workplace') input-error @enderror">
                            @error('workplace')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3 class="text-lg font-semibold text-primary-700 mb-4">Informations eglise</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="member_since" class="label">{{ __('app.members.member_since') }}</label>
                            <input type="date" id="member_since" name="member_since" value="{{ old('member_since') }}"
                                class="input @error('member_since') input-error @enderror">
                            @error('member_since')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="baptism_date" class="label">{{ __('app.members.baptism_date') }}</label>
                            <input type="date" id="baptism_date" name="baptism_date" value="{{ old('baptism_date') }}"
                                class="input @error('baptism_date') input-error @enderror">
                            @error('baptism_date')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="church_class" class="label">{{ __('app.members.church_class') }}</label>
                            <input type="text" id="church_class" name="church_class" value="{{ old('church_class') }}"
                                class="input @error('church_class') input-error @enderror">
                            @error('church_class')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="school_class" class="label">{{ __('app.members.school_class') }}</label>
                            <input type="text" id="school_class" name="school_class" value="{{ old('school_class') }}"
                                class="input @error('school_class') input-error @enderror">
                            @error('school_class')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3 class="text-lg font-semibold text-primary-700 mb-4">Rattachements</h3>

                    @error('zone_ids')
                        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg">
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        </div>
                    @enderror

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-group">
                            <label for="branch_ids" class="label">Branches *</label>
                            <select id="branch_ids" name="branch_ids[]" multiple class="input" style="height: auto;">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" {{ in_array($branch->id, old('branch_ids', [])) ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="form-help text-amber-600">Le membre doit appartenir à au moins une branche OU une zone</p>
                        </div>

                        <div class="form-group">
                            <label for="zone_ids" class="label">Zones *</label>
                            <select id="zone_ids" name="zone_ids[]" multiple class="input" style="height: auto;">
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}" {{ in_array($zone->id, old('zone_ids', [])) ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="form-help">Maintenez Ctrl pour selectionner plusieurs</p>
                        </div>

                        <div class="form-group">
                            <label for="bacenta_ids" class="label">Bacentas</label>
                            <select id="bacenta_ids" name="bacenta_ids[]" multiple class="input" style="height: auto;">
                                @foreach($bacentas as $bacenta)
                                    <option value="{{ $bacenta->id }}" {{ in_array($bacenta->id, old('bacenta_ids', [])) ? 'selected' : '' }}>
                                        {{ $bacenta->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="label">{{ __('app.nav.departments') }}</label>
                            <select name="department_ids[]" multiple class="input" style="height: auto;">
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}" {{ in_array($department->id, old('department_ids', [])) ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <div class="card">
                    <h3 class="text-lg font-semibold text-primary-700 mb-4">Photo</h3>

                    <div class="form-group">
                        <div class="flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="text-sm text-gray-500">Cliquez pour telecharger</p>
                                    <p class="text-xs text-gray-400">PNG, JPG (Max. 2MB)</p>
                                </div>
                                <input type="file" name="photo" class="hidden" accept="image/*">
                            </label>
                        </div>
                        @error('photo')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="card">
                    <h3 class="text-lg font-semibold text-primary-700 mb-4">Roles & Acces</h3>

                    <div class="form-group">
                        <label class="label">Roles</label>
                        <div class="space-y-2">
                            @foreach($roles as $role)
                            <label class="flex items-center">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                    {{ in_array($role->name, old('roles', ['member'])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                <span class="ml-2 text-sm">{{ __('app.roles.' . $role->name) }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="label">Mot de passe</label>
                        <input type="password" id="password" name="password"
                            class="input @error('password') input-error @enderror"
                            placeholder="Laisser vide pour 'password123'">
                        @error('password')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                            <span class="ml-2 text-sm">{{ __('app.members.is_active') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="submit" class="btn-primary flex-1">{{ __('app.save') }}</button>
                    <a href="{{ route('members.index') }}" class="btn-outline">{{ __('app.cancel') }}</a>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
