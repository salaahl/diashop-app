@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Ajouter un nouveau produit')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<nav>
    <ul>
        <li>
            <a href="{{ route('create.catalog') }}">Ajouter un catalogue</a>
        </li>
        <li>
            <a href="{{ route('create.category') }}">Ajouter une catégorie</a>
        </li>
        <li>
            <a href="{{ route('create.brand') }}">Ajouter une marque</a>
        </li>
        <li>
            <a href="{{ route('create.product') }}">Ajouter un article</a>
        </li>
        <li>
            <a href="{{ route('create.option') }}">Ajouter une option</a>
        </li>
        <li>
            <a href="{{ route('create.size') }}">Ajouter des tailles</a>
        </li>
    </ul>
</nav>
@endsection

@section('scripts')
@parent
@endsection