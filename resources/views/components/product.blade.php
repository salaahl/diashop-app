<article class="product">
    <a href="{{ $link }}">
        <div class="thumbnail">
            <img src="{{ $image }}" />
            <img src="{{ $hover }}" />
        </div>
        <div class="details">
            <h4 class="title">{{ ucfirst($title) }}</h4>
            <div class="price text-sm">{{ $price }}</div>
        </div>
    </a>
</article>