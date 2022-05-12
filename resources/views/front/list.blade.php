@extends('front.layouts.app')
  
@section('title')
    {{ config('app.name') }} - {{ $articles->first()->category->name }}
@endsection

@section('content')

    <!-- Page Header-->
    <header class="masthead" style="background-image: url('{{asset('front/assets/img/home-bg.jpg')}}')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Blog</h1>
                        <span class="subheading">
                            {{ $articles->first() ? $articles->first()->category->name : null }}
                    </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Content-->    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-9">
                @if(count($articles))
                    @foreach($articles as $article)
                        @if(!$loop->first)
                            <hr class="my-4" />
                        @endif
                        <div class="post-preview">
                            <a href="{{ route('front.detail',[$article->category->slug,$article->slug]) }}">
                                <h2 class="post-title">{{ $article->title }}</h2>
                                <h3 class="post-subtitle">{{ Str::limit($article->detail,50,'...[Devamını Oku]') }}</h3>
                            </a>
                            <p class="post-meta">
                                Yazar: {{ $article->createdBy->name }}
                                <br>
                                {{ $article->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endforeach
                        {{ $articles->links() }}
                    @else 
                        <span class="d-flex justify-content-center text-primary">Kategoriye ait makale bulunamadı</span>
                @endif
            </div>
            @include('front.widgets.category')
        </div>
    </div>

@endsection