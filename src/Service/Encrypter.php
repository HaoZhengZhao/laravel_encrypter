<?php
namespace App\Service;

use Illuminate\Encryption\Encrypter as BaseEncrypter;

class Encrypter
{
    const DATA_PREFIX = 'COMIRU.';

    /**@var \Illuminate\Encryption\Encrypter $encrypter  */
    protected $encrypter;

    public function __construct()
    {
        $key = getenv('APP_KEY');
        if (empty($key)) {
            throw new \Exception('must has APP_KEY');
        }
        
        $key = trim($key);
        $keyPrefix = 'base64:';
        if (substr($key, 0, strlen($keyPrefix)) === $keyPrefix) {
            $key = base64_decode(substr($key, strlen($keyPrefix)));
        }
        $this->encrypter = new BaseEncrypter($key, 'AES-256-CBC');
    }

    public function decrypt(string $data): string
    {
        return $this->encrypter->decrypt($this->normalizationData($data));
    }

    public function encrypt(string $data, bool $userPrefix = true): string
    {
        $encryptCode = $this->encrypter->encrypt($this->normalizationData($data));
        if ($userPrefix) {
            $encryptCode = self::DATA_PREFIX . $encryptCode;
        }
        return $encryptCode;
    }

    public function hasPrefix(string $data): bool
    {
        return substr($data, 0, strlen(static::DATA_PREFIX)) === static::DATA_PREFIX;
    }

    protected function normalizationData(string $data): string
    {
        if ($this->hasPrefix($data)) {
            return substr($data, strlen(static::DATA_PREFIX));
        }
        return $data;
    }
}