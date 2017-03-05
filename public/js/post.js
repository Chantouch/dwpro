/**
 * Created by Chantouch on 3/3/2017.
 */
Vue.http.headers.common['X-CSRF-TOKEN'] = $("#token").attr("content");
const app = new Vue({
    el: '#app',
    data(){
        return {
            props: {
                pagination: {
                    type: Object,
                    required: true
                },
                offset: {
                    type: Number,
                    default: 4
                }
            },
            items: [],
            pagination: {},
            offset: 4,
            formErrors: {},
            formErrorsUpdate: {},
            newItem: {'title': '', 'description': ''},
            fillItem: {'title': '', 'description': '', 'id': ''}
        }
    },
    computed: {
        isActived: function () {
            return this.pagination.current_page;
        },
        pagesNumber: function () {
            if (!this.pagination.to) {
                return [];
            }
            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + (this.offset * 2);
            if (to >= this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            let pagesArray = [];
            while (from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    created: function () {
        this.getItems(this.pagination.current_page);
    },
    methods: {
        getItems: function (page) {
            this.$http.get('/posts?page=' + page).then((response) => {
                this.items = response.data.data;
                this.pagination = response.data;
            });
        },
        createItem: function () {
            let input = this.newItem;
            this.$http.post('/posts', input).then((response) => {

                this.changePage(this.pagination.current_page);
                this.newItem = {'title': '', 'description': ''};
                $("#create-item").modal('hide');
                toastr.success('Post Created Successfully.', 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },
        deleteItem: function (item) {
            let con = confirm("Are you sure to do this?");
            if (con) {
                this.$http.delete('/posts/' + item.id).then((response) => {
                    this.changePage(this.pagination.current_page);
                    toastr.success('Post Deleted Successfully.', 'Success Alert', {timeOut: 5000});
                });
            }
        },
        editItem: function (item) {
            this.fillItem.title = item.title;
            this.fillItem.id = item.id;
            this.fillItem.description = item.description;
            $("#edit-item").modal('show');
        },
        updateItem: function (id) {
            let input = this.fillItem;
            this.$http.put('/posts/' + id, input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {'title': '', 'description': '', 'id': ''};
                $("#edit-item").modal('hide');
                toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },
        changePage: function (page) {
            this.pagination.current_page = page;
            this.getItems(page);
        }
    }
});