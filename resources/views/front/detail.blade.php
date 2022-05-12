@extends('front.layouts.app')

@section('title')
    {{ config('app.name') }} - {{ $article->title }}
@endsection

@section('content')

<header class="masthead" style="background-image: url('{{ asset($article->image) }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $article->title }}</h1>
                    <span class="meta">
                        Yazar: <span class="text-primary">{{ $article->createdBy->name }}</span>
                        <br><br>
                        Kategori: <a class="text-primary" href="../{{ $article->category->slug }}">{{ $article->category->name }}</a>
                        <br><br>
                        {{ $article->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-9">
            <article class="mb-4">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-7">
                            <p>
                                {{ $article->detail }}
                            </p>
                        </div>
                    </div>
                </div>
            </article>
        </div>

        @include('front.widgets.category')

    </div>
</div>

@endsection