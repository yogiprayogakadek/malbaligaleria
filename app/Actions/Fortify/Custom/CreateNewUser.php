<?php

namespace App\Actions\Fortify\Custom;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    public function create(array $input)
    {
        Validator::make($input, [
            'name'                  => ['required', 'string', 'max:255'],
            'email'                 => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'              => ['required', 'confirmed', 'min:8'],
            'tenant'                => ['nullable', 'exists:tenants,id'],
        ], [
            'tenant.exists' => 'Tenant tidak valid.',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tenant_id' => $input['tenant_id'] ?? null,
        ]);

        $user->assignRole('tenant');

        return $user;
    }
}
