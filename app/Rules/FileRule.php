<?php

namespace App\Rules;

// My Declarations
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Helper\Enumeration\File;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileRule implements ValidationRule
{
  //*****************************************************************************
  public function __construct(
    private File $file
  ) {}

  //*****************************************************************************

  /**
  * Run the validation rule.
  *
  * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
  */

  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    switch ($this->file)
    {
      case File::PortraitPicture :

        if ( ! $this->handlePortraitPicture($value))
        {
          $fail(__('validation.custom.imageFile.ratio'));
        }

        break;
    }
  }

  //*****************************************************************************
  private function handlePortraitPicture($image) : bool
  {
    // create new Image Intervention manager
    $imageInterventionManager = new ImageManager(new Driver());

    // create new Image::class
    $image = $imageInterventionManager->read($image->path());

    // get width
    $width = $image->width();

    // get height
    $height = $image->height();

    // calculate dimension ratios
    $ratio = $width / $height;
    $ratioServer = config('image.portraitPicture.width') / config('image.portraitPicture.height');

    // compare
    return (int)($ratio / $ratioServer) == 1;
  }
}
