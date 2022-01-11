<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use App\Models\Tag;
use App\Models\Text;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|unique:projects|max:20',
            'description' => 'required',
            'color' => 'required|max:7',
            'profilePicPath' => 'required',
            'token' => 'required'
        ]);

        // Check if token is correct, stop if not
        if (!ProjectController::tokenExist($validated['token'])) {
            return response()->json([
                "status" => 'fail wrong token',
            ]);
        }

        // Create the new project
        $projectId = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'color' => $validated['color'],
            'like' => 0,
            'profilePicPath' => $validated['profilePicPath']
        ])->id;

        // Link the user with the new project
        $user = User::where('identificationToken', $validated['token'])->get()->first();
        $user->projects()->attach($projectId);

        // Create texts and link them to the new project
        $data = json_decode($request->getContent());
        if (isset($data->{'texts'})) {
            foreach ($data->{'texts'} as $text) {
                if (ProjectController::validText($text)) {
                    $text = Text::create(["text" => $text]);
                    $text->projects()->attach($projectId);
                }
            }
        }

        // Link the tags with the new project (create them if they don't already exist)
        if (isset($data->{'hashtags'})) {
            foreach ($data->{'hashtags'} as $hashtagName) {
                if (ProjectController::validHashtag($hashtagName)) {
                    $hashtag = Tag::where('name', $hashtagName)->get()->first();
                    if (empty($hashtag)) {
                        $hashtag = Tag::create(["name" => $hashtagName]);
                    }
                    $hashtag->projects()->attach($projectId);
                }
            }
        }

        return response()->json([
            "status" => 'success',
            "id" => $projectId
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return response()->json([
            "project" => $project,
            "hashtags" => $project->hashtags()->get()->pluck('name'),
            "texts" => $project->texts()->get()->pluck('text'),
            "users" => $project->users()->get()->pluck('pseudo'),
        ]);
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
    }


    public static function like($id)
    {
        $msg = "fail";
        if (is_int((int)$id)) {
            $project = Project::findOrFail($id);
            $project['like'] = $project['like'] + 1;
            $project->update();
            $msg = "success";
        }
        return response()->json(["status" => $msg]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    static private function tokenExist($token)
    {
        $user = User::where('identificationToken', $token)->get();
        return isset($user[0]['pseudo']);
    }

    static private function validText($text)
    {
        return True;
    }

    static private function validHashtag($text)
    {
        return True;
    }

}
