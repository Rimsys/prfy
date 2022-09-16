<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessWebhook;
use App\Models\WebhookLog;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use function PHPUnit\Framework\isEmpty;

class WebhookController extends Controller
{

    public function index() {
        $payload = WebhookLog::query()->find(10)->data->toArray();
        return json_decode(json_encode($payload), true);
    }

    public function store(Request $request): JsonResponse
    {
//        logger($request);
        $data = json_decode($request['payload'], true);
        $webhookLog = WebhookLog::query()->create([
            'vendor' => 'github',
            'data' => $data
        ]);
        if (!array_key_exists('action', $data)) {
            return $this->render([]);
        }
        ProcessWebhook::dispatch($webhookLog);
        return $this->render([]);
    }
}
