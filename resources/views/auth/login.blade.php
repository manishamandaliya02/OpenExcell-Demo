@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                        @if(Session::has("success"))
                            <div class="alert alert-success">
                                {{Session::get("success")}}
                            </div>
                        @elseif(Session::has("failed")) 
                        <div class="alert alert-danger"> 
                            {{Session::get("failed")}}
                        </div>
                        @endif
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <!-- <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button> -->

                                <a href="{{ url('auth/facebook') }}" class="btn btn-primary">
                                    {{ __('Facebook With Login') }}
                                </a>

                                <a href="{{ url('authorized/google') }}" class="btn btn-primary">
                                    {{ __('Google With Login') }}
                                </a>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
