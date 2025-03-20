<?php
// function isColorOrImage($value) {
//     return preg_match('/^#([a-f0-9]{3}){1,2}$/i', $value) || 
//            preg_match('/^rgb\((\d{1,3}),\s?(\d{1,3}),\s?(\d{1,3})\)$/i', $value) || 
//            filter_var($value, FILTER_VALIDATE_URL);
// }
// function isColorOrImage($value)
// {
//     // Cek apakah nilai adalah kode warna (RGB atau HEX)
//     if (preg_match('/^rgb\((\d{1,3}),\s?(\d{1,3}),\s?(\d{1,3})\)$/', $value) || 
//         preg_match('/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/', $value)) {
//         return true;
//     }

//     // Cek apakah nilai adalah URL gambar (format relatif atau absolut)
//     if (filter_var($value, FILTER_VALIDATE_URL) || str_contains($value, 'storage/backgrounds/')) {
//         return true;
//     }

//     return false;
// }
function isColorOrImage($value)
{
    // Jika path mengarah ke file gambar
    if (str_contains($value, 'storage/backgrounds/') || str_contains($value, '/uploads/') || str_contains($value, '/images/')) {
        return true;
    }

    // Jika nilai adalah kode warna RGB atau HEX
    if (preg_match('/^rgb\((\d{1,3}),\s?(\d{1,3}),\s?(\d{1,3})\)$/', $value) || 
        preg_match('/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/', $value)) {
        return true;
    }

    return false;
}

// function isColor($value)
// {
//     // Cek jika format RGB (rgb(0, 0, 0) atau rgba(255, 255, 255, 0.5))
//     if (preg_match('/^rgba?\(\d+,\s?\d+,\s?\d+(,\s?[\d\.]+)?\)$/i', $value)) {
//         return true;
//     }

//     // Cek jika format HEX (#FFFFFF atau #FFF)
//     if (preg_match('/^#([A-Fa-f0-9]{3}|[A-Fa-f0-9]{6})$/', $value)) {
//         return true;
//     }

//     // Cek jika nama warna CSS (contoh: red, blue, transparent)
//     $cssColors = ['red', 'blue', 'green', 'black', 'white', 'gray', 'yellow', 'purple', 'pink', 'orange', 'transparent'];
//     if (in_array(strtolower($value), $cssColors)) {
//         return true;
//     }

//     return false; // Jika bukan warna, berarti ini file gambar
// }
