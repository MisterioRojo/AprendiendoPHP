@extends("layouts.layout")
@section("title", "Home")
@section("content")
    <div class="container">
        <h1>Eliminar artículo</h1>
        <p>¿Estás seguro de que quieres eliminar esta categoria?</p>
        <form action="{{ route('eliminar_categoria', $article->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="{{ route('articles.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection