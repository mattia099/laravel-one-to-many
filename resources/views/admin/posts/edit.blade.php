@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header"><h3>{{__('Create')}}</h3></div>

              <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
              
                <form action="{{ route('admin.posts.store') }}" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="title" class="form-label">Title*</label>
                    <input type="text" class="form-control @error ('title') is-invalid @enderror" name="title" id="title" value="{{ old('title') ?: $post->title }}">
                    @error('title')
                      <div class="invalid-feedback">{{ $message }}</div>    
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="content" class="form-label">Content*</label>
                    <textarea type="text" class="form-control @error ('content') is-invalid @enderror" name="content" id="content" value="{{ old('content') ?:$pos->content }}"></textarea>
                    @error('content')
                      <div class="invalid-feedback">{{ $message }}</div>    
                    @enderror
                  </div>
                  <div class="mb-3">
                    <label for="published_at" class="form-label">Published at</label>
                    <input type="date" class="form-control" name="date" id="date" value="{{ old('published_at') }}">
                  </div>
                  
                  <button type="submit" class="btn btn-primary">Create</button>
                </form>
              </div>
          </div>
      </div>
  </div>
</div>
@section