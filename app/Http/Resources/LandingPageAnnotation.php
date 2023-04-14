<?php
namespace App\Http\Resources;


/**
 * @OA\Schema(
 *     schema="LandingPage",
 *     type="object",
 *     @OA\Property(
 *         property="logo_image",
 *         type="string"
 *     ),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="subtitle", type="string"),
 *     @OA\Property(property="visi", type="string"),
 *     @OA\Property(property="misi", type="string"),
 *     @OA\Property(property="about_manud_jaya", type="string")
 * )
 *
 * @OA\Schema(
 *     schema="LandingPageResponse",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         ref="#/components/schemas/LandingPage"
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="LandingPageUpdateRequest",
 *     type="object",
 *     required={
 *         "title",
 *         "subtitle",
 *         "visi",
 *         "misi",
 *         "about_manud_jaya"
 *     },
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="subtitle", type="string"),
 *     @OA\Property(property="visi", type="string"),
 *     @OA\Property(property="misi", type="string"),
 *     @OA\Property(property="about_manud_jaya", type="string"),
 *     @OA\Property(property="logo_image", type="string"),
 *     @OA\Property(
 *         property="aparat_desa",
 *         type="array",
 *         @OA\Items(
 *             type="object",
 *             required={
 *                 "photo",
 *                 "name",
 *                 "position"
 *             },
 *             @OA\Property(
 *                 property="photo",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="name",
 *                 type="string"
 *             ),
 *             @OA\Property(
 *                 property="position",
 *                 type="string"
 *             )
 *         )
 *     )
 * )
 */
class LandingPageAnnotation { /* .... */ }
