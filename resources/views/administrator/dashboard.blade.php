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
<section class="mb-20">
    <h3 class="mb-2">Ajouter</h3>
    <ul>
        <li>
            <a href="./administrator/add/catalog">Ajouter un catalogue</a>
        </li>
        <li>
            <a href="./administrator/add/category">Ajouter une catégorie</a>
        </li>
        <li>
            <a href="./administrator/add/product">Ajouter un article</a>
        </li>
    </ul>
</section>
<section class="mb-20">
    <h3 class="mb-2">Management de mes entités</h3>
    <ul>
        <li>
            <a href="./administrator/show/catalogs">Modifier ou supprimer un catalogue</a>
        </li>
        <li>
            <a href="./administrator/show/categories">Modifier ou supprimer une catégorie</a>
        </li>
        <li>
            <a href="./administrator/show/products">Modifier ou supprimer un article</a>
        </li>
    </ul>
</section>
@endsection

@section('scripts')
@parent
@endsection
