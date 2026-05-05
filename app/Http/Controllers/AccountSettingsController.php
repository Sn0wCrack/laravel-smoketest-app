<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AccountSettingsController extends Controller
{
    public function edit(): View
    {
        return view('account.edit');
    }

    public function update(UpdateAccountRequest $request): RedirectResponse
    {
        $user = auth()->user();
        $data = $request->safe()->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $data['profile_picture'] = $request->file('profile_picture')->store('profile-pictures', 'public');
        }

        $user->update($data);

        return redirect()->route('account.edit')->with('success', 'Account updated successfully.');
    }
}
