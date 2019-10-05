import vue from "./vue/vue";
import ImageUploadController from "./controllers/ImageUpload";
import EntryOptions from "./controllers/EntryOptions";

application.register("fields--image-upload", ImageUploadController);
application.register("layouts--entry-options", EntryOptions);

