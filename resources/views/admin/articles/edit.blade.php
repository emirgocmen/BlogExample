@extends('admin.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ __('articles.edit') }} - {{ $article->title }}
@endsection

@section('content')

    <div class="card">
        <img src="{{ asset($article->image) }}" class="card-img-top mx-auto w-25 my-3" alt="{{ $article->title }}" >
        <div class="card-body">
            <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <x-input-group-component 
                    label="{{__('articles.title')}}" 
                    name="title"
                    value="{{ $article->title }}"
                />
                
                <x-textarea-group-component 
                    label="{{__('articles.detail')}}" 
                    name="detail"
                    value="{{ $article->detail }}"
                />

                <x-file-group-component 
                    label="{{__('articles.photo')}}" 
                    name="image"
                />

                <select class="form-control mb-3" name="category_id" id="category_id">
                    @foreach($categories as $category)
                        <option class="{{$category->status == 1 ? "text-success" : "text-danger" }}" value="{{ $category->id }}" {{ $category->id == $article->category_id ? "selected" : null }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                
                <x-checkbox-group-component 
                    label="{{__('articles.active')}}" 
                    name="status"
                    value="{{ $article->status == '1' ? 'on' : null }}"
                />

                <button type="submit" class="btn btn-primary d-flex mx-auto">{{ __('titles.update') }}</button>
            </form>
        </div>
    </div>

@endsection