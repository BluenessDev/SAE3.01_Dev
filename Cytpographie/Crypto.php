<?php

// Fonction pour générer une clé en fonction du message donné
function generateKey($message) {
    $firstLetter = strtolower($message[0]); // Récupère la première lettre du message en minuscule
    $consonants = array('b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z');
    $key = '';

    // Vérifie si la première lettre est une consonne
    if (in_array($firstLetter, $consonants)) {
        // Utilise les lettres impaires comme clé
        for ($i = 0; $i < strlen($message); $i++) {
            if ($i % 2 !== 0) {
                $key .= $message[$i];
            }
        }
    } else {
        // Utilise les lettres paires comme clé
        for ($i = 0; $i < strlen($message); $i++) {
            if ($i % 2 === 0) {
                $key .= $message[$i];
            }
        }
    }

    return $key; // Retourne la clé générée
}

// Fonction pour générer le flux de clés pseudo-aléatoire
function PRGA(&$S, $n) {
    $i = 0;
    $j = 0;
    $keystream = array();

    while (count($keystream) < $n) {
        $i = ($i + 1) % 256;
        $j = ($j + $S[$i]) % 256;
        $temp = $S[$i];
        $S[$i] = $S[$j];
        $S[$j] = $temp;
        $zi = $S[($S[$i] + $S[$j]) % 256];
        array_push($keystream, $zi);
    }

    return $keystream; // Retourne le flux de clés généré
}

// Fonction pour initialiser l'état du tableau utilisé dans RC4
function KSA($key) {
    $S = range(0, 255);
    $j = 0;
    $key_length = strlen($key);

    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $S[$i] + ord($key[$i % $key_length])) % 256;
        $temp = $S[$i];
        $S[$i] = $S[$j];
        $S[$j] = $temp;
    }

    return $S; // Retourne le tableau d'état initialisé
}

// Fonction de chiffrement RC4
function chiffrement_RC4($password) {
    $key_bytes = generateKey($password);
    echo "Clé utilisée : ". $key_bytes ."\n";
    $password_bytes = $password;
    $S = KSA($key_bytes);
    $keystream = PRGA($S, strlen($password_bytes));
    $encrypted_password = '';

    foreach (str_split($password_bytes) as $index => $char) {
        $encrypted_password .= sprintf('%02x', ord($char) ^ $keystream[$index]);
    }

    return $encrypted_password; // Retourne le texte chiffré
}

// Fonction de déchiffrement RC4
function dechiffrement_RC4($encrypted_password, $key) {
    $key_bytes = $key;
    $S = KSA($key_bytes);
    $keystream = PRGA($S, strlen($encrypted_password) / 2);
    $encrypted_bytes = pack('H*', $encrypted_password);
    $decrypted_password = '';

    foreach (str_split($encrypted_bytes) as $index => $byte) {
        $decrypted_password .= chr(ord($byte) ^ $keystream[$index]);
    }

    return $decrypted_password; // Retourne le texte déchiffré
}

// Test avec les mêmes données que l'exemple Python
$plaintext = 'admin';
$key = generateKey($plaintext);
$encrypted_password = chiffrement_RC4($plaintext, $key);
$decrypted_password = dechiffrement_RC4($encrypted_password, $key);

// Affichage des résultats du test
echo "Mot de passe chiffré : " . $encrypted_password . "\n";
echo "Mot de passe déchiffré : " . $decrypted_password . "\n";

?>
