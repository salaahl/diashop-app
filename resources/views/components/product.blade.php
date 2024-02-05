<article class="product">
    <a href="{{ $link }}">
        <div class="thumbnail">
            <img src="{{ $image }}" />
            <img src="{{ $hover }}" />
        </div>
        <div class="details flex justify-between items-center px-1 py-2 mt-1">
            <h4 class="title">{{ ucfirst($title) }}</h4>
            <div class="price text-sm font-bold">{{ $price }}</div>
        </div>
    </a>
</article>