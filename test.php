<?php
$hash = '$2y$10$zUvPXkPfn3g0cAZhsm8JXudWwZuI1cXEXsGV5ZCvA2BaVz7QTSz3y'; // reemplazá con el hash real
$input = 'admin123';

if (password_verify($input, $hash)) {
    echo "✅ Coincide";
} else {
    echo "❌ No coincide";
}
