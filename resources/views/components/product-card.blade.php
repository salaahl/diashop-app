<article class="product">
    <a href="{{ $link }}" data-turbo="false">
        <div class="thumbnail">
            <img src="{{ $image1 }}" alt="{{ $title }}" />
            <img src="{{ $image2 }}" alt="{{ $title }}" />
        </div>
        <div class="details lg:flex justify-between px-1 py-2 mt-1">
            <div class="w-full flex flex-wrap items-baseline justify-between">
                <h4 class="title lg:max-w-[75%] mr-[20px] text-ellipsis overflow-hidden">{{ ucfirst($title) }}</h4>
                <div class="flex items-center">
                    @if(empty($message))
                    @if(empty($promotion))
                    <h4 class="price flex items-center max-lg:mt-1 text-sm font-normal">{{ $price }}</h4>
                    @else
                    <h4 class="price flex items-center max-lg:mt-1 text-sm font-normal line-through">{{ $price }}</h4>
                    <h4 class="price flex items-center ml-2 max-lg:mt-1 text-sm font-normal">{{ $promotion }}</h4>
                    @endif
                    @else
                    <span class="message text-sm font-thin text-red-500">{{ $message }}</span>
                    @endif
                </div>
            </div>
        </div>
    </a>
</article>
