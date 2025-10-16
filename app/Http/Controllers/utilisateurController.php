<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class utilisateurController extends Controller
{
    public function list(){
        $listUser = User::all();
        return view('utilisateur.list', ['listUser'=>$listUser]);
    }


public function persist(Request $request)
{
    // ✅ Étape 1 : Validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|string',
        'password' => 'required|min:6|confirmed',
    ], [
        'name.required' => 'Le nom est obligatoire.',
        'email.required' => "L'adresse e-mail est obligatoire.",
        'email.email' => "L'adresse e-mail n'est pas valide.",
        'email.unique' => "Cette adresse e-mail est déjà utilisée.",
        'role.required' => 'Le rôle est obligatoire.',
        'password.required' => 'Le mot de passe est obligatoire.',
        'password.min' => 'Le mot de passe doit contenir au moins 6 caractères.',
        'password.confirmed' => 'Les mots de passe ne correspondent pas.',
    ]);

    // ✅ Étape 2 : Création de l’utilisateur
    $u = new User();
    $u->name = $validated['name'];
    $u->email = $validated['email'];
    $u->role = $validated['role'];
    $u->password = Hash::make($validated['password']);
    $u->save();

   return redirect()
    ->back()
    ->withErrors($validator)
    ->withInput();

}



    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('utilisateur.editUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'role' => 'sometimes|string|in:admin,super_admin',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        // Mettre à jour le rôle uniquement si l'utilisateur connecté est super admin
        if(auth()->user()->role === 'super_admin' && $request->has('role')) {
            $data['role'] = $request->role;
        }

        // Mettre à jour le mot de passe si fourni
        if($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()->route('listutilisateur')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function delete($id)
    {
        $user = User::find($id);
    
        if ($user) {
            $entreesCount = DB::table('entrees')->where('user_id', $id)->count();
    
            if ($entreesCount > 0) {
                return redirect()->route('listutilisateur')->with('error', 'Cet admin a encore des entrées associées. Veuillez les supprimer avant de supprimer l\'admin.');
            } else {
                $user->delete();
                return redirect()->route('listutilisateur')->with('success', 'admin supprimé avec succès.');
            }
        }
    
        return redirect()->route('listutilisateur')->with('error', 'admin non trouvé.');
    }
    

}

