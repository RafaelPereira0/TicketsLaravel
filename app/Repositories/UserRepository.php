<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserRepository
{
    public function findAllUsers()
    {
        try {
            return User::all();
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar usuários: " . $e->getMessage());
        }
    }

    public function findUserById($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                throw new ModelNotFoundException("Usuário não encontrado.");
            }

            return $user;
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception("Erro ao buscar usuário: " . $e->getMessage());
        }
    }

    public function update($id, $data)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                throw new ModelNotFoundException("Usuário não encontrado para atualização.");
            }

            $updated = $user->update($data);

            if (!$updated) {
                throw new Exception("Erro ao atualizar o usuário.");
            }

            return $user;
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }

    public function create($data)
    {
        try {
            if (User::where('email', $data['email'])->exists()) {
                throw new Exception("Já existe um usuário com esse e-mail.");
            }

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
                'role' => $data['role']
            ]);

            if (!$user) {
                throw new Exception("Erro ao criar o usuário.");
            }

            return $user;
        } catch (Exception $e) {
            throw new Exception("Erro ao criar usuário: " . $e->getMessage());
        }
    }

    public function deleteUser(int $id): bool
    {
        try {
            $user = User::find($id);

            if (!$user) {
                throw new ModelNotFoundException("Usuário não encontrado para exclusão.");
            }

            $deleted = $user->delete();

            if (!$deleted) {
                throw new Exception("Erro ao deletar o usuário.");
            }

            return $deleted;
        } catch (ModelNotFoundException $e) {
            throw $e;
        } catch (Exception $e) {
            throw new Exception("Erro ao deletar usuário: " . $e->getMessage());
        }
    }
}
