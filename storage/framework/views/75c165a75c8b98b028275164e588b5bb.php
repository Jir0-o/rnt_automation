
<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
.cke_notification_message {
    display: none !important;
}

.cke_notifications_area {
    display: none !important;
}
</style>
<div class="row mt-5">
    <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Create Note</h5>
                    </div>
                    <form id="Note-Submit" action="" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="note" class="form-label">Note:</label>
                            <textarea class="form-control" name="note_details" id="note" cols="30" rows="3"></textarea>
                            <span class="text-danger" id="NoteError"></span>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="date" name="date">
                            <span class="text-danger" id="DateError"></span>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Attachment:</label>
                            <input type="file" class="form-control" id="file" name="file" multiple>
                            <span class="text-danger" id="FileError"></span>
                            <div id="file-preview" class="d-flex justify-content-between mt-3"></div>
                        </div>

                        <div id="append_box_note_content"></div>

                        <!-- display right side of the page -->
                        <div class="d-flex justify-content-between">
                            <!-- back button -->
                            <div class="d-flex justify-content-start">
                                <a href="<?php echo e(route('initiator-notes.create')); ?>" class="btn btn-primary">
                                    <i class="bx bx-arrow-back me-1"></i> Back
                                </a>
                            </div>

                            <!-- //save draft -->
                            <button type="button" class="btn btn-info saveDraft">
                                <i class="bx bx-save me-1"></i> Save Draft
                            </button>

                            <button class="btn btn-sm btn-secondary" type="button" onclick="add_more()">
                                <i class="bx bx-plus"></i> Add More</button>

                            <button class="btn btn-sm btn-primary" type="button" onclick="show_requisition_table();">
                                <i class="bx bx-plus"></i> Add Requisition
                            </button>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">
                                    <!-- // Forward button and icon -->
                                    <i class="bx bx-send me-1"></i> Forward
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const requisitionsData = <?php echo json_encode($requisition, 15, 512) ?>;
</script>


<script>
function remove_box(event) {

    $(event.target).parent().parent().remove();


}

let CKEditorInstances = {}; // Object to store CKEditor instances by their unique IDs


// script for add more text field for mission page
function add_more() {

    let randomNumber = String(Math.floor(Math.random() * (98765 - 12345 + 1)) + 5);

    let add_element = `
            <div class="mb-3">
                <label for="note" class="form-label">Note:</label>
                <textarea class="form-control" name="${randomNumber}" id="dynamic_details_${randomNumber}" cols="30" rows="3"></textarea>
                <span class="text-danger" id="NoteError"></span>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Attachment:</label>
                <input type="file" class="form-control file-input" id="file_${randomNumber}" name="file" multiple>
                <span class="text-danger" id="FileError"></span>
                <div id="file-preview-${randomNumber}" class="d-flex justify-content-between mt-3"></div>
            </div>
    `;

    let textbox_script = `<script> CKEDITOR.replace('${randomNumber}'); </scr` +
        `ipt>`;

    let append_box = $("#append_box_note_content");

    $(append_box).append(`<li>
        <div class='d-flex justify-content-between'>
            <h5>New Item</h5><button class='btn btn-sm btn-danger' onclick='remove_box(event)'>Remove</button>
        </div>${add_element}${textbox_script}
    </li>`);

    // Initialize a new CKEditor instance and store it in CKEditorInstances
    let editorId = `dynamic_details_${randomNumber}`;

    CKEditorInstances[editorId] = CKEDITOR.instances[editorId];

    // Add file preview functionality
    $(`#file_${randomNumber}`).on('change', function(event) {
        var files = event.target.files;
        var previewContainer = $(`#file-preview-${randomNumber}`);

        // console.log(previewContainer);

        previewContainer.empty(); // Clear any previous previews

        $.each(files, function(i, file) {
            var fileReader = new FileReader();

            fileReader.onload = function(e) {
                var fileURL = e.target.result;
                var previewElement;

                if (file.type.startsWith('image/')) {
                    previewElement = $('<img>').attr('src', fileURL).css({
                        maxWidth: '300px',
                        maxHeight: '300px',
                        marginRight: '10px',
                        display: 'block',
                        marginBottom: '10px'
                    });
                } else if (file.type === 'application/pdf') {
                    previewElement = $('<embed>').attr('src', fileURL).attr('type',
                        'application/pdf').css({
                        maxWidth: '300px',
                        maxHeight: '300px',
                        marginRight: '10px',
                        display: 'block',
                        marginBottom: '10px'
                    });
                } else if (file.type === 'application/msword' || file.type ===
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
                    previewElement = $('<a>').attr('href', fileURL).attr('download', file.name)
                        .html(`<i class="fas fa-file-word"></i> ${file.name}`).css({
                            marginBottom: '10px',
                            fontSize: '16px',
                            display: 'block'
                        });
                } else {
                    previewElement = $('<a>').attr('href', fileURL).attr('download', file.name)
                        .html(`${file.name}`).css({
                            marginBottom: '10px'
                        });
                }

                previewContainer.append(previewElement);
            };

            fileReader.readAsDataURL(file);
        });
    });
}

