$(document).ready(function(){
    let selectedScreenId = null;
    let screenCountInSelectedScreen = null;

    let imageContainer = $('#image_container .row');
    let videoContainer = $('#video_container');
    let fileUploadContainer = $('#file_upload_container');

    let eachImgTagHtml = $('#each_image_container').html();
    let eachVideoTagHtml = $('#each_video_container').html();
    let eachFileInputHtml = $('#each_file_upload_container').html();

    let noImgSrc = $('#no_image_src').val();

    let theAccordion = $('#add_clip_collection_steps').accordion({
        heightStyle: 'content'
    });
    let currentStep = 0;

    $.validator.addMethod("pageRequired", function(value, element) {
        var $element = $(element)

        function match(index) {
            return currentStep === index && $(element).parents("#step_" + (index + 1)).length;
        }
        if (match(0) || match(1) || match(2)) {
            return !this.optional(element);
        }
        return "dependency-mismatch";
    }, $.validator.messages.required)

    let theFormValidator = $("#add_clip_collection_form").validate({
        errorClass: "validation_error",
        onkeyup: false,
        onfocusout: false,
        submitHandler: function() {
            return true;
        }
    });

    $('.step_button').on('click', function(){
        let ths = $(this);
        let dataPageId = parseInt(ths.data('page-id'));
        let dataNextPageId = parseInt(ths.data('next-page-id'));

        if(dataNextPageId < dataPageId){
            //previous button
            theAccordion.accordion("option", "active", dataNextPageId);
            currentStep = dataNextPageId;
        }
        else{
            if (theFormValidator.form()) {
                theAccordion.accordion("option", "active", dataNextPageId);
                currentStep = dataNextPageId;
            }
        }

        if(dataPageId === 0 && dataNextPageId === 1){
            selectedScreenId = $('#screen-collection-id').val();
            screenCountInSelectedScreen = screenCountPerScreen[selectedScreenId];

            let thisFind = [
                'video_name_placeholder',
                'video_label_placeholder',
                'video_id_placeholder',
                'image_name_placeholder',
                'image_id_placeholder',
            ];

            let currentNumberOfInputs = fileUploadContainer.find('.each_file').length;

            if(currentNumberOfInputs){
                if(currentNumberOfInputs > screenCountInSelectedScreen){
                    let allFileInputContainer = fileUploadContainer.find('.each_file');
                    let allImageTagContainer = imageContainer.find('.each_image');
                    let allVideoTagContainer = videoContainer.find('.each_video');
                    for(let i = currentNumberOfInputs - 1; i > screenCountInSelectedScreen - 1; i--){
                        allFileInputContainer[i].remove();
                        allImageTagContainer[i].remove();
                        allVideoTagContainer[i].remove();
                    }
                    if(!imageContainer.find('.each_image.active').length) imageContainer.find('.each_image').eq(0).addClass('active');
                    if(!$('.each_video.active').length) $('.each_video').eq(0).addClass('active');
                    if(!$('.each_file.active').length) $('.each_file').eq(0).addClass('active');
                }
                else{
                    for(let i = currentNumberOfInputs; i < screenCountInSelectedScreen; i++){
                        imageContainer.append(eachImgTagHtml.replace('image_tag_id_placeholder', 'image_tag_'+i));
                        videoContainer.append(eachVideoTagHtml.replace('video_tag_id_placeholder', 'video_tag_'+i));

                        let thisReplaces = [
                            'video_file['+i+']',
                            'Upload video (mp4 only) - '+(i+1),
                            'video_file_'+i,
                            'image_file['+i+']',
                            'image_file_'+i,
                        ];
                        fileUploadContainer.append(eachFileInputHtml.replaceAllArray(thisFind, thisReplaces));
                    }
                }
            }
            else{
                for(let i = 0; i < screenCountInSelectedScreen; i++){
                    imageContainer.append(eachImgTagHtml.replace('image_tag_id_placeholder', 'image_tag_'+i));
                    videoContainer.append(eachVideoTagHtml.replace('video_tag_id_placeholder', 'video_tag_'+i));

                    let thisReplaces = [
                        'video_file['+i+']',
                        'Upload video (mp4 only) - '+(i+1),
                        'video_file_'+i,
                        'image_file['+i+']',
                        'image_file_'+i,
                    ];
                    fileUploadContainer.append(eachFileInputHtml.replaceAllArray(thisFind, thisReplaces));
                }
                imageContainer.find('.each_image').eq(0).addClass('active');
                $('.each_video').eq(0).addClass('active');
                $('.each_file').eq(0).addClass('active');
            }
        }
        if(dataPageId === 1 && dataNextPageId === 2){
            $('#final_image_space .row').html($('#image_container .row').html());
        }
    });

    $(document).on('click', '#image_container .each_image', function(){
        let ths = $(this);
        let thsIndex = ths.index();

        imageContainer.find('.each_image').removeClass('active');
        imageContainer.find('.each_image').eq(thsIndex).addClass('active');

        $('.each_video').removeClass('active');
        $('.each_video').eq(thsIndex).addClass('active');

        $('.each_file').removeClass('active');
        $('.each_file').eq(thsIndex).addClass('active');
    });

    $(document).on('change', '.video_input_field', async function(){
        let ths = $(this);
        let thsIndex = ths.closest('.each_file').index();
        let thsFile = ths[0].files[0];
        let imgTag = $('#image_tag_'+thsIndex);
        let videoTag = $('#video_tag_'+thsIndex);
        let imgInput = $('#image_file_'+thsIndex);
        /*let videoPlayerContainer = ths.closest('.each_video_upload_container').find('.video_player_container');
        let thumbnailContainer = ths.closest('.each_video_upload_container').find('.image_container');
        let thumbnailInput = ths.closest('.each_video_upload_container').find('.thumbnail_input');

        videoPlayerContainer.html('');
        thumbnailContainer.html('');
        thumbnailInput.val('');*/

        imgTag.attr('src', noImgSrc);
        videoTag.attr('src', '');
        imgInput.val('');

        if(thsFile){
            try {
                // get the frame at 1.5 seconds of the video file
                let dataUrl = await getVideoCover(thsFile, 0.2, videoTag[0]);
                // print out the result image blob
                //let videoPlayer = cover[0];
                //let canvas = cover[1];
                // videoPlayerContainer.html('<strong>The Video</strong>');
                // thumbnailContainer.html('<strong>Thumbnail</strong>');
                // videoPlayerContainer.append(videoPlayer);
                // thumbnailContainer.append(canvas);
                //console.log(dataUrl);
                imgInput.val(dataUrl);
                imgTag.attr('src', dataUrl);
            } catch (ex) {
                console.log("ERROR: ", ex);
            }
        }
    });
});
