<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Burger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 40px 15px;
        }

        .card-custom {
            background-color: #111;
            color: #ffc107;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            max-width: 700px;
            margin: auto;
            padding: 30px;
        }

        h1.title {
            text-align: center;
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 30px;
            color: #ffc107;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
        }

        .details p {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .details strong {
            color: #fff;
            font-weight: bold;
        }

        img.burger-img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
            border-radius: 10px;
            border: 3px solid #ffc107;
            box-shadow: 0 0 10px #ffc107;
        }

        .btn-back {
            background-color: #ffc107;
            color: #000;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }

        .btn-back:hover {
            background-color: #000;
            color: #ffc107;
            border: 1px solid #ffc107;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h1 class="title">🍔 Détails du Burger</h1>

    <div class="card card-custom">
        <div class="details">
            <p><strong>Nom :</strong> {{ $burger->nom }}</p>
            <p><strong>Prix :</strong> {{ $burger->prix }} FCFA</p>
            <p><strong>Description :</strong> {{ $burger->description }}</p>
            <p><strong>Stock :</strong> {{ $burger->stock }}</p>

            @if($burger->image)
                <img src="{{ asset('storage/' . $burger->image) }}" alt="{{ $burger->nom }}" class="burger-img">
            @endif
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('burger') }}" class="btn-back">⬅️ Retour à la liste</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
