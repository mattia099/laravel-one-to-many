@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3>{{__('Modifica')}}</h3></div>

              <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
              
                <form action="{{ route('admin.posts.update',$post) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" class="form-control @error ('title') is-invalid @enderror" name="title" id="title" value="{{ $post->title }}">
                    @error('title')
                      <div class="invalid-feedback">{{ $message }}</div>    
                    @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label for="content" class="form-label">Content*</label>
                    <textarea class="form-control @error ('content') is-invalid @enderror" name="content" id="content">{{$post->content}}</textarea>
                    
                    @error('content')
                      <div class="invalid-feedback">{{ $message }}</div>    
                    @enderror
                  </div>
                  <div class="form-group mb-3">
                    <label for="published_at" class="form-label">Published at</label>
                    <input type="date" class="form-control" name="published_at" id="publishered_at" value="{{ Str::substr($post->published_at, 0, 10) }}">
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Salva</button>
                </form>
                
              </div>
          </div>
      </div>
  </div>
</div>
@endsection