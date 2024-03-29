<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use YouTube\YouTubeDownloader;
use YouTube\Exception\YouTubeException;
use Sovit\TikTok\Api;
use Exception;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class DownloadController extends Controller
{
    public function youtubeDownload(Request $request)
    {
        $yt = new YouTubeDownloader();

        $links = $yt->getDownloadLinks($request->url);

        $links = $links->getAllFormats();

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
                'X-RapidAPI-Key' => env('RAPID_API_KEY'),
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
                'X-RapidAPI-Key' => env('RAPID_API_KEY'),
                'X-RapidAPI-Host' => 'tiktok-scraper7.p.rapidapi.com'
            ])->get('{+endpoint}?url={url}&hd={hd}');

            return $tiktok->json();
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function downloadVideo(Request $request)
    {
        $videoUrl = $request->url;
        $client = new Client();

        try {
            $response = $client->get($videoUrl);
            $videoContent = $response->getBody()->getContents();

            $response = response($videoContent, 200, [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="video.mp4"',
            ]);

            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
