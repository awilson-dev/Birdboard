import axios from "axios";

class BirdboardForm {
    constructor(data) {
        this.originalData = JSON.parse(JSON.stringify(data));

        Object.assign(this, data);

        this.errors = {};
        this.submitted = false;
    }

    data() {
        let data = {};

        for (let attribute in this.originalData) {
            data[attribute] = this[attribute];
        }

        return data;
    }

    post(endpoint) {
        return this.submit(endpoint);
    }

    patch(endpoint) {
        return this.submit(endpoint, 'patch');
    }

    delete(endpoint) {
        return this.submit(endpoint, 'delete');
    }

    submit(endpoint, requestType = 'post') {
        var data = this.data();

        for (let i = data.tasks.length - 1; i >= 0; i--) {
            if (!data.tasks[i].body) {
                data.tasks.splice(i, 1);
            }
        }

        return axios[requestType](endpoint, data)
            .catch(this.onFail.bind(this))
            .then(this.onSuccess.bind(this));

        // return axios.post(endpoint, this.data())
        //     .catch(this.onFail.bind(this));
    }

    onSuccess(response) {
        this.submitted = true;
        this.errors = {};

        return response;
    }

    onFail(error) {
        this.errors = error.response.data.errors;
        this.submitted = false;

        throw error;
    }

    reset() {
        Object.assign(this, this.originalData);
    }
}

export default BirdboardForm;