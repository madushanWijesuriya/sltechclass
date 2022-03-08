<?php

namespace App\Http\Controllers;

use App\Http\Service\ToastMessageServices;
use App\Models\Month;
use App\Models\Video;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function createVideo($id): Application|Factory|View
    {
        return view('videos.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'embed_code' => ['required', 'string'],
            'month_id' => ['required', 'exists:months,id'],
            'description' => ['string','nullable'],
            'url' => ['required', 'image'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        $img_ext = $request->file('url')->getClientOriginalExtension();
        $filename = time() . '.' . $img_ext;
        $path = $request->file('url')->move(public_path() . '/video_thumbnails/', $filename);

        try {

            $month = Month::find($request->input('month_id'));
            if ($month->videos()->create(collect($request->only(['name', 'description', 'embed_code']))->merge(['url' => $filename])->toArray()))
                return redirect()->route('class.edit', $month->classe->id)->with(ToastMessageServices::generateMessage('successfully added'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Added', false));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $video = Video::find($id);
        return view('videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'embed_code' => ['required', 'string'],
            'description' => ['string','nullable'],
        ]);
        //get message type
        $notification = ToastMessageServices::generateValidateMessage($validate);
        //check message type and return message
        if ($notification !== true)
            return redirect()->back()->with($notification);

        try {
            $video = Video::find($id);
            if ($video->update($request->only(['name', 'description', 'embed_code'])))
                return redirect()->route('class.edit', $video->month->classe->id)->with(ToastMessageServices::generateMessage('successfully updated'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Update', false));

        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Update', false));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function deleteVideo($id)
    {
        try {

            if (Video::find($id)->delete())
                return redirect()->back()->with(ToastMessageServices::generateMessage('successfully deleted'));

            return redirect()->back()->with(ToastMessageServices::generateMessage('Cannot Delete', false));
        } catch (Exception $e) {
            return redirect()->back()->with(ToastMessageServices::generateMessage($e->getMessage(), false));
        }
    }
}
