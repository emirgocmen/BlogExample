@extends('admin.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ __('categories.update') }} - {{ $category->name }}
@endsection

@section('content')

    <div class="card m-5 p-5">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                @method('PUT')
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
                    label="{{__('categories.name')}}" 
                    name="name"
                    value="{{ $category->name }}"
                />

                <x-checkbox-group-component 
                    label="{{__('categories.sub_category')}}" 
                    name="subcategory"
                    value="{{ $category->pid  ? 'on' : null }}"
                />

                <div id="select-main-category" class="{{ $category->pid ? null : 'd-none' }}">
                    <label for="name" class="w-100">{{ __('categories.main_category') }}</label>
                    <select class="form-control mb-3" name="pid" id="pid">
                        <option value=""></option>
                        @foreach($categories as $category_info)
                            <option class="{{$category_info->status == 1 ? "text-success" : "text-danger" }}" {{ $category->pid == $category_info->id ? "selected" : null }} value="{{ $category_info->id }}">{{ $category_info->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox"  name="status" id="status" {{ $category->status == 1 ? 'checked' : null }}>
                    <label class="form-check-label" for="status">
                        {{ __('categories.active') }}
                    </label>
                </div>

                <button type="submit" class="btn btn-primary d-flex mx-auto">{{ __('categories.update') }}</button>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $("#subcategory").change(function(){
            if($("#subcategory").is(':checked')){
                $("#select-main-category").removeClass("d-none");
            }else{
                $("#select-main-category").addClass("d-none");
            }
        });
    </script>

@endsection