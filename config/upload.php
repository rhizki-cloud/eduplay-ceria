<?php
function safe_upload(array $file, string $folder, array $allowed=['image/jpeg','image/png','image/webp']): ?string {
    if (($file['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) return null;
    $type=(new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    if (!in_array($type,$allowed,true)) return null;
    $ext=['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp'][$type]??'bin';
    $name=bin2hex(random_bytes(8)).'.'.$ext;
    $dir=__DIR__.'/../uploads/'.trim($folder,'/'); if(!is_dir($dir)) mkdir($dir,0775,true);
    return move_uploaded_file($file['tmp_name'],$dir.'/'.$name) ? $name : null;
}
