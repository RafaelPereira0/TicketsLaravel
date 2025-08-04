<x-layout title="Criar Ticket">
    <h1>Criar Ticket</h1>

    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{route('tickets.store')}}" method="POST">
        @csrf

        <div class="mt-4">

            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" name="title" id="title">

            <div class="mt-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-primary mt-4">
                Salvar
            </button>
        </div>
    </form>
</x-layout>
