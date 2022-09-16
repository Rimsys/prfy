<?php

namespace App\Services;

class GithubApi extends Service
{
    public function baseUri()
    {
        return config('repositorydetails.github.base_url');
    }

    public function getCompany(string $accessToken)
    {
        $response = $this->get('user', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);
        return $response;
    }

    public function getmembers(string $accessToken, string $organization)
    {
        $response = $this->get("orgs/{$organization}/members", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        return $response;
    }

    public function getOrganization(string $accessToken)
    {
        $response = $this->get('user/orgs', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        return $response;
    }

    public function getOrganizationRepositories(string $accessToken, string $organization)
    {
        $response = $this->get("orgs/{$organization}/repos", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        return $response;
    }

    public function createWebhook(string $accessToken, string $organization_name, string $repository_name)
    {
        if(!config('app.webhook_url')) {
            throw new \Exception('Webhook_URL is empty');
        }
        $response = $this->post("repos/{$organization_name}/{$repository_name}/hooks", [
            'json' => [
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
            ],
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $accessToken
            ]
        ]);

        return $response;
    }
}
