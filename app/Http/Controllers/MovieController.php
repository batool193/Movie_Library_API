<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MovieController extends Controller
{
    protected $movieservice;
   
     /**
     * Constructor to initialize MovieService
     *
     * @param MovieService $movieservice
     */
    public function __construct(MovieService $movieservice){
        $this->movieservice = $movieservice;
    }
    /**
     * Display a listing of the Movies
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


     public function index(Request $request)
    {
        try {
             // Retrieve all movies and convert to query builder instance
        $movies = Movie::all()->toQuery();
           // Filter by genre if provided
        if ($request->has('genre')) {
            $movies->ByGenre($request->genre);
        }
         // Filter by director if provided
        if ($request->has('director')) {
            $movies->ByDirector($request->director);
        }
          // Sort by release year if provided
        if ($request->has('sort_by')) {
           if($request->sort_by === 'desc')
            $order = 'desc';
            else 
            $order = 'asc';
            $movies->ByReleaseYear($order);
        }
         // Return paginated list of movies
        return response()->json($movies->paginate(10),200);
    }
        catch (Exception $e) {  
            return response()->json(["message"=> "internal server error"],500);
           }
    }
    

     /**
     * Store a newly created movie 
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
      try{
         // Validate the request data
        $validateddata= $request->validate([
            "title"=> "required|string|max:255",
            "director"=> "required|string|max:255",
            "genre"=>"required|string|max:255",
            "release_year"=> "required|integer",
            "description"=> "required|string|max:255",]);
      } 
      catch (Exception $e)
    {
        return response()->json(["message"=> "validation error"],400);
       
    }

        try{
              // Create a new movie using the validated data and movie service
           $movie = $this->movieservice->createMovie($validateddata);
            return response()->json($movie,201);
        } 
         catch(Exception $e) 
         {
            return response()->json(["message"=> "internal server error"],500);

         }
    }

   /**
     * Display the specified movie with its rating
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try{
              // Find the movie by ID and find its ratings
            $movie= Movie::with('ratings')->findOrFail($id);
            return response()->json($movie,200);
        }
        catch (ModelNotFoundException $e) {
            return response()->json(["message"=> "not found"],404);
        }
        catch (Exception $e) {
        return response()->json(["message"=> "internal server error"],500);
        }
     
    }

     /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try{
             // Validate the request data
            $validateddata= $request->validate([
                "title"=> "required|string|max:255",
                "director"=> "required|string|max:255",
                "genre"=>"required|string|max:255",
                "release_year"=> "required|integer",
                "description"=> "required|string|max:255",]);
          } 
          catch (Exception $e)
        {
            return response()->json(["message"=> "validation error"],400);
           
        }
            try{
                // Find the movie by ID
                $movie= Movie::findOrFail($id);
                  // Update the movie using the validated data and movie service
            $movie = $this->movieservice->updateMovie($validateddata, $movie);
            return response()->json($movie,201);
        }
        catch (ModelNotFoundException $e) {
             return response()->json(["message"=> "not found"],404);
        }
            catch (Exception $e)
            {
                return response()->json(["message"=> "internal server error"],500);
            }
    }

     /**
     * delete movie
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try{
                 // Find the movie by ID
            $movie= Movie::findOrFail($id);
               // Delete the movie using movie service
        $movie = $this->movieservice->deleteMovie($movie);
        return response()->json($movie,204);}
        catch (ModelNotFoundException $e)
        {
            return response()->json(["message"=> "not found"],404);
        }
        catch (Exception $e)
            {
                return response()->json(["message"=> "internal server error"],500);
            }
    }
}
