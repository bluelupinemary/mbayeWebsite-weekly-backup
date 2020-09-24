<template>
    <div class="imageEditorApp">
        <tui-image-editor ref="tuiImageEditor" :include-ui="useDefaultUI" :options="options"></tui-image-editor>
    </div>
</template>

<script>
// To use the basic UI, the svg files for the icons is required.
import 'tui-image-editor/dist/svg/icon-a.svg';
import 'tui-image-editor/dist/svg/icon-b.svg';
import 'tui-image-editor/dist/svg/icon-c.svg';
import 'tui-image-editor/dist/svg/icon-d.svg';

// Load Style Code
import 'tui-image-editor/dist/tui-image-editor.css';
import 'tui-color-picker/dist/tui-color-picker.min.css';
import {ImageEditor} from '@toast-ui/vue-image-editor';

export default {
    props: {
        edit_blog: Number
    },
    components: {
        'tui-image-editor': ImageEditor
    },
    data() {
        return {
            useDefaultUI: true,
            options: { // for tui-image-editor component's "options" prop
                imageSize: {oldWidth: 200, oldHeight: 200, newWidth: 200, newHeight: 200},
                selectionStyle: {
                    cornerSize: 5,
                    rotatingPointOffset: 70
                },
                includeUI: {
                    initMenu: 'text',
                    imageSize: {oldWidth: 200, oldHeight: 200, newWidth: 200, newHeight: 200},
                    uiSize: {
                        width: '100%',
                        height: '100%'
                    },
                },
                cssMaxWidth: (window.innerWidth < 991 && window.innerHeight < 991 ? (screen.width < screen.height ? screen.height : screen.width) : 500),
                cssMaxHeight: (window.innerWidth < 991 && window.innerHeight < 991 ? (screen.width < screen.height ? (screen.width - 135) : (screen.height - 135)) : 500)
            }
        };
    },
    methods: {
        onTextEditing(pos) {
            console.log('editing text');
        },
        // onMouseDown() {
        //     console.log('mousedown');
        //     // $('.tui-image-editor-main .tui-image-editor-submenu').hide();
        // },
    },
    mounted() {
        var $this = this;

        // replace download button
        var save_button = document.createElement('button');
        save_button.textContent = "Save";
        save_button.setAttribute('class', 'tui-image-editor-save-btn');
        document.querySelector('.tui-image-editor-header-buttons .tui-image-editor-download-btn').
        replaceWith(save_button);

        // replace logo with cancel button
        var cancel_button = document.createElement('button');
        cancel_button.textContent = "Cancel";
        cancel_button.setAttribute('class', 'tui-image-editor-cancel-btn');
        document.querySelector('.tui-image-editor-header-logo img').
        replaceWith(cancel_button);

        // cancel button functionality
        $('.tui-image-editor-cancel-btn').click(function() {
            $('#photoEditorModal').modal('hide');
        });

        // save button functionality
        $('.tui-image-editor-save-btn').click(function() {
            var image_src = $this.$refs.tuiImageEditor.invoke('toDataURL');

            $('.main-form input[name="edited_featured_image"]').val(image_src);
            $('.all-blog #featured-image-previewimg').attr('src', image_src);
            $('#photoEditorModal').modal('hide').fadeOut();
        });
        
        // load image on change of featured image input file
        document.querySelector('#featured_image').addEventListener('change',function(event) {
            const file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    let actions = $this.$refs.tuiImageEditor.invoke('getActions');
                    actions.main.initLoadImage(e.target.result, 'My sample image').then(result => {
                        console.log(result);
                        $this.$refs.tuiImageEditor.invoke('ui.resizeEditor', {imageSize: result});
                    });
                    $this.$refs.tuiImageEditor.invoke('ui.activeMenuEvent');
                };
                reader.readAsDataURL(file);
            }
        });

        document.querySelector('.edit_image').addEventListener('click',function(event) {
             var featured_image = document.querySelector("#featured-image-previewimg").getAttribute("src");

            $this.$refs.tuiImageEditor.invoke('loadImageFromURL', featured_image, "SampleImage");
            $this.$refs.tuiImageEditor.invoke('ui.activeMenuEvent');
        });

        // on editing blog
        // on load of featured image preview image load image to editor as well
        document.querySelector("#featured-image-previewimg").addEventListener('load', function() {
            if($this.edit_blog) {
                var featured_image = document.querySelector("#featured-image-previewimg").getAttribute("src");

                $this.$refs.tuiImageEditor.invoke('loadImageFromURL', featured_image, "SampleImage");
                $this.$refs.tuiImageEditor.invoke('ui.activeMenuEvent');
                $('.edit_image').removeAttr('disabled');
            }
        });

        $('.tui-image-editor-wrap').on('mousedown, touchstart', function() {
            $('.tui-image-editor-main .tui-image-editor-submenu').hide();
        });

        $('.tui-image-editor-wrap').on('mouseup, touchend', function() {
            $('.tui-image-editor-main .tui-image-editor-submenu').css('display', 'table');
        });

        $(".tui-image-editor-menu").on('click', 'li', function() {
            if($(this).hasClass('active')) {
                $('.tui-image-editor-submenu-style').css('background-color', '#1e1e1e');
                
            } else {
                $('.tui-image-editor-submenu-style').css('background-color', 'transparent');
            }
            
        });
    }
}
</script>

<style scoped>
.imageEditorApp {
    width: 100%;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
}
</style>