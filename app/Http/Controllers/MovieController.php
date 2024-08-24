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
    public function __construct(MovieService $movieservice){
        $this->movieservice = $movieservice;
    }
    /**
     * Display a listing of the resource.
     */


     public function index(Request $request)
    {
        try {
        $movies = Movie::all()->toQuery();

        if ($request->has('genre')) {
            $movies->ByGenre($request->genre);
        }

        if ($request->has('director')) {
            $movies->ByDirector($request->director);
        }

        if ($request->has('sort_by')) {
           if($request->sort_by == 'desc')
            $order = 'desc';
            else 
            $order = 'asc';
            $movies->ByReleaseYear($order);
        }
        return response()->json($movies->paginate(10),200);
    }
        catch (Exception $e) {  
            return response()->json(["message"=> "internal server error"],500);
           }
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      try{
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
           $movie = $this->movieservice->createMovie($validateddata);
            return response()->json($movie,201);
        } 
         catch(Exception $e) 
         {
            return response()->json(["message"=> "internal server error"],500);

         }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
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
     */
    public function update(Request $request, $id)
    {
        try{
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
                $movie= Movie::findOrFail($id);
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
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $movie= Movie::findOrFail($id);
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
