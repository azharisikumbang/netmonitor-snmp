<?php

namespace App\Services;

use App\Core\Request;
use App\Core\Router;
use App\Enum\Role;
use App\Helpers\RequestValidator;
use App\Repositories\UserRepository;

class UpdateUserInformationService
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function update(
        Request $request
    ): bool|array {

        $validated = $this->validateRequest($request);

        if ($validated['has_error'])
            return $validated;

        $userTarget = $this->userRepository->findById($request->get('id'));

        if (is_null($userTarget))
        {
            $validated['errors'][] = [
                'name' => "BAD_REQUEST",
                'value' => "USER TARGET DOES NOT EXISTS.",
                'message' => "Data pengguna tidak ditemukan, mohon cek kembali permintaan anda."
            ];

            $validated['has_error'] = true;
        }


        return (bool) $this->userRepository->update(
            $userTarget,
            $this->filterAttributeToSave($validated['validated'])
        );
    }

    private function validateRequest(Request $request): array
    {
        $requestData = $this->skipRequestAttributesWantToValidate($request);

        $hasError = false;
        $validated = [];
        $errors = [];
        foreach ($requestData as $key => $value)
        {
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
            'validated' => $this->mergeValidatedWithSkippedData($validated, $request),
            'errors' => $errors,
            'has_error' => $hasError
        ];
    }

    private function skipRequestAttributesWantToValidate(Request $request): array
    {
        $wantToValidatedData = $request->all();

        unset(
            $wantToValidatedData['id'],
            $wantToValidatedData['address'],
            $wantToValidatedData['contact'],
            $wantToValidatedData[Router::PATH_QUERY_NAME]
        );

        return $wantToValidatedData;
    }

    private function mergeValidatedWithSkippedData(array $validated, Request $request): array
    {
        $skipped = [
            'address' => $request->get('address'),
            'contact' => $request->get('contact')
        ];

        return [...$validated, ...$skipped];
    }

    private function filterAttributeToSave(array $data)
    {
        return [
            'name' => $data['name'],
            'contact' => $data['contact'],
            'address' => $data['address'],
            'role' => Role::from($data['role'])->name
        ];
    }
}