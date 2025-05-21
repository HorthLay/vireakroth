<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ActionResultMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LockedActionController extends Controller
{
    public function handle(Request $request)
    {
        $lockKey = 'lock:api-action:' . ($request->user()->id ?? 'guest');
        $lock = Cache::lock($lockKey, 10); // 10 seconds lock

        try {
            if ($lock->get()) {
                // Your successful logic
                $result = '✅ Action completed successfully at ' . now();

                // Send success email
                Mail::to('meysoung@gmail.com')->send(new ActionResultMail($result));

                return response()->json(['message' => $result]);
            } else {
                // Lock is already held, send error email
                $error = '❌ Failed to acquire lock at ' . now();

                Mail::to('recipient@example.com')->send(new ActionResultMail($error));

                return response()->json(['error' => 'Another process is running.'], 423);
            }
        } catch (\Throwable $e) {
            $error = '❌ Exception occurred: ' . $e->getMessage() . ' at ' . now();

            // Send exception email
            Mail::to('recipient@example.com')->send(new ActionResultMail($error));

            return response()->json(['error' => 'Something went wrong.'], 500);
        } finally {
            optional($lock)->release();
        }
    }
}
