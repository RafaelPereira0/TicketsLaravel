<x-layout title="Dashboard">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Usuários
    </h1>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <a href="{{route('users.create')}}" class="btn btn-primary mt-4">
        Criar Usuario
    </a>

    <div class="list-group shadow-sm mt-4">
        <div class="container text-center">
            <div class="row align-items-start">
                <div class="list-group-item d-flex justify-content-between align-items-center" >
                    <h5 class="col">Nome</h5>
                    <h5 class="col">Email</h5>
                    <h5 class="col">Tipo</h5>
                    <h5 class="col">Opções</h5>
                </div>

                @if($users->isEmpty())
                    <li class="list-group-item text-center">
                        Nenhum usuário criado.
                    </li>
                @else
                    @foreach ($users as $user)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="col">{{$user->name}}</div>
                            <div class="col">{{$user->email}}</div>
                            <div class="col">{{$user->role}}</div>
                            <div class="btn-group " role="group">
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning btn-sm me-2">
                                    Editar
                                </a>
                                <form action="{{route('users.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</x-layout>
