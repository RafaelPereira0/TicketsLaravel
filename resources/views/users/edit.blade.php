<x-layout title="editar usuario">
    <h1>
        Editar Usuario
    </h1>
    <form action="{{route('users.update', $user->id)}}" method="POST">
        @csrf
        @method('put')
        <div class="mt-4">

            <div class="mt-3">
                <label for="title" class="form-label">Nome</label>
                <input type="text" class="form-control" value="{{$user->name}}" name="name" id="name">
            </div>

            <div class="mt-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}"></input>
            </div>

            <div class="mt-3">
                <label for="role" class="form-lable mb-2">Tipo</label>
                <select class="form-select" name="role" id="role">
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuário</option>
                </select>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary mt-4">
                Salvar
            </button>
        </div>
    </form>
</x-layout>
