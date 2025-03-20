<?php

namespace App\Http\Controllers;
use App\Models\Textfont;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;


class LinkController extends Controller
{
    //
    public function updateSetting(Request $request)
    {
     
        $request->validate([
            'key' => 'required|string',
            'value' => 'required|string'
        ]);

        Textfont::updateOrCreate(
            ['key' => $request->key],
            ['value' => $request->value]
        );

        return response()->json(['success' => true, 'message' => 'Teks berhasil diperbarui!']);
    }

}
