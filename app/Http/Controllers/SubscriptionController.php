<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'email' => 'required|email|unique:subscriptions,email|max:255',
    ]);

    Subscription::create(['email' => $validated['email']]);

    return response()->json([
        'message' => __('تم الاشتراك بنجاح! شكراً لانضمامك إلى قائمتنا البريدية.')
    ]);
}
}
