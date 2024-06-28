<section>
    <style>
        .button_file_input {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 8px 12px 8px 16px;
            gap: 8px;
            border: none;
            background: #c7d2fe;
            border-radius: 20px;
            cursor: pointer;
        }

        .lable {
            margin-top: 1px;
            font-size: 15px;
            line-height: 22px;
            color: #056DFA;
            font-family: sans-serif;
            letter-spacing: 1px;
        }

        .button_file_input:hover {
            background: #6366f1;
        }

        .button_file_input:hover .lable {
            color: white;
        }

        

        .button_file_input:hover .svg-icon {
            animation: spin 1s linear infinite;
        }

        .button_file_input:hover .svg-icon g {
            stroke: white
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-8deg);
            }

            50% {
                transform: rotate(0deg);
            }

            75% {
                transform: rotate(8deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }
    </style>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="image" :value="__('Image Profile')" />
            <img src="{{ asset('storage/' . $user->image) }}" alt="Profile User" width="150" class="mb-3">

            <!-- Hidden File Input -->
            {{-- <input type="file" id="image" name="image" class="hidden" onchange="updateFileName()"> --}}
            <input type="file" id="image" name="image" class="hidden">

            <!-- Custom Button -->
            <label for="image" class="button_file_input">
                <svg class="svg-icon" width="24" viewBox="0 0 24 24" height="24" fill="none">
                    <g stroke-width="2" stroke-linecap="round" stroke="#056dfa" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z">
                        </path>
                        <path
                            d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z">
                        </path>
                    </g>
                </svg>
                <span class="lable">Choose File</span>
            </label>

            <!-- Display File Name -->
            <span id="file-name" class="ml-2 text-gray-600"></span>

            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    {{-- <script>
        const updateFileName = () => {
            const input = document.getElementById('image');
            const fileName = input.files[0] ? input.files[0].name : 'Tidak ada file yang dipilih';
            document.getElementById('file-name').textContent = fileName;
        }
    </script> --}}
</section>
