<?php
namespace App\Http\Resources;

/**
 * @OA\Schema(
 *     schema="DataResponse",
 *     type="object",
 *     description="Data response dari permintaan perizinan",
 *     @OA\Property(
 *         property="status",
 *         type="string",
 *         description="Keterangan status response",
 *         example="success"
 *     ),
 *     @OA\Property(
 *         property="message",
 *         type="string",
 *         description="Pesan terkait response",
 *         example="Permintaan perizinan berhasil diajukan"
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="object",
 *         description="Data API",
 *     ),
 *     example={
 *         "status": "success",
 *         "message": "Permintaan perizinan berhasil diajukan",
 *         "data": {
 *             "nama": "John Doe",
 *             "alamat": "Jl. Kenanga No. 123",
 *             "jenis_perizinan": "Izin Usaha",
 *             "tanggal_mulai": "2023-04-01",
 *             "tanggal_selesai": "2023-06-30"
 *         }
 *     }
 * )
 */
class DataResponseAnnotation { /* .... */}

