@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('title', 'Mes catalogues')

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
<h1 class="my-20">Tableau de bord</h1>
<section>
    <h3 class="mb-6">Ajouter</h3>
    <ul>
        <li>
            <a href="./add/catalog">Ajouter un catalogue</a>
        </li>
        <li>
            <a href="./add/category">Ajouter une catégorie</a>
        </li>
        <li>
            <a href="./add/product">Ajouter un article</a>
        </li>
    </ul>
</section>
<section>
    <h3 class="mb-6">Management de mes entités</h3>
    <ul>
        <li>
            <a href="./show/catalogs">Modifier ou supprimer un catalogue</a>
        </li>
        <li>
            <a href="./show/categories">Modifier ou supprimer une catégorie</a>
        </li>
        <li>
            <a href="./show/products">Modifier ou supprimer un article</a>
        </li>
    </ul>
</section>
@endsection

@section('scripts')
@parent
@endsection
