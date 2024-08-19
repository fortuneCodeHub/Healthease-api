<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Exception;

class CustomerController extends Controller
{
    //
    /**
     * Display all the specialist data in the database
     */
    public function index(Request $request)
    {
        // Filter data based on url queries
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request); //[["column", "operator", "value"]]

        // return new UserCollection(User::all());
        if (count($filterItems) == 0) {

            return response()->json([
                'status' => true,
                'data' => new CustomerCollection(Customer::paginate())
            ], 200);
        } else {
            $customers = Customer::where($filterItems)->paginate();

            return response()->json([
                'status' => true,
                'data' => new CustomerCollection($customers->appends($request->query()))
            ], 200);
        }
    }

    /**
     * Show one customer
     */
    public function show(Customer $customer)
    {
        return response()->json([
            'status' => true,
            'data' => new CustomerResource($customer)
        ], 200);
    }

    /**
     * Store new customer data
     */
    public function store(StoreCustomerRequest $request)
    {
        try {

            return response()->json([
                'status' => true,
                'data' => new CustomerResource(Customer::create($request->all())),
                'message' => "Customer created successfully"
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }

    /**
     * Update customer data
     */
    public function update(UpdateCustomerRequest $request,  Customer $customer)
    {
        try {

            return response()->json([
                'status' => true,
                'data' => $customer->update($request->all()),
                'message' => "Customer updated successfully"
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 200);
        }
    }
}
