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
<style>
</style>
@endsection

@section('main')
<section>Ajouter un catalogue, une catégorie ou un article</section>
<section>
    <h2>Management de mes entités</h2>
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
