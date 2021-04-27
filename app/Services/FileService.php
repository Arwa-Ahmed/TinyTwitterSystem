<?php


namespace App\Services;


class FileService
{
    /**
     * Upload User Image after validate .
     *
     * @param  File $file
     * @return String ImageName
     */
    public function UploadImage($file , $path){

        //filename with extension
        $fileNameWithExtension = $file->getClientOriginalName();
        //filename
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        //file extension
        $extension = $file->getClientOriginalExtension();
        //filename to Save
        $fileNameToSave = $fileName.'_'.time().'.'.$extension;
        $filePath =  $path;
        $file->move($filePath, $fileNameToSave);

        return $fileNameToSave;
    }

}
