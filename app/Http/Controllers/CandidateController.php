<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $candidates = Candidate::all();
        return response()->json($candidates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'nationalite' => 'required|string|max:255',
            'age' => 'required|integer',
            'poids' => 'required|numeric',
            'taille' => 'required|numeric',
            'description_rapide' => 'required|string',
            'description_complete' => 'required|string',
            'photo_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo_profil')) {
            $path = $request->file('photo_profil')->store('public/candidates');
            $data['photo_profil'] = Storage::url($path);
        }

        $candidate = Candidate::create($data);

        return response()->json($candidate, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = Candidate::find($id);
        if (is_null($candidate)) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }
        return response()->json($candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $candidate = Candidate::find($id);
        if (is_null($candidate)) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }

        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'nationalite' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer',
            'poids' => 'sometimes|required|numeric',
            'taille' => 'sometimes|required|numeric',
            'description_rapide' => 'sometimes|required|string',
            'description_complete' => 'sometimes|required|string',
            'photo_profil' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo_profil')) {
            // Supprimer l'ancienne photo si elle existe
            if ($candidate->photo_profil) {
                $oldPath = str_replace('/storage', 'public', $candidate->photo_profil);
                Storage::delete($oldPath);
            }
            $path = $request->file('photo_profil')->store('public/candidates');
            $data['photo_profil'] = Storage::url($path);
        }

        $candidate->update($data);

        return response()->json($candidate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        if (is_null($candidate)) {
            return response()->json(['message' => 'Candidate not found'], 404);
        }

        // Supprimer la photo si elle existe
        if ($candidate->photo_profil) {
            $path = str_replace('/storage', 'public', $candidate->photo_profil);
            Storage::delete($path);
        }

        $candidate->delete();

        return response()->json(['message' => 'Candidate deleted'], 204);
    }
}