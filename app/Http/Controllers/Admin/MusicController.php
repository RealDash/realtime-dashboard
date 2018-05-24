<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MusicController as UserMusicController;
use App\Http\Resources\Music\MusicResourceCollection;
use App\Http\Resources\Music\MusicResource;
use Illuminate\Support\Facades\Validator;
use App\Model\Music;
use Auth;


class MusicController extends UserMusicController
{

    /**
     * Deletes a single music by finding the model using id
     *
     * @param Request $request
     * @param [int] $id
     * @return success or not found json response
     */
    public function uploadMusic(Request $request){

        $file = $request->file('music');
        $filename = time().".".$file->getClientOriginalExtension();
        $path = public_path('/img');
        $file->move($path,$filename);
    }

    /**
     * Creates a new music
     *
     * @param Request $request
     * @return validation failed or music resource json response
     */
    public function createMusic(Request $request){
        
        $data = $request->all();
        $music = $request->file('file_name'); 
        $this->validator($data)->validate();

        $filename = time().".mp3";
        $size = $music->getClientSize() / 1000000;
        $format = $music->getClientOriginalExtension();
        $path = public_path('music');

        $music->move($path,$filename);

        $music_data = $this->create($data, $filename , $size, $format);
        return back()->with('success', 'Music Created');
    }


    /**
     * Deletes a single music by finding the model using id
     *
     * @param Request $request
     * @param [int] $id
     * @return success or not found json response
     */
    public function deleteSingleMusic(Request $request, $id){

        $music= Music::find($id);
        if (!is_null($music)){
            if($music->delete()){
                return back()->with('success', 'Music Deleted');
            }
        }else{
            return back()->with('error', 'Music doesnot exist');
        }
    }

    /**
     * Deletes all selected music coming from the form
     *
     * @param Request $request
     * @return success or not found json response
     */
    public function deleteMultipleMusic(Request $request){

        $music= Music::whereIn('id', $request->music_id);
        if (!is_null($music)){
            if($music->delete()){
                return $this->actionSuccess(count($request->music_id).' Music(s) deleted');
            }
        }else{
            return $this->notFound('No Music Selected', ["No Music Selected"]);
        }
    }

    /**
     * Edit single music
     *
     * @param Request $request
     * @return success or not found json response
     */
    public function editSingleMusic(Request $request, $id){

        $music= Music::find($id);
        // dd($request);
        if (!is_null($music)){
            $data = $request->all();
            $validate = null;
            $has_file = false;
            
            if($request->has('file_name')){
                $has_file = true;
                $validate = $this->validator($data);
            }else{
                $validate = $this->validatorEdit($data);
            }
            
            if(count($validate->errors()) > 0){
                return $this->validationFailed("Music creation failed", $validate->errors());
            }

            try{
                if($has_file){
                    $old_file = public_path()."/music/".$music->file_name;
                    $music_file = $request->file('file_name');
                    $filename = time().".".$music_file->getClientOriginalExtension();
                    $size = $music_file->getClientSize() / 1000000;
                    $format = $music_file->getClientOriginalExtension();
                    $path = public_path('music');
                    @unlink($old_file);
                    $music_file->move($path,$filename);
                    $music->file_name = $filename;
                    $music->format = $request->format;
                    $music->size = $request->size;
                }
                $music->music_title = $request->music_title;
                $music->artist_id = $request->artist_id;
                $music->album_id = $request->album_id;
                $music->genre_id = $request->genre_id;
                
                $music->save();
                return $this->actionSuccess("Music saved successfully");
            }catch(\Exception $exception){
                return $this->dataCreationFailed($exception->getMessage());
            }
        }else{
            return $this->notFound('Music not found', ["Music with id of $id not found"]);
        }


    }


       /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'file_name' => 'file|max:32768',
            'artist_id' => 'required|numeric',
            'music_title' => 'required|string|max:255',
        ]);
    }

       /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validatorEdit(array $data)
    {
        return Validator::make($data, [
            'artist_id' => 'required|numeric',
            'music_title' => 'required|string|max:255',
        ]);
    }


    /**
     * Create a new music instance after saving data.
     *
     * @param  array  $data
     * @return \App\Model\Music
     */
    protected function create(array $data, $filename, $size, $format)
    {
        try{
            return Music::create([
                'file_name' => $filename,
                'music_title' => $data['music_title'],
                'format' => $format,
                'artist_id' => $data['artist_id'],
                'size' => $size,
                'user_id' => Auth::user()->id,
            ]);
        }catch(\Exception $exception){

            return $this->dataCreationFailed($exception->getMessage());

        }
    }

}
