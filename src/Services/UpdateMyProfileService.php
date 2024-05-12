<?php

namespace App\Services;

use App\Core\Request;
use App\Helpers\RequestValidator;
use App\Repositories\UserRepository;

class UpdateMyProfileService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function updateUserInformation(Request $request): bool|array
    {
        $validated = $this->validateRequest($request);

        if ($validated['has_error'])
            return $validated;

        $owner = session()->user();

        return $this->userRepository->update(
            $owner,
            $this->getUpdatableAttribute($validated['validated'])
        );
    }

    private function validateRequest(Request $request): array
    {
        $hasError = false;
        $errors = [];

        $requestData = $request->all();
        if (RequestValidator::isNullOrEmpty($requestData['name']))
        {
            $hasError = true;
            $errors[] = [
                'name' => 'name',
                'value' => $requestData['name'],
                'message' => "Form 'Nama Lengkap Pengguna' tidak boleh kosong, mohon dicek kembali."
            ];

            unset($requestData['name']);
        }

        return [
            'validated' => $requestData,
            'errors' => $errors,
            'has_error' => $hasError
        ];
    }

    private function getUpdatableAttribute(array $data): array
    {
        return [
            'name' => $data['name'],
            'contact' => $data['contact'],
            'address' => $data['address']
        ];
    }
}