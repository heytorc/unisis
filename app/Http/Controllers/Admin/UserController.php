<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('site.profile.profile');
    }

    public function profileUpdate(Request $request)
    {
        $formData = $request->except('_token');
        $user     = auth()->user();

        if($formData['password'] != null)
            $formData['password'] = bcrypt($formData['password']);
        else
            unset($formData['password']);

        
        $formData['image'] = $user->image;

        //é um arquivo e ele é válido?
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image)
                $name = $user->image;
            else
                $name = $user->id.kebab_case($user->name);
            
            $extension = $request->image->extension();
            $filename  = "{$name}.{$extension}";

            $upload = $request->image->storeAs('users', $filename);

            $formData['image'] = $filename;

            if (!$upload)
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao atualizar!');
        }




        $update = auth()->user()->update($formData);

        if ($update)
            return redirect()
                        ->route('profile')
                        ->with('success', 'Sucesso ao atualizar!');
        
        return redirect()
                    ->back()
                    ->with('error', 'Falha ao atualizar!');
    }
}
