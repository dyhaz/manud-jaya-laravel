<?php
namespace App\Http\Resources;


/**
 * Error validasi data request
 *
 * @OA\Schema(
 *     schema="ValidationError",
 *     description="Error validasi data request",
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Pesan error yang menunjukkan data request tidak valid"
 *     ),
 *     @OA\Property(
 *         property="errors",
 *         type="array",
 *         description="Daftar error validasi pada setiap properti request",
 *         @OA\Items(
 *             type="string"
 *         )
 *     ),
 *     example={
 *         "message": "Data request tidak valid",
 *         "errors": {
 *             "Nama harus diisi",
 *             "Alamat harus diisi",
 *             "Jenis perizinan harus diisi",
 *             "Warga ID harus diisi"
 *         }
 *     }
 * )
 */
class ValidationErrorAnnotation { /* .... */}
