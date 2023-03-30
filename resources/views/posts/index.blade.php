@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <b>{{ __('Posts List') }}</b>
                    @if(Auth::user()->user_type == 'client')
                        <a class="btn btn-primary btn-sm float-right" href="{{ route('posts.create') }}">Add Post</a> 
                    @endif
                    <div class="">
                        <form action="{{route('posts.index')}}" method="GET" role="search">

                            <div class="input-group">
                                
                                <input type="text" class="form-control mr-2" name="search" placeholder="Search post">
                                <span class="input-group-btn mr-5 mt-1">
                                    <button class="btn btn-info" type="submit" title="Search post">
                                        Search
                                    </button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Client Name</th>
                                <th>Assign Name</th>
                                <th>Description</th>
                                <th>Date</th>   
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>{{$post->id}}</td>
                                    <td><img src="/post_images/{{explode('|',$post->images)[0]}}" width="100" height="100"/></td>
                                    <td>{{$post->title}}</td>
                                    <td>{{$post->name}}</td>
                                    <td>{{ucfirst($post->assignTo)}}</td>
                                    <td>{!!$post->description!!}</td>
                                    <td>{{$post->date}}</td>                             
                                </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
