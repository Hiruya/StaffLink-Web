<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PromotionController extends Controller
{
    public function predict(Request $request)
    {
        // Validasi input (pakai nama bebas)
        $validated = $request->validate([
            'department' => 'required|integer',
            'education' => 'required|integer',
            'gender' => 'required|integer',
            'recruitment_channel' => 'required|integer',
            'no_of_trainings' => 'required|integer',
            'age' => 'required|integer|min:18|max:60',
            'previous_year_rating' => 'required|integer|min:1|max:5',
            'length_of_service' => 'required|integer',
            'kpis_met' => 'required|integer|in:0,1',
            'awards_won' => 'required|integer|in:0,1',
            'avg_training_score' => 'required|numeric'
        ]);

        // Remap field agar sesuai dengan yang diminta Flask
        $payload = [
            'department' => $validated['department'],
            'education' => $validated['education'],
            'gender' => $validated['gender'],
            'recruitment_channel' => $validated['recruitment_channel'],
            'no_of_trainings' => $validated['no_of_trainings'],
            'age' => $validated['age'],
            'previous_year_rating' => $validated['previous_year_rating'],
            'length_of_service' => $validated['length_of_service'],
            'KPIs_met >80%' => $validated['kpis_met'],
            'awards_won?' => $validated['awards_won'],
            'avg_training_score' => $validated['avg_training_score'],
        ];

        try {
            $response = Http::post('http://localhost:5000/api/predict', $payload); //INI TARUH ENV WOY

            if ($response->failed()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Prediction service unavailable'
                ], 503);
            }

            return $response->json();

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Exception: ' . $e->getMessage()
            ], 500);
        }
    }
}
