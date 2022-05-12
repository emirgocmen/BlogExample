@if(count($categories))
<div class="d-none d-md-block col-md-4 col-lg-3">
    <ul class="list-group">
        <li class="list-group-item text-primary fs-5 fw-bold">Kategoriler</li>
        @foreach($categories as $category)
          <a href="{{ route('front.category', $category->slug) }}">
            <li class="list-group-item @if($category->slug == Request::segment(1)) active @endif">{{ $category->name }}
              <span class="float-end">{{ $category->active_articles_count }}</span>
            </li>
          </a>

          @foreach($category->subCategory as $subcategory)
                <a href="{{ route('front.category', $subcategory->slug) }}">
                  <li class="list-group-item fs-6 @if($subcategory->slug == Request::segment(1)) active @endif">
                  {{ $loop->iteration }}- {{ $subcategory->name }}
                </li>
              </a>
          @endforeach

        @endforeach

        <a href="{{ route('front.index') }}">
          <li class="list-group-item ">Tümü</li>
        </a>
      </ul>
</div>
@endif