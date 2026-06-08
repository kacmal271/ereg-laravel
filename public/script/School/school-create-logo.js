//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # use BiWork.css
 * # update image preview on User/create
 */

var apiOK = true;

var imageFile = null;
var logo = null;

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
  logo = document.getElementById('logo');

  imageFile.addEventListener('change', updateImage);
}

//***************************************************************************
function updateImage(changeEvent)
{
  if (imageFile == null)
  {
    return;
  }
  
  if (logo == null)
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

    // set image source to Image object
    logo.src = loadEvent.target.result;
  }

  // check mime type
  if (file.type.match(/image/))
  {
    // return blob data
    reader.readAsDataURL(file);
  }

}