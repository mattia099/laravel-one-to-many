@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h4>Post</h4>
                  <h5><a href="{{route('admin.home')}}">Torna alla dashboard</a></h5>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                      @foreach ($posts as $post)
                      <li>
                        <h3>{{$post->title}}</h3>
                        <p>{{$post->content}}</p>
                      </li> 
                      @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection