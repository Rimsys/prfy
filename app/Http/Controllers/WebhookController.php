<?php

namespace App\Http\Controllers;

use App\Models\WebhookLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class WebhookController extends Controller
{

    public function index() {
        $payload = WebhookLog::query()->find(7)->data->toArray();
        return json_decode(json_encode($payload), true);
    }

    public function store(Request $request): JsonResponse
    {
        // pass it to job
        // save the webhook to database with pending default status
        // process the webhook
        // update the status success

        logger($request);
        $data = json_decode($request['payload'], true);
        WebhookLog::create([
            'vendor' => 'github',
            'data' => $data,
        ]);
        return $this->render([]);
    }
}