function appendEditorData(editorId, newRequisitionDetails) {
    const ckEditorInstance = CKEditorInstances[editorId];
    
    if (ckEditorInstance) {
        const existingData = ckEditorInstance.getData();
        ckEditorInstance.setData(existingData + newRequisitionDetails);
    } else {
        setTimeout(() => appendEditorData(editorId, newRequisitionDetails), 100);
    }
}

function show_requisition_table() {
    if (!$('#requisitions_table').length) {
        let tableStructure = `
            <table id="requisitions_table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>S.L.</th>
                        <th>Requisition Name</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="requisition_table_body">
                </tbody>
            </table>
        `;
        if($('#append_box_note_content').length > 0){
            $('#append_box_note_content').before(tableStructure);
        } else {
            console.error('Could not find the element to append the table');
        }
    }

    $('#requisition_table_body').empty();

    requisitionsData.forEach((requisition, index) => {
        let requisitionName = requisition.requisition_no || `Requisition ${index + 1}`;
        let userName = requisition.user ? requisition.user.name : "N/A";

        let newRow = `
            <tr>
                <td>${index + 1}</td>
                <td>${requisitionName}</td>
                <td>${userName}</td>
                <td><button class="btn btn-primary btn-sm" type="button" onclick="selectRequisition(${index})">Select</button></td>
            </tr>
        `;

        $('#requisition_table_body').append(newRow);
    });

    if (!$.fn.DataTable.isDataTable('#requisitions_table')) {
        new DataTable('#requisitions_table');
    }
}

function selectRequisition(index) {
    const requisition = requisitionsData[index];
    
    let newRequisitionDetails = `
        <p><strong>স্মারক নং:</strong> ${requisition.requisition_no || 'N/A'}</p>
        <p><strong>তারিখ:</strong> ${requisition.requisition_date || 'N/A'}</p>
        <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
            <thead>
                <tr>
                    <th>S.L</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Specification</th>
                    <th>Unit Type</th>
                </tr>
            </thead>
            <tbody>
    `;

    requisition.requisition_products.forEach((productData, idx) => {
        const productName = productData.product ? productData.product.product_name : "N/A";
        const productQuantity = productData ? productData.quantity : "N/A";
        const productSpec = productData ? productData.spec : "N/A";
        const unitType = productData.unit_type ? productData.unit_type.name : "N/A";

        newRequisitionDetails += `
            <tr>
                <td>${idx + 1}</td>
                <td>${productName}</td>
                <td>${productQuantity}</td>
                <td>${productSpec}</td>
                <td>${unitType}</td>
            </tr>
        `;
    });

    newRequisitionDetails += `</tbody></table>`;

    // Retrieve the last added editor ID to append the requisition details
    const lastEditorId = Object.keys(CKEditorInstances).pop();
    if (lastEditorId) {
        appendEditorData(lastEditorId, newRequisitionDetails);
    } else {
        ckEditorInstance = CKEDITOR.instances['note'];

        if (ckEditorInstance) {
            const existingData = ckEditorInstance.getData();
            ckEditorInstance.setData(existingData + newRequisitionDetails);
        } else {
            setTimeout(() => appendEditorData('note', newRequisitionDetails), 100);
        }
    }
}

