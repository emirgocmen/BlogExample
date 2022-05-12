@extends('admin.layouts.guest')
  
@section('title')
    {{ config('app.name') }} - {{ __('auth.login') }}
@endsection

@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center my-5">

        <div class="col-12 col-md-8 col-lg-5 my-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-5">

                                <div class="d-flex justify-content-center mb-3">
                                    @foreach (Config::get('languages') as $lang => $language)
                                        <a class="p-1" href="{{ route('lang.switch', $lang) }}"><img src="../back/img/flags/{{$language['icon']}}" width="35" height="30"></a>
                                    @endforeach
                                </div>

                                @if(session('fail'))
                                    <div class="text-danger mb-2">{{session('fail')}}</div>
                                @endif

                                <form method="POST" action="{{ route('auth.loginEvent') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="{{ __('auth.email') }}" name="email" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="{{ __('auth.password') }}" name="password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary d-flex mx-auto">{{ __('auth.login') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

@endsection