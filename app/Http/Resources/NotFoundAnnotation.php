<?php
namespace App\Http\Resources;


/**
 * Data yang diminta tidak ditemukan
 *
 * @OA\Schema(
 *     schema="NotFound",
 *     description="Data yang diminta tidak ditemukan",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Pesan error yang menunjukkan data tidak ditemukan"
 *     ),
 *     example={
 *         "message": "Data dengan ID 123 tidak ditemukan"
 *     }
 * )
 */
class NotFoundAnnotation { /* .... */}
