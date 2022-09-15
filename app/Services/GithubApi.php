<?php

namespace App\Services;

class GithubApi extends Service
{
    public function baseUri()
    {
        return config('repositorydetails.github.base_url');
    }

    public function getCompany($token)
    {
        $response = $this->get('user', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authentication' => 'Bearer ' . $token
            ]
        ]);
        return $response;
    }

    public function getmembers($token, $organization)
    {
        $response = $this->get("orgs/{$organization}/members", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authentication' => 'Bearer ' . $token
            ]
        ]);

        return $response;
    }
}
