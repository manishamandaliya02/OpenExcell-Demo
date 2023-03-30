@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Post') }}</div>

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

                <form method="POST" id="regForm" enctype = "multipart/form-data" action="{{ route('posts.store') }}">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" name="name" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                            <div class="col-md-6">
                            <textarea id="myeditorinstance" name="description"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Images') }}</label>
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control" multiple name="image[]" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="date" class="col-md-4 col-form-label text-md-end">{{ __('Date') }}</label>
                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control" name="date" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="assignTo" class="col-md-4 col-form-label text-md-end">{{ __('Assign To') }}</label>
                            <div class="col-md-6">
                                <select id="assignTo" class="form-control" name="assignTo">
                                    <option value="client">Client</option>
                                    <option value="designer">Designer</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
