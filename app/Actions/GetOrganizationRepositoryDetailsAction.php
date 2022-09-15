<?php

namespace App\Actions;

use App\Services\GithubApi;

class GetOrganizationRepositoryDetailsAction
{
    public function execute($token)
    {
        $response = (new GithubApi())->getOrganization($token);

        if ($response['status'] !== 200) {
            if (isset($response['error'])) {
                $errorMessage = $response['error']['message'];
            }

            \abort($response['status'], $errorMessage ? $errorMessage : 'Bad credentials.');
        }

        if (is_null($response['data'])) {
            \abort(400, 'you donnot belong to any organization.');
        }

        return $response['data'];
    }
}
