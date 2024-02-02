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
<li>
    <a href="../update/catalog/{{ $catalog->id }}">Modifier</a>
</li>
@endforeach
@elseif(isset($categories))
@foreach ($categories as $category)
<li>
    <a href="../update/category/{{ $category->id }}">Modifier</a>
</li>
@endforeach
@elseif(isset($products))
@foreach ($products as $product)
<li>
    <a href="../update/product/{{ $product->id }}">Modifier</a>
</li>
@endforeach
@endif
@endsection

@section('scripts')
@parent
@endsection