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

        $response = Http::withHeaders(
            [
                'Accept' => 'application/vnd.github+json',
                'Authorization' => "Bearer $request->access_token"
            ]
        )->get(
            "https://api.github.com/repos/$request->organization_name/repos"
        );

        $repos = collect($response->json()->toArray());

        $repos->each(function ($repo) use ($request) {
            $this->createWebhook($request->access_token, $request->organization_name, $repo['name']);
        });

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

    /**
     * @param string $accessToken
     * @param string $organization_name
     * @param string $repositoryName
     * @return array|mixed
     * @throws \Exception
     */
    private function createWebhook(string $accessToken, string $organization_name, string $repositoryName) {
        $response = Http::withHeaders(
            [
                'Accept' => 'application/vnd.github+json',
                'Authorization' => "Bearer $accessToken"
            ]
        )->post(
            "https://api.github.com/repos/$organization_name/$repositoryName/hooks",
            [
                'name' => 'web',
                'active' => true,
                'events' => [
                    "pull_request",
                    "pull_request_review",
                    "pull_request_review_comment",
                ],
                'config' => [
                    'url' => config('app.webhook_url'),
                    'content_type' => "form",
                    'insecure_ssl' => "0",
                ]
            ]
        );

        if ($response->failed()) {
            // throw exception
            $message = 'Webhook could not be created';
            throw new \Exception($message);
        }

        return $response->json();
    }
}
