import vue from "./vue/vue";
import ImageUploadController from "./controllers/ImageUpload";
import EntryOptions from "./controllers/EntryOptions";
import TinyMCE5 from "./controllers/TinyMCE5";

application.register("fields--image-upload", ImageUploadController);
application.register("layouts--entry-options", EntryOptions);
application.register("fields--tinymce5", TinyMCE5);

$(document).on('focusin', function (e) {
    if ($(e.target).closest(".tox-tinymce-aux, .moxman-window, .tam-assetmanager-root").length) {
        e.stopImmediatePropagation();
    }
});
