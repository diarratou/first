@extends('welcome')

@section('content')

<form action="{{ route($user->id ? 'updateUser' : 'storeUser', $user->id) }}" method="post">
    @method($user->id ? 'put' : 'post')
    @csrf
 <label for="">Photo </label>
    <input type="file" name="photo" class="form-control" id="" value="{{$user->photo}}">

    <label for="">Nom</label>
    <input type="text" name="name" class="form-control" value="{{ $user->id ? $user->name : old('name') }}">
    @error('name')
        <span class="text-danger">{{$message}}</span> <br>
    @enderror

    <label for="">Email</label>
    <input type="email" name="email" class="form-control" value="{{ $user->id ? $user->email : old('email') }}">
    @error('email')
        <span class="text-danger">{{$message}}</span> <br>
    @enderror

    <label for="">Mot de passe</label>
    <input type="password" name="password" class="form-control" {{ $user->id ? '' : 'required' }}>
    @error('password')
        <span class="text-danger">{{$message}}</span> <br>
    @enderror

    <label for="">Rôle</label>
    <select name="role" class="form-control">
        <option value="">-- Sélectionner un rôle --</option>
        <option value="client" {{ ($user->id && $user->role == 'client') || old('role') == 'client' ? 'selected' : '' }}>Client</option>
        <option value="gestionnaire" {{ ($user->id && $user->role == 'gestionnaire') || old('role') == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
    </select>
    @error('role')
        <span class="text-danger">{{$message}}</span> <br>
    @enderror

    <button type="submit" class="btn btn-success mt-2">{{ $user->id ? 'Modifier' : 'Ajouter' }}</button>

</form>
