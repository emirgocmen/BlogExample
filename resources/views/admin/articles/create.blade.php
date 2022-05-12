@extends('admin.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ __('articles.create_article') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data">
                @csrf

                @if($errors->any())
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
                    value="{{ old('title') }}"
                />

                <x-textarea-group-component 
                    label="{{__('articles.detail')}}" 
                    name="detail"
                    value="{{ old('detail') }}"
                /> 

                <x-file-group-component 
                    label="{{__('articles.photo')}}" 
                    name="image"
                />

                <div class="input-group mb-3">
                    <label for="category_id" class="w-100">{{ __('articles.category') }}</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option>{{ __('articles.category') }}</option>
                        @foreach($categories as $category)
                            <option class="{{$category->status == 1 ? "text-success" : "text-danger" }}" value="{{ $category->id }}" {{ $category->id == old('category_id') ? "selected" : null }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-checkbox-group-component 
                    label="{{__('articles.active')}}" 
                    name="status"
                    value="{{ old('status') }}"
                />

                <button type="submit" class="btn btn-primary d-flex mx-auto">{{ __('titles.add') }}</button>
            </form>
        </div>
    </div>

@endsection