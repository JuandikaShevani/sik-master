<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input)
    {
        $validator = Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => ['required', 'string', 'confirmed'],
        ], [
            'current_password.current_password' => __('The provided password does not match your current password.'),
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
