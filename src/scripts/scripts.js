const block = {
    init() {
        this.form = document.querySelector('form');
        this.submit = document.querySelector('.submit button');
        this.input = document.querySelector('input[name=phone]');
        this.events();
    },
    events() {
        this.input.addEventListener('input', this.mask, false);
        this.input.addEventListener('focus', this.mask, false);
        this.input.addEventListener('blur', this.mask, false);
        this.input.addEventListener('keydown', this.mask, false);
        this.form.addEventListener('submit', (e) => this.submitForm(e), false);
        this.submit.addEventListener('click', (e) => this.submitForm(e), false);
    },
    mask(event) {
        let keyCode;
        if (this.selectionStart < 3) {
            event.preventDefault();
        }
        let matrix = "+7 (___) ___-__-__";
        let i = 0;
        let def = matrix.replace(/\D/g, "");
        let val = this.value.replace(/\D/g, "");
        let new_value = matrix.replace(/[_\d]/g, function (a) {
            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
        });
        i = new_value.indexOf("_");
        if (i !== -1) {
            i < 5 && (i = 3);
            new_value = new_value.slice(0, i)
        }
        let reg = matrix.substring(0, this.value.length).replace(/_+/g, str => {
            return "\\d{1," + str.length + "}"
        }).replace(/[+()]/g, "\\$&");
        reg = new RegExp("^" + reg + "$");
        if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) {
            this.value = new_value;
        }
        if (event.type === "blur" && this.value.length < 5) {
            this.value = ""
        }
    },
    submitForm(event) {
        event.preventDefault();
        let that = this;
        if (!this.input.value || this.input.value.length < 18) {
            return false;
        }
        let data = new FormData(this.form);
        this.request(data)
            .then(res => res.json())
            .then(res => console.log(res))
            .catch(err => console.log(err))
            .finally(() => {
                that.input.value = '';
                that.form.reset();
            });
    },
    async request(data) {
        return await fetch('send_mail.php', {
            method: 'post',
            body: data
        });
    }
}

document.addEventListener('DOMContentLoaded', () => {
    block.init();
});