<div class="hidden carousel-item duration-1000 ease-in-out" data-carousel-item>
    <img src="{{ $image }}" class="z-[5] absolute block h-full w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
    <div class="carousel-text-container z-[10] absolute flex flex-col justify-center w-full bottom-12 left-0 right-0">
        <h3 class="w-fit max-w-[80%] text-center uppercase rounded-lg">{{ $title }}</h3>
        <div class="max-md:hidden w-fit max-w-[80%] text-center rounded-lg">{{ $text }}</div>
    </div>
</div>