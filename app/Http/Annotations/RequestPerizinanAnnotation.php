<?php
/**
 * @OA\Schema(
 *     schema="UpdateRequestPerizinan",
 *     title="Update Request Perizinan",
 *     description="Data yang diperlukan untuk memperbarui permintaan perizinan",
 *     type="object",
 *     required={"nama", "alamat", "jenis_perizinan", "jenis_id", "tanggal_mulai", "tanggal_selesai"},
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
 *         property="jenis_perizinan",
 *         type="string",
 *         description="Jenis perizinan yang diminta"
 *     ),
 *     @OA\Property(
 *         property="jenis_id",
 *         type="integer",
 *         description="ID dari perizinan yang diajukan"
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
 *         property="status_request",
 *         type="string",
 *         description="Status perizinan"
 *     ),
 *     @OA\Property(
 *         property="tanggal_mulai",
 *         type="string",
 *         format="date",
 *         description="Tanggal mulai berlakunya perizinan"
 *     ),
 *     @OA\Property(
 *         property="tanggal_selesai",
 *         type="string",
 *         format="date",
 *         description="Tanggal berakhirnya perizinan"
 *     ),
 *     example={
 *         "nama": "John Doe",
 *         "alamat": "Jl. Kenanga No. 123",
 *         "jenis_perizinan": "Izin Usaha",
 *         "tanggal_request": "2022-01-01",
 *         "status_request": "",
 *         "keterangan": "Pembuatan surat izin usaha",
 *         "jenis_id": 123,
 *         "tanggal_mulai": "2023-04-01",
 *         "tanggal_selesai": "2023-06-30"
 *     }
 * )
 */

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
