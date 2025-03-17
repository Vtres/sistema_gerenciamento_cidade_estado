<?php
/**
 * Carrega as variáveis do arquivo .env e as define no ambiente.
 *
 * @param string $filePath O caminho completo para o arquivo .env.
 *
 * @return void
 */
function loadEnv($filePath)
{
    if (!file_exists($filePath)) {
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        $value = trim($value, "\"'");

        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}
