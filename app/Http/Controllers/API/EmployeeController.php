<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employee;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        return $this->sendResponse(EmployeeResource::collection($employees), 'Employees retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
{
    $input = $request->all();

    $validator = Validator::make($input, [
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Image upload validation
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email',
        'post' => 'required',
        'phone' => 'required'
    ]);

    if ($validator->fails()) {
        return $this->sendError('Validation Error.', $validator->errors());
    }

    if ($request->hasFile('avatar')) {
        $image = $request->file('avatar');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $imageName); // Store the image in the 'public/images' directory inside the storage folder
        $input['avatar'] = $imageName; // Save only the image name without the directory path

    }

    $employee = Employee::create($input);

    return $this->sendResponse(new EmployeeResource($employee), 'Employee created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employee::find($id);

        if (is_null($employees)) {
            return $this->sendError('Employee not found.');
        }

        return $this->sendResponse(new EmployeeResource($employees), 'Employee retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return $this->sendError('Employee not found.', [], 404);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'avatar' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Image upload validation
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'post' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if ($request->hasFile('avatar')) {
            // Delete the old avatar image if it exists
            if ($employee->avatar && Storage::exists('public/images/' . $employee->avatar)) {
                Storage::delete('public/images/' . $employee->avatar);
            }

            $image = $request->file('avatar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Store the image in the 'public/images' directory inside the storage folder
            $input['avatar'] = $imageName; // Save only the image name without the directory path
        }

        $employee->update($input);

        return $this->sendResponse(new EmployeeResource($employee), 'Employee updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Employee $employees)
    // {
    //     $employees->delete();

    //     return $this->sendResponse([], 'Employee deleted successfully.');
    // }


    public function destroy($id)
{
    $employees = Employee::find($id);

    if (!$employees) {
        return $this->sendError('Employee not found.', [], 404);
    }

    // Delete the avatar image if it exists
    if ($employees->avatar && Storage::exists('public/images/' . $employees->avatar)) {
        Storage::delete('public/images/' . $employees->avatar);
    }

    $employees->delete();

    return $this->sendResponse([], 'Employee deleted successfully.');
}

}
