<?php
namespace App\Http\Resources;

/**
 * @OA\Schema(
 *     schema="CreateRequestPerizinan",
 *     required={"nama", "alamat", "warga_id"},
 *     title="Create Request Perizinan",
 *     type="object",
 *     @OA\Property(
 *         property="nama",
 *         type="string",
 *         description="Nama lengkap pemohon perizinan"
 *     ),
 *     @OA\Property(
 *         property="alamat",
 *         type="string",
 *         description="Alamat lengkap pemohon perizinan"
 *     ),
 *     @OA\Property(
 *         property="tanggal_request",
 *         type="string",
 *         description="Tanggal request perizinan"
 *     ),
 *     @OA\Property(
 *         property="keterangan",
 *         type="string",
 *         description="Keterangan perizinan"
 *     ),
 *     @OA\Property(
 *         property="lampiran",
 *         type="string",
 *         description="Lampiran perizinan"
 *     ),
 *     @OA\Property(
 *         property="status_request",
 *         type="string",
 *         description="Status perizinan"
 *     ),
 *     @OA\Property(
 *         property="jenis_perizinan",
 *         type="string",
 *         description="Jenis perizinan yang diajukan"
 *     ),
 *     @OA\Property(
 *         property="jenis_id",
 *         type="integer",
 *         description="ID dari perizinan yang diajukan"
 *     ),
 *     @OA\Property(
 *         property="warga_id",
 *         type="integer",
 *         description="ID dari warga yang mengajukan perizinan"
 *     ),
 *     example={
 *         "nama": "John Doe",
 *         "alamat": "Jl. Sudirman No. 123",
 *         "jenis_perizinan": "Surat Izin Keramaian",
 *         "tanggal_request": "2022-01-01",
 *         "status_request": "",
 *         "keterangan": "Pembuatan surat izin keramaian",
 *         "warga_id": 1
 *     }
 * )
 */
class RequestPerizinanAnnotation { /* .... */}
