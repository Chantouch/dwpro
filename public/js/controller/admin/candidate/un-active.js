/**
 * Created by Chantouch on 3/3/2017.
 */
const business = new Vue({
    el: '#un_active',
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
                'first_name': '',
                'last_name': '',
                'status': '',
                'id': '',
                'email': '',
                'phone_number': '',
                'data_of_birth': ''
            },
            fillItem: {
                'first_name': '',
                'last_name': '',
                'status': '',
                'id': '',
                'email': '',
                'phone_number': '',
                'data_of_birth': ''
            },
            candidates: [],
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
        this.fetchCandidates(this.pagination.current_page);
    },
    methods: {
        fetchCandidates (page)
        {
            this.$http.get('/api/admin/candidates/get-un-active-candidate?page=' + page).then((response) => {
                this.candidates = response.data.data;
                this.pagination = response.data;
            });
        },

        createItem(){
            let input = this.newItem;
            this.$http.post('/api/admin/candidates', input).then((response) => {
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

        editItem(data){
            let fill = this.fillItem;
            fill.first_name = data.first_name;
            fill.last_name = data.last_name;
            fill.email = data.email;
            fill.status = data.status;
            fill.id = data.id;
            fill.phone_number = data.phone_number;
            fill.data_of_birth = data.data_of_birth;
            $("#edit-item").modal('show');
        },

        updateItem(id){
            let input = this.fillItem;
            this.$http.patch('/api/admin/candidates/' + id, input).then((response) => {
                this.changePage(this.pagination.current_page);
                this.newItem = {
                    'first_name': '',
                    'last_name': '',
                    'status': '',
                    'id': '',
                    'email': '',
                    'phone_number': '',
                    'data_of_birth': ''
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
                this.$http.delete('/api/admin/candidates/' + item.id).then((response) => {
                    this.changePage(this.pagination.current_page);
                    toastr.success("Item deleted successfully.", "Success Alert", {timeOut: 5000});
                });
            }
        },

        changePage(page){
            this.pagination.current_page = page;
            this.fetchCandidates(page)
        }
    }
});