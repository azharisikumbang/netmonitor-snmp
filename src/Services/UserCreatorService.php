<?php

namespace App\Services;

use App\Core\Request;
use App\Entities\User;
use App\Enum\Role;
use App\Helpers\RequestValidator;
use App\Repositories\UserRepository;

class UserCreatorService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function create(
        Request $request
    ): true|array {

        $validated = $this->validateRequest($request);

        if ($validated['has_error'])
            return $validated;


        return (bool) $this->userRepository->create($this->filterAttributeToSave($validated['validated']));
    }

    private function validateRequest(Request $request): array
    {
        $hasError = false;

        $requestData = $request->all();
        $validated = [];
        $errors = [];
        foreach ($requestData as $key => $value)
        {
            // skip for app request stack (all start with underscore)
            if (str_starts_with($key, "_"))
                continue;

            if (RequestValidator::isNullOrEmpty($value))
            {
                $hasError = true;
                $errors[] = [
                    'name' => $key,
                    'value' => $value,
                    'message' => "Form $key tidak boleh kosong, mohon dicek kembali."
                ];

                continue;
            }

            $validated[$key] = $value;
        }

        return [
            'validated' => $validated,
            'errors' => $errors,
            'has_error' => $hasError
        ];
    }

    private function filterAttributeToSave(array $data)
    {
        return [
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'name' => $data['name'],
            'role' => Role::from($data['role'])->name
        ];
    }
}