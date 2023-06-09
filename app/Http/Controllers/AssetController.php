<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Upload a new asset file.
     *
     * @OA\Post(
     *     path="/api/assets",
     *     summary="Upload a new asset file.",
     *     operationId="uploadAssetFile",
     *     tags={"Assets"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Asset file to upload",
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"file"},
     *                 @OA\Property(
     *                     property="file",
     *                     type="file",
     *                     format="binary",
     *                     description="Asset file to upload",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Asset file uploaded successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request",
     *     ),
     * )
     */
    public function upload(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'Asset file is required'], 400);
        }

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:50000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $file = $request->file('file');
        $filename = $file->getClientOriginalName();

        // Check if file already exists on disk and append a unique number if necessary
        $path = storage_path('app/assets/' . $filename);
        $increment = 0;
        while (File::exists($path)) {
            $increment++;
            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . $increment . '.' . $file->getClientOriginalExtension();
            $path = storage_path('app/assets/' . $filename);
        }

        // Save the file to disk and return a success response
        $file->storeAs('assets', $filename);

        return response()->json(['data' => $filename,'message' => 'Asset file uploaded successfully'], 201);
    }

    /**
     * Download an asset file.
     *
     * @OA\Get(
     *     path="/api/assets/{filename}",
     *     summary="Download an asset file.",
     *     operationId="downloadAssetFile",
     *     tags={"Assets"},
     *     @OA\Parameter(
     *         name="filename",
     *         in="path",
     *         required=true,
     *         description="The filename of the asset to download",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Asset file downloaded successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Asset file not found",
     *     ),
     * )
     */
    public function download($filename)
    {
        $path = storage_path('app/assets/' . $filename);

        if (!File::exists($path)) {
            return response()->json(['error' => 'Asset file not found'], 404);
        }

        $headers = [
            'Content-Type' => 'application/octet-stream',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        return response()->download($path, $filename, $headers);
    }

    /**
     * Upload a new asset file from base64-encoded data.
     *
     * @OA\Post(
     *     path="/api/assets2",
     *     summary="Upload a new asset file from base64-encoded data.",
     *     operationId="uploadAssetFileFromBase64",
     *     tags={"Assets"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Asset file to upload in base64-encoded format",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"file"},
     *                 @OA\Property(
     *                     property="file",
     *                     type="string",
     *                     format="byte",
     *                     description="Base64-encoded asset file to upload",
     *                 ),
     *                 @OA\Property(
     *                     property="extension",
     *                     type="string",
     *                     description="File extension of the asset file (e.g. 'jpg', 'png', 'pdf')",
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Asset file uploaded successfully",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid request",
     *     ),
     * )
     */
    public function uploadBase64(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $fileData = $request->input('file');
        $fileData = str_replace('data:application/octet-stream;base64,', '', $fileData);
        $fileData = str_replace(' ', '+', $fileData);
        $fileData = base64_decode($fileData);

        $maxFileSize = 50 * 1024 * 1024; // 50 MB
        if (strlen($fileData) > $maxFileSize) {
            return response()->json(['errors' => ['file' => 'The file size must not exceed 50 MB']], 400);
        }

        $extension = $request->input('extension');
        $filename = uniqid('file_', true) . ($extension ? '.' . $extension : '');
        $path = 'assets/' . $filename;
        $increment = 0;
        while (Storage::exists($path)) {
            $increment++;
            $filename = uniqid('file_', true) . '_' . $increment . ($extension ? '.' . $extension : '');
            $path = 'assets/' . $filename;
        }

        Storage::put($path, $fileData);

        return response()->json(['data' => $filename, 'message' => 'Asset file uploaded successfully'], 201);
    }
}
