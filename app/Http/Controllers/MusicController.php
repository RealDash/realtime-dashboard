<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\Music\MusicResourceCollection;
use App\Http\Resources\Music\MusicResource;
use App\Http\Resources\Music\MusicGenericResource;
use App\Model\Music;
use App\Events\CurrentMusic;
use App\Model\Artist;
use Auth;

class MusicController extends ApiController
{
    
    /**
     * Gets and paginates the musics store in the database
     *
     * @return Resource collection
     */
    public function getMusics(){
        // return new MusicResourceCollection(Music::all()->load('genre', 'artist'));
        $musics = Music::all();
        $artists = Artist::all();
        return view('admin.musics', compact('musics', 'artists'));
    }


    /**
     * Gets and paginates the musics store in the database
     *
     * @return Resource collection
     */
    public function apiGetMusics(){
        return new MusicResourceCollection(Music::all()->load('artist'));
    }

    

    /**
     * Gets and paginates the musics store in the database
     *
     * @return Resource collection
     */
    public function getMusicsCount(){
        $collection = collect(['totalmusics' => Music::count()]);
        return new MusicGenericResource($collection);
    }

    /**
     * Gets and paginates the musics store in the database
     *
     * @return Resource collection
     */
    public function updateFrequency($id){
        $music = Music::find($id);

        if(!is_null($music)){
            $music->frequency = $music->frequency + 1;
            $music->save();
            return $this->actionSuccess('Frequency Updated');
        }
    }


    public function getLatestMusics(){
        $music = Music::orderBy('created_at', 'desc')->get()->take(6);
        return new MusicResourceCollection($music->load('genre', 'artist'));
    }


    /**
     * Fetches a single music if it exists
     *
     * @param [int] $id
     * @return not found or music resource json response 
     */
    public function getSingleMusicDetails($id){
        $music= Music::find($id);
        if (!is_null($music)){
            return new MusicResource($music->load('genre'));
        }else{
            return $this->notFound('Music not found', ["Music with id of $id does not exists"]);
        }
    }


    /**
     * Fetches a single music if it exists
     *
     * @param [int] $id
     * @return not found or music resource json response 
     */
    public function apiSetCurrentMusic($id){
        $this->broadcastCurrentMusic($id);
        return $this->actionSuccess("Music set, wait a while");
    }


    

    /**
     * Increases the music frequency
     *
     * @param [int] $id
     * @return success or not found json response
     */
    public function setMusicFrequencty($id){

        $music= Music::find($id);
        if (!is_null($music)){
            try{
                $music->frequency = $music->frequency + 1;
                $music->save();
            }catch(\Exception $exception){
                return $this->actionFailure($exception->getMessage());
            }
        }else{
            return $this->notFound('Music not found', ["Music with id of $id does not exists"]);
        }
    }


}
