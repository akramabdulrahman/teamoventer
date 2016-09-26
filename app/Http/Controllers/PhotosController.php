<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\Like;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\Facades\Image;
use App\Http\Requests;

class PhotosController extends Controller
{
    public function index(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->getMessageBag()->all());
        }

        return response()->json(Photo::distance($request->get('lat'), $request->get('lng'), 1)->get());
    }

    public function create(Request $request, Photo $photo)
    {
        $validation = Validator::make($request->all(), [
            'lat' => 'required',
            'lng' => 'required',
            'user_id' => 'required',
            'img' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->getMessageBag()->all());
        }

        $img = Image::make($request->get('img'));
        $publicPath = 'photos/' . $request->get('user_id') . '_' . str_random() . '.' . explode('/', $img->mime)[1];
        $img->save(base_path() . '/public/' . $publicPath);

        return response()->json($photo->create([
            'lat' => $request->get('lat'),
            'lng' => $request->get('lng'),
            'user_id' => $request->get('user_id'),
            'url' => $publicPath,
        ]));

    }

    public function like(Photo $photo, Request $request)
    {
        $photo->likes()->save(Like::firstOrNew([
            'user_id' => $request->get('user_id'),
            'likable_id' => $photo->id,
            'likable_type' => Photo::class
        ]));
        return response()->json($photo);
    }

    public function comment(Photo $photo, Request $request)
    {
        $comment = new Comment([
            'user_id' => $request->get('user_id'),
            'content' => $request->get('content')
        ]);
        $photo->comments()->save($comment);
        return response()->json($photo->first());
    }


}
