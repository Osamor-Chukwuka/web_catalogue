<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request, $websiteId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $userId = $request->input('user_id');

        // Check if the user has already voted for this website
        $existingVote = Vote::where('user_id', $userId)->where('website_id', $websiteId)->first();

        if ($existingVote) {
            // If vote exists, remove the vote
            $existingVote->delete();
            return response()->json(['message' => 'Vote removed'], 200);
        } else {
            // If vote doesn't exist, add a new vote
            Vote::create([
                'user_id' => $userId,
                'website_id' => $websiteId,
            ]);
            return response()->json(['message' => 'Vote added'], 201);
        }
    }
}
