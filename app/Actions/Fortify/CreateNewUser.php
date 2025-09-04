<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User 
     */
    public function create(array $input)
    { 
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'title' => ['required', 'string', 'max:255'],
            'personal_number' => ['required', 'string', 'max:50'],
            'occupation' => ['required', 'string', 'max:50'],
            'department_or_unit' => ['required', 'string', 'max:70'],
            'mobile_number' => ['numeric', 'digits:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'title' => $input['title'],
            'personal_number' => $input['personal_number'],
            'occupation' => $input['occupation'],
            'department_or_unit' => $input['department_or_unit'],
            'mobile_number' => $input['mobile_number'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
