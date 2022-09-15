<?php

namespace App\Http\Controllers;

use App\Actions\GetOrganizationRepositoryDetailsAction;
use Illuminate\Http\Request;

class OrganizationRepositoryDetailsController extends Controller
{
    public function getOrganizationMembers(Request $request)
    {
        $this->validate($request, ['token' => 'required']);

        try {
            $response = (new GetOrganizationRepositoryDetailsAction())->execute($request->token);

            return $this->okResponse("Organizations retrieved successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("organization details not found", $e->getMessage());
        }
    }
}
