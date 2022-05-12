@extends('admin.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ __('titles.articles') }}
@endsection


@section('content')

<div id="content-wrapper" class="d-flex flex-column">

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-primary">{{ __('titles.articles') }}</h1>
        </div>

        <div class="d-flex">
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary my-3 mx-auto">{{ __('articles.create_article') }}</a>
        </div>

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                        <thead class="text-primary">
                            <tr>
                                <th>{{ __('articles.title') }}</th>
                                <th>{{ __('articles.category') }}</th>
                                <th>{{ __('articles.status') }}</th>
                                <th>{{ __('articles.created_by') }}</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <th style="width:40%">{{ $article->title }}</th>
                                    <th>{{ $article->category->name }}</th>
                                    <th>{{ $article->status == 1 ? __('articles.active') : __('articles.passive') }}</th>
                                    <th>{{ $article->createdBy->name }}</th>
                                    <th class="text-center">
                                        @if($article->status && $article->category->status)
                                            <a href="{{ route('front.detail', [$article->category->slug, $article->slug]) }}" class="px-1" target="_blank"><i class="fa-regular fa-eye fa-lg text-success"></i></a>
                                        @endif
                                        <a href="{{ route('admin.articles.edit', $article->id) }}" class="px-1"><i class="fa-solid fa-pen-to-square fa-lg text-primary"></i></a>
                                        <a href="{{ route('admin.articles.destroy', $article->id) }}" class="px-1"><i class="fa-solid fa-trash fa-lg text-danger"></i></a>
                                    </th>
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