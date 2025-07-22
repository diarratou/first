@extends('welcome')

@section('content')
<div class="container mt-4">

    {{-- En-tête et bouton d'ajout --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-secondary">Liste des Utilisateurs</h2>
        <a href="{{ route('addUser') }}" class="btn btn-success">
            <i class="bi bi-person-plus-fill"></i> Ajouter un utilisateur
        </a>
    </div>

    {{-- Alertes --}}
    @if(session("message"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("message") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session("messageDelete"))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session("messageDelete") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tableau --}}
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Photo</th>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . ($u->photo ?? 'images/user.png')) }}" width="80" class="img-thumbnail" alt="photo utilisateur">
                        </td>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge bg-{{ $u->role == 'admin' ? 'danger' : 'secondary' }}">
                                {{ ucfirst($u->role ?? 'Non défini') }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('editUser', $u->id) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <form action="{{ route('deleteUser', $u->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>

</div>
@endsection
