<article class="product">
    <a href="{{ $link }}">
        <div class="product-thumbnail" style="background-image:url('{{ $image }}')" onmouseenter="this.style.backgroundImage='url({{ $hover }})'" onmouseleave="this.style.backgroundImage='url({{ $image }})'"></div>
        <div class="product-details">
            <h4 class="title uppercase">{{ $title }}</h4>
            <div class="short-description text-sm">{{ $description }}</div>
            <div class="price">{{ $price }}</div>
        </div>
    </a>
</article>