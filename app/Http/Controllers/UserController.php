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
            $message = 'User List from Redis';
            if (!$users) {
                $users = User::all();
                $this->setRedis('users', $users);
                $message = 'User List from Database';
            }
            return response()->json([
                'success' => true,
                'message' => $message,
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

    public function show($id): JsonResponseAlias
    {
        try {
            $user = $this->getRedis('user_'.$id);
            $message = 'User Details from Redis';
            if (!$user) {
                $user = User::find($id);
                $this->setRedis('user_'.$id, $user);
                $message = 'User Details from Database';
            }
            return response()->json([
                'success' => true,
                'message' => $message,
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

    public function clearCache($key): JsonResponseAlias
    {
        try {
            $this->deleteRedis($key);
            return response()->json([
                'success' => true,
                'message' => 'Cache Cleared',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cache Cleared',
                'data' => $e->getMessage()
            ], 500);
        }
    }

}
