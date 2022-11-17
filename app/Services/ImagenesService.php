<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Helpers\ClassHelper;
use App\Enums\HttpStatusEnum;
use Illuminate\Support\Facades\Storage;

class ImagenesService
{
    /**
     * Nombre de la clase
     *
     * @var string
     */
    public string $className;

    /**
     * Construct
     *
     * @return void
     */
    public function _construct()
    {
        $this->className = ClassHelper::getName(__CLASS__);
    }

    /**
     * Guardar imagen
     *
     * @param string $disk
     * @param string $file
     * @return string $path
     */
    public static function guardar(string $disk, string $file, string $originalFileName)
    {
        try {
            $extension        = pathinfo($originalFileName, PATHINFO_EXTENSION);
            $originalFileName = Str::replace(".{$extension}", '', $originalFileName);
            $now              = now()->format('YmdHis');
            $uuid             = Str::uuid();
            $appShortName     = config('app.short_name');
            $fileName         = Str::slug("{$now}_{$uuid}_{$appShortName}_{$originalFileName}", '_') . '.' . $extension;
            $guardar          = Storage::disk($disk)->put($fileName, $file);

            if (!$guardar) abort(HttpStatusEnum::INTERNAL_SERVER_ERROR, 'Error al guardar la imagen');

        } catch (\Throwable $th) {
            error_('Error al guardar la imagen', [
                'disk'     => $disk,
                'fileName' => $fileName,
                'error'    => $th->getMessage()
            ]);

            throw $th;
        }

        return $fileName;
    }
}
