<?php

namespace App\Actions;

use App\Models\Service;
use App\Services\GithubApi;

class CreateCompanyAction
{
    public function execute($request)
    {
        $checkService = $this->validateService($request);

        $company = $this->getCompanydetails($request);
    }

    private function validateService($request)
    {
        $validateService = Service::find($request->service_id);

        if (!$validateService) {
            \abort(404, 'Service not found.');
        } elseif ($validateService->name !== Service::GITHUB_SERVICES) {
            \abort(400, 'Service not available at the moment.');
        }
        return  $validateService;
    }

    private function getCompanydetails($request)
    {
        $response = (new GithubApi())->getCompany($request->access_token);

        if ($response === false) {

            \abort(400, 'Bad credentials.');
        }

        return $response;
    }
}
