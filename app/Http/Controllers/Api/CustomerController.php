<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = $request->user()->customers()->get();
        return response()->json($customers);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('customers', 'public');
        }
        $customer = $request->user()->customers()->create($data);
        return response()->json($customer, 201);
    }

    public function show(Customer $customer)
    {
        $this->authorizeCustomer($customer);
        return response()->json($customer);
    }

    public function update(Request $request, Customer $customer)
    {
        $this->authorizeCustomer($customer);
        $data = $request->validate([
            'name' => 'required',
            'phone' => 'nullable',
            'photo' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('customers', 'public');
        }
        $customer->update($data);
        return response()->json($customer);
    }

    public function destroy(Customer $customer)
    {
        $this->authorizeCustomer($customer);
        $customer->delete();
        return response()->json(['message' => 'deleted']);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $customers = $request->user()->customers()
            ->where('name', 'like', "%$query%")
            ->get();
        return response()->json($customers);
    }

    protected function authorizeCustomer(Customer $customer)
    {
        abort_unless(auth()->id() === $customer->user_id, 403);
    }
} 