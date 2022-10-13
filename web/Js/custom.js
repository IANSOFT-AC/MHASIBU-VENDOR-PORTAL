/**
 * Created by HP ELITEBOOK 840 G5 on 1/6/2021.
 * Written with love by @francnjamb -- Twitter
 */

//Initialize Sweet Alert

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000
});

function closeInput(elm) {
  var td = elm.parentNode;
  var value = elm.value;

  /** Handle Checkbox state */
  var child = td.children[0];



  if (child.type == 'checkbox') {
    value = (child.checked) ? 1 : 0;

    console.log('Checkbox check state');
    console.log(child.checked);
  }

  /** Finish handling checkbox state */
  td.removeChild(elm);
  td.innerHTML = value;

  const data = td.dataset;

  console.log(`The Data Set.........................................................`);
  console.table(data);

  // Post Changes
  field = document.querySelector(`#${data.validate}`);
  $.post('./commit', { 'key': data.key, 'name': data.name, 'no': data.no, 'filterKey': data.filterField, 'service': data.service, 'value': value }).done(function (msg) {

    // Update all key dataset values for the row
    if (msg.Key) {
      let parent = td.parentNode;
      parent.querySelectorAll('[data-key]').forEach(elem => elem.dataset.key = msg.Key);
    }



    console.log(`Committing Data.... Result`);
    console.table(msg);


    if (data.validate) // Custom Grid Error Reporting
    {
      let parent = td.parentNode;
      console.log(`Parent to be validated ....`);
      let ClassName = data.validate;
      let validatedElement = parent.querySelector('.' + ClassName);
      const DataKey = data.validate;
      validatedElement.innerText = typeof (msg) === 'string' ? msg : msg[DataKey];
    }


    // Toasting The Outcome
    typemsg = typeof msg;
    console.log(typemsg);
    console.log('');
    if (typeof (msg) === 'string') {
      console.log(msg);
      // Fire a sweet alert if you can
      Toast.fire({
        type: 'error',
        title: msg
      })
    } else {

      console.log(msg);
      Toast.fire({
        type: 'success',
        title: msg[data.name] + ' Saved Successfully.'
      })
    }

  });

  // Check if the is a request to reload dom

  if (data.reload) {
    setTimeout(() => {
      location.reload(true);
    }, 500);
  }

}

function addInput(elm, type = false, field = false) {
  if (elm.getElementsByTagName('input').length > 0) return;

  var value = elm.innerHTML;
  elm.innerHTML = '';

  var input = document.createElement('input');
  if (type) {
    input.setAttribute('type', type);
  } else {
    input.setAttribute('type', 'text');
  }

  input.setAttribute('value', value);// use placeholder instead of value attribute

  if (type === 'checkbox') {
    input.checked = event.target.value;

  }



  input.setAttribute('class', 'form-control');
  input.setAttribute('onBlur', 'closeInput(this)');
  elm.appendChild(input);
  input.focus();
}

function addTextarea(elm) {
  if (elm.getElementsByTagName('textarea').length > 0) return;

  var value = elm.textContent;
  elm.innerHTML = '';

  var input = document.createElement('textarea');
  input.setAttribute('rows', 2);
  //input.setAttribute('value', value);// use placeholder instead of value attribute  
  input.innerText = value;
  input.setAttribute('class', 'form-control');
  input.setAttribute('onBlur', 'closeInput(this)');
  elm.appendChild(input);
  input.focus();
}

// Get Drop Down Filters

function extractFilters(elm, ClassName) {
  let parent = elm.parentNode;
  let filterValue = parent.querySelector('.' + ClassName).innerText;
  console.log(`Subject Parent Value`);
  console.log(filterValue);
  return filterValue;
}

async function addDropDown(elm, resource, filters = {}) {
  if (elm.getElementsByTagName('input').length > 0) return;


  let processedFilters = null;
  if (Object.entries(filters).length) {
    const content = Object.entries(filters);
    processedFilters = Object.assign(...content.map(([key, val]) => ({ [key]: extractFilters(elm, val) })));

    console.log('Extracted Filters.....................');
    console.log(processedFilters);
    console.log(typeof processedFilters);
  }


  elm.innerHTML = 'Processing ......';

  const ddContent = await getData(resource, processedFilters);
  console.log(`DD Content:`);
  console.log(ddContent);
  elm.innerHTML = '';

  var select = document.createElement('select');
  const InitialOption = document.createElement('option');

  InitialOption.innerText = 'Select ...';
  select.appendChild(InitialOption);

  // Prepare the returned data and append it on the select

  for (const [key, value] of Object.entries(ddContent)) {
    // console.log(`${key}: ${value}`);
    const option = document.createElement('option');
    option.value = key;
    option.text = value;

    select.appendChild(option);
  }

  select.setAttribute('class', 'form-control');
  select.setAttribute('onChange', 'closeInput(this)');
  elm.appendChild(select);
  select.focus();
}


