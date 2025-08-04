<?php

namespace App\Repositories;

use App\Models\Ticket;
use App\Models\User;
use Exception;

class TicketRepository
{
    public function add(array $ticket): Ticket
    {
        try {
            return Ticket::create($ticket);
        } catch (Exception $e) {
            throw new Exception('Erro ao criar ticket: ' . $e->getMessage());
        }
    }

    public function allForUser(int $id)
    {
        try {
            $user = User::find($id);

            if ($user && $user->role === 'admin') {
                return Ticket::orderBy('title', 'asc')->get();
            } else {
                return Ticket::where('user_id', $id)
                    ->orderBy('title', 'asc')
                    ->get();
            }
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar tickets: ' . $e->getMessage());
        }
    }

    public function delete(int $id): bool
    {
        try {
            $ticket = Ticket::find($id);

            if ($ticket) {
                return $ticket->delete();
            }

            throw new Exception('Ticket não encontrado.');
        } catch (Exception $e) {
            throw new Exception('Erro ao deletar ticket: ' . $e->getMessage());
        }
    }

    public function findTicketById(int $id)
    {
        try {
            $ticket = Ticket::find($id);

            if ($ticket) {
                return $ticket;
            }

            throw new Exception('Ticket não encontrado.');
        } catch (Exception $e) {
            throw new Exception('Erro ao buscar ticket: ' . $e->getMessage());
        }
    }

    public function update(int $id, string $status)
    {
        try {
            $ticket = Ticket::find($id);

            if ($ticket) {
                $ticket->status = $status;
                return $ticket->save();
            }

            throw new Exception('Ticket não encontrado.');
        } catch (Exception $e) {
            throw new Exception('Erro ao atualizar ticket: ' . $e->getMessage());
        }
    }
}
