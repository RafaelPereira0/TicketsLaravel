<x-layout title="criar novo usuario">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">Criar Novo Usuário</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    @endforeach
                </ul>
            </div>
        @endif


    <div class="py-12 mt-3">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                <div class="mb-4">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label for="role" class="form-label">Tipo de usuário</label>
                    <select name="role" class="form-control" required>
                        <option value="user">Usuário</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>

                <button class="btn btn-primary">Criar</button>
            </form>
        </div>
    </div>
</x-layout>
