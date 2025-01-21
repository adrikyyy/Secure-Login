<?php
echo "<pre>";
echo "PHP Version: " . phpversion() . "\n\n";

echo "OpenSSL Status Check:\n";
echo "-------------------\n";
echo "1. OpenSSL loaded: " . (extension_loaded('openssl') ? "YES" : "NO") . "\n";
echo "2. OpenSSL version: " . (defined('OPENSSL_VERSION_TEXT') ? OPENSSL_VERSION_TEXT : "Not Available") . "\n";

// Cek konfigurasi OpenSSL
$openssl_config = ini_get('openssl.cnf');
echo "3. OpenSSL config path: " . ($openssl_config ?: "Not set") . "\n";

// Cek apakah fungsi OpenSSL tersedia
echo "\nOpenSSL Functions Check:\n";
echo "----------------------\n";
echo "openssl_pkey_new(): " . (function_exists('openssl_pkey_new') ? "Available" : "Not Available") . "\n";
echo "openssl_pkey_export(): " . (function_exists('openssl_pkey_export') ? "Available" : "Not Available") . "\n";
echo "openssl_public_encrypt(): " . (function_exists('openssl_public_encrypt') ? "Available" : "Not Available") . "\n";

// Test membuat key pair
echo "\nTesting Key Generation:\n";
echo "--------------------\n";
try {
    $config = array(
        "digest_alg" => "sha256",
        "private_key_bits" => 1024,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
    );
    
    echo "Attempting to generate key pair...\n";
    $keypair = openssl_pkey_new($config);
    
    if ($keypair === false) {
        echo "Failed to generate key pair.\n";
        echo "OpenSSL Error: " . openssl_error_string() . "\n";
    } else {
        echo "Successfully generated key pair!\n";
        openssl_free_key($keypair);
    }
} catch (Exception $e) {
    echo "Error during key generation: " . $e->getMessage() . "\n";
}

echo "\nPHP OpenSSL Extension Info:\n";
echo "-------------------------\n";
$extensions = get_loaded_extensions();
foreach ($extensions as $extension) {
    if (stripos($extension, 'openssl') !== false) {
        echo "$extension\n";
    }
}

echo "</pre>";
?>