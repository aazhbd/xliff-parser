<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\XLIFFDocument;
use Illuminate\Support\Facades\DB;


class BaseController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function xliffPost()
    {
        request()->validate([
            'file' => 'required|max:10240',
        ]);

        $filename = time() . '.' . request()->file->getClientOriginalExtension();

        request()->file->move(public_path('files'), $filename);

        return back()->with('success', 'The file is uploaded with name ' . $filename . ' successfully.')->with('file', $filename);
    }

    /**
     * @param $filename
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function importFile($filename)
    {
        $filecontent = file_get_contents(public_path('files') . '/' . $filename);

        $document = new XLIFFDocument($filecontent);

        $body = $document->getBody();

        $language = $document->getLanguage();

        $count = 0;

        foreach ($body['trans-unit'] as $entry) {
            $cond = "";
            $cond .= (!empty($entry['@attributes']['resname'])) ? "resname = '" . $entry['@attributes']['resname'] . "'" : "";
            $cond .= (!empty($entry['@attributes']['id'])) ? " or trans_id = '" . $entry['@attributes']['id'] . "'" : "";

            $exists = DB::table('translations')
                ->where('language_code', $language)
                ->whereRaw($cond)
                ->get();

            if ($exists->isEmpty()) {
                DB::table('translations')->insert([
                    'language_code' => $language,
                    'trans_id' => $entry['@attributes']['id'],
                    'resname' => $entry['@attributes']['resname'],
                    'text' => $entry['source'],
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]);
                $count++;
            }
        }

        if ($count == 0) {
            $message = "The entries were pre-existing, so inserted no entries from XLIFF.";
        } else {
            $message = "The file import operation inserted " . $count . " entries from XLIFF.";
        }

        return back()->with('success', $message);
    }

    /**
     * @return $this
     */
    public function display()
    {
        $languages = DB::table('translations')
            ->select('language_code')->distinct()
            ->get();

        if (request()->isMethod('post')) {
            request()->validate([
                'language_code' => 'required',
            ]);

            $language = request()->language_code;

            $translations = DB::table('translations')
                ->where('language_code', $language)
                ->get();

            return view('display')->with('languages', $languages)->with('translations', $translations);
        }

        return view('display')->with('languages', $languages);
    }
}