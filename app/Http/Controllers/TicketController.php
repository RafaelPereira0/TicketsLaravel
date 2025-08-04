<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Repositories\TicketRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class TicketController extends Controller
{
    protected $repo;

    public function __construct(TicketRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        try {
            $userId = Auth::id();
            $tickets = $this->repo->allForUser($userId);

            return view('tickets.index', compact('tickets'));
        } catch (Exception $e) {
            Log::error('Erro ao carregar tickets: ' . $e->getMessage());
            return back()->with('error', 'Erro ao carregar os tickets.');
        }
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string'
        ]);

        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id()
            ];

            $this->repo->add($data);

            return to_route('tickets.index')->with('success', 'Ticket criado com sucesso!');
        } catch (Exception $e) {
            Log::error('Erro ao criar ticket: ' . $e->getMessage());
            return back()->with('error', 'Erro ao criar o ticket.')->withInput();
        }
    }

    public function edit(Ticket $ticket)
    {
        try {
            $ticket = $this->repo->findTicketById($ticket->id);

            if (!$ticket) {
                return redirect()->route('tickets.index')->with('error', 'Ticket não encontrado.');
            }

            return view('tickets.edit', compact('ticket'));
        } catch (Exception $e) {
            Log::error('Erro ao editar ticket: ' . $e->getMessage());
            return redirect()->route('tickets.index')->with('error', 'Erro ao carregar o ticket.');
        }
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|string|in:aberto,em_andamento,concluido'
        ]);

        try {
            $updated = $this->repo->update($ticket->id, $request->status);

            if ($updated) {
                return to_route('tickets.index')->with('success', 'Ticket atualizado com sucesso!');
            }

            return to_route('tickets.index')->with('error', 'Não foi possível atualizar o ticket.');
        } catch (Exception $e) {
            Log::error('Erro ao atualizar ticket: ' . $e->getMessage());
            return redirect()->route('tickets.index')->with('error', 'Erro ao atualizar o ticket.');
        }
    }

    public function destroy(Ticket $ticket)
    {
        try {
            $deleted = $this->repo->delete($ticket->id);

            if ($deleted) {
                return redirect()->route('tickets.index')->with('success', 'Ticket deletado com sucesso!');
            }

            return redirect()->route('tickets.index')->with('error', 'Ticket não encontrado.');
        } catch (Exception $e) {
            Log::error('Erro ao deletar ticket: ' . $e->getMessage());
            return redirect()->route('tickets.index')->with('error', 'Erro ao deletar o ticket.');
        }
    }
}
