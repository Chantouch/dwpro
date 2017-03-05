/**
 * Created by Chantouch on 3/3/2017.
 */
const business = new Vue({
    el: '#qualifications',
    data(){
        return {
            prop: {
                pagination: {
                    type: Object,
                    required: true
                },
                offset: {
                    type: Number,
                    default: 4
                }
            },
            pagination: {},
            offset: 4,
            newItem: {
                'name': '',
                'description': '',
                'status': '',
            },
            fillItem: {
                'name': '',
                'description': '',
                'status': '',
                'id': ''
            },
            items: [],
            formErrors: {},
            formErrorsUpdate: {},
        }
    },
    computed: {
        isActive(){
            return this.pagination.current_page;
        },
        pagesNumber(){
            if (!this.pagination.to) {
                return [];
            }
            let from = this.pagination.current_page - this.offset;
            if (from < 1) {
                from = 1;
            }
            let to = from + (this.offset * 2);
            if (to > this.pagination.last_page) {
                to = this.pagination.last_page;
            }
            let pagesArray = [];
            for (from = 1; from <= to; from++) {
                pagesArray.push(from);
            }
            return pagesArray;
        }
    },
    created(){
        this.fetchItems(this.pagination.current_page);
    },
    methods: {
        fetchItems (page)
        {
            this.$http.get('/api/admin/modules/qualifications?page=' + page).then((response) => {
                this.items = response.data.data;
                this.pagination = response.data;
            });
        },

        createItem(){
            let input = this.newItem;
            this.$http.post('/api/admin/modules/qualifications', input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {
                    'name': '',
                    'description': '',
                    'status': ''
                };
                $('#create-item').modal('hide');
                toastr.success("Item created success fully!", 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            })
        },

        editItem(item){
            let fill = this.fillItem;
            fill.name = item.name;
            fill.description = item.description;
            fill.status = item.status;
            fill.id = item.id;
            $("#edit-item").modal('show');
        },

        updateItem(id){
            let input = this.fillItem;
            this.$http.patch('/api/admin/modules/qualifications/' + id, input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {
                    'name': '',
                    'description': '',
                    'status': '',
                    'id': ''
                };
                $("#edit-item").modal('hide');
                toastr.success('Item successfully updated.', 'Success Alert', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            })
        },

        deleteItem(item){
            let con = confirm("Are you sure to do that?");
            if (con) {
                this.$http.delete('/api/admin/modules/qualifications/' + item.id).then((response) => {
                    this.changePage(this.pagination.current_page);
                    toastr.success("Item deleted successfully.", "Success Alert", {timeOut: 5000});
                });
            }
        },

        changePage(page){
            this.pagination.current_page = page;
            this.fetchItems(page)
        }
    }
});