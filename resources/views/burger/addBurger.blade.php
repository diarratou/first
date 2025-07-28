@extends('welcome')

@section('content')

<style>
    /* Suppression du fond noir global */
    .form-label {
        color: #ffc107;
    }

    .form-control,
    textarea.form-control {

        background-color: #1c1c1c;
        color: #fff;
        border: 1px solid #ffc107;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 5px #ffc107;
    }

    .invalid-feedback {
        color: #ff4d4d;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #000;
        font-weight: bold;
    }

    .btn-warning:hover {
        background-color: #e0a800;
        color: #000;
    }

    .form-container {
        max-width: 600px;
        margin: auto;
        background-color: #111;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px #ffc107;
    }

    h2 {
        color: #ffc107;
        text-align: center;
        margin-bottom: 25px;
    }
</style>

<div class="container py-5">
    <div class="form-container">
        <h2>➕ Ajouter un Nouveau Burger</h2>
        <form action="{{ route($burger->id ? 'updateBurger' : 'saveBurger',$burger->id) }}" method="POST" enctype="multipart/form-data">

            @method($burger->id ? 'put' :'post')
            @csrf

            <!-- Nom -->
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{$burger->id ? $burger->nom : old('nom')}}">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <!-- Prix -->
            <div class="mb-3">
                <label for="prix" class="form-label">Prix (FCFA)</label>
                <input type="number" name="prix" class="form-control @error('prix') is-invalid @enderror" value="{{$burger->id ? $burger->prix : old('prix')}}">
                @error('prix')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" value="{{'storage/'.$burger->image}}">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" id="" class="form-control @error('description') is-invalid @enderror" value="{{$burger->id ? $burger->description : old('description')}}">
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stock -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{$burger->id ? $burger->stock : old('stock')}}">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-warning px-5">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

@endsection
