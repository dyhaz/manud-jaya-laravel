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
 *         description="Data hasil permintaan perizinan yang diajukan",
 *         @OA\Property(
 *             property="nama",
 *             type="string",
 *             description="Nama lengkap pemohon perizinan"
 *         ),
 *         @OA\Property(
 *             property="alamat",
 *             type="string",
 *             description="Alamat lengkap pemohon perizinan"
 *         ),
 *         @OA\Property(
 *             property="jenis_perizinan",
 *             type="string",
 *             description="Jenis perizinan yang diminta"
 *         ),
 *         @OA\Property(
 *             property="tanggal_mulai",
 *             type="string",
 *             format="date",
 *             description="Tanggal mulai berlakunya perizinan"
 *         ),
 *         @OA\Property(
 *             property="tanggal_selesai",
 *             type="string",
 *             format="date",
 *             description="Tanggal berakhirnya perizinan"
 *         )
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

