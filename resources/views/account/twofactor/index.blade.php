@extends('account.layouts.default')

@section('account.content')
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __('Two Factor Authentication') }}</h4>

            @if (auth()->user()->twoFactorEnabled())
                <form method="POST" action="{{ route('account.twofactor.destroy') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <p class="form-text">{{ __('Two factor authentication is enabled for your account.') }}</p>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Disable') }}
                        </button>
                    </div>
                </form>
            @elseif(auth()->user()->twoFactorPendingVerification())
                <form method="POST" action="{{ route('account.twofactor.verify') }}">
                    {{ csrf_field() }}

                    <div class="form-group row{{ $errors->has('token') ? ' has-error' : '' }}">
                        <label for="token" class="col-md-4 control-label">{{ __('Verification token') }}</label>

                        <div class="col-md-6">
                            <input id="token" type="text"
                                class="form-control{{ $errors->has('token') ? ' is-invalid' : '' }}" name="token"
                                required autofocus>

                            @if ($errors->has('token'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('token') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Verify') }}
                            </button>
                        </div>
                    </div>
                </form>

                <form class="mt-2" method="POST" action="{{ route('account.twofactor.destroy') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-secondary">
                                {{ __('Cancel verification') }}
                            </button>
                        </div>
                    </div>
                </form>
            @else
                <form method="POST" action="{{ route('account.twofactor.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group row{{ $errors->has('dial_code') ? ' has-error' : '' }}">
                        <label for="dial_code" class="col-md-4 control-label">{{ __('Dial code') }}</label>

                        <div class="col-md-6">
                            <select name="dial_code" id="dial_code"
                                class="form-control custom-select{{ $errors->has('dial_code') ? ' is-invalid' : '' }}">

                                @foreach ($countries as $country)
                                    <option value="{{ $country->dial_code }}"
                                        {{ old('dial_code') === $country->dial_code ? ' selected' : '' }}>
                                        {{ $country->name }} (+{{ $country->dial_code }})
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('dial_code'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('dial_code') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                        <label for="phone_number" class="col-md-4 control-label">{{ __('Phone number') }}</label>

                        <div class="col-md-6">
                            <input id="phone_number" type="text"
                                class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                                name="phone_number" required autofocus>

                            @if ($errors->has('phone_number'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Enable') }}
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection
