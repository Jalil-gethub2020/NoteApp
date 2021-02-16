<?php

namespace App\Http\Controllers\WEB;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller as Controller;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        //$note = Note::where('user_id',Auth::id())->get();
        $notes = Note::where('user_id', auth()->user()->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('notes.index')->with('notes', $notes);
    }


    public function create()
    {
        return view('notes.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content'  => 'required'
        ]);

        $note = Note::create([
            'user_id' => Auth::id(), // $request->user()->id,
            'title'   => $request->title,
            'content' => $request->content
        ]);

        return redirect()->route('notes');
    }


    public function edit($id)
    {
        $note = Note::where('id', $id)->where('user_id', Auth::id())->first();

        if ($note === null) {
            return redirect()->back();
        }

        return view('notes.edit')->with('note', $note);
    }


    public function show($id)
    {
        $note = Note::where('id', $id)->where('user_id', Auth::id())->first();
        return view('notes.show')->with('note', $note);
    }


    public function update(Request $request, $id)
    {
        $note = Note::find($id)->where('user_id', Auth::id())->first();
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ]);

        $note->title = $request->title;
        $note->content = $request->content;
        $note->save();

        return redirect()->back();
    }


    public function destroy($id)
    {
        $note = Note::where('id', $id)->where('user_id', Auth::id())->first(); //only the user note's owner can edit, modify or destroy it!!

        if ($note === null) {
            return redirect()->back();
        }

        $note->delete($id);
        return redirect()->back();
    }
}
