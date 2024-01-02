<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;
use Sovit\TikTok\Api;
use Exception;
use Illuminate\Support\Facades\Http;

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
            $url = $request->url;
            $parts = explode("reel/", $url);
            $secondPart = explode(" ", $parts[1]);
            $reelsId = substr($secondPart[0], 0, 11);

            $reels = Http::withUrlParameters([
                'endpoint' => 'https://instagram-bulk-profile-scrapper.p.rapidapi.com/clients/api/ig/media_by_id',
                'shortcode' => $reelsId,
                'response_type' => 'reels'
            ])->withHeaders([
                'X-RapidAPI-Key' => '6ef8a43c79msh27786a55139ba01p128c62jsn232fa4a4948d',
                'X-RapidAPI-Host' => 'instagram-bulk-profile-scrapper.p.rapidapi.com'
            ])->get('{+endpoint}?shortcode={shortcode}&response_type={response_type}');

            return $reels->json();
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function tiktokDownload(Request $request)
    {
        try {
            $url = $request->url;

            $tiktok = Http::withUrlParameters([
                'endpoint' => 'https://tiktok-scraper7.p.rapidapi.com/',
                'url' => $url,
                'hd' => '1'
            ])->withHeaders([
                'X-RapidAPI-Key' => '6ef8a43c79msh27786a55139ba01p128c62jsn232fa4a4948d',
                'X-RapidAPI-Host' => 'tiktok-scraper7.p.rapidapi.com'
            ])->get('{+endpoint}?url={url}&hd={hd}');

            return $tiktok->json();
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