async function getData(resource, filters) {
  payload = JSON.stringify({ ...filters });
  const res = await fetch(`./${resource}`, {
    method: 'POST',
    headers: new Headers({
      Origin: 'http://localhost:2026/',
      "Content-Type": 'application/json',
      //'Content-Type': 'application/x-www-form-urlencoded'
    }),
    body: payload
  });
  const data = await res.json();
  return data;
}


function JquerifyField(model, fieldName) {
  field = fieldName.toLowerCase();
  const selector = '#' + model + '-' + field;
  return selector;
}
function sanitizeTime(timeString) {
  let timeParts = timeString.split(":");
  let res = Number(timeParts[0]) + ":" + Number(timeParts[1]);
  console.log('Converted times : ');
  console.log(res);
  return res;
}

function notifySuccess(parentClassField, message) {
  let parent = document.querySelector(parentClassField);

  console.log('Parent to report success to.....................');
  console.dir(parent);
  let span = document.createElement('span');
  span.classList.add('text');
  span.classList.add('text-success');
  span.classList.add('small');
  span.innerText = message;

  parent.appendChild(span);
}

function notifyError(parentClassField, message) {
  let parent = document.querySelector(parentClassField);

  let span = document.createElement('span');
  span.classList.add('text');
  span.classList.add('text-danger');
  span.classList.add('small');
  span.innerText = message;

  parent.appendChild(span);
}

// Function to do ajax field level updating

function globalFieldUpdate(entity, controller = false, fieldName, ev, autoPopulateFields = [], service = false) {
  console.log('Global Field Update was invoked');
  const model = entity.toLowerCase();
  const field = fieldName.toLowerCase();
  const formField = '.field-' + model + '-' + fieldName.toLowerCase();
  const keyField = '#' + model + '-key';
  const targetField = '#' + model + '-' + field;
  const tget = '#' + model + '-' + field;

  console.log(targetField);
  const fieldValue = ev.target.value;
  const Key = $(keyField).val();

  console.log(`My Key is ${Key}`);
  console.log(autoPopulateFields);

  let route = '';
  // If controller is falsy use the model value (entity) as the route
  if (!controller) {
    route = model;
  } else {
    route = controller;
  }
  const url = $('input[name=absolute]').val() + route + '/setfield?field=' + fieldName;
  console.log(`route to use is : ${url}`);


  if (Key.length) {
    $.post(url, { fieldValue: fieldValue, 'Key': Key, 'service': service }).done(function (msg) {

      console.log('Original Result ..................');
      console.log(msg);

      if (msg.Start_Time || msg.End_Time) {
        msg = { ...msg, Start_Time: sanitizeTime(msg.Start_Time), End_Time: sanitizeTime(msg.End_Time) };
      }

      console.log('Updated Result ..................');
      console.log(msg);

      // Populate relevant Fields
      $(keyField).val(msg.Key);
      $(targetField).val(msg[fieldName]);

      // Update DOM values for fields specified in autoPopulatedFields: fields in this array should be exact case and name as specified in Nav Web Service 

      if (autoPopulateFields.length > 0) {
        autoPopulateFields.forEach((field) => {
          let domSelector = JquerifyField(model, field);

          console.log(`Field of Corncern is ${field}`);
          console.log(`Model of Corncern is ${model}`);
          console.log(`Jquerified field is ${domSelector}`);
          $(domSelector).val(msg[field]);
        });
      }

      /*******End Field auto Population  */
      if ((typeof msg) === 'string') { // A string is an error
        console.log(`Form Field is: ${formField}`);
        const parent = document.querySelector(formField);

        //Inline status notifier
        notifyError(formField, msg);
        // Fire a sweet alert if you can

        Toast.fire({
          type: 'error',
          title: msg
        })

      } else { // An object represents correct details
        const parent = document.querySelector(formField);
        //Inline status notifier
        notifySuccess(formField, `${field} Saved Successfully.`);
        // If you can Fire a sweet alert                 

        Toast.fire({
          type: 'success',
          title: field + ' Saved Successfully.'
        })

      }
    }, 'json');
  }

}
function disableSubmit() {
  document.getElementById('submit').setAttribute("disabled", "true");
}

function enableSubmit() {
  document.getElementById('submit').removeAttribute("disabled");
}

