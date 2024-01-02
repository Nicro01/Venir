<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;
use RandsX\InstagramDownloader\InstagramDownloader;
use Exception;

class DownloadController extends Controller
{
    public function youtubeDownload(Request $request)
    {
        $yt = new YouTubeDownloader();

        $links = $yt->getDownloadLinks($request->url);

        $links = $links->getVideoFormats();

        $info = $yt->getVideoInfo($request->url);

        return response()->json([$links, $info]);
    }

    public function instagramDownload(Request $request)
    {
        try {
            $ig = new InstagramDownloader;

            $ig->setUrl($request->url);

            $instagramLink = $ig->getDownloadLink();

            return response()->json($instagramLink);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
