<?php

namespace App\Actions;

use App\Services\GithubApi;
use App\Models\Organization;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CreateOrganizationAction
{
    public function execute($request)
    {
        $githubApi = new GithubApi;

        $organizationMembers = $this->getCompanyMembers($request);

        $createOrganization = Organization::create([
            'name' => $request->organization_name,
            'service_id' => $request->service_id,
            'access_token' => $request->access_token,
            'git_id' => $request->organization_id,
        ]);

        foreach ($organizationMembers as $member) {
            $createOrganization->members()->create([
                'user_name' => $member['login'],
                'avatar_url' => $member['avatar_url'],
                'git_id' => $member['id']
            ]);
        }

        //move process to a job when refactoring
        $organizationRepositories = $githubApi->getOrganizationRepositories($request->access_token, $request->organization_name);

        if ($organizationRepositories['status'] === 200 && !empty($organizationRepositories['data'])) {
            collect($organizationRepositories['data'])->each(function ($org) use ($githubApi, $request) {
                $organization = $githubApi->createWebhook($request->access_token, $request->organization_name, $org['name']);
            });
        }

        return true;
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
