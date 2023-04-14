<?php

namespace App\Http\Controllers;

use App\Models\LandingPage;
use Illuminate\Http\Request;

class LandingPageController
{
    /**
     * @OA\Get(
     *     path="/api/landing-page",
     *     summary="Get landing page data",
     *     operationId="landingPage",
     *     tags={"Landing"},
     *     @OA\Response(
     *         response="200",
     *         description="Returns the landing page data",
     *         @OA\Property(property="nama", type="object", example="Program A"),
     *         @OA\JsonContent(ref="#/components/schemas/LandingPageResponse")
     *     )
     * )
     */
    public function show()
    {
        $landingPage = LandingPage::first();

        if (!$landingPage) {
            $landingPage = LandingPage::create([]);
        }

        return response()->json(['data' => $landingPage]);
    }

    /**
    * @OA\Post(
    *     path="/api/landing-page",
    *     summary="Update landing page data",
    *     operationId="updateLandingPage",
    *     tags={"Landing"},
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/LandingPageUpdateRequest")
    *     ),
    *     @OA\Response(
    *         response="200",
    *         description="Landing page updated successfully"
    *     ),
    *     @OA\Response(
    *         response="422",
    *         description="Validation error(s)",
    *         @OA\JsonContent(ref="#/components/schemas/ValidationError")
    *     )
    * )
    */
    public function update(Request $request)
    {
        $landingPage = LandingPage::first();

        if (!$landingPage) {
            $landingPage = LandingPage::create([]);
        }

        if ($request->has('aparat_desa')) {
            $aparatDesa = $request->aparat_desa;
            $landingPage->aparat_desa = $aparatDesa;
        }

//        $landingPage->update([
//            'logo_image' => $request->logo_image,
//            'title' => $request->title,
//            'subtitle' => $request->subtitle,
//            'visi' => $request->visi,
//            'misi' => $request->misi,
//            'about_manud_jaya' => $request->about_manud_jaya,
//        ]);
        $landingPage->logo_image = $request->logo_image;
        $landingPage->title = $request->title;
        $landingPage->subtitle = $request->subtitle;
        $landingPage->visi = $request->visi;
        $landingPage->misi = $request->misi;
        $landingPage->about_manud_jaya = $request->about_manud_jaya;
        $landingPage->save();

        return response()->json(['message' => 'Landing page updated successfully.']);
    }
}
