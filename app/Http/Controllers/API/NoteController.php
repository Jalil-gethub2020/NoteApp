<?php

namespace App\Http\Controllers\API;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Note as NoteResource;
use App\Http\Controllers\API\BaseController as BaseController;

class NoteController extends BaseController
{

    public function index()
    {
        // $notes = Note::all();
        $notes = Note::where('user_id', auth()->user()->id); //only logged user can see his own notes !!
        return $this->sendResponse(NoteResource::collection($notes), 'All User Notes Sent');
        // return $this->sendError('', ['error' => 'Unauthorized !!You have access ONLY to your Own Notes']);
    }

    /*  public function userNote($id) // userNote($id) can replace index function in case private notes !!
    {
        $notes = Note::where('user_id', $id)->get();
        return $this->sendResponse(NoteResource::collection($notes), 'Notes Successfully Retrieved');
    }
*/

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
            //'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }

        $user = Auth::user();
        $input['user_id'] = $user->id;
        $note = Note::create($input);
        return $this->sendResponse(new noteResource($note), 'Note Successfully Created');
    }


    public function show($id)
    {
        $note = Note::find($id);
        if (is_null($note)) {
            return $this->sendError('Note Not Found');
        }

        if ($note->user_id != Auth::id()) {
            // return $this->sendError('You are NOT Allowed to do this action !!', $validator->errors());
            return $this->sendError('Please Check your Auth and Try again', ['error' => 'Unauthorized']);
        }

        return $this->sendResponse(new NoteResource($note), 'Note Successfully Found');
    }


    public function update(Request $request, Note $note)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
            // 'user_id' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError('Please validate error', $validator->errors());
        }

        if ($note->user_id != Auth::id()) {
            return $this->sendError('You are NOT Allowed to do this action !!', $validator->errors());
        }

        $note->title = $input['title'];
        $note->content = $input['content'];
        // $note->user_id = $input['user_id'];
        $note->save();

        return $this->sendResponse(new NoteResource($note), 'Note Successfully Updated');
    }


    public function destroy(Note $note)
    {
        $errorMessage = [];

        if ($note->user_id != Auth::id()) {
            return $this->sendError('You are NOT Allowed to do this action !!', $errorMessage);
        }

        $note->delete();
        return $this->sendResponse(new NoteResource($note), 'Note Successfully Deleted');
    }
}
