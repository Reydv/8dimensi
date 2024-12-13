<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Tanggal Lahir -->
        <br>
        <div>
            <x-input-label for="tanggal_lahir" :value="__('Tanggal Lahir')" />
            <x-text-input id="tanggal_lahir" class="block mt-1 w-full" type="date" name="tanggal_lahir"/>
            <x-input-error :messages="$errors->get('tanggal_lahir')" class="mt-2" />
        </div>

        <!-- Jenis Kelamin -->
        <br>
        <div>
            <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
            <x-text-input id="jenis_kelamin" class="block mt-1 w-full" type="text" name="jenis_kelamin"/>
            <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nomor Telepon -->
        <br>
        <div>
            <x-input-label for="notelp" :value="__('Nomor Telepon')" />
            <x-text-input id="notelp" class="block mt-1 w-full" type="text" name="notelp"/>
            <x-input-error :messages="$errors->get('notelp')" class="mt-2" />
        </div>

        <!-- Pendidikan Terakhir -->
        <br>
        <div>
            <x-input-label for="pendidikan_terakhir" :value="__('Pendidikan Terakhir')" />
            <x-text-input id="pendidikan_terakhir" class="block mt-1 w-full" type="text" name="pendidikan_terakhir"/>
            <x-input-error :messages="$errors->get('pendidikan_terakhir')" class="mt-2" />
        </div>

        <!-- Institusi -->
        <br>
        <div>
            <x-input-label for="institusi" :value="__('Institusi')" />
            <x-text-input id="institusi" class="block mt-1 w-full" type="text" name="institusi"/>
            <x-input-error :messages="$errors->get('institusi')" class="mt-2" />
        </div>

        <!-- jurusan -->
        <br>
        <div>
            <x-input-label for="jurusan" :value="__('Jurusan')" />
            <x-text-input id="jurusan" class="block mt-1 w-full" type="text" name="jurusan"/>
            <x-input-error :messages="$errors->get('jurusan')" class="mt-2" />
        </div>

        <!-- perusahaan -->
        <br>
        <div>
            <x-input-label for="perusahaan" :value="__('Perusahaan')" />
            <x-text-input id="perusahaan" class="block mt-1 w-full" type="text" name="perusahaan"/>
            <x-input-error :messages="$errors->get('perusahaan')" class="mt-2" />
        </div>

        <!-- jabatan -->
        <br>
        <div>
            <x-input-label for="jabatan" :value="__('Jabatan')" />
            <x-text-input id="jabatan" class="block mt-1 w-full" type="text" name="jabatan"/>
            <x-input-error :messages="$errors->get('jabatan')" class="mt-2" />
        </div>

        <!-- masa_kerja -->
        <br>
        <div>
            <x-input-label for="masa_kerja" :value="__('Masa Kerja')" />
            <x-text-input id="masa_kerja" class="block mt-1 w-full" type="text" name="masa_kerja"/>
            <x-input-error :messages="$errors->get('masa_kerja')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
