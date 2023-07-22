<?php

namespace App\Helpers;

class HTTPMessage
{
    const SUCCESS_READ = "Berhasil membaca data";
    const SUCCESS_INSERT = "Berhasil menambah data";
    const SUCCESS_UPDATE = "Berhasil mengupdate data";
    const SUCCESS_DELETE = "Berhasil menghapus data";
    const SUCCESS_SYNC   = "Berhasil menyinkron data";

    const FAILED_READ = "Gagal membaca data";
    const FAILED_FIND = "Data tidak ditemukan";
    const FAILED_INSERT = "Gagal menambah data";
    const FAILED_UPDATE = "Gagal mengupdate data";
    const FAILED_DELETE = "Gagal mengahapus data";

    const VALIDATION_ERROR = "Gagal memvalidasi";
    const INTERNAL_SERVER_ERROR = "Terjadi kesalahan pada server";

    const UNAUTHORIZE = "Kamu tidak diizinkan untuk mengakses API yang diminta";

    const AUTH_SUCCESS_LOGIN = "Login sukses";
    const AUTH_NO_RECORD = "Identitas tersebut tidak cocok dengan data kami";
}