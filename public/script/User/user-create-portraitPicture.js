//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # use BiWork.css
 * # update image preview on User/create
 */

var apiOK = true;

var classWarning = 'font-warning';

var imageFile = null;
var imageHeightText = null;
var imageWidthText = null;
var portraitPicture = null;

//***************************************************************************
// main(): DOM Rendered fully
document.addEventListener('DOMContentLoaded', function()
{
  main();

});

//***************************************************************************
function main()
{
  if (apiOK)
  {
    if (! window.File || ! window.FileReader || ! window.FileList || ! window.Blob)
    {
      apiOK = false;
      // render error statusbar
      var div = document.createElement('div');
      div.innerHTML = document.getElementById('statusbar').value;
      document.appendChild(div);
      return;
    }
  }

  imageFile = document.getElementById('imageFile');
  imageHeightText = document.getElementById('imageHeightText');
  imageWidthText = document.getElementById('imageWidthText');
  portraitPicture = document.getElementById('portraitPicture');

  imageFile.addEventListener('change', updateImage);
}

//***************************************************************************
function updateImage(changeEvent)
{
  if (imageFile == null)
  {
    return;
  }
  
  if (portraitPicture == null)
  {
    return;
  }

  var file = imageFile.files[0];

  if (imageFile.files.length == 0)
  {
    return;
  }

  // setup reader
  var reader = new FileReader();
  reader.onload = function(loadEvent)
  {
    // create Image object
    var image = new Image();
    // set Image object to blob data
    image.src = loadEvent.target.result;

    // wait until image actually loads
    image.onload = function(imgLoadEvent)
    {
      // verify dimensions
      verifyDimensions(image);
    }

    // set image source to Image object
    portraitPicture.src = loadEvent.target.result;
  }

  // check mime type
  if (file.type.match(/image/))
  {
    // return blob data
    reader.readAsDataURL(file);
  }

}

//***************************************************************************
function verifyDimensions(image)
{
  console.log(`width ${image.width}`);
  console.log(`img width ${portraitPicture.width}`);
  console.log(`height ${image.height}`);
  console.log(`img height ${portraitPicture.height}`);

  if (image.height != portraitPicture.height)
  {
    imageHeightText.classList.add(classWarning);
  }
  else
  {
    imageHeightText.classList.remove(classWarning);
  }

  if (image.width != portraitPicture.width)
  {
    imageWidthText.classList.add(classWarning);
  }
  else
  {
    imageWidthText.classList.remove(classWarning);
  }
}