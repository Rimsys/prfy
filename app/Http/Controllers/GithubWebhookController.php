<?php

namespace App\Http\Controllers;

use App\Models\WebhookLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GithubWebhookController extends Controller
{

    public function index() {
        $payload = WebhookLog::query()->find(1)->data->toArray();
        return json_decode(json_encode($payload), true);
    }

    public function store(Request $request): Response|JsonResponse
    {
        // pass it to job
        // save the webhook to database with pending default status
        // process the webhook
        // update the status success

        $data = json_decode($request['payload'], true);
        WebhookLog::create([
            'vendor' => 'github',
            'data' => $data,
        ]);
        return $this->render([]);
    }
}
