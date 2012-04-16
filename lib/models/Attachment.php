<?php

class Attachment
{

    public static function uniqueName($name, $ext)
    {
       return date('/Ym/d/') . current(str_split(md5($name.time()), 8)).'.'. $ext;
    }
    public static function fromRemote($urls, $dest_dir, $allowed_types=array(), $thumb_configs=array())
    {
        $files = array();
        settype($urls, 'array');
        foreach($urls as $url)
        {
            if(!empty($url) && ($content = @file_get_contents($url)))
            {
                $orig_name = basename($url);
                $name = pathinfo($orig_name, PATHINFO_FILENAME);
                $extention = pathinfo($orig_name, PATHINFO_EXTENSION);
                $size = strlen($content);
                $filename = self::uniqueName($orig_name, $extention);
                $dest_file = $dest_dir .'/base/'. $filename;
                self::assureDir(dirname($dest_file));
                file_put_contents($dest_file, $content);
                $files[]= self::generateRecord($dest_dir, $dest_file, $thumb_configs, $filename, $name, $extention, $type='', $size);
            }
        }
        return $files;
    }
    public static function fromUpload($field, $dest_dir, $allowed_types=array(), $thumb_configs=array())
    {
        $files = array();
        if(!is_array($_FILES[$field]["error"]))
        {
            foreach($_FILES[$field] as $k=>$v)
            {
                $_FILES[$field][$k] = array($v);
            }
        }
        foreach ($_FILES[$field]["error"] as $key => $error) {
            $files[$key] = false;
            if ($error == UPLOAD_ERR_OK) {
                $type = $_FILES[$field]["type"][$key];
                if(!$allowed_types || regexInArray($type, $allowed_types))
                {
                    $tmp_name = $_FILES[$field]["tmp_name"][$key];
                    $orig_name = $_FILES[$field]["name"][$key];
                    $name = pathinfo($orig_name, PATHINFO_FILENAME);
                    $extention = pathinfo($orig_name, PATHINFO_EXTENSION);

                    $size = $_FILES[$field]["size"][$key];
                    $filename = self::uniqueName($orig_name, $extention);
                    $dest_file = $dest_dir .'/base/'. $filename;

                    self::assureDir(dirname($dest_file));
                    move_uploaded_file($_FILES[$field]["tmp_name"][$key], $dest_file);
                    $files[$key]= self::generateRecord($dest_dir, $dest_file, $thumb_configs, $filename, $name, $extention, $type, $size);
                }
            }
        }
        return $files;
    }
    public static function generateRecord($dest_dir, $dest_file, $thumb_configs, $filename, $name, $extention, $type, $size)
    {
        $fullpath = $dest_file = realpath($dest_file);
        list($width, $height, $img_type, $attr) = getimagesize($dest_file);
        if(!$type)
        {
            $type = image_type_to_mime_type($img_type);
        }
        if($width)
        {
            foreach($thumb_configs as $thumb_name=>$thumb_config)
            {
                self::generateThumb($dest_file, $dest_dir .'/'.$thumb_name.'/'. $filename, $thumb_config);
            }
        }
        return compact('name', 'filename', 'fullpath', 'extention', 'type', 'size', 'width', 'height');
    }
     public static function generateThumb($src_file, $dest_file, $config)
    {
        self::assureDir(dirname($dest_file));
        copy($src_file, $dest_file);
    }
    public static function assureDir($dir)
    {
        if(!is_dir($dir))
        {
            mkdir($dir, 0777, true);
        }
    }
}



