@extends('layouts.index')

@include('components.progressive-image')

@section('title', 'Ganti Password')

@section('content')
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mx-4">
                <div class="card-body p-4">
                    <form method="post" action="{{ route('password.change') }}">
                        @csrf
                        <h1>Ganti Password</h1>

                        <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-lock"></i>
                            </span>
                          <input type="password" class="form-control {{ $errors->has('password_old')?'is-invalid':''}}" name="password_old" placeholder="Password lama" required >
                          @if ($errors->has('password_old'))
                              <span class="invalid-feedback">
                                  <strong>{{ $errors->first('password_old') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="input-group mb-3">
                              <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                              </span>
                            <input type="password" class="form-control {{ $errors->has('password')?'is-invalid':''}}" name="password" placeholder="Password baru" required >
                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input type="password" name="password_confirmation" class="form-control"
                                   placeholder="Konfirmasi password baru" required >
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                               </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-block btn-primary btn-block btn-flat">
                            <i class="fa fa-btn fa-refresh"></i> Simpan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
