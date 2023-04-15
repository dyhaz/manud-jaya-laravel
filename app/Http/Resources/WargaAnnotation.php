<?php
namespace App\Http\Resources;


/**
 * @OA\Schema(
 *     schema="Warga",
 *     @OA\Property(property="warga_id", type="integer", format="int64"),
 *     @OA\Property(property="nama_warga", type="string"),
 *     @OA\Property(property="alamat", type="string"),
 *     @OA\Property(property="nomor_telepon", type="string"),
 *     @OA\Property(property="email", type="string", format="email"),
 *     @OA\Property(property="news_subscribe", type="boolean"),
 *     @OA\Property(property="nik", type="string"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class WargaAnnotation { /* .... */}
