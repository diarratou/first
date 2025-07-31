@extends('welcome')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
        font-family: 'Inter', 'Segoe UI', sans-serif;
        min-height: 100vh;
    }

    .form-wrapper {
        background: linear-gradient(135deg, #ff416c 0%, #ff4757 100%);
        min-height: 100vh;
        padding: 30px 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 40px;
        max-width: 600px;
        width: 100%;
        margin: 0 15px;
        box-shadow: 0 20px 40px rgba(255, 65, 108, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .form-title {
        color: #2d3436;
        font-size: 1.8rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 35px;
        position: relative;
    }

    .form-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(135deg, #ff416c, #ff4757);
        border-radius: 2px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        color: #2d3436;
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        background: rgba(248, 249, 250, 0.8);
        border: 2px solid rgba(255, 65, 108, 0.1);
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 0.95rem;
        color: #2d3436;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
        border-color: #ff416c;
        box-shadow: 0 0 0 3px rgba(255, 65, 108, 0.1);
        background: white;
        outline: none;
    }

    .form-control::placeholder {
        color: #636e72;
        font-weight: 500;
    }

    .form-control.is-invalid {
        border-color: #e74c3c;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.85rem;
        font-weight: 500;
        margin-top: 6px;
        display: block;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input {
        position: absolute;
        left: -9999px;
        opacity: 0;
    }

    .file-input-label {
        background: rgba(255, 65, 108, 0.1);
        color: #ff416c;
        border: 2px dashed rgba(255, 65, 108, 0.3);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
        font-weight: 600;
    }

    .file-input-label:hover {
        background: rgba(255, 65, 108, 0.15);
        border-color: #ff416c;
    }

    .file-input-label.has-file {
        background: rgba(0, 184, 148, 0.1);
        color: #00b894;
        border-color: rgba(0, 184, 148, 0.3);
    }

    .image-preview {
        margin-top: 15px;
        text-align: center;
        display: none;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        object-fit: cover;
    }

    .image-preview.show {
        display: block;
    }

    .btn-submit {
        background: linear-gradient(135deg, #ff416c, #ff4757);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px 40px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 65, 108, 0.4);
        width: 100%;
        cursor: pointer;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 65, 108, 0.6);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 12px;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
        margin-bottom: 20px;
    }

    .back-btn:hover {
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .form-container {
            margin: 0 10px;
            padding: 30px 20px;
        }

        .form-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="form-wrapper">
    <div class="form-container">
        <a href="{{ route('burger') }}" class="back-btn">← Retour</a>

        <h2 class="form-title">
            {{ $burger->id ? 'Modifier le Burger' : 'Ajouter un Nouveau Burger' }}
        </h2>

        <form action="{{ route($burger->id ? 'updateBurger' : 'saveBurger',$burger->id) }}" method="POST" enctype="multipart/form-data">
            @method($burger->id ? 'put' :'post')
            @csrf

            <!-- Nom -->
            <div class="form-group">
                <label for="nom" class="form-label">Nom du Burger</label>
                <input type="text"
                       name="nom"
                       id="nom"
                       class="form-control @error('nom') is-invalid @enderror"
                       value="{{ $burger->id ? $burger->nom : old('nom') }}"
                       placeholder="Ex: Big Burger Deluxe">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Prix -->
            <div class="form-group">
                <label for="prix" class="form-label">Prix (FCFA)</label>
                <input type="number"
                       name="prix"
                       id="prix"
                       class="form-control @error('prix') is-invalid @enderror"
                       value="{{ $burger->id ? $burger->prix : old('prix') }}"
                       placeholder="Ex: 5000">
                @error('prix')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Image -->
            <div class="form-group">
                <label for="image" class="form-label">Image du Burger</label>
                <div class="file-input-wrapper">
                    <input type="file"
                           name="image"
                           id="image"
                           class="file-input @error('image') is-invalid @enderror"
                           accept="image/*"
                           onchange="previewImage(this)">
                    <label for="image" class="file-input-label" id="file-label">
                        <div>📷 Cliquez pour choisir une image</div>
                        <small>JPG, PNG, GIF - Max 2MB</small>
                    </label>
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <!-- Aperçu de l'image -->
                <div class="image-preview" id="image-preview">
                    <img id="preview-img" src="" alt="Aperçu">
                </div>

                <!-- Image actuelle si modification -->
                @if($burger->id && $burger->image)
                <div class="image-preview show">
                    <small style="color: #636e72; display: block; margin-bottom: 10px;">Image actuelle:</small>
                    <img src="{{ asset('storage/'.$burger->image) }}" alt="Image actuelle">
                </div>
                @endif
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea name="description"
                          id="description"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4"
                          placeholder="Décrivez votre burger...">{{ $burger->id ? $burger->description : old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Stock -->
            <div class="form-group">
                <label for="stock" class="form-label">Stock Disponible</label>
                <input type="number"
                       name="stock"
                       id="stock"
                       class="form-control @error('stock') is-invalid @enderror"
                       value="{{ $burger->id ? $burger->stock : old('stock') }}"
                       placeholder="Ex: 50"
                       min="0">
                @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-submit">
                {{ $burger->id ? 'Mettre à jour' : 'Enregistrer le Burger' }}
            </button>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const file = input.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const label = document.getElementById('file-label');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.add('show');
        }

        reader.readAsDataURL(file);

        // Changer le texte du label
        label.innerHTML = `
            <div style="color: #00b894;">✅ Image sélectionnée</div>
            <small>${file.name}</small>
        `;
        label.classList.add('has-file');
    } else {
        preview.classList.remove('show');
        label.innerHTML = `
            <div>📷 Cliquez pour choisir une image</div>
            <small>JPG, PNG, GIF - Max 2MB</small>
        `;
        label.classList.remove('has-file');
    }
}
</script>

@endsection
