<?php
namespace App\Http\Resources;


/**
 * Data yang diminta tidak ditemukan
 *
 * @OA\Schema(
 *     schema="Error",
 *     description="Error",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Pesan error"
 *     ),
 *     example={
 *         "message": "Oops, something went wrong."
 *     }
 * )
 */
class ErrorAnnotation { /* .... */}

