<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests\SynonymRequest;
use App\Repositories\Site\SynonymRepository;
use Illuminate\Http\Request;

class SynonymController extends BaseSiteController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SynonymRequest $request, SynonymRepository $synonymRepository)
    {
        $data = $request->input();
        array_unshift($data["synonyms"], $data["synonym"]);

        $errors = $synonymRepository->serverRequest($data["mainWord"], $data["synonyms"]);

        if (empty($errors)) {
            \Session::flash("info", "Синонимы успешно добавлены!");
            \Session::flash("alert-class", "alert-success");

            return redirect("/");
        }

        dd("wtf");

        //dd($data);

//        if (empty($data)) {
//            echo "good!";
//        }
//        return back()
//            ->withErrors($request)
//            ->withInput();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
