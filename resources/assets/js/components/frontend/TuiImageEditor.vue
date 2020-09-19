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
                imageSize: {oldWidth: 300, oldHeight: 300, newWidth: 400, newHeight: 400},
                selectionStyle: {
                    cornerSize: 20,
                    rotatingPointOffset: 70
                },
                includeUI: {
                    initMenu: 'text',
                    imageSize: {oldWidth: 200, oldHeight: 200, newWidth: 200, newHeight: 200}
                },
                cssMaxWidth: 700,
                cssMaxHeight: 500
            }
        };
    },
    methods: {
        onTextEditing(pos) {
            console.log('editing text');
        }
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
        var first_editor_button = document.createElement('button');
        first_editor_button.textContent = "First Editor";
        first_editor_button.setAttribute('class', 'tui-cancel-btn');
        document.querySelector('.tui-image-editor-header-logo img').
        replaceWith(first_editor_button);

        // cancel button functionality
        $('.tui-cancel-btn').click(function() {
            var image_src = $this.$refs.tuiImageEditor.invoke('toDataURL');
            $('input[name="edited_featured_image"]').val(image_src);
            $('#featured-image-previewimg').attr('src', image_src);
            $('#tuiEditorModal').hide();
            $('#imageEditorModal').show();
        });

        // save button functionality
        $('.tui-image-editor-save-btn').click(function() {
            var image_src = $this.$refs.tuiImageEditor.invoke('toDataURL');

            $('input[name="edited_featured_image"]').val(image_src);
            $('#featured-image-previewimg').attr('src', image_src);
            $('#tuiEditorModal').hide();
            $('#page-content').show();
        });
      

        document.querySelector('#open_tuiEditor').addEventListener('click',function(event) {
            var featured_image = document.querySelector("#featured-image-previewimg").getAttribute("src");
            $this.$refs.tuiImageEditor.invoke('loadImageFromURL', featured_image, "SampleImage");
            $this.$refs.tuiImageEditor.invoke('ui.activeMenuEvent');
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