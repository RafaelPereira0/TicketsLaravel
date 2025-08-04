<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserController extends Controller
{
    protected $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        try {
            $users = $this->repo->findAllUsers();
            return view('users.index', compact('users'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['erro' => 'Erro ao carregar os usuários.']);
        }
    }

    public function edit(User $user)
    {
        try {
            $user = $this->repo->findUserById($user->id);
            return view('users.edit', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('users.index')->withErrors(['erro' => 'Usuário não encontrado.']);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $data = $request->all();
            $updated = $this->repo->update($user->id, $data);

            if ($updated) {
                return redirect()->route('users.edit', $user->id)->with('success', 'Usuário atualizado com sucesso.');
            }

            return redirect()->back()->withErrors(['erro' => 'Erro ao atualizar o usuário.']);
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['erro' => $e->getMessage()]);
        }
    }

    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            abort(403);
        }

        return view('users.create');
    }

    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user || !$user->isAdmin()) {
            abort(403);
        }

        try {
            $data = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role'     => 'nullable|string|in:user,admin',
            ]);

            $data['password'] = Hash::make($data['password']);

            $created = $this->repo->create($data);

            if (!$created) {
                return redirect()->back()->withErrors(['erro' => 'Já existe um usuário com esse e-mail.']);
            }

            return redirect()->route('dashboard')->with('success', 'Usuário criado com sucesso.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['erro' => $e->getMessage()]);
        }
    }

    public function destroy(User $user)
    {
        /** @var \App\Models\User $userADM */
        $userADM = Auth::user();

        if (!$userADM || !$userADM->isAdmin()) {
            abort(403);
        }

        try {
            $deleted = $this->repo->deleteUser($user->id);

            if ($deleted) {
                return redirect()->route('users.index')->with('success', 'Usuário deletado com sucesso!');
            }

            return redirect()->route('users.index')->withErrors(['erro' => 'Usuário não encontrado.']);
        } catch (Exception $e) {
            return redirect()->route('users.index')->withErrors(['erro' => $e->getMessage()]);
        }
    }
}
