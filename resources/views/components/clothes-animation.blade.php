<div class="clothes-animation">
    <div class="container">
        <div class="carousel">
            @for($i = 0; $i <= 20; $i++)
            <div class="dress">
                <img src="{{ asset('images/loader/dress.png') }}" alt="dress" />
            </div>
            <div class="jacket">
                <img src="{{ asset('images/loader/jacket.png') }}" alt="jacket" />
            </div>
            <div class="pant">
                <img src="{{ asset('images/loader/pant.png') }}" alt="pant" />
            </div>
            @endfor
        </div>
    </div>
</div>