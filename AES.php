<?php
class AES {
    private $key;
    private $method;

    public function __construct($key) {
        // Hash key untuk menghasilkan kunci 256-bit
        $this->key = hash('sha256', $key, true); 
        $this->method = 'aes-256-cbc'; // Metode enkripsi yang digunakan
    }

    // Fungsi untuk menghasilkan IV acak
    private function generateIv() {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
    }

    public function encrypt($data) {
        $iv = $this->generateIv(); // Generate random IV
        $encrypted = openssl_encrypt($data, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);
        // Combine IV and encrypted data, then encode
        return base64_encode($iv . $encrypted);
    }

    public function decrypt($data) {
        $data = base64_decode($data); // Decode base64 encoded data
        $iv_length = openssl_cipher_iv_length($this->method); // Panjang IV yang digunakan saat enkripsi

        // Mengambil IV dari data yang didekode
        $iv = substr($data, 0, $iv_length);

        // Memastikan panjang IV benar
        if (strlen($iv) !== $iv_length) {
            die("IV memiliki panjang yang salah. IV yang diterima: " . strlen($iv) . " bytes");
        }

        // Mengambil data terenkripsi dari data yang didekode
        $encrypted = substr($data, $iv_length);

        // Dekripsi data dengan IV yang diambil
        return openssl_decrypt($encrypted, $this->method, $this->key, OPENSSL_RAW_DATA, $iv);
    }
}
?>