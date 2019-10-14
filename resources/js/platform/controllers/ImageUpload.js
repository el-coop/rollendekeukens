export default class extends window.Controller {

    static get targets() {
        return ["value"]
    }

    connect() {
        this.initialPreview();
    }

    clear(event) {
        if (this.element.querySelector('input').value) {
            event.preventDefault();
            this.initialPreview();
        }
    }

    async change(event) {
        if (!event.target.files[0]) {
            return;
        }

        const image = await this.imageToBlob(event.target.files[0]);
        this.showPreview('data:image/jpeg;base64,' + btoa(image));

    }

    showPreview(src) {
        this.element.querySelector('.image-upload__no-preview-wrapper').classList.add('d-none');
        this.element.querySelector('.image-upload__preview-wrapper').classList.remove('d-none');
        this.element.querySelector('.image-upload__preview-image').src = src;
    }

    initialPreview() {
        this.element.querySelector('input').value = null;
        this.element.querySelector('.image-upload__preview-image').src = '';
        if (this.data.get('url')) {
            return this.showPreview(this.data.get('url'));
        }

        this.element.querySelector('.image-upload__no-preview-wrapper').classList.remove('d-none');
        this.element.querySelector('.image-upload__preview-wrapper').classList.add('d-none');
    }

    imageToBlob(image) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.addEventListener('abort', (error) => {
                reject(error);
            });
            reader.addEventListener('error', (error) => {
                reject(error);
            });
            reader.addEventListener('loadend', (event) => {
                resolve(reader.result);
            });
            reader.readAsBinaryString(image);
        });
    }
}
