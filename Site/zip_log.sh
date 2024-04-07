#!/bin/bash

# Répertoire où seront stockés les fichiers compressés
destination_folder="$(dirname "$0")/logs"

# Créer le répertoire de destination s'il n'existe pas
mkdir -p "$destination_folder"

# Parcourir tous les dossiers dans le répertoire de destination
for folder_path in "$destination_folder"/*; do
    # Nom du dossier actuel
    folder_name=$(basename "$folder_path")

    # Nom du fichier zip
    zip_file="$destination_folder/$folder_name.zip"

    # Supprimer l'archive existante si elle existe déjà
    [ -e "$zip_file" ] && rm "$zip_file"

    echo "Compression en cours du dossier $folder_name..."

    # Zipper uniquement les fichiers CSV dans le contenu du dossier actuel
    zip -r "$zip_file" "$folder_path"/*.csv

    # Supprimer le dossier d'origine
    rm -r "$folder_path"

    echo "Compression du dossier $folder_name terminée."
done

echo "Toutes les compressions sont terminées."
read -p "Appuyez sur Entrée pour continuer..."
