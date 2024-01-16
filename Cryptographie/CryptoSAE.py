# Algorithme de génération de la suite chiffrante (PRGA) RC4
def PRGA(S, n):
    i = 0
    j = 0
    keystream = []
    
    while len(keystream) < n:
        i = (i + 1) % 256
        j = (j + S[i]) % 256
        S[i], S[j] = S[j], S[i]  # Échange des valeurs S[i] et S[j]
        zi = S[(S[i] + S[j]) % 256]
        keystream.append(zi)  # Ajout de l'octet généré à la suite chiffrante
    
    return keystream

# Algorithme de génération de la permutation initiale (KSA) RC4
def KSA(key):
    S = list(range(256))  # Initialise le tableau S de 0 à 255
    j = 0
    key_length = len(key)
    
    for i in range(256):
        j = (j + S[i] + key[i % key_length]) % 256
        S[i], S[j] = S[j], S[i]  # Échange des valeurs S[i] et S[j]
    
    return S

# Fonction de chiffrement RC4 pour un mot de passe donné
def chiffrement_RC4(password, key):
    # Conversion de la clé et du mot de passe en octets ASCII
    key_bytes = key.encode('ascii')
    password_bytes = password.encode('ascii')
    
    # Génération de la permutation initiale S avec la clé
    S = KSA(key_bytes)
    
    # Génération de la suite chiffrante
    keystream = PRGA(S, len(password_bytes))
    
    # Chiffrement du mot de passe
    encrypted_password = ''.join([format(password_bytes[i] ^ keystream[i], '02x') for i in range(len(password_bytes))]) #****
    
    return encrypted_password

# Fonction de déchiffrement RC4 pour un mot de passe chiffré donné
def dechiffrement_RC4(encrypted_password, key):
    # Conversion de la clé en octets ASCII
    key_bytes = key.encode('ascii')
    
    # Génération de la permutation initiale S avec la clé
    S = KSA(key_bytes)
    
    # Génération de la suite chiffrante
    keystream = PRGA(S, len(encrypted_password) // 2)  # Conversion hexadécimale à l'origine
    
    # Conversion du mot de passe chiffré en octets
    encrypted_bytes = bytes.fromhex(encrypted_password)
    
    # Déchiffrement du mot de passe
    decrypted_password = ''.join([chr(encrypted_bytes[i] ^ keystream[i]) for i in range(len(encrypted_bytes))]) #****
    
    return decrypted_password

# Test du chiffrement et déchiffrement avec les données du tableau 1
key = 'Key'
plaintext = 'Plaintext'
encrypted_password = chiffrement_RC4(plaintext, key)
decrypted_password = dechiffrement_RC4(encrypted_password, key)

# Affichage des résultats du test
print(f"Mot de passe chiffré : {encrypted_password}")
print(f"Mot de passe déchiffré : {decrypted_password}")
