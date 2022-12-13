@extends('layouts.auth')

@section('content')
    <form class="card card-md" action="{{ route('login') }}" method="post" autocomplete="off">
        @csrf
        <div class="card-body p-4">
            <h3 class="mb-4">Siap untuk ambil langkah berikutnya?</h3>
            <div class="">
                <div class="mb-3">
                    <label class="form-label">{{ __('Nama Pengguna') }}</label>
                    <input type="text" name="username" value="{{ old('username') }}"
                        class="form-control @error('username') is-invalid @enderror"
                        placeholder="{{ __('Nama Pengguna Anda') }}" required autofocus tabindex="1">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label class="form-label">
                        {{ __('Kata Sandi') }}
                    </label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="{{ __('Kata Sandi Anda') }}" required tabindex="2">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" tabindex="3" name="remember" />
                        <span class="form-check-label">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-blue shadow w-100" tabindex="4"><i
                            class='bx bxs-log-in-circle me-1'></i>Masuk</button>
                </div>
            </div>
        </div>
    </form>
    <div class="text-center mt-3">
        <code>Developed by &copy; ASTA PIJAR KREASI TEKNOLOGI ∘ {{ date('Y') }}</code>
    </div>
@endsection
