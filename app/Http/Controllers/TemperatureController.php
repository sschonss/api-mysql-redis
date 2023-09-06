<?php

namespace App\Http\Controllers;

use App\Models\Temperature;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemperatureController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $temperatures = $this->getRedis('temperatures');
            $message = 'Temperature List from Redis';
            if (!$temperatures) {
                $temperatures = Temperature::all();
                $this->setRedis('temperatures', $temperatures);
                $message = 'Temperature List from Database';
            }
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $temperatures
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Temperature List',
                'data' => $e->getMessage()
            ], 500);
        }

    }

    public function show(Temperature $temperature): JsonResponse
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Temperature Detail',
                'data' => $temperature
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Temperature Detail',
                'data' => $e->getMessage()
            ], 500);
        }
    }



}
