<article class="product">
    <a href="{{ $link }}">
        <div class="product-thumbnail">
            <img src="{{ $image }}" />
            <img src="{{ $hover }}" />
        </div>
        <div class="product-details">
            <h4 class="brand uppercase">{{ $brand }}</h4>
            <h4 class="title capitalize">{{ $title }}</h4>
            <div class="price">{{ $price }}</div>
        </div>
    </a>
</article>