<?php

//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * ServerDatabaseConversion Class - Goals
 * # define function(s) converting datatypes
 * # support view data display
 * 
 * Table of Contents
 * # LANGUAGE INFLEXION
 * # AM/PM DATE() STRING SWITCH
 */

namespace App\Helper;

use \Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

//-----------------------------------------------------------------------------
class ServerDatabaseConversion
{
	///////////////////////////////////////////////////////////////////////////////
  // MEMBER FUNCTION: PUBLIC

	//*****************************************************************************

  /**
   * desc
   *   input: Uploaded File from <form multipart/form-data>
   *   output: "myfile-20241002-CNXD420.realExtension"
   */

  public static function getFileName(UploadedFile $file) : string
  {
    // get file name and ext
    $fileName = $file->getClientOriginalName();

    // get real file ext
    $fileExt = $file->extension();

    // get file name
    $fileExtClient = $file->getClientOriginalExtension();
    $fileName = basename($fileName, ".$fileExtClient");

    // Assert: filename unique
    $date = config('fs.filename.date');
    $seed = Str::random(config('fs.filename.seed.length'));
    
    return $fileName . "-$date-$seed.$fileExt";
  }

	//*****************************************************************************
	// Float to Human Readable String
	public static function formatGrade(float $grade) : string
	{
		$grade = round_down($grade, 2);
		$gradeOnes = round_down($grade, 0);
		
		$gradeDecimal = $grade - $gradeOnes;

		$formattedGrade = match(true)
		{
			$gradeDecimal <= 0.0 	=> (string)$gradeOnes					,
			$gradeDecimal <= 0.5 	=> (string)$gradeOnes . '+'		,
			default								=> (string)($gradeOnes + 1) . '-'
			
		};

    // [DEBUG]
    // dump([$grade, $gradeOnes, $gradeDecimal, $formattedGrade]);

		return $formattedGrade;
		
	}

	//*****************************************************************************
	
  /**
   * description
   *   Turn Newline(s) Into <br>
   */

	public static function markupNewlines(?string $message) : ?string
	{
    if ($message == null)
    {
      return null;
    }

    $message = Sanitization::sanitizeInput($message);

		$message = str_replace("\r\n", '<br>', $message);
		$message = str_replace('\n', '<br>', $message);
		
		return $message;
		
	}

	//*****************************************************************************
	
  /**
   * description
   *   input: string "long-something-text-so-so-looong-like-a-snake.extension"
   *   output: string "long-somet..."
   *   output: string "long-somet... .extension"
   */

	public static function shortenFileName(
    string $fileName,
    int $maxChars = 10,
    bool $isExt = true
  ) : string
	{
    $dotPosition = strpos($fileName, '.');              // : int(10)
    $extension = substr($fileName, $dotPosition + 1);   // : 'txt'
    $fileName = substr($fileName, 0, $dotPosition);     // : 'robots'
		$fileNameNew = substr($fileName, 0, $maxChars);

    if (strlen($fileNameNew) != strlen($fileName))
    {
      $fileNameNew .= '...';
      if ($isExt)
        $fileNameNew .= " .$extension";
    }
    else
    {
      if ($isExt)
        $fileNameNew .= ".$extension";
    }
		
		return $fileNameNew;
		
	}
	
}