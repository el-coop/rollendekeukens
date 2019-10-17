// Core
import tinymce from 'tinymce';

// A theme is also required
// import 'tinymce/themes/modern';
// import 'tinymce/themes/inlite'

// Plugins

/*
import 'tinymce/plugins/advlist'
import 'tinymce/plugins/anchor'
import 'tinymce/plugins/autolink'
import 'tinymce/plugins/autoresize'
import 'tinymce/plugins/autosave'
import 'tinymce/plugins/bbcode'
import 'tinymce/plugins/charmap'
import 'tinymce/plugins/code'
import 'tinymce/plugins/codesample'
import 'tinymce/plugins/colorpicker'
import 'tinymce/plugins/contextmenu'
import 'tinymce/plugins/directionality'
import 'tinymce/plugins/emoticons'
import 'tinymce/plugins/fullpage'
import 'tinymce/plugins/fullscreen'
import 'tinymce/plugins/help'
import 'tinymce/plugins/hr'
import 'tinymce/plugins/image'
import 'tinymce/plugins/imagetools'
import 'tinymce/plugins/importcss'
import 'tinymce/plugins/insertdatetime'
import 'tinymce/plugins/legacyoutput'
import 'tinymce/plugins/link'
import 'tinymce/plugins/lists'
import 'tinymce/plugins/media'
import 'tinymce/plugins/nonbreaking'
import 'tinymce/plugins/noneditable'
import 'tinymce/plugins/pagebreak'
import 'tinymce/plugins/paste'
import 'tinymce/plugins/preview'
import 'tinymce/plugins/print'
import 'tinymce/plugins/save'
import 'tinymce/plugins/searchreplace'
import 'tinymce/plugins/spellchecker'
import 'tinymce/plugins/tabfocus'
import 'tinymce/plugins/table'
import 'tinymce/plugins/template'
import 'tinymce/plugins/textcolor'
import 'tinymce/plugins/textpattern'
import 'tinymce/plugins/toc'
import 'tinymce/plugins/visualblocks'
import 'tinymce/plugins/visualchars'
import 'tinymce/plugins/wordcount'
*/

export default class extends window.Controller {
    /**
     *
     */
    connect() {

        tinymce.baseURL = '/js';

        const selector = this.element.querySelector('.tinymce').id;
        const input = this.element.querySelector('input');

        // for remove cache
        tinymce.remove(`#${selector}`);

        tinymce.init({
            branding: false,
            selector: `#${selector}`,
            min_height: 300,
            height: 300,
            max_height: 600,
            plugins: 'quickbars table',
            toolbar: '',
            hidden_input: false,
            menubar: false,
            quickbars_insert_toolbar: 'table',
            quickbars_selection_toolbar:
                'bold italic | quicklink h2 h3 | alignleft aligncenter alignright alignjustify | outdent indent | removeformat forecolor',
            table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
            inline: true,
            convert_urls: false,
            setup: (element) => {
                element.on('change', () => {
                    $(input).val(element.getContent());
                });
            },
        });
    }

    disconnect() {
        tinymce.remove(`#${this.element.querySelector('.tinymce').id}`);
    }
}