$(document).ready(function() {

    // Extract the ID from the URL
    var pathArray = window.location.pathname.split('/');
    var url_file_id = pathArray[pathArray.length - 1];

    // Save draft
    $('.saveDraft').on('click', function() {
        const file_id = url_file_id;
        const note = CKEDITOR.instances['note'].getData();
        const date = $('#date').val();
        const files = $('#file').prop('files');


        const formData = new FormData();
        formData.append('file_id', file_id);
        formData.append('note', note);
        formData.append('date', date);

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        //dynamic values
        var dynamicValues = [];
        $('#append_box_note_content').find('li').each(function(index, element) {
            var dynamicValue = {};
            dynamicValue.date = $('#date').val();

            // Retrieve the unique identifier of the textarea
            var textareaId = $(this).find('textarea').attr('id');

            // Retrieve the value of the textarea using the unique identifier
            dynamicValue.note = CKEDITOR.instances[textareaId].getData();

            // Retrieve the multi files using the unique identifier
            var files = $(this).find('input[type="file"]').prop('files');
            dynamicValue.files = files;

            dynamicValues.push(dynamicValue);
        });

        formData.append('dynamicValues', JSON.stringify(dynamicValues));

        $.ajax({
            url: "<?php echo e(route('drafts.store')); ?>",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            contentType: false,
            processData: false,
            success: function(response) {
                Toastify({
                    text: 'Note submitted successfully.',
                    backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                    className: 'info',
                }).showToast();
            },
            error: function(xhr, status, error) {
                console.error('Failed to submit note:', error);
                Toastify({
                    text: 'Failed to submit note.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });

    function showDrafts() {
        const file_id = url_file_id;

        $.ajax({
            url: "<?php echo e(route('drafts.show', ':file_id')); ?>".replace(':file_id', file_id),
            type: 'GET',
            success: function(response) {
                console.log('show', response);

                if (response.data && response.data.length > 0) {
                    if (response.data.length > 1) {
                        // Display the first data differently
                        var firstData = response.data[0];
                        var descriptionHtml = firstData.note;
                        var tempElement = document.createElement('div');
                        tempElement.innerHTML = descriptionHtml;
                        var descriptionText = tempElement.innerText;

                        // Initialize all values to be updated for the first data
                        CKEDITOR.instances['note'].setData(descriptionText);
                        $('#date').val(firstData.date);

                        // Loop through the attached files and display them in the preview
                        var previewContainer = $('#file-preview');
                        previewContainer.empty(); // Clear any previous previews

                        var attachments = firstData.attachment.split(', '); // Split the attachment string into an array

                        console.log(attachments);

                        for (let i = 0; i < attachments.length; i++) {
                            var fileName = attachments[i];
                            var fileURL = '/public/global_assets/initiator_notes/' + fileName; // Adjust the path according to your file storage location
                            var previewElement;

                            // Determine the type based on file extension (assuming no MIME type is available)
                            var fileExtension = fileName.split('.').pop().toLowerCase();

                            if (['jpg', 'jpeg', 'png', 'gif', 'bmp'].includes(fileExtension)) {
                                previewElement = $('<img>').attr('src', fileURL).css({
                                    maxWidth: '300px',
                                    maxHeight: '300px',
                                    marginRight: '10px',
                                    display: 'block',
                                    marginBottom: '10px'
                                });
                            } else if (fileExtension === 'pdf') {
                                previewElement = $('<embed>').attr('src', fileURL).attr('type', 'application/pdf').css({
                                    maxWidth: '300px',
                                    maxHeight: '300px',
                                    marginRight: '10px',
                                    display: 'block',
                                    marginBottom: '10px'
                                });
                            } else if (['doc', 'docx'].includes(fileExtension)) {
                                previewElement = $('<a>').attr('href', fileURL).attr('download', fileName)
                                    .html(`<i class="fas fa-file-word"></i> ${fileName}`).css({
                                        marginBottom: '10px',
                                        fontSize: '16px',
                                        display: 'block'
                                    });
                            } else {
                                previewElement = $('<a>').attr('href', fileURL).attr('download', fileName)
                                    .html(`${fileName}`).css({
                                        marginBottom: '10px'
                                    });
                            }

                            previewContainer.append(previewElement);
                        }


                        // Loop through the remaining data starting from the second item
                        for (var i = 1; i < response.data.length; i++) {
                            var dynamicValue = response.data[i];
                            var randomNumber = String(Math.floor(Math.random() * (
                                98765 - 12345 + 1)) + 5);

                            var add_element =
                                //add hidden input field for CLO id
                                `<div class="mb-3">
                                        <label for="note" class="form-label">Note:</label>
                                        <textarea class="form-control" name="${randomNumber}" id="dynamic_details_${randomNumber}" cols="30" rows="3">${dynamicValue.note}</textarea>
                                        <span class="text-danger" id="NoteError"></span>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label">Attachment:</label>
                                        <input type="file" class="form-control file-input" id="file_${randomNumber}" name="file" multiple>
                                        <span class="text-danger" id="FileError"></span>
                                        <div id="file-preview-${randomNumber}" class="d-flex justify-content-between mt-3"></div>
                                    </div>
                                `;
                            var textbox_script =
                                `<script> CKEDITOR.replace('${randomNumber}'); </scr` +
                                `ipt>`;

                            var append_box = $("#append_box_note_content");

                            $(append_box).append(
                                `<li><div class='d-flex justify-content-between'><h5>New Item</h5><button class='btn btn-sm btn-danger' onclick='remove_box(event)'>Remove</button></div>${add_element}${textbox_script}</li>`
                            );
                        }
                    } else {
                        // Display the first data differently
                        var firstData = response.data[0];
                        var descriptionHtml = firstData.note;
                        var tempElement = document.createElement('div');
                        tempElement.innerHTML = descriptionHtml;
                        var descriptionText = tempElement.innerText;

                        // Initialize all values to be updated for the first data
                        CKEDITOR.instances['note'].setData(descriptionText);
                        $('#date').val(firstData.date);

                        // Loop through the attached files and display them in the preview
                        var previewContainer = $('#file-preview');
                        previewContainer.empty(); // Clear any previous previews

                        var attachments = firstData.attachment.split(', '); // Split the attachment string into an array

                        console.log(attachments);

                        for (let i = 0; i < attachments.length; i++) {
                            var fileName = attachments[i];
                            var fileURL = '/public/global_assets/initiator_notes/' + fileName; // Adjust the path according to your file storage location
                            var previewElement;

                            // Determine the type based on file extension (assuming no MIME type is available)
                            var fileExtension = fileName.split('.').pop().toLowerCase();

                            if (['jpg', 'jpeg', 'png', 'gif', 'bmp'].includes(fileExtension)) {
                                previewElement = $('<img>').attr('src', fileURL).css({
                                    maxWidth: '300px',
                                    maxHeight: '300px',
                                    marginRight: '10px',
                                    display: 'block',
                                    marginBottom: '10px'
                                });
                            } else if (fileExtension === 'pdf') {
                                previewElement = $('<embed>').attr('src', fileURL).attr('type', 'application/pdf').css({
                                    maxWidth: '300px',
                                    maxHeight: '300px',
                                    marginRight: '10px',
                                    display: 'block',
                                    marginBottom: '10px'
                                });
                            } else if (['doc', 'docx'].includes(fileExtension)) {
                                previewElement = $('<a>').attr('href', fileURL).attr('download', fileName)
                                    .html(`<i class="fas fa-file-word"></i> ${fileName}`).css({
                                        marginBottom: '10px',
                                        fontSize: '16px',
                                        display: 'block'
                                    });
                            } else {
                                previewElement = $('<a>').attr('href', fileURL).attr('download', fileName)
                                    .html(`${fileName}`).css({
                                        marginBottom: '10px'
                                    });
                            }

                            previewContainer.append(previewElement);
                        }
                    }
                    //end of course clo

                    //start of course content
                } else {
                    console.log('No data found');
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to fetch drafts:', error);
            }
        });
    }
    showDrafts();

    // Initialize CKEditor for the textarea with ID 'note'
    if (typeof CKEDITOR !== 'undefined') {
        CKEDITOR.replace('note');
    } else {
        console.error('CKEditor not found');
    }

    $('#file').on('change', function(event) {
        var files = event.target.files;
        var previewContainer = $('#file-preview');
        previewContainer.empty(); // Clear any previous previews

        $.each(files, function(i, file) {
            var fileReader = new FileReader();

            fileReader.onload = function(e) {
                var fileURL = e.target.result;
                var previewElement;

                // console.log(fileURL);


                if (file.type.startsWith('image/')) {
                    previewElement = $('<img>').attr('src', fileURL).css({
                        maxWidth: '300px',
                        maxHeight: '300px',
                        marginRight: '10px',
                        display: 'block',
                        marginBottom: '10px'
                    });
                } else if (file.type === 'application/pdf') {
                    previewElement = $('<embed>').attr('src', fileURL).attr('type',
                        'application/pdf').css({
                        maxWidth: '300px',
                        maxHeight: '300px',
                        marginRight: '10px',
                        display: 'block',
                        marginBottom: '10px'
                    });
                } else if (file.type === 'application/msword' || file.type ===
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ) {
                    previewElement = $('<a>').attr('href', fileURL).attr('download', file
                            .name).html(`<i class="fas fa-file-word"></i> ${file.name}`)
                        .css({
                            marginBottom: '10px',
                            fontSize: '16px'
                        });
                } else {
                    previewElement = $('<a>').attr('href', fileURL).attr('download', file
                            .name)
                        .html(`${file.name}`).css({
                            marginBottom: '10px'
                        });
                }

                previewContainer.append(previewElement);
            };

            fileReader.readAsDataURL(file);
        });
    });

    $('#Note-Submit').on('submit', function(e) {
        e.preventDefault();

        const file_id = url_file_id;
        const note = CKEDITOR.instances['note'].getData();
        const date = $('#date').val();
        const files = $('#file').prop('files');


        const formData = new FormData();
        formData.append('file_id', file_id);
        formData.append('note', note);
        formData.append('date', date);

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        //dynamic values
        var dynamicValues = [];
        $('#append_box_note_content').find('li').each(function(index, element) {
            var dynamicValue = {};
            dynamicValue.date = $('#date').val();

            // Retrieve the unique identifier of the textarea
            var textareaId = $(this).find('textarea').attr('id');

            // Retrieve the value of the textarea using the unique identifier
            dynamicValue.note = CKEDITOR.instances[textareaId].getData();

            // Retrieve the multi files using the unique identifier
            var files = $(this).find('input[type="file"]').prop('files');
            dynamicValue.files = files;

            dynamicValues.push(dynamicValue);
        });

        formData.append('dynamicValues', JSON.stringify(dynamicValues));

        $.ajax({
            url: "<?php echo e(route('initiator-notes.store')); ?>",
            type: 'POST',
            data: formData,
            headers: {
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
            },
            contentType: false,
            processData: false,
            success: function(response) {
                Toastify({
                    text: 'Note submitted successfully.',
                    backgroundColor: 'linear-gradient(to right, #00b09b, #96c93d)',
                    className: 'info',
                }).showToast();
                CKEDITOR.instances['note'].setData('');
                $('#date').val('');
                $('#is_close').val('');
                $('#file').val('');
                window.location.href = "<?php echo e(route('initiator-notes.create')); ?>";
            },
            error: function(xhr, status, error) {
                console.error('Failed to submit note:', error);
                Toastify({
                    text: 'Failed to submit note.',
                    backgroundColor: 'linear-gradient(to right, #ff416c, #ff4b2b)',
                    className: 'info',
                }).showToast();
            }
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\Procurement_final\resources\views/backend/initiator_file/createNote.blade.php ENDPATH**/ ?>