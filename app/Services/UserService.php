<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserService
{
    public function createUserFromRequest(Request $request, bool $autoToken = false, bool $autoAuth = true)
    {
        return $this->createUserFromArray($request->all(), $autoToken, $autoAuth);
    }

    public function createUserFromArray(array $data, bool $autoToken = false, bool $autoAuth = true)
    {
        if(!data_get($data, 'auth_token') && $autoToken){
            $data['auth_token'] = Hash::make(Str::random(9));
        }

        $validator = Validator::make($data, [
            'name' => 'string|max:255',
            'email' => 'string|lowercase|email|max:255|unique:'.User::class,
            'contactEmail' => 'string|lowercase|email|max:255|unique:'.User::class,
            'contactTel' => 'string|lowercase|max:12',
            'social_id' => 'string',
            'social_type' => 'string',
            'auth_token' => 'required|string',
        ]);

        $validated = $validator->validated();

        $fields = [
            'name' => data_get($validated, 'name', 'auto_user'),
            'email' => Str::lower(data_get($validated, 'email', data_get($data, 'auth_token') . "@schoolton.com")),
            'contact_email' => Str::lower(data_get($validated, 'contactEmail')),
            'contact_tel' => data_get($validated, 'contactTel'),
            'auth_token' => data_get($validated, 'auth_token'),
            'social_id' => data_get($validated, 'social_id'),
            'social_type' => data_get($validated, 'social_type'),
            'password' => data_get($validated, 'password', Hash::make(Str::random(9))),
        ];


        $user = User::create($fields);

        if($autoAuth) {
            event(new Registered($user));
            Auth::login($user);
        }

        return $user;
    }

    public function updateUserFromArray($userId, array $data)
    {
        $user = User::find($userId);
        if(!$user) return null;

        $validator = Validator::make($data, [
            'name' => 'string|max:255',
            'contactEmail' => 'string|lowercase|email|max:255|unique:'.User::class,
            'tel' => 'nullable|string|lowercase|max:12',
            'socialId' => 'nullable|string',
            'socialType' => 'nullable|string',
        ]);

        $validated = $validator->validate();

        $user->name = data_get($validated, 'name', $user->name);
        $user->contact_email = Str::lower(data_get($validated, 'contactEmail', $user->contact_email));
        $user->contact_tel = data_get($validated, 'tel', $user->contact_tel);
        $user->social_id = data_get($validated, 'socialId', $user->social_id);
        $user->social_type = data_get($validated, 'socialType', $user->social_type);
        $user->password = data_get($validated, 'password', $user->password);

        $user->save();

        return $user;
    }

}
