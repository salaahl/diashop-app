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
    <h2 class="mb-6">Ajouter</h2>
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
    <h2 class="mb-6">Management de mes entités</h2>
    <ul>
        <li>
            <a href="#">Modifier ou supprimer un catalogue</a>
        </li>
        <li>
            <a href="#">Modifier ou supprimer une catégorie</a>
        </li>
        <li>
            <a href="#">Modifier ou supprimer un article</a>
        </li>
    </ul>
</section>
@endsection

@section('scripts')
@parent
@endsection
