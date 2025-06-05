<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index() { return Subscription::all(); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'student_id' => 'required|exists:students,id',
            'type' => 'required',
            'started_at' => 'required|date',
            'expires_at' => 'required|date'
        ]);
        return Subscription::create($data);
    }

    public function show(Subscription $subscription) { return $subscription; }

    public function update(Request $request, Subscription $subscription)
    {
        $subscription->update($request->all());
        return $subscription;
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(['message' => 'Deleted']);
    }
}

