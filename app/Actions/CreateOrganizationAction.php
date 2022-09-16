<?php

namespace App\Actions;

use App\Models\Organization;
use App\Services\GithubApi;

class CreateOrganizationAction
{
    public function execute($request)
    {
        $companyMembers = $this->getCompanyMembers($request);

        $createOrganization = Organization::create([
            'name' => $request->organization_name,
            'service_id' => $request->service_id,
            'access_token' => $request->access_token,
            'git_id' => $request->organization_id,
        ]);

        foreach ($companyMembers as $companyMember) {
            $createOrganization->members()->create([
                'user_name' => $companyMember['login'],
                'avatar_url' => $companyMember['avatar_url'],
                'git_id' => $companyMember['id']
            ]);
        }
    }

    private function getCompanyMembers($request)
    {
        $response = (new GithubApi())->getMembers($request->access_token, $request->organization_name);

        if ($response['status'] !== 200) {
            if (isset($response['error'])) {
                $errorMessage = $response['error']['message'];
            }

            \abort($response['status'], $errorMessage ? $errorMessage : 'Bad credentials.');
        }
        return $response['data'];
    }
}
