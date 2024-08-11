<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Surname -->
                        <div class="mt-4">
                            <x-input-label for="surname" :value="__('Surname')" />
                            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $user->surname)" required autocomplete="surname" />
                            <x-input-error :messages="$errors->get('surname')" class="mt-2" />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-input-label for="address" :value="__('Address')" />
                            <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->userMeta->address ?? '')" autocomplete="street-address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>

                        <!-- ZIP Code -->
                        <div class="mt-4">
                            <x-input-label for="zip_code" :value="__('ZIP Code')" />
                            <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code', $user->userMeta->zip_code ?? '')" autocomplete="postal-code" />
                            <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                        </div>

                        <!-- City -->
                        <div class="mt-4">
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $user->userMeta->city ?? '')" autocomplete="address-level2" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <!-- Province -->
                        <div class="mt-4">
                            <x-input-label for="province" :value="__('Province')" />
                            <x-text-input id="province" class="block mt-1 w-full" type="text" name="province" :value="old('province', $user->userMeta->province ?? '')" autocomplete="address-level1" />
                            <x-input-error :messages="$errors->get('province')" class="mt-2" />
                        </div>

                        <!-- Country -->
                        <div class="mt-4">
                            <x-input-label for="country_id" :value="__('Country')" />
                            <select id="country_id" name="country_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id', $user->userMeta->country_id ?? '') == $country->id ? 'selected' : '' }}>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                        </div>

                        <!-- Is Admin (only visible to admins) -->
                        @if(Auth::user()->is_admin)
                            <div class="mt-4">
                                <x-input-label for="is_admin" :value="__('Admin Status')" />
                                <select id="is_admin" name="is_admin" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="0" {{ old('is_admin', $user->is_admin) == 0 ? 'selected' : '' }}>Regular User</option>
                                    <option value="1" {{ old('is_admin', $user->is_admin) == 1 ? 'selected' : '' }}>Admin</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_admin')" class="mt-2" />
                            </div>
                        @endif

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>