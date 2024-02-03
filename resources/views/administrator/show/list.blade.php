@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Liste')

@section('links')
@parent
<style>
    .button-stylised-1 {
        width: auto;
    }
</style>
@endsection

@section('header')
@parent
@endsection

@section('main')
@if(isset($catalogs))
@foreach($catalogs as $catalog)
<li class="flex flex-wrap justify-between">
    <h3>{{ $catalog->gender }}</h3>
    <div class="w-screen lg:w-auto flex justify-between">
        <a href="../edit/catalog/{{ $catalog->id }}" class="button-stylised-1 lg:min-w-[10vw]">Modifier</a>
        <form method="POST" action="../delete/catalog/{{ $catalog->id }}" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
            @csrf
            <button role="submit" class="button-stylised-1 button-stylised-1-custom">Supprimer</button>
        </form>
    </div>
</li>
@endforeach
@elseif(isset($categories))
@foreach($categories as $category)
<li class="flex flex-wrap justify-between">
    <h3>{{ $category->name }}</h3>
    <div class="w-screen lg:w-auto flex justify-between">
        <a href="../edit/category/{{ $category->id }}" class="button-stylised-1 min-w-[45vw] lg:min-w-[10vw]">Modifier</a>
        <form method="POST" action="../delete/category/{{ $category->id }}" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
            @csrf
            <button role="submit" class="button-stylised-1 button-stylised-1-custom">Supprimer</button>
        </form>
    </div>
</li>
@endforeach
@elseif(isset($products))
@foreach($products as $product)
<li class="flex flex-wrap justify-between">
    <h3>{{ $product->name }}</h3>
    <div class="w-screen lg:w-auto flex justify-between">
        <a href="../edit/product/{{ $product->id }}" class="button-stylised-1 min-w-[45vw] lg:min-w-[10vw]">Modifier</a>
        <form method="POST" action="../delete/product/{{ $product->id }}" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
            @csrf
            <button role="submit" class="button-stylised-1 button-stylised-1-custom">Supprimer</button>
        </form>
    </div>
</li>
@endforeach
@endif
@endsection

@section('scripts')
@parent
@endsection
