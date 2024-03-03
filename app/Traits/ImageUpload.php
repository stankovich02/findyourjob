<?php
namespace App\Traits;

trait ImageUpload {

    /**
     * @param $image
     * @param int $width
     * @param int $height
     * @return string
     */
    public function resizeAndUploadImage($image,string $path ,int $width, int $height) : string
    {
        $tmpPath = $image->getPathname();
        $type = $image->getMimeType();
        $extension = $image->getClientOriginalExtension();
        list($imgWidth, $imgHeight) = getimagesize($tmpPath);
        $uniqueName = time() . '.' . $extension;
        if ($type == "image/jpeg") {

            $originalImage = imagecreatefromjpeg($tmpPath);
        } elseif ($type == "image/png") {
            $originalImage = imagecreatefrompng($tmpPath);
        }
        $resizeImagePath = public_path($path . $uniqueName);

        $resizedImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($resizedImage, $originalImage, 0, 0, 0, 0, $width, $height, $imgWidth, $imgHeight);
        move_uploaded_file($tmpPath, $resizeImagePath);
        if($type=='image/jpeg') imagejpeg($resizedImage,  $resizeImagePath );
        if($type=='image/png') imagepng($resizedImage,  $resizeImagePath);

        return $uniqueName;
    }
}
