<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ArtistController as UserArtistController;
use App\Http\Resources\Artist\ArtistResourceCollection;
use App\Http\Resources\Artist\ArtistResource;
use App\Http\Resources\Artist\ArtistGenericResource;
use Illuminate\Support\Facades\Validator;
use App\Model\Artist;
use Illuminate\Validation\Rule;

class ArtistController extends UserArtistController
{
    /**
     * Creates a new Artist
     *
     * @param Request $request
     * @return validation failed or Artist resource json response
     */
    public function createArtist(Request $request){
        $data = $request->all();
        $this->validator($data)->validate();
        $artist = $this->create($data, $request);
        return back();
    }


    
    /**
     * Deletes a single Artist by finding the model using id
     *
     * @param Request $request
     * @param [int] $id
     * @return success or not found json response
     */
    public function deleteSingleArtist(Request $request, $id){

        $artist= Artist::find($id);
        if (!is_null($artist)){
            if($artist->delete()){
                return $this->actionSuccess('Artist deleted');
            }
        }else{
            return $this->notFound('Artist not found', ["Artist with id of $id does not exists"]);
        }
    }

    /**
     * Deletes all selected Artist coming from the form
     *
     * @param Request $request
     * @return success or not found json response
     */
    public function deleteMultipleArtist(Request $request){

        $artist= Artist::whereIn('id', $request->Artist_id);
        if (!is_null($artist)){
            if($artist->delete()){
                return $this->actionSuccess(count($request->Artist_id).' Artist(s) deleted');
            }
        }else{
            return $this->notFound('No Artist Selected', ["No Artist Selected"]);
        }
    }


    /**
     * Edit single Artist
     *
     * @param Request $request
     * @return success or not found json response
     */
    public function editSingleArtist(Request $request, $id){

        $artist= Artist::find($id);
        $validate = $this->validatorEdit($request->all());
        if (!is_null($artist)){
            $has_file = false;
            if($request->has('avatar')){
                    $has_file = true;
                    
                }
            if(count($validate->errors()) > 0){
                return $this->validationFailed("Artist Creation failed", $validate->errors());
            }

            try{
                if($has_file){
                    $old_file = public_path()."/artists/img/".$artist->avatar;
                    $artist->avatar = $this->processImage($request);
                    @unlink($old_file);
                }
                
                $artist->artist_name = $request->artist_name;
                $artist->save();
                return $this->actionSuccess("Artist saved successfully");
            }catch(\Exception $exception){
                return $this->dataCreationFailed($exception->getMessage());
            }
        }else{
            return $this->notFound('Artist not found', ["Artist with id of $id not found"]);
        }


    }

    protected function processImage($request){
        $filename = null;

        if($request->has('avatar')){
            $image = $request->file('avatar'); 
            $filename = time().".".$image->getClientOriginalExtension();
            $path = public_path('/artists/img/');
            $image->move($path,$filename);
        }
        return $filename;
    }


    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            'artist_name' => 'required|string|max:255|unique:artists',
            'avatar' => ['nullable',Rule::dimensions()->maxWidth(550)->maxHeight(512)->minWidth(400)->minHeight(400)],
        ]);
    }

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorEdit(array $data){
        return Validator::make($data, [
            'artist_name' => 'required|string|max:255',
            'avatar' => ['nullable',Rule::dimensions()->maxWidth(550)->maxHeight(512)->minWidth(300)->minHeight(300)],
        ]);
    }


    /**
     * Create a new Artist instance after saving data.
     *
     * @param  array  $data
     * @return \App\Model\Artist
     */
    protected function create(array $data, $request){
        try{
            return Artist::create([
                'artist_name' => $data['artist_name'],
                'avatar' => $this->processImage($request)
            ]);
        }catch(\Exception $exception){

            return $this->dataCreationFailed($exception->getMessage());

        }
    }

}
