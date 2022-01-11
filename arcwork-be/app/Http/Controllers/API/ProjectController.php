<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Project;
use App\Models\User;
use App\Models\Tag;
use App\Models\Text;
use App\Models\ProjectHashTag;
use App\Models\ProjectText;

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
        $validated = $request->validate([
            'name' => 'required|unique:projects|max:20',
            'description' => 'required',
            'color' => 'required|max:7',
            'profilePicPath' => 'required',
            'token' => 'required'
        ]);


        $exist = ProjectController::tokenExist($validated['token']);
        if (!$exist) {
            return response()->json([
                "status" => 'fail wrong token',
            ]);
        }
        $projectId = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'color' => $validated['color'],
            'like' => 0,
            'profilePicPath' => $validated['profilePicPath']
        ])->id;

        $data = json_decode($request->getContent());
        if (isset($data->{'texts'})) {
            foreach ($data->{'texts'} as $text) {
                if (ProjectController::validText($text)) {
                    $text = Text::create(["text" => $text]);
                    $text->projects()->attach($projectId);

                }
            }
        }
        if (isset($data->{'hashtags'})) {
            foreach ($data->{'hashtags'} as $hashtag) {
                if (ProjectController::validHashtag($hashtag)) {
                    //$hashtag = DB::table('tags')->where('name', $hashtag)->get(); // other version, delete the DB header along with this line
                    Tag::where('name', $hashtag)->get();
                    if (empty($hashtag)) {
                        $hashtag = Tag::create(["name" => $hashtag]);
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


    public function like(Request $request)
    {
        $validated = $request->validate(['id' => 'required']);
        $user = Project::findOrFail($validated['id']);
        $user['like'] = $user['like'] + 1;
        $user->update();
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
