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

    public function persist(Request $request){
        $u = new User();
        //dd($request);
        $u->name = $request->name;
        $u->email = $request->email;
        $u->role = $request->role; // Assign the selected role to the user object

        if ($request->password_confirmation == $request->password){
            $u->password = Hash::make($request->password);
            $u->password;
            $u->save();
            $sms = "Opération réussi !!!";
        }else{
            $sms = "Les mots de passes ne correspondent pas !!!";
        }
        $listUser = User::all();
        return view('utilisateur.list', ['listUser'=>$listUser, 'sms'=>$sms]);
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

