<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
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
        ]);

        $projectId = Project::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'color' => $validated['color'],
            'like' => 0,
            'profilePicPath' => $validated['profilePicPath']
        ])->id;

        $dd = [];
        $data = json_decode($request->getContent());
        if (isset($data->{'texts'})) {
            foreach ($data->{'texts'} as $text) {
                if (ProjectController::validText($text)) {
                    $textId = Text::create(["text" => $text])->id;
                    ProjectText::create([
                        "projectId" => $projectId,
                        "textId" => $textId
                    ]);
                }
            }
        }
        if (isset($data->{'hashtags'})) {
            foreach ($data->{'hashtags'} as $hashtag) {
                if (ProjectController::validHashtag($hashtag)) {
                    try {
                        $hashtagId = Tag::create(["name" => $hashtag])->id;
                        ProjectHashTag::create([
                            "projectId" => $projectId,
                            "hashtagId" => $hashtagId
                        ]);
                    } catch (\Throwable $th) {
                        /**
                         * il faudrait verifier que l'erreur soit bien
                         * que le hashtag existe deja sinon nimporte qui pourrait
                         * link de mauvais hashtag
                         */
                        $hashtagId = ProjectController::getHashtagId($hashtag);
                        if ($hashtagId != -1) {
                            ProjectHashTag::create([
                                "projectId" => $projectId,
                                "hashtagId" => $hashtagId
                            ]);
                        }
                    }
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
            "hashtags" => ProjectController::getProjectHashtag($id),
            "texts" => ProjectController::getProjectText($id)

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

    //mauvais, à remplacer par un truc plus laravel
    static private function getHashtagId($hashtag)
    {
        $hashtags = Tag::all();
        foreach ($hashtags as $tag) {
            if ($tag["name"] == $hashtag) {
                return $tag['id'];
            }
        }
        return -1;
    }

    static private function getProjectHashtag($projectId)
    {
        //j'arrive pas à utiliser where !!
        $hashtags = [];
        foreach (ProjectHashTag::all() as $l) {
            if ($l['projectId'] == $projectId) {
                array_push($hashtags, Tag::findOrFail($l['hashtagId'])['name']);
            }
        }

        return $hashtags;
    }

    static private function getProjectText($projectId)
    {
        $texts = [];
        foreach (ProjectText::all() as $l) {
            if ($l['projectId'] == $projectId) {
                array_push($texts, Text::findOrFail($l['textId'])['text']);
            }
        }

        return $texts;
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