function requestStateUpdater(fieldParentNode, notificationType, msg = '') {
  let inputParentNode = fieldParentNode.children[1]; // This is in boostrap 5

  if (notificationType === 'success') {
    let successElement = document.createElement('span');
    successElement.innerText = 'Data Saved Successfully.';
    successElement.setAttribute('class', 'text-success small');
    inputParentNode.append(successElement);

    // clean up the notification elements after 3 seconds
    setTimeout(() => {
      successElement.remove();
    }, 3000);

  } else if (notificationType === 'error' && msg) {

    let errorElement = document.createElement('span');
    errorElement.innerText = `Message: ${msg}`;
    errorElement.setAttribute('class', 'text-danger small');
    inputParentNode.append(errorElement);

    // clean up the notification elements after 3 seconds
    setTimeout(() => {
      errorElement.remove();
      location.reload(true);
    }, 7000);

  }


}

// Global Uploader

async function globalUpload(attachmentService, entity, fieldName, documentService = false) {
  const formField = '.field-' + entity.toLowerCase() + '-' + fieldName.toLowerCase();
  const model = entity.toLowerCase();
  const key = '';//document.querySelector(`#${model}-key`).value;
  const fileInput = document.querySelector(`#${model}-${fieldName}`);
  let endPoint = './upload/';
  let error = false;
  let data = _('attachment-attachment').dataset;

  console.log(`data .......`);
  console.log(data.name);
  const navPayload = {
    "Key": key,
    "Service": attachmentService,
    "documentService": documentService
  }

  const formData = new FormData();
  formData.append("attachment", fileInput.files[0]);
  formData.append("Key", key);
  formData.append("DocumentService", documentService);


  console.log(fileInput.files);
  // Validate file you are uploading
  let file = fileInput.files[0];
  console.log(file);
  if (!['application/pdf'].includes(file.type)) {
    console.log(`We require only PDFs: ${file.name} is of type: ${file.type}`);
    error = `<div class="text text-danger">We require only PDFs: ${file.name} is of type: ${file.type}</div>`;
    msg = `We require only PDFs: ${file.name} is of type: ${file.type}`;
  } else { // Create request payload and upload
    formData.append('attachments[]', file);
  }

  if (error) {
    notifyError(formField, msg);
    _(`#{model}-${fieldName}`).value = '';
    Toast.fire({
      type: 'error',
      title: error
    })
    return;
  }


  try {
    const Request = await fetch(endPoint,
      {
        method: "POST",
        body: formData,
        headers: new Headers({
          Origin: 'http://localhost:8062/'
        })
      });

    const Response = await Request.json();
    // reset file input
    fileInput.value = '';
    console.log(`File Upload Request`);
    console.log(Response);

    let filePath = Response.filePath;



    // Do a Nav Request
    let UploadType = data.name;
    endPoint = `${endPoint}?Key=${navPayload.Key}&Service=${navPayload.Service}&filePath=${filePath}&documentService=${navPayload.documentService}&type=${UploadType}`
    const navReq = await fetch(endPoint, {
      method: "GET",
      headers: new Headers({
        Origin: 'http://localhost:8062/'
      })
    });

    const NavResp = await navReq.json();
    console.log(`Nav Request Response`);
    console.log(NavResp);
    console.info(navReq.ok);
    if (navReq.ok) {
      notifySuccess(formField, 'Attachment Uploaded Successfully.');
      Toast.fire({
        type: 'success',
        title: 'Attachment uploaded Successfully.'
      });
      // Reload
      setTimeout(() => {
        console.log(`Trying to reload.`);
        location.reload(true)
      }, 1000)
    } else {
      Toast.fire({
        type: 'error',
        title: 'Attachment could not be uploaded.'
      })
    }


  } catch (error) {
    console.log(error);
  }
}

// Create an element selector helper function

function _(element) {
  return document.getElementById(element);
}

