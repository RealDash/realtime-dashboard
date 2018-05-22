<?php

namespace App\Http\Controllers;
use App\Http\Resources\Artist\ArtistResourceCollection;
use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Artist\ArtistGenericResource;
use Illuminate\Support\Facades\Validator;
use App\Model\Artist;


use Illuminate\Http\Request;

class ArtistController extends ApiController
{
    public function getArtists(){
        $artists = Artist::all();
        return view('admin.artists', compact('artists'));
    }

    public function getSingleArtistDetails($id){
        $artist= Artist::find($id);
        if (!is_null($artist)){
            return new ArtistResource($artist);
        }else{
            return $this->notFound('Artist not found', ["Artist with id of $id does not exists"]);
        }
    }

    /**
     * Gets and paginates the Artists store in the database
     *
     * @return Resource 
     */
    public function getArtistsCount(){
        $collection = collect(['totalArtists' => Artist::count()]);
        return new ArtistGenericResource($collection);
    }

    public function getArtistsWithSummary(){
        $artist = Artist::all()->load('music');
        return new ArtistGenericResource($artist);
    }
}
