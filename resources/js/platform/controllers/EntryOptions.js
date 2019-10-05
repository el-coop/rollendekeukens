export default class extends window.Controller {

    connect() {
        const currentValue = this.element.querySelector('.custom-select').value;
        this.forms = this.element.querySelectorAll('.entry-options-form');
        this.toggleForm(currentValue);
    }

    async change(event) {
        const currentValue = this.element.querySelector('.custom-select').value;
        this.toggleForm(currentValue);
    }

    toggleForm(formName) {
        this.forms.forEach((form, index) => {
            if (form.classList.contains(formName)) {
                this.element.appendChild(form);
            } else {
                if(form.parentNode){
                    this.element.removeChild(form);
                }
            }
        });
    }
}
