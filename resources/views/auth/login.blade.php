@extends('layouts.app')
 
@section('content')

<div class="container">
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-male-female"></i>
                    </span>
                    <span class="login100-form-title p-b-34 p-t-27">
                        ÖĞRETMEN GİRİŞİ
                    </span>
                    <div class="wrap-input100 validate-input">
                        {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}
                       
                            <input id="email" placeholder="E-Posta" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <span class="focus-input100" data-placeholder="&#xf207;"></span>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                      
                    </div>

                 

                    <div class="wrap-input100 validate-input">
                        {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}
                            <input id="password" placeholder="Parola" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <span class="focus-input100" data-placeholder="&#xf191;"></span>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="contact100-form-checkbox">
                            <div class="form-check">
                                <input class="input-checkbox100" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="label-checkbox100" for="remember">
                                    {{-- {{ __('Remember Me') }} --}}
                                    Beni Hatırla
                                </label>
                            </div>
                    </div>
                    <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                {{-- {{ __('Login') }} --}}
                                Giriş
                            </button>
                    </div>
                        @if (Route::has('password.request'))
                            <div class="text-center p-t-90">
                                <a class="txt1" href="{{ route('password.request') }}">
                                    {{-- {{ __('Forgot Your Password?') }} --}}
                                    Şifremi Unuttum
                                </a>
                            </div>
                        @endif
                    
                </form>
            </div>
        </div>
        <div class="text-center text-white">
            &copy; 2020 | <a class="text-white" href="http://turktelekomeml26.meb.k12.tr/" target="_blank">Türk Telekom M.T.A.L</a> | <a class="text-white" href="https://github.com/ascanipek">ascanipek</a>
        </div>
    </div>
</div>
@endsection
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script>
    $(document).ready(function(){
        randombg()

        function randombg(){
            var random= Math.floor(Math.random() * 7) + 0;
            // background: url('/img/backTwo.jpg') no-repeat center center fixed;
            var bigSize = [
                "url('/img/bg-01.jpg')",
                "url('/img/bg-02.jpg')",
                "url('/img/bg-03.jpg')",
                "url('/img/bg-04.jpg')",
                "url('/img/bg-05.jpg')",
                "url('/img/bg-06.jpg')",
                "url('/img/bg-07.jpg')",
            ];
            // document.getElementById('app').style.backgroundImage = bigSize[random];
            $('body').css({
                'background' : bigSize[random], 
                'background-repeat' : 'no-repeat',
                'background-position': 'center',
                'background-attachment' : 'fixed'
            });
        }
    })

    
</script>