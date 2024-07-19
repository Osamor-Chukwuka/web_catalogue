<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWebsiteRequest;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebsiteController extends Controller
{
    // Method to List all websites
    public function index()
    {
        // Get all websites ordered by the number of votes in descending order
        $websites = Website::withCount('votes')
            ->orderBy('votes_count', 'desc')
            ->get();

        return response()->json($websites);
    }


    // Method to Search
    public function search(Request $request)
    {
        $search =  $request->input('search');

        // Initial query to order the result by votes_count descending. If a user searches for a word, the website that matches the word, and has the highest vote, will be shown first, then the rest will follow
        $query = Website::withCount('votes')->orderBy('votes_count', 'desc');

        // Check if the search parameter has a value, if not return error message
        if ($search) {
            // check for the search term in the title, description and URL column
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhere('url', 'like', "%$search%");
            });
            $searchResult = $query->get();

            // Check if search term does not exist in DB
            if ($searchResult->isEmpty()) {
                return response()->json(['message' => 'No data found'], 404);
            }
            return response()->json($searchResult);
        } else {
            return response()->json(['message' => 'Please try searching a word'], 400);
        }
    }



    // Method For Authenticated users to submit new websites
    public function store(StoreWebsiteRequest $request)
    {
        try {
            Log::info('Request Data: ', $request->all());

            // Create the new website
            $website = Website::create([
                'url' => $request->input('url'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]);

            // Attach the website to the selected categories
            $website->categories()->attach($request->input('category_ids'));

            return response()->json($website, 201); // 201 Created status
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server Error'], 500);
        }
    }

    public function destroy($id)
    {
        // Find the website by ID
        $website = Website::findOrFail($id);

        // Delete the website
        $website->delete();

        return response()->json(['message' => 'Website deleted successfully'], 200);
    }
}
