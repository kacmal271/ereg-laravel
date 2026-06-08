//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

/**
 * This File - Goals
 * # use BiWork.css
 * # add attachments using JavaScript
 * # peripheral file for: Snippets/Mail/mail-create-attachments.blade.php
 */

var apiOK = true;

var filesCount = 0;
var filesContainer;
var attachmentButton;

var wrapperClassesHidden = 'input-file-parent hidden'; // this file uses: BiWork.css
var wrapperClasses = 'input-file-parent mr-1 mb-1 font-text-alt';
var inputClasses = 'input-file-input';
var metadataClasses = 'input-file-metadata';
var buttonClasses = 'button button-icon input-file-button';

var wrapperTagName = 'div'
var inputTagName = 'input'
var metadataTagName = 'span'
var buttonTagName = 'button'


//***************************************************************************
// main(): DOM Rendered fully
document.addEventListener('DOMContentLoaded', function()
{
  main();

});

//***************************************************************************
function main()
{
  // files container: remember
  filesContainer = document.getElementById('mail-create-attachments-attachments');

  // attachment button: remember
  attachmentButton = document.getElementById('mail-create-attachments-add');

  // attachment button: listen for click
  attachmentButton.addEventListener('click', function()
  {
    var inputFile = addAttachmentAsInput();

    // (B) WINDOWS: HANDLE FILE DIALOG
    // Scope: triggered by user event, ok
    // Scope: modern browsers block FILE DIALOG opening
    inputFile.click();

  });

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

}

//***************************************************************************

/**
 * desc
 *   user deletes first <input file>
 *   subsequent <input file>s need property update
 */

function updateElements()
{
  if (filesContainer == null)
    return;

  // reset files count
  filesCount = 0;

  // loop div wrappers
  for (var i = 0; i < filesContainer.children.length; i++)
  {
    // assert attachment div wrapper
    if (filesContainer.children.item(i).children == null)
      continue;

    // wrapper elements
    var wrapper = filesContainer.children.item(i)

    // change div wrapper id
    wrapper.id = filesCount;

    // loop div wrapper elements
    for (var j = 0; j < wrapper.children.length; j++)
    {
      // wrapper element
      var wrapperElement = wrapper.children.item(j);

      // change input name
      if (wrapperElement.tagName.toLowerCase() == inputTagName)
        wrapperElement.name = `file${filesCount}`;

      // change button value
      if (wrapperElement.tagName.toLowerCase() == buttonTagName)
        wrapperElement.value = `${filesCount}`;

    }

    filesCount++;

  }

}

//***************************************************************************

/**
 * desc
 *   add <input file> element to <div>
 *   1 <input file> contains 1 file
 *   observe naming conventions:
 *     file0
 *     file1
 *     file2
 */

function addAttachmentAsInput()
{
  //
  // VERIFY EVERYTHING WORKS
  //

  if (! apiOK)
    return;

  if (filesContainer == null)
    return;

  //
  // CREATE NEW ATTACHMENT SNIPPET
  //

  // create attachment data wrapper
  var inputFileWrapper = document.createElement(wrapperTagName)
  inputFileWrapper.className = wrapperClassesHidden;
  inputFileWrapper.id = `${filesCount}`;            // (A) Note: filesCount is 0 initially

  // create input file element
  var inputFile = document.createElement(inputTagName);
  inputFile.className = inputClasses;
  inputFile.name = `file${filesCount}`;
  inputFile.type = 'file';

  // create attachment metadata span
  var inputFileMetadata = document.createElement(metadataTagName);
  inputFileMetadata.className = metadataClasses;
  inputFileMetadata.innerHTML = ''; // assign after user picks files

  // create attachment 'trash' button
  var inputFileButton = document.createElement(buttonTagName)
  inputFileButton.className = buttonClasses;
  inputFileButton.type = 'button';
  inputFileButton.value = `${filesCount}`;      // (A) inputFile id passed to button, for onclick trashing

  // children -> wrapper
  inputFileWrapper.appendChild(inputFile);
  inputFileWrapper.appendChild(inputFileMetadata);
  inputFileWrapper.appendChild(inputFileButton);

  // wrapper -> container
  filesContainer.appendChild(inputFileWrapper);

  // trash button: add listener: trash input file
  inputFileButton.addEventListener('click', removeAttachment);

  // FILE DIALOG: Check results: good
  inputFile.addEventListener('change', function() // function() lambda has this scope
                                                  // () -> lambda has NOT this scope
  {
    // if mysterious file error
    if (inputFile.files.length == 0)
    {
      // delete last attachment
      inputFileButton.click();
      return;
    }

    // JavaScript function() lambda has scope of the parent
    inputFileMetadata.innerText = inputFile.files[0].name;
    inputFileWrapper.className = wrapperClasses;

  });

  // FILE DIALOG: Check results: cancel
  inputFile.addEventListener('cancel', function() // function() lambda has this scope
                                                  // () -> lambda has NOT this scope
  {
    inputFileButton.click();

  });

  // increase files number
  filesCount++;

  // (B) WINDOWS: HANDLE FILE DIALOG
  return inputFile;

}

//***************************************************************************

/**
 * desc
 *   remove <input file> element from <div>
 * param name
 *   id of which element should be removed
 */

function removeAttachment(event)
{
  // get input file wrapper
  var attachment = document.getElementById(event.target.value) // (A)

  if (attachment == null)
    return;

  // remove trashed input file
  filesContainer.removeChild(attachment);

  // decrease files number
  filesCount--;

  // property updates
  updateElements();

}