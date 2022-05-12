@extends('admin.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ __('categories.create_category') }}
@endsection

@section('content')

    <div class="card m-5 p-5">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.categories.store') }}">
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

                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <x-input-group-component 
                    label="{{__('categories.name')}}" 
                    name="name"
                    value="{{ old('name') }}"
                />
                
                <x-checkbox-group-component 
                    label="{{__('categories.sub_category')}}" 
                    name="subcategory"
                    value="{{ old('subcategory') }}"
                />

                <div id="select-main-category" class="{{ old('subcategory') == 'on' ? null : 'd-none' }}">
                    <label for="name" class="w-100">{{ __('categories.main_category') }}</label>
                    <select class="form-control mb-3" name="pid" id="pid">
                        <option value=""></option>
                        @foreach($categories as $category)
                            <option class="{{$category->status == 1 ? "text-success" : "text-danger" }}" {{old('pid') == $category->id ? "selected" : null }} value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-checkbox-group-component 
                    label="{{__('categories.active')}}" 
                    name="status"
                    value="{{ old('status') }}"
                />

                <button type="submit" class="btn btn-primary d-flex mx-auto">{{ __('categories.add') }}</button>
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