<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
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

        $validationRules = $this->getValidationForCreate();
        $validated = Validator::make($data, $validationRules)->validated();
        $user = new User();
        $user = $this->fillUser($user, $validated);
        $user->email = Str::lower(data_get($validated, 'email', data_get($data, 'auth_token') . "@fake.mail"));
        $user->auth_token = data_get($validated, 'auth_token');
        $user->password = Hash::make(data_get($validated, 'password', Str::random(9)));
        $user->ref_key = Str::random(9);

        $user->save();
        // dd($user, $validated);

        if($autoAuth) {
            event(new Registered($user));
            Auth::login($user);
        }

        return $user;

        $fields = [
            'name' => data_get($validated, 'name', 'auto_user'),
            'email' => Str::lower(data_get($validated, 'email', data_get($data, 'auth_token') . "@schoolton.com")),
            'contact_email' => Str::lower(data_get($validated, 'contact_email')),
            'contact_tel' => data_get($validated, 'contact_tel'),
            'auth_token' => data_get($validated, 'auth_token'),
            'social_id' => data_get($validated, 'social_id'),
            'social_type' => data_get($validated, 'social_type'),
            'password' => Hash::make(data_get($validated, 'password', Str::random(9))),

            'first_name' => data_get($validated, 'first_name'),
            'middle_name' => data_get($validated, 'middle_name'),
            'last_name' => data_get($validated, 'last_name'),
            'age' => data_get($validated, 'age'),
            'gender' => data_get($validated, 'gender'),
            'region' => data_get($validated, 'region'),
            'address' => data_get($validated, 'address'),
            'user_data' => data_get($validated, 'user_data'),

        ];
    }

    public function updateUserFromArray($userId, array $data)
    {
        $user = User::findOrFail($userId);

        $validationRules = $this->getValidationForCreate();
        $validated = Validator::make($data, $validationRules)->validated();

        $user = $this->fillUser($user, $validated);
        $user->save();

        return $user;

        $validator = Validator::make($data, [
            'name' => 'string|max:255',
            'email' => 'string|lowercase|email|max:255|unique:'.User::class,
            'contact_email' => 'string|lowercase|email|max:255|unique:'.User::class,
            'contact_tel' => 'string|max:12',
            'social_id' => 'string',
            'social_type' => 'string',

            'first_name' => 'string|max:255|nullable',
            'middle_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'age' => 'numeric',
            'gender' => 'numeric',
            'region' => 'string|nullable',
            'address' => 'string|nullable',
            'user_data' => 'array|nullable',
        ]);

    }

    private function getValidationForCreate()
    {
        return $this->getValidationRules();
    }

    private function getValidationForUpdate()
    {
        return Arr::except($this->getValidationRules(), ['auth_token', 'email', 'password']);
    }

    private function getValidationRules()
    {
        return [
            'name' => 'string|max:255',
            'email' => 'string|lowercase|email|max:255|unique:'.User::class,
            'contact_email' => 'string|lowercase|email|max:255|unique:'.User::class,
            'contact_tel' => 'string|max:12',
            'social_id' => 'string',
            'social_type' => 'string',
            'auth_token' => 'required|string',

            'first_name' => 'string|max:255|nullable',
            'middle_name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'age' => 'numeric|max:150',
            'birthday' => 'date:Y-m-d|nullable',
            'gender' => 'numeric',
            'region' => 'string|nullable',
            'address' => 'string|nullable',
            'user_data' => 'array|nullable',
        ];

    }


    private function fillUser(User $user, $validated)
    {
        $user->name = data_get($validated, 'name', $user->name);
        $user->contact_email = Str::lower(data_get($validated, 'contact_email', $user->contact_email));
        $user->contact_tel = data_get($validated, 'contact_tel', $user->contact_tel);
        $user->social_id = data_get($validated, 'social_id', $user->social_id);
        $user->social_type = data_get($validated, 'social_type', $user->social_type);

        $user->first_name = data_get($validated, 'first_name', $user->first_name);
        $user->middle_name = data_get($validated, 'middle_name', $user->middle_name);
        $user->last_name = data_get($validated, 'last_name', $user->last_name);
        $user->birthday = data_get($validated, 'birthday', $user->birthday);
        $user->age = data_get($validated, 'age', $user->age);
        $user->gender = data_get($validated, 'gender', $user->gender);
        $user->region = data_get($validated, 'region', $user->region);
        $user->address = data_get($validated, 'address', $user->address);
        $user->user_data = data_get($validated, 'user_data', $user->user_data);

        return $user;
    }

}
