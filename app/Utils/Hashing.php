<?php

namespace App\Utils;

class Hashing
{
    private $hashMethods = array();

    public function isFirstHash($passwd, $hash, $staticSalt = Constants::_COOKIE_KEY_)
    {
        if (!count($this->hashMethods)) {
            $this->initHashMethods();
        }

        $closure = reset($this->hashMethods);

        return $closure['verify']($passwd, $hash, $staticSalt);
    }

    public function checkHash($passwd, $hash, $staticSalt = Constants::_COOKIE_KEY_)
    {
        if (!count($this->hashMethods)) {
            $this->initHashMethods();
        }

        foreach ($this->hashMethods as $closure) {
            if ($closure['verify']($passwd, $hash, $staticSalt)) {
                return true;
            }
        }

        return false;
    }

    public function hash($plaintextPassword, $staticSalt = Constants::_COOKIE_KEY_)
    {
        if (!count($this->hashMethods)) {
            $this->initHashMethods();
        }

        $closure = reset($this->hashMethods);

        return $closure['hash']($plaintextPassword, $staticSalt, $closure['option']);
    }

    private function initHashMethods()
    {
        $this->hashMethods = array(
            'bcrypt' => array(
                'option' => array(),
                'hash' => function ($passwd, $staticSalt, $option) {
                    return password_hash($passwd, PASSWORD_BCRYPT);
                },
                'verify' => function ($passwd, $hash, $staticSalt) {
                    return password_verify($passwd, $hash);
                },
            ),
            'md5' => array(
                'option' => array(),
                'hash' => function ($passwd, $staticSalt, $option) {
                    return md5($staticSalt . $passwd);
                },
                'verify' => function ($passwd, $hash, $staticSalt) {
                    return md5($staticSalt . $passwd) === $hash;
                },
            ),
        );
    }
}
