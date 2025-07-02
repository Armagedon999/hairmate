<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\HaircutHistory;
use Illuminate\Http\Request;

class HaircutHistoryController extends Controller
{
    // Untuk barbershop (nested resource)
    public function index(Customer $customer)
    {
        $this->authorizeCustomer($customer);
        return response()->json($customer->haircutHistories);
    }

    public function store(Request $request, Customer $customer)
    {
        $this->authorizeCustomer($customer);
        $data = $request->validate([
            'date' => 'required|date',
            'style' => 'required',
            'note' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('haircuts', 'public');
        }
        $history = $customer->haircutHistories()->create($data);
        return response()->json($history, 201);
    }

    public function show(Customer $customer, HaircutHistory $history)
    {
        $this->authorizeCustomer($customer);
        abort_unless($history->customer_id === $customer->id, 404);
        return response()->json($history);
    }

    public function update(Request $request, Customer $customer, HaircutHistory $history)
    {
        $this->authorizeCustomer($customer);
        abort_unless($history->customer_id === $customer->id, 404);
        $data = $request->validate([
            'date' => 'required|date',
            'style' => 'required',
            'note' => 'nullable',
            'photo' => 'nullable|image|max:2048',
            'is_favorite' => 'boolean',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('haircuts', 'public');
        }
        $history->update($data);
        return response()->json($history);
    }

    public function destroy(Customer $customer, HaircutHistory $history)
    {
        $this->authorizeCustomer($customer);
        abort_unless($history->customer_id === $customer->id, 404);
        $history->delete();
        return response()->json(['message' => 'deleted']);
    }

    // Untuk barbershop (nested resource)
    public function filter(Request $request, Customer $customer)
    {
        $this->authorizeCustomer($customer);
        $query = $customer->haircutHistories();
        if ($request->filled('date')) {
            $query->where('date', $request->input('date'));
        }
        if ($request->filled('style')) {
            $query->where('style', 'like', '%' . $request->input('style') . '%');
        }
        return response()->json($query->get());
    }

    // Untuk pelanggan
    public function myHistories(Request $request)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();
        if (!$customer) return response()->json([]);
        return response()->json($customer->haircutHistories);
    }

    public function setFavorite(Request $request, HaircutHistory $history)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();
        abort_unless($history->customer_id === optional($customer)->id, 403);
        $history->is_favorite = true;
        $history->save();
        return response()->json($history);
    }

    public function myHistoriesFilter(Request $request)
    {
        $user = $request->user();
        $customer = Customer::where('user_id', $user->id)->first();
        if (!$customer) return response()->json([]);
        $query = $customer->haircutHistories();
        if ($request->filled('date')) {
            $query->where('date', $request->input('date'));
        }
        if ($request->filled('style')) {
            $query->where('style', 'like', '%' . $request->input('style') . '%');
        }
        return response()->json($query->get());
    }

    protected function authorizeCustomer(Customer $customer)
    {
        abort_unless(auth()->id() === $customer->user_id, 403);
    }
} 