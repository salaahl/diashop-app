<article class="product">
    <a href="{{ $link }}">
        <div class="thumbnail">
            <img src="{{ $image1 }}" alt="{{ $title }}" />
            <img src="{{ $image2 }}" alt="{{ $title }}" />
        </div>
        <div class="details lg:flex justify-between px-1 py-2 mt-1">
            <h4 class="title lg:max-w-[75%] items-center text-ellipsis overflow-hidden">{{ ucfirst($title) }}</h4>
            <h4 class="price flex items-center max-lg:mt-1 text-sm font-normal">{{ $price }}</h4>
        </div>
    </a>
</article>