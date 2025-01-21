<?php
class RSAEncryption {
    private $privateKey;
    private $publicKey;
    
    public function __construct() {
        // Pre-generated test keys (1024-bit RSA)
        $this->privateKey = "-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQDlOJu6TyygqxfWT7eLtGDwajtNFOb9I5XRb6khyfD1Yt3YiCgQ
WMNW649887VGJiGr/L5i2osbl8C9+WJTeucF+S76xFxdU6jE0NQ+Z+zEdhUTooNR
aY5nZiu5PgDB0ED/ZKBUSLKL7eibMxZtMlUDHjm4gwQco1KRMDSmXSMkDwIDAQAB
AoGAfY9LpnuWK5Bs50UVep5c93SJdUi82u7yMx4iHFMc/Z2hfenfYEzu+57fI4fv
xTQ//5DbzRR/XKb8ulNv6+CHyPF31xk7YOBfkGI8qjLoq06V+FyBfDSwL8KbLyeH
m7KUZnLNQbk8yGLzB3iYKkRHlmUanQGaNMIJziWOkN+N9dECQQD0ONYRNZeuM8zd
8XJTSdcIX4a3gy3GGCJxOzv16XHxD03GW6UNLmfPwenKu+cdrQeaqEixrCejXdAF
z/7+BSMpAkEA8EaSOeP5Xr3ZrbiKzi6TGMwHMvC7HdJxaBJbVRfApFrE0/mPwmP5
rN7QwjrMY+0+AbXcm8mRQyQ1+IGEembsdwJBAN6az8Rv7QnD/YBvi52POIlRSSIM
V7SwWvSK4WSMnGb1ZBbhgdg57DXaspcwHsFV7hByQ5BvMtIduHcT14ECfcECQATe
aTgjFnqE/lQ9Q6RJTEg7wIrIVkzGZj/zWAO7yBlJgGaqBLLxEQL7ktWQyVhs7moo
jBQOOXX/Krg8sj/YQP0CQQDiSwkb4vyQfDe8/NpU7j0ioOlGXyBgkUKODIlOlwRE
bkk/9YpPSrBzNjWydfGo4ALVf8hjhmwS1Z7dnHx3MLC/
-----END RSA PRIVATE KEY-----";

        $this->publicKey = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDlOJu6TyygqxfWT7eLtGDwajtN
FOb9I5XRb6khyfD1Yt3YiCgQWMNW649887VGJiGr/L5i2osbl8C9+WJTeucF+S76
xFxdU6jE0NQ+Z+zEdhUTooNRaY5nZiu5PgDB0ED/ZKBUSLKL7eibMxZtMlUDHjm4
gwQco1KRMDSmXSMkDwIDAQAB
-----END PUBLIC KEY-----";
    }
    
    public function getPublicKey() {
        return $this->publicKey;
    }
    
    public function encrypt($data) {
        if (empty($data)) {
            throw new Exception("Data to encrypt cannot be empty");
        }
        
        $encrypted = '';
        if (!openssl_public_encrypt($data, $encrypted, $this->publicKey)) {
            throw new Exception("Encryption failed: " . openssl_error_string());
        }
        return base64_encode($encrypted);
    }
    
    public function decrypt($data) {
        if (empty($data)) {
            throw new Exception("Data to decrypt cannot be empty");
        }
        
        $decrypted = '';
        $binary_data = base64_decode($data);
        
        if (!openssl_private_decrypt($binary_data, $decrypted, $this->privateKey)) {
            throw new Exception("Decryption failed: " . openssl_error_string());
        }
        return $decrypted;
    }
}
?>