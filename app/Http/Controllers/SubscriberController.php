<?php

namespace App\Http\Controllers;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class SubscriberController extends Controller
{
public function index()
{
    $subscribers = Subscriber::all(); // or paginate()
    return view('pages.subscribers', compact('subscribers'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20|unique:subscribers,phone',
        'gender' => 'required|in:male,female',
        'subscription_date' => 'required|date', // Match database column
        'fees' => 'required|numeric|min:0',
        'status' => 'required|in:paid,unpaid'
    ]);

    try {
        $subscriber = Subscriber::create($validated); // No need to remap fields now

        return response()->json([
            'success' => true,
            'message' => 'Subscriber created successfully',
            'data' => $subscriber
        ], 201);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to create subscriber: ' . $e->getMessage(),
            'error' => $e->getMessage()
        ], 500);
    }
}

public function update(Request $request, $id)
{
     try {
        $subscriber = Subscriber::findOrFail($id);
    } catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Subscriber not found.'
        ], 404);
    }

    // Validate the incoming request data
    $validated = $request->validate([
        'name' => 'required|string|min:2|max:255',
        'phone' => 'required|digits_between:7,15',
        'gender' => 'required|in:male,female',
        'subscriptiondate' => 'required|date',
        'fees' => 'required|numeric|min:0',
        'status' => 'required|in:paid,unpaid',
    ]);

    // Update subscriber data
    $subscriber->update([
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'gender' => $validated['gender'],
        'subscription_date' => $validated['subscriptiondate'], // Adjust column name if needed
        'fees' => $validated['fees'],
        'status' => $validated['status'],
    ]);

    return response()->json(['message' => 'Subscriber updated successfully']);
}


public function destroy($id)
{
    try {
        $subscriber = Subscriber::findOrFail($id);
        $subscriber->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Subscriber deleted successfully'
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to delete subscriber',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
