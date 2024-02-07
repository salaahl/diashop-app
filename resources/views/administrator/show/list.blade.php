@extends('layouts.app')

@section('meta')
@parent
@endsection

@section('links')
@parent
@endsection

@section('header')
@parent
@endsection

@section('main')
@if(isset($catalogs))
<h1>Catalogues</h1>
@elseif(isset($categories))
<h1>Catégories</h1>
@elseif(isset($products))
<h1>Articles</h1>
@endif
<nav id="filters" class="w-full flex justify-between items-center p-2 my-4 bg-gray-100 rounded-t-lg">
    <h4>Trier par :</h4>
    <select id="filter_select" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value="alphabetical_asc" @if(request()->get('filter') == 'alphabetical_asc' || !request()->get('filter')) selected @endif>A-Z</option>
        <option value="alphabetical_desc" @if(request()->get('filter') == 'alphabetical_desc') selected @endif>Z-A</option>
        <option value="created_at_asc" @if(request()->get('filter') == 'created_at_asc') selected @endif>Du plus récent au plus ancien</option>
        <option value="created_at_desc" @if(request()->get('filter') == 'created_at_desc') selected @endif>Du plus ancien au plus récent</option>
    </select>
</nav>
<ul>
    @if(isset($catalogs))
    @foreach($catalogs as $catalog)
    <li class="flex flex-wrap justify-between items-center mb-2 p-2 rounded-md bg-gray-200">
        <div class="w-screen lg:w-auto flex justify-between">
            <h4>{{ ucfirst($catalog->gender) }}</h4>
        </div>
        <div class="w-screen lg:w-auto flex justify-between">
            <a href="../edit/catalog/{{ $catalog->id }}" class="button-stylised-1 lg:min-w-[10vw] lg:mr-[40px]">Modifier</a>
            <form method="POST" action="../delete/catalog/{{ $catalog->id }}" class="min-w-[45vw] lg:min-w-[10vw]" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
                @csrf
                <button role="submit" class="button-stylised-1 button-stylised-1-custom w-full">Supprimer</button>
            </form>
        </div>
    </li>
    @endforeach
    @elseif(isset($categories))
    @foreach($categories as $category)
    <li class="flex flex-wrap justify-between items-center mb-2 p-2 rounded-md bg-gray-200">
        <div class="w-screen lg:w-auto flex justify-between">
            <h4 class="mr-1">{{ ucfirst($category->name) }} -</h4>
            <h4>{{ ucfirst($category->catalog->gender) }}</h4>
        </div>
        <div class="w-screen lg:w-auto flex justify-between">
            <a href="../edit/category/{{ $category->id }}" class="button-stylised-1 min-w-[45vw] lg:min-w-[10vw] lg:mr-[40px]">Modifier</a>
            <form method="POST" action="../delete/category/{{ $category->id }}" class="min-w-[45vw] lg:min-w-[10vw]" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
                @csrf
                <button role="submit" class="button-stylised-1 button-stylised-1-custom w-full">Supprimer</button>
            </form>
        </div>
    </li>
    @endforeach
    @elseif(isset($products))
    @foreach($products as $product)
    <li class="flex flex-wrap justify-between items-center mb-2 p-2 rounded-md bg-gray-200">
        <div class="w-screen lg:w-auto flex justify-between">
            <h4 class="mr-1">{{ ucfirst($product->name) }} -</h4>
            <h4 class="mr-1">{{ ucfirst($product->catalog->gender) }} -</h4>
            <h4>{{ ucfirst($product->category->name) }}</h4>
        </div>
        <div class="w-screen lg:w-auto flex justify-between">
            <a href="../edit/product/{{ $product->id }}" class="button-stylised-1 min-w-[45vw] lg:min-w-[10vw] lg:mr-[40px]">Modifier</a>
            <form method="POST" action="../delete/product/{{ $product->id }}" class="min-w-[45vw] lg:min-w-[10vw]" onSubmit="return confirm('Etes-vous sûr ? Cette action est irreversible')">
                @csrf
                <button role="submit" class="button-stylised-1 button-stylised-1-custom w-full">Supprimer</button>
            </form>
        </div>
    </li>
    @endforeach
    @endif
</ul>

@if(isset($catalogs))
<aside class="w-full my-4">
    {{ $catalogs->links() }}
</aside>
@elseif(isset($categories))
<aside class="w-full my-4">
    {{ $categories->links() }}
</aside>
@elseif(isset($products))
<aside class="w-full my-4">
    {{ $products->links() }}
</aside>
@endif
@endsection

@section('scripts')
@parent
@vite('resources/js/filter_data.js')
@endsection
