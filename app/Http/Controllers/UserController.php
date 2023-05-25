<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse as JsonResponseAlias;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponseAlias
    {
        try {
            $users = $this->getRedis('users');
            if (!$users) {
                $users = User::all();
                $this->setRedis('users', $users);
            }
            return response()->json([
                'success' => true,
                'message' => 'User List',
                'data' => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User List',
                'data' => $e->getMessage()
            ], 500);
        }

    }

    public function store(Request $request): JsonResponseAlias
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $user = User::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User Created',
            'data' => $user
        ], 201);
    }

    public function update(Request $request, User $user): JsonResponseAlias
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'User Updated',
            'data' => $user
        ], 200);
    }

    public function show(User $user): JsonResponseAlias
    {
        try {
            $user = $this->getRedis('user_'.$user->id);
            if (!$user) {
                $user = User::find($user->id);
                $this->setRedis('user_'.$user->id, $user);
            }
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User Details',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(User $user): JsonResponseAlias
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User Deleted',
        ], 200);
    }


    public function filterByName($name): JsonResponseAlias
    {
        try {
            $user = $this->getRedis('user_'.$name);
            if (!$user) {
                $user = User::where('name', 'LIKE', '%'.$name.'%')->get();
                $this->setRedis('user_'.$name, $user);
            }
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User Details',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByEmail($email): JsonResponseAlias
    {
        try {
            $user = $this->getRedis('user_'.$email);
            if (!$user) {
                $user = User::where('email', 'LIKE', '%'.$email.'%')->get();
                $this->setRedis('user_'.$email, $user);
            }
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User Details',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function filterByNameAndEmail($name, $email): JsonResponseAlias
    {
        try {
            $user = $this->getRedis('user_'.$name.'_'.$email);
            if (!$user) {
                $user = User::where('name', 'LIKE', '%'.$name.'%')->where('email', 'LIKE', '%'.$email.'%')->get();
                $this->setRedis('user_'.$name.'_'.$email, $user);
            }
            return response()->json([
                'success' => true,
                'message' => 'User Details',
                'data' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User Details',
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
