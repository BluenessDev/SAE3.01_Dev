<?php

namespace Test;

require_once "Site/Crypto.php";
use PHPUnit\Framework\TestCase;

class Crypto_Test extends TestCase{

    public function testChiffrementRC4()
    {
        $encrypted_password = chiffrement_RC4_key('pedia','wiki');
        $this->assertEquals('34a8a217e4', $encrypted_password);
    }

    public function testDechiffrementRC4()
    {
        $password = '45A01F645FC35B383552544B9BF5';
        $key = 'Secret';
        $decrypted_password = dechiffrement_RC4($password, $key);
        $this->assertEquals("Attack at dawn", $decrypted_password);
    }


    public function testPRGA()
    {
        $S = range(0, 255);
        $keystream = PRGA($S, 10);
        $this->assertCount(10, $keystream);
        $this->assertContainsOnly('int', $keystream);

    }



    public function testGenerateKey()
    {
        $this->assertEquals('et', generateKey('test'));
        $this->assertEquals('ape', generateKey('apple'));
    }

}
