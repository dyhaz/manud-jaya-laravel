<?php
namespace App\Http\Resources;


/**
 * @OA\Schema(
 *     schema="JenisPerizinanInput",
 *     title="Jenis Perizinan Input",
 *     type="object",
 *     required={"nama_jenis", "deskripsi"},
 *     @OA\Property(
 *         property="nama_jenis",
 *         type="string",
 *         description="Nama jenis perizinan"
 *     ),
 *     @OA\Property(
 *         property="deskripsi_perizinan",
 *         type="string",
 *         description="Deskripsi jenis perizinan"
 *     ),
 * )
 */
class JenisPerizinanAnnotation { /* .... */}
