<div class="clothes-animation">
    <div class="container">
        <div class="carousel">
            @for($i = 0; $i < 9; $i++)
            <div class="jacket">
                <img src="{{ asset('images/loader/jacket.png') }}" alt="jacket">
            </div>
            @endfor
        </div>
    </div>
    <div class="container">
        <div class="carousel">
            @for($i = 0; $i < 9; $i++)
            <div class="dress">
                <img src="{{ asset('images/loader/dress.png') }}" alt="dress">
            </div>
            @endfor
        </div>
    </div>
    <div class="container">
        <div class="carousel">
            @for($i = 0; $i < 9; $i++)
            <div class="pant">
                <img src="{{ asset('images/loader/pant.png') }}" alt="pant" />
            </div>
            @endfor
        </div>
    </div>
</div>