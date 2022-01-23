<x-layouts.auth>
    <x-slot name="title">Login</x-slot>
    <div class="content-body">
        <div class="auth-wrapper auth-v2">
            <div class="auth-inner row m-0">
                <!-- Brand logo-->
                <a class="brand-logo" href="javascript:void(0);">
                    <?xml version="1.0" standalone="no"?>
                    <!DOCTYPE svg
                        PUBLIC "-//W3C//DTD SVG 20010904//EN" "http://www.w3.org/TR/2001/REC-SVG-20010904/DTD/svg10.dtd">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="38" height="38"
                        viewBox="0 0 137.000000 135.000000" preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,125.000000) scale(0.100000,-0.100000)" fill="#8E73F3"
                            stroke="none">
                            <path d="M590 1263 c-234 -39 -450 -242 -505 -474 -96 -411 229 -800 649 -777
                                277 16 511 206 581 473 8 33 15 101 15 155 0 113 -17 187 -66 287 -78 158
                                -241 287 -416 328 -58 14 -199 18 -258 8z m412 -359 c3 -3 -15 -51 -42 -107
                                -70 -150 -69 -147 -21 -147 42 0 62 -14 35 -24 -9 -3 -33 -6 -54 -6 l-39 0
                                -21 -66 c-11 -36 -20 -88 -20 -114 0 -54 -16 -73 -37 -45 -15 21 -17 120 -4
                                178 l9 39 -36 -7 c-21 -3 -44 -8 -52 -11 -10 -2 -27 -40 -44 -91 -32 -99 -75
                                -153 -120 -153 -74 0 -136 60 -136 132 0 66 71 126 178 149 l49 10 13 57 c6
                                31 20 76 30 100 11 23 15 42 11 42 -4 0 -32 -7 -62 -16 -60 -18 -119 -57 -119
                                -80 0 -22 -18 -17 -36 10 -25 39 -15 68 31 91 33 16 60 20 152 20 64 0 116 -4
                                122 -10 8 -8 0 -38 -24 -100 -19 -48 -35 -92 -35 -97 0 -4 20 -8 44 -8 l44 0
                                18 53 c21 64 60 154 80 185 10 15 24 22 48 22 18 0 35 -3 38 -6z" />
                            <path d="M578 545 c-54 -29 -78 -58 -78 -98 0 -67 56 -94 84 -39 11 21 48 163
                                43 162 -1 -1 -23 -12 -49 -25z" />
                        </g>
                    </svg>
                    <h2 class="brand-text text-primary ml-1">Hapra</h2>
                </a>
                <!-- /Brand logo-->
                <!-- Left Text-->
                <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                    <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img
                            class="img-fluid" src="{{ asset('app-assets/images/pages/login-v2.svg') }}"
                            alt="Login V2" /></div>
                </div>
                <!-- /Left Text-->
                <!-- Login-->
                <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                    <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                        <h2 class="card-title font-weight-bold mb-1">{{ __('Welcome To') }} Hapra! 👋</h2>
                        <p class="card-text mb-2">{{ __('Please sign-in to your account and start the adventure') }}
                        </p>
                        <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="email">{{ __('Email Address') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="text"
                                    name="email" placeholder="{{ __('Your Email') }}" value="{{ old('email') }}"
                                    aria-describedby="email" autofocus="" tabindex="1" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between">
                                    <label for="password">{{ __('Password') }}</label><a
                                        href="page-auth-forgot-password-v2.html"><small>{{ __('Forgot Password?') }}</small></a>
                                </div>
                                <div class="input-group input-group-merge form-password-toggle">
                                    <input
                                        class="form-control form-control-merge  @error('password') is-invalid @enderror"
                                        id="password" type="password" name="password" aria-describedby="password"
                                        tabindex="2" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="input-group-append"><span class="input-group-text cursor-pointer"><i
                                                data-feather="eye"></i></span></div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" id="remember" name="remember" type="checkbox"
                                        tabindex="3" />
                                    <label class="custom-control-label" for="remember">
                                        {{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block"
                                tabindex="4">{{ __('Sign in') }}</button>
                        </form>
                        <p class="text-center mt-2"><span>New on our platform?</span><a
                                href="page-auth-register-v2.html"><span>&nbsp;{{ __('Create an account') }}</span></a>
                        </p>
                        <div class="divider my-2">
                            <div class="divider-text">or</div>
                        </div>
                        <div class="auth-footer-btn d-flex justify-content-center"><a class="btn btn-facebook"
                                href="javascript:void(0)"><i data-feather="facebook"></i></a><a
                                class="btn btn-twitter white" href="javascript:void(0)"><i
                                    data-feather="twitter"></i></a><a class="btn btn-google"
                                href="javascript:void(0)"><i data-feather="mail"></i></a><a class="btn btn-github"
                                href="javascript:void(0)"><i data-feather="github"></i></a></div>
                    </div>
                </div>
                <!-- /Login-->
            </div>
        </div>
    </div>
</x-layouts.auth>
