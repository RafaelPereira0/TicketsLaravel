<x-layout title="edit ticket">
    <h1>
        Editar Ticket
    </h1>
    <form action="{{route('tickets.update', $ticket->id)}}" method="POST">
        @csrf
        @method('put')
        <div class="mt-4">

            <div class="mt-3">
                <label for="title" class="form-label">Título</label>
                <input type="text" class="form-control" value="{{$ticket->title}}" name="title" id="title" disabled>
                <input type="number" name="user_id" id="user_id" hidden value=2>
            </div>

            <div class="mt-3">
            <label for="description" class="form-label">Descrição</label>
            <textarea class="form-control" name="description" id="description" rows="3" disabled>{{$ticket->description}}</textarea>
            </div>

            <div class="mt-3">
                <label for="status" class="form-lable mb-2">Status</label>
                <select class="form-select" name="status" id="status">
                    <option value="Aberto" {{ $ticket->status == 'Aberto' ? 'selected' : '' }}>Aberto</option>
                    <option value="Em andamento" {{ $ticket->status == 'Em andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="Resolvido" {{ $ticket->status == 'Resolvido' ? 'selected' : '' }}>Resolvido</option>
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
