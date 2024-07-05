<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Validator;
use App\Models\Integration;

class IntegrationController extends Controller
{
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|url',
            'token' => 'required|string',
        ]);

        $user = $request->user();

        Integration::updateOrCreate(
            ['user_id' => $user->id],
            $validatedData
        );

        return redirect('/integrations')->with('success', 'Integration saved successfully!');
    }

    public function getAlienVaultCredentials(Request $request)
    {
        $user = $request->user();

        $credentials = Integration::where('user_id', $request->user()->id)->first();

        if ($credentials) {
            return response()->json([
                'url' => $credentials->url,
                'token' => $credentials->token,
            ]);
        } else {
            return response()->json(['message' => 'Credentials not found.'], 404);
        }
    }

    public function storeActivities(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'activities' => 'required|array',
            'activities.*.activity_id' => 'required|string',
            'activities.*.activity_name' => 'required|string',
            'activities.*.activity_description' => 'required|string',
            'activities.*.activity_author' => 'required|string',
            'activities.*.activity_timestamp' => 'required|string',
            'activities.*.activity_ips' => 'nullable|string',
            'activities.*.activity_file_hashes' => 'nullable|string',
            'activities.*.activity_domains' => 'nullable|string',
            'activities.*.activity_emails' => 'nullable|string',
            'activities.*.activity_cves' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        foreach ($request->input('activities') as $activityData) {
            Activity::create($activityData);
        }

        return response()->json(['status' => 'success'], 200);
    }
}
