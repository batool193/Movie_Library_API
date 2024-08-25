<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Services\RatingService;
use Illuminate\Support\Facades\Auth;


class RatingController extends Controller
{
    protected $ratingservice;

     /**
     * Constructor to initialize RatingService
     *
     * @param RatingService $ratingservice
     */
    public function __construct(RatingService $ratingservice){
        $this->ratingservice = $ratingservice;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

     /**
     * Store a newly created rating 
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try{
            $validateddata= $request->validate([
                "user_id" => "required|integer",
                "movie_id" => "required|integer",
                "rating" => "required|integer|min:1|max:5",
                "review" => "nullable|string", ]);     
          } 
          catch (Exception $e)
        {
            return response()->json(["message"=> "validation error"],400);
           
        }
    
            try{
              $rating = $this->ratingservice->createRating($validateddata);
                return response()->json($rating,201);
            } 
             catch(Exception $e) 
             {
                return response()->json(["message"=> "internal server error"],500);
    
             }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