// Upload multiple Files
async function globalUploadMultiple(attachmentService, entity, route, documentService = false) {
  const formField = '.field-select_multiple';
  const model = entity.toLowerCase();
  const key = _(`${model}-key`).value;
  let endPoint = _('absolute').value + `${route}/upload-multiple`;
  //console.log(endPoint); return;
  const navPayload = {
    "Key": key,
    "Service": attachmentService,
    "documentService": documentService
  }

  const formData = new FormData();
  // formData.append("attachment", fileInput.files[0]);
  formData.append("Key", key);
  formData.append("DocumentService", documentService);
  formData.append("attachmentService", attachmentService);



  let error = '';

  try {
    console.log(Array.from(_('select_multiple').files));
    Array.from(_('select_multiple').files).forEach((file) => {
      console.log(file);
      if (!['application/pdf'].includes(file.type)) {
        console.log(`We require only PDFs: ${file.name} is of type: ${file.type}`);
        error = `<div class="text text-danger">We require only PDFs: ${file.name} is of type: ${file.type}</div>`;
      } else { // Create request payload and upload
        formData.append('attachments[]', file);
      }
    });

    if (error) {
      _('upload-note').innerHTML = error;
      _('select_multiple').value = '';
      Toast.fire({
        type: 'error',
        title: error
      })
      return;
    }

    _('progress_bar').style.display = 'block';
    let ajax_request = new XMLHttpRequest();
    ajax_request.open("post", endPoint); // Initiate request

    // Set headers
    ajax_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax_request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');


    ajax_request.upload.addEventListener('progress', (e) => {
      let percentCompleted = Math.round((e.loaded / e.total) * 100);
      _('progress_bar_process').style.width = `${percentCompleted}%`;
      _('progress_bar_process').innerHTML = `${percentCompleted}% completed`;
      console.log('progress values-------------------');
      console.log(_('progress_bar_process').innerHTML);
    });

    ajax_request.addEventListener('load', (e) => {
      _('upload-note').innerHTML = `<div class="text text-success">Files uploaded successfully.</div>`;
      _('select_multiple').value = '';
    });

    /** I did 2 requests since XMLHttpRequest would not send metadata and multipart data simultaneously,
     * Reason for using fetch was to send attachment metadata like Key, Webservices etc.
     * XMLHttpRequest has progress and load events while fetch didn't have (Used to measure progress)
     * If these limitations are addressed in future, please update the code to only use one request.
     * @francnjamb -  fnjambi@outlook.com
     */
    const request = ajax_request.send(formData);
    const Requesto = await fetch(endPoint,
      {
        method: "POST",
        body: formData,
        headers: new Headers({
          Origin: 'http://localhost:2026/'
        })
      });

    const res = await Requesto.json();

    console.log(`Data Request......................`);
    console.log(res);

    if (Requesto.ok) {
      notifySuccess(formField, 'Attachments Uploaded Successfully.');
      Toast.fire({
        type: 'success',
        title: 'Attachment uploaded Successfully.'
      });
      // Reload
      setTimeout(() => {
        console.log(`Trying to reload.`);
        //location.reload(true)
      }, 1000)
    } else {
      Toast.fire({
        type: 'error',
        title: 'Attachment could not be uploaded.'
      })
    }


    ajax_request.addEventListener('error', (e) => {
      console.log(`Errors...........`);
      console.log(e);
    });

  } catch (error) {
    console.log(error);
  }
}


//Delete a document Line


$('.delete').on('click', function (e) {
  e.preventDefault();
  if (confirm('Are you sure about deleting this record?')) {
    let data = $(this).data();
    let url = $(this).attr('href');
    let Key = data.key;
    let Service = data.service;
    const payload = {
      'Key': Key,
      'Service': Service
    };
    $(this).text('Deleting...');
    $(this).attr('disabled', true);
    $.get(url, payload).done((msg) => {
      Toast.fire({
        type: 'success',
        title: 'Operation completed successfully.'
      });

      setTimeout(() => {
        location.reload(true);
      }, 1200);
    })
      .fail(function (xhr, status, error) {
        console.log(xhr);
        $('.delete').text('Delete');

        Toast.fire({
          type: 'error',
          title: status + ' : ' + error
        });

        setTimeout(() => {
          location.reload(true);
        }, 1200);

      });
  }

});



// Trigger Creation of a line
$('.add').on('click', function (e) {
  e.preventDefault();
  let url = $(this).attr('href');
  let data = $(this).data(); // object of arrays - strange structure
  payloadContent = Object.entries(data);
  // convert object of arrays into a pure object
  payload = Object.assign(...payloadContent.map(([key, val]) => ({ [key.replace(/(^\w{1})|(\_+\w{1})/g, letter => letter.toUpperCase())]: val })));
  console.log(`Formatted payload`);
  console.log(payload);

  $(this).text('Inserting...');
  $(this).attr('disabled', true);
  const res = fetch(url, {
    method: 'POST',
    headers: new Headers({
      Origin: 'http://localhost:8062/',
      "Content-Type": 'application/json',
      //'Content-Type': 'application/x-www-form-urlencoded'
    }),
    body: JSON.stringify({ ...payload })
  })
    .then(data => data.json())
    .then(result => {
      console.log(result);
      if (result.result) {

        Toast.fire({
          type: 'success',
          title: result.note
        });

        setTimeout(() => {
          location.reload(true);
        }, 1500);

      } else {
        Toast.fire({
          type: 'error',
          title: result.note
        });

        setTimeout(() => {
          location.reload(true);
        }, 1500);
      }
    })
    ;

});
