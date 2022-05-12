@extends('admin.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ __('titles.categories') }}
@endsection

@section('content')

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-primary">{{ __('titles.categories') }}</h1>
        </div>

        <div class="d-flex">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary my-3 mx-auto">{{ __('categories.create_category') }}</a>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        
        <div class="card shadow mb-4">
            <div class="card-body">

                <div class="alert alert-warning text-center" role="alert">
                    {{ __('categories.deleting_main_category') }}
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center" width="100%" cellspacing="0">
                        <thead class="text-primary">
                            <tr>
                                <th>{{ __('categories.name') }}</th>
                                <th>{{ __('categories.category_level') }}</th>
                                <th>{{ __('categories.status') }}</th>
                                <th>{{ __('categories.article_count') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        {{ $category->pid  == null ? __('categories.main_category') : __('categories.sub_category')." -Main Category:".$category->mainCategory->name }}
                                    </td>
                                    <td>
                                        {{ $category->status  == 1 ? __('categories.active') : __('categories.passive') }}
                                    </td>
                                    <td>
                                        {{ $category->articles_count }}
                                    </td>
                                    <td>
                                        @if($category->status)
                                            <a href="{{ route('front.category', $category->slug) }}" target="_blank"><i class="fa-regular fa-eye fa-lg text-success"></i></a>
                                        @endif
                                        <a href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa-solid fa-pen-to-square fa-lg text-primary"></i></a>

                                       <a onclick="deleteCategory(this)" category_id="{{ $category->id }}" articles_count="{{ $category->articles_count }}"  style="cursor: pointer"><i class="fa-solid fa-trash fa-lg text-danger"></i></a>
                                       
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    function deleteCategory(x)
    {
        var id = x.getAttribute("category_id");
        var count = parseInt(x.getAttribute("articles_count"));
        var textmsg;

        if (count > 0) {
            textmsg = count + " {{ __('categories.delete_message_detail') }}";
        } else {
            textmsg = "";
        }

        Swal.fire({
            title: "{{ __('categories.delete_message_title') }}",
            text: textmsg,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('categories.delete_message_confirm') }}",
            cancelButtonText: "{{ __('categories.delete_message_cancel') }}",
            }).then((result) => {
            if (result.isConfirmed) {
                location.href="categories/"+id;
            }
        });
    }
</script>

@endsection