@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Liste')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
@if(isset($catalogs))
@foreach ($catalogs as $catalog)
<li class="flex">
    <h3>{{ $catalog->name }}</h3>
    <a href="../edit/catalog/{{ $catalog->id }}" class="button-stylised-1">Modifier</a>
    <form method="POST" action="../delete/catalog/{{ $catalog->id }}" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
        @csrf
        <button role="submit" class="button-stylised-1 button-stylised-1-custom">Supprimer</button>
    </form>
</li>
@endforeach
@elseif(isset($categories))
@foreach ($categories as $category)
<li class="flex">
    <h3>{{ $category->name }}</h3>
    <a href="../edit/category/{{ $category->id }}" class="button-stylised-1">Modifier</a>
    <form method="POST" action="../delete/category/{{ $category->id }}" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
        @csrf
        <button role="submit" class="button-stylised-1 button-stylised-1-custom">Supprimer</button>
    </form>
</li>
@endforeach
@elseif(isset($products))
@foreach ($products as $product)
<li class="flex">
    <h3>{{ $product->name }}</h3>
    <a href="../edit/product/{{ $product->id }}" class="button-stylised-1">Modifier</a>
    <form method="POST" action="../delete/product/{{ $product->id }}" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
        @csrf
        <button role="submit" class="button-stylised-1 button-stylised-1-custom">Supprimer</button>
    </form>
</li>
@endforeach
@endif
@endsection

@section('scripts')
@parent
@endsection
