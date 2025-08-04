<x-layout title="Dashboard">
    <h1 class="font-semibold text-xl text-gray-800 leading-tight">
        Tickets Abertos
    </h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center my-3">

        <a href="{{route('tickets.create')}}" class="btn btn-primary mt-4">
            Criar Chamado
        </a>

        @if (auth()->user()->isAdmin())
            <a href="{{ route('users.index') }}" class="btn btn-success mt-4">
                Usuários
            </a>
        @endif

    </div>


    <div class="list-group shadow-sm mt-4">
        <div class="container text-center">
            <div class="row align-items-start">
                <div class="list-group-item d-flex justify-content-between">
                    <h5 class="col">Título</h5>
                    <h5 class="col">Descrição</h5>
                    <h5 class="col">Status</h5>
                    @if (auth()->user()->isAdmin())
                        <h5 class="col">Opções</h5>
                    @endif

                </div>

                @if($tickets->isEmpty())
                    <li class="list-group-item text-center">
                        Nenhum chamado criado.
                    </li>
                @else
                    @foreach ($tickets as $ticket)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="col">{{$ticket->title}}</div>
                            <div class="col">{{$ticket->description}}</div>
                            <div class="col">{{$ticket->status}}</div>
                            @if (auth()->user()->isAdmin())
                                <div class="btn-group" role="group">
                                    <a href="{{route('tickets.edit', $ticket->id)}}" class="btn btn-warning btn-sm me-2">
                                        Editar
                                    </a>
                                    <form action="{{route('tickets.destroy', $ticket->id)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm">Excluir</button>
                                    </form>
                                </div>
                            @endif

                        </li>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</x-layout>
